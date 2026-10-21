@extends('tata_letak.utama')
@section('title', 'Data Pengguna')
@section('content')
<div class="container" style="max-width:1100px;margin:32px auto;padding:0 18px">
    <h1>Data Pengguna</h1>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <section style="padding:20px;background:#fff;border-radius:12px;margin:20px 0">
        <h2>Tambah Pengguna</h2>
        <form method="POST" action="{{ route('pengguna.simpan') }}">
            @csrf
            <p><label>Nama<br><input name="name" value="{{ old('name') }}" required maxlength="120"></label></p>
            <p><label>Email<br><input type="email" name="email" value="{{ old('email') }}" required></label></p>
            <p><label>Kata sandi (minimal 8 karakter)<br><input type="password" name="password" required minlength="8"></label></p>
            <p><label>Peran<br><select name="role" required><option value="masyarakat">Masyarakat</option><option value="uptd">UPTD</option><option value="supir">Supir</option><option value="admin">Admin</option></select></label></p>
            <p><label>Wilayah<br><select name="id_wilayah"><option value="">Tidak ditentukan</option>@foreach($wilayah as $w)<option value="{{ $w->id_wilayah }}">{{ $w->nama_wilayah }}</option>@endforeach</select></label></p>
            <button type="submit">Simpan Pengguna</button>
        </form>
    </section>
    <h2>Daftar Akun</h2>
    <div style="overflow:auto"><table style="width:100%;border-collapse:collapse;background:#fff"><thead><tr><th style="text-align:left;padding:10px">Nama</th><th style="text-align:left;padding:10px">Email</th><th style="text-align:left;padding:10px">Peran</th><th style="text-align:left;padding:10px">Wilayah</th><th style="text-align:left;padding:10px">Status</th></tr></thead><tbody>
    @forelse($users as $u)<tr><td style="padding:10px">{{ $u->name }}</td><td style="padding:10px">{{ $u->email }}</td><td style="padding:10px">{{ strtoupper($u->role ?? '-') }}</td><td style="padding:10px">{{ $u->wilayah->nama_wilayah ?? '-' }}</td><td style="padding:10px">{{ ($u->status_aktif ?? true) ? 'Aktif' : 'Tidak aktif' }}</td></tr>@empty<tr><td colspan="5" style="padding:10px">Belum ada data pengguna.</td></tr>@endforelse
    </tbody></table></div>
    <div style="margin-top:18px">{{ $users->links() }}</div>
</div>
@endsection
