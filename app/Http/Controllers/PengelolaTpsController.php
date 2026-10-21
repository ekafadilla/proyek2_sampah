<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Pengguna;
use App\Models\Wilayah;
use App\Models\Tps;
use App\Models\Laporan;
use App\Models\RiwayatStatus;
use App\Models\Penugasan;
use App\Models\FotoLaporan;



class PengelolaTpsController extends Controller
{
    public function home()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        $tps = Tps::with('wilayah')
            ->where('status_aktif', true)
            ->orderBy('nama_tps')
            ->limit(4)
            ->get();

        $wilayah = Wilayah::orderBy('nama_wilayah')->get();

        $stats = [
            'total' => Tps::where('status_aktif', true)->count(),
            'menunggu' => 0,
            'diproses' => 0,
            'selesai' => 0,
        ];

        $laporan = collect();

        return view('beranda', compact(
            'tps',
            'wilayah',
            'stats',
            'laporan'
        ));
    }

    public function login()
    {
        return view('autentikasi.masuk');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->status_aktif) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors([
                        'email' => 'Akun tidak aktif. Hubungi administrator.',
                    ])
                    ->onlyInput('email');
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors([
                'email' => 'Email atau kata sandi tidak sesuai.',
            ])
            ->onlyInput('email');
    }

    public function register()
    {
        return view('autentikasi.daftar', [
            'wilayah' => Wilayah::orderBy('nama_wilayah')->get(),
        ]);
    }

    public function storeRegister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_hp' => 'nullable|string|max:25',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'masyarakat';
        $data['status_aktif'] = true;

        Pengguna::create($data);

        return redirect()
            ->route('login')
            ->with('success', 'Akun berhasil dibuat. Silakan masuk.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function allow(array $roles)
    {
        abort_unless(
            auth()->check()
            && in_array(auth()->user()->role, $roles),
            403,
            'Anda tidak memiliki akses ke halaman ini.'
        );
    }

    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $query = Laporan::query();

        if ($user->role === 'masyarakat') {
            $query->where('id_pelapor', $user->id);
        } elseif ($user->role === 'uptd') {
            $query->where(function ($q) use ($user) {
                $q->where('id_uptd', $user->id);

                if ($user->id_wilayah) {
                    $q->orWhereHas('tps', function ($tpsQuery) use ($user) {
                        $tpsQuery->where(
                            'id_wilayah',
                            $user->id_wilayah
                        );
                    });
                }
            });
        } elseif ($user->role === 'supir') {
            $query->whereHas('penugasan', function ($q) use ($user) {
                $q->where('id_supir', $user->id);
            });
        }

        $laporan = (clone $query)
            ->with(['pelapor', 'tps'])
            ->latest()
            ->take(8)
            ->get();

        $stats = [
            'total' => (clone $query)->count(),
            'menunggu' => (clone $query)
                ->where('status', 'menunggu')
                ->count(),
            'diproses' => (clone $query)
                ->whereIn('status', [
                    'diverifikasi',
                    'diproses',
                    'ditangani',
                ])
                ->count(),
            'selesai' => (clone $query)
                ->where('status', 'selesai')
                ->count(),
        ];

        return view('dashboard', compact('laporan', 'stats'));
    }

    public function reports(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        $query = Laporan::with(['pelapor', 'tps', 'foto']);

        if ($user->role === 'masyarakat') {
            $query->where('id_pelapor', $user->id);
        } elseif ($user->role === 'uptd') {
            $query->where(function ($q) use ($user) {
                $q->where('id_uptd', $user->id);

                if ($user->id_wilayah) {
                    $q->orWhereHas('tps', function ($tpsQuery) use ($user) {
                        $tpsQuery->where(
                            'id_wilayah',
                            $user->id_wilayah
                        );
                    });
                }
            });
        } elseif ($user->role === 'supir') {
            $query->whereHas('penugasan', function ($q) use ($user) {
                $q->where('id_supir', $user->id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $laporan = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('laporan.daftar', compact('laporan'));
    }

    public function createReport()
    {
        $this->allow(['masyarakat']);

        $tps = Tps::where('status_aktif', true)
            ->orderBy('nama_tps')
            ->get();

        return view('laporan.buat', compact('tps'));
    }

    public function storeReport(Request $request)
    {
        $this->allow(['masyarakat']);

        $data = $request->validate([
            'kategori_masalah' => [
                'required',
                'in:TPS penuh,Sampah meluber,Sampah menumpuk,Kondisi lainnya',
            ],
            'tingkat_kondisi' => [
                'required',
                'in:hampir penuh,penuh,meluber',
            ],
            'keterangan' => 'required|string|max:2000',
            'id_tps' => 'nullable|exists:tps,id_tps',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data['id_pelapor'] = auth()->id();
        $data['status'] = 'menunggu';
        $data['waktu_lapor'] = now();

        $data['tingkat_urgensi'] =
            $data['tingkat_kondisi'] === 'meluber'
                ? 'sangat tinggi'
                : (
                    $data['tingkat_kondisi'] === 'penuh'
                        ? 'tinggi'
                        : 'sedang'
                );

        $laporan = DB::transaction(function () use ($data, $request) {
            $laporanData = collect($data)
                ->except('foto')
                ->all();

            $laporan = Laporan::create($laporanData);

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')
                    ->store('laporan', 'public');

                FotoLaporan::create([
                    'id_laporan' => $laporan->id_laporan,
                    'nama_file' => $path,
                    'jenis_foto' => 'bukti',
                ]);
            }

            RiwayatStatus::create([
                'id_laporan' => $laporan->id_laporan,
                'status' => 'menunggu',
                'catatan' => 'Laporan dibuat oleh masyarakat.',
                'id_pengguna' => auth()->id(),
            ]);

            return $laporan;
        });

        return redirect()
            ->route('laporan.detail', $laporan->id_laporan)
            ->with('success', 'Laporan berhasil dikirim.');
    }

    public function showReport(Laporan $laporan)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($user->role === 'masyarakat') {
            abort_unless(
                $laporan->id_pelapor == $user->id,
                403
            );
        }

        if ($user->role === 'supir') {
            $ditugaskan = Penugasan::where(
                'id_laporan',
                $laporan->id_laporan
            )
                ->where('id_supir', $user->id)
                ->exists();

            abort_unless($ditugaskan, 403);
        }

        $laporan->load([
            'pelapor',
            'tps.wilayah',
            'foto',
            'riwayat',
            'penugasan.supir',
        ]);

        return view('laporan.detail', compact('laporan'));
    }

    public function updateReport(Request $request, Laporan $laporan)
    {
        $this->allow(['admin', 'uptd']);

        $data = $request->validate([
            'status' => 'required|in:diverifikasi,diproses,ditangani,selesai,ditolak',
            'tingkat_urgensi' => 'required|in:rendah,sedang,tinggi,sangat tinggi',
            'catatan' => 'nullable|string|max:2000',
            'id_tps' => 'nullable|exists:tps,id_tps',
        ]);

        $laporan->update([
            'status' => $data['status'],
            'tingkat_urgensi' => $data['tingkat_urgensi'],
            'id_tps' => $data['id_tps'] ?? $laporan->id_tps,
        ]);

        RiwayatStatus::create([
            'id_laporan' => $laporan->id_laporan,
            'status' => $data['status'],
            'catatan' => $data['catatan'] ?? null,
            'id_pengguna' => auth()->id(),
        ]);

        return back()->with('success', 'Status laporan diperbarui.');
    }

    public function assign(Request $request, Laporan $laporan)
    {
        $this->allow(['admin', 'uptd']);

        $data = $request->validate([
            'id_supir' => 'required|exists:users,id',
            'id_armada' => 'nullable|exists:armada,id_armada',
        ]);

        Penugasan::updateOrCreate(
            ['id_laporan' => $laporan->id_laporan],
            [
                'id_supir' => $data['id_supir'],
                'id_armada' => $data['id_armada'] ?? null,
                'waktu_ditugaskan' => now(),
            ]
        );

        $laporan->update(['status' => 'diproses']);

        RiwayatStatus::create([
            'id_laporan' => $laporan->id_laporan,
            'status' => 'diproses',
            'catatan' => 'Laporan ditugaskan kepada supir.',
            'id_pengguna' => auth()->id(),
        ]);

        return back()->with('success', 'Penugasan berhasil disimpan.');
    }

    public function myTasks()
    {
        $this->allow(['supir']);

        $laporan = Laporan::with([
            'tps',
            'pelapor',
            'penugasan.armada',
        ])
            ->whereHas('penugasan', function ($q) {
                $q->where('id_supir', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('laporan.daftar', compact('laporan'));
    }

    public function taskUpdate(Request $request, Laporan $laporan)
    {
        $this->allow(['supir']);

        $task = Penugasan::where(
            'id_laporan',
            $laporan->id_laporan
        )
            ->where('id_supir', auth()->id())
            ->firstOrFail();

        $data = $request->validate([
            'status' => 'required|in:ditangani,selesai',
            'keterangan_hasil' => 'nullable|string|max:2000',
        ]);

        $task->update([
            'waktu_mulai' => $task->waktu_mulai ?? now(),
            'waktu_selesai' => $data['status'] === 'selesai'
                ? now()
                : null,
            'keterangan_hasil' => $data['keterangan_hasil'] ?? null,
        ]);

        $laporan->update(['status' => $data['status']]);

        RiwayatStatus::create([
            'id_laporan' => $laporan->id_laporan,
            'status' => $data['status'],
            'catatan' => $data['keterangan_hasil']
                ?? 'Status diperbarui oleh supir.',
            'id_pengguna' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Perkembangan tugas berhasil diperbarui.'
        );
    }

    public function tpsIndex(Request $request)
    {
        $query = Tps::with('wilayah')
            ->where('status_aktif', true);

        if ($request->filled('q')) {
            $keyword = $request->input('q');

            $query->where(function ($q) use ($keyword) {
                $q->where('nama_tps', 'like', "%{$keyword}%")
                    ->orWhere('alamat', 'like', "%{$keyword}%")
                    ->orWhereHas('wilayah', function ($w) use ($keyword) {
                        $w->where(
                            'nama_wilayah',
                            'like',
                            "%{$keyword}%"
                        );
                    });
            });
        }

        if ($request->filled('wilayah')) {
            $query->where('id_wilayah', $request->input('wilayah'));
        }

        $tps = $query
            ->orderBy('nama_tps')
            ->paginate(10)
            ->withQueryString();

        $wilayah = Wilayah::orderBy('nama_wilayah')->get();

        return view('data_tps.daftar', compact('tps', 'wilayah'));
    }

    public function tpsStore(Request $request)
    {
        $this->allow(['admin']);

        $data = $request->validate([
            'nama_tps' => 'required|string|max:150',
            'alamat' => 'required|string|max:500',
            'id_wilayah' => 'required|exists:wilayah,id_wilayah',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        Tps::create($data);

        return back()->with('success', 'Data TPS ditambahkan.');
    }

    public function users()
    {
        $this->allow(['admin']);

        $users = Pengguna::with('wilayah')
            ->latest()
            ->paginate(12);

        $wilayah = Wilayah::orderBy('nama_wilayah')->get();

        return view('pengguna.daftar', compact('users', 'wilayah'));
    }

    public function userStore(Request $request)
    {
        $this->allow(['admin']);

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,uptd,supir,masyarakat',
            'id_wilayah' => 'nullable|exists:wilayah,id_wilayah',
        ]);

        $data['password'] = Hash::make($data['password']);

        Pengguna::create($data);

        return back()->with('success', 'Akun berhasil ditambahkan.');
    }

    public function recap()
    {
        $this->allow(['admin', 'uptd']);

        $query = Laporan::with('tps.wilayah');

        if (
            auth()->user()->role === 'uptd'
            && auth()->user()->id_wilayah
        ) {
            $query->whereHas('tps', function ($q) {
                $q->where(
                    'id_wilayah',
                    auth()->user()->id_wilayah
                );
            });
        }

        $rows = (clone $query)
            ->selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        $laporan = $query->latest()->paginate(12);

        return view(
            'laporan.rekapitulasi',
            compact('rows', 'laporan')
        );
    }
    // Alias metode agar sesuai dengan nama route dan form pada Blade.
    public function formLogin()
    {
        return $this->login();
    }

    public function prosesLogin(Request $request)
    {
        return $this->authenticate($request);
    }

    public function formRegister()
    {
        return $this->register();
    }

    public function prosesRegister(Request $request)
    {
        return $this->storeRegister($request);
    }

    public function dataTps(Request $request)
    {
        return $this->tpsIndex($request);
    }

    public function simpanTps(Request $request)
    {
        return $this->tpsStore($request);
    }

    public function buatLaporan()
    {
        return $this->createReport();
    }

    public function simpanLaporan(Request $request)
    {
        return $this->storeReport($request);
    }

    public function laporanSaya(Request $request)
    {
        return $this->reports($request);
    }

    public function detailLaporan(Laporan $laporan)
    {
        return $this->showReport($laporan);
    }

    public function ubahStatusLaporan(Request $request, Laporan $laporan)
    {
        return $this->updateReport($request, $laporan);
    }

    public function tugaskanLaporan(Request $request, Laporan $laporan)
    {
        return $this->assign($request, $laporan);
    }

    public function tugasSaya()
    {
        return $this->myTasks();
    }

    public function ubahStatusTugas(Request $request, Laporan $laporan)
    {
        return $this->taskUpdate($request, $laporan);
    }

    public function pengguna()
    {
        return $this->users();
    }

    public function simpanPengguna(Request $request)
    {
        return $this->userStore($request);
    }

    public function rekapitulasi()
    {
        return $this->recap();
    }

    public function laporan()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return $this->reports(request());
    }
}

