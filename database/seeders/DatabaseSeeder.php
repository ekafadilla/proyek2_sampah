<?php
namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Wilayah;
use App\Models\Tps;
use App\Models\Laporan;
use App\Models\RiwayatStatus;
use App\Models\Penugasan;
use App\Models\Armada;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $wilayah = Wilayah::firstOrCreate(['nama_wilayah' => 'Indramayu']);

        $akun = [
            ['email'=>'admin@pantautps.test','name'=>'Administrator DLH','password'=>'Admin12345!','role'=>'admin'],
            ['email'=>'uptd@pantautps.test','name'=>'Petugas UPTD Indramayu','password'=>'Uptd12345!','role'=>'uptd'],
            ['email'=>'supir@pantautps.test','name'=>'Ahmad Fauzi','password'=>'Supir12345!','role'=>'supir'],
            ['email'=>'masyarakat@pantautps.test','name'=>'Amanda Zulfa','password'=>'Warga12345!','role'=>'masyarakat'],
            ['email'=>'warga2@pantautps.test','name'=>'Rizky Ramadhan','password'=>'Warga12345!','role'=>'masyarakat'],
            ['email'=>'warga3@pantautps.test','name'=>'Siti Nurhaliza','password'=>'Warga12345!','role'=>'masyarakat'],
        ];
        foreach ($akun as $data) {
            $email = $data['email'];
            Pengguna::firstOrCreate(['email'=>$email], [
                'name'=>$data['name'], 'password'=>Hash::make($data['password']), 'role'=>$data['role'],
                'id_wilayah'=>$data['role']==='uptd' ? $wilayah->id_wilayah : null,
                'status_aktif'=>true,
            ]);
        }
        $admin = Pengguna::where('email','admin@pantautps.test')->first();
        $uptd = Pengguna::where('email','uptd@pantautps.test')->first();
        $supir = Pengguna::where('email','supir@pantautps.test')->first();
        $warga = Pengguna::where('email','masyarakat@pantautps.test')->first();
        $warga2 = Pengguna::where('email','warga2@pantautps.test')->first();
        $warga3 = Pengguna::where('email','warga3@pantautps.test')->first();

        $dataTps = [
            ['nama_tps'=>'TPS Pasar Baru','alamat'=>'Jl. Pasar Baru, Kecamatan Indramayu','latitude'=>-6.3268,'longitude'=>108.3201],
            ['nama_tps'=>'TPS Karanganyar','alamat'=>'Jl. Karanganyar, Kecamatan Indramayu','latitude'=>-6.3372,'longitude'=>108.3258],
            ['nama_tps'=>'TPS Haurgeulis','alamat'=>'Jl. Raya Haurgeulis, Kabupaten Indramayu','latitude'=>-6.4624,'longitude'=>107.9360],
            ['nama_tps'=>'TPS Karangampel','alamat'=>'Jl. Raya Karangampel, Kabupaten Indramayu','latitude'=>-6.4592,'longitude'=>108.4490],
            ['nama_tps'=>'TPS Jatibarang','alamat'=>'Jl. Mayor Dasuki, Jatibarang, Indramayu','latitude'=>-6.4741,'longitude'=>108.3031],
            ['nama_tps'=>'TPS Sindang','alamat'=>'Jl. Raya Sindang, Kabupaten Indramayu','latitude'=>-6.3370,'longitude'=>108.3050],
            ['nama_tps'=>'TPS Margadadi','alamat'=>'Kelurahan Margadadi, Kecamatan Indramayu','latitude'=>-6.3275,'longitude'=>108.3214],
        ];
        $tpsList = [];
        foreach ($dataTps as $row) {
            $tpsList[] = Tps::firstOrCreate(['nama_tps'=>$row['nama_tps']], $row + ['id_wilayah'=>$wilayah->id_wilayah,'status_aktif'=>true]);
        }
        $armada = Armada::firstOrCreate(['plat_nomor'=>'E 1234 XX'],['jenis_armada'=>'Truk pengangkut','status_tersedia'=>'tersedia']);
        Armada::firstOrCreate(['plat_nomor'=>'E 5678 YY'],['jenis_armada'=>'Truk bak terbuka','status_tersedia'=>'tersedia']);

        $contohLaporan = [
            ['TPS Pasar Baru',$warga,'TPS penuh','penuh','tinggi','Sampah sudah menumpuk sejak pagi dan tempat penampungan hampir tidak dapat menampung sampah tambahan.','menunggu'],
            ['TPS Jatibarang',$warga2,'Sampah meluber','meluber','sangat tinggi','Sampah meluber ke sisi jalan dan mulai mengganggu akses warga.','diproses'],
            ['TPS Karanganyar',$warga3,'Sampah menumpuk','penuh','tinggi','Perlu pengangkutan karena tumpukan sampah sudah melewati batas bak.','ditangani'],
            ['TPS Haurgeulis',$warga,'TPS penuh','penuh','sedang','Kapasitas TPS hampir penuh. Mohon dijadwalkan pengangkutan berikutnya.','selesai'],
            ['TPS Karangampel',$warga2,'Kondisi lainnya','hampir penuh','rendah','Kondisi TPS perlu dipantau, kapasitas mulai mendekati penuh.','selesai'],
            ['TPS Sindang',$warga3,'Sampah meluber','meluber','sangat tinggi','Sampah keluar dari area bak dan perlu segera ditangani petugas.','diproses'],
            ['TPS Margadadi',$warga,'Sampah menumpuk','penuh','tinggi','Terdapat tumpukan di samping tempat penampungan.','diverifikasi'],
            ['TPS Pasar Baru',$warga2,'TPS penuh','penuh','sedang','Laporan susulan untuk pemantauan kondisi TPS Pasar Baru.','selesai'],
            ['TPS Jatibarang',$warga3,'Sampah menumpuk','penuh','tinggi','Perlu pengangkutan lanjutan untuk mencegah sampah meluber.','ditolak'],
            ['TPS Karanganyar',$warga,'Kondisi lainnya','hampir penuh','rendah','Mohon dilakukan pemeriksaan berkala pada lokasi ini.','menunggu'],
        ];
        foreach ($contohLaporan as $i=>$row) {
            [$namaTps,$pelapor,$kategori,$kondisi,$urgensi,$ket,$status] = $row;
            $tps = collect($tpsList)->firstWhere('nama_tps',$namaTps);
            $laporan = Laporan::firstOrCreate(['keterangan'=>$ket], [
                'kategori_masalah'=>$kategori,'tingkat_kondisi'=>$kondisi,'tingkat_urgensi'=>$urgensi,
                'status'=>$status,'id_pelapor'=>$pelapor->id,'id_tps'=>$tps->id_tps,'id_uptd'=>$uptd->id,
                'latitude'=>$tps->latitude,'longitude'=>$tps->longitude,
                'waktu_lapor'=>now()->subDays(9-$i)->setTime(8+($i%8),15),
                'alasan_ditolak'=>$status==='ditolak'?'Laporan ganda, lokasi telah tercakup dalam laporan sebelumnya.':null,
            ]);
            if (!RiwayatStatus::where('id_laporan',$laporan->id_laporan)->exists()) {
                RiwayatStatus::create(['id_laporan'=>$laporan->id_laporan,'status'=>'menunggu','catatan'=>'Laporan diterima oleh sistem.','id_pengguna'=>$pelapor->id,'waktu_status'=>$laporan->waktu_lapor]);
                if ($status!=='menunggu') RiwayatStatus::create(['id_laporan'=>$laporan->id_laporan,'status'=>$status,'catatan'=>'Data contoh untuk demonstrasi sistem.','id_pengguna'=>$uptd->id,'waktu_status'=>$laporan->waktu_lapor->copy()->addHours(2)]);
            }
            if (in_array($status,['diproses','ditangani','selesai']) && !Penugasan::where('id_laporan',$laporan->id_laporan)->exists()) {
                Penugasan::create(['id_laporan'=>$laporan->id_laporan,'id_supir'=>$supir->id,'id_armada'=>$armada->id_armada,'waktu_ditugaskan'=>$laporan->waktu_lapor->copy()->addHours(2),'waktu_mulai'=>in_array($status,['ditangani','selesai'])?$laporan->waktu_lapor->copy()->addHours(3):null,'waktu_selesai'=>$status==='selesai'?$laporan->waktu_lapor->copy()->addHours(5):null,'keterangan_hasil'=>$status==='selesai'?'Pengangkutan selesai (data contoh).':null]);
            }
        }
    }
}
