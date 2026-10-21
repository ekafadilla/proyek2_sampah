
@extends('tata_letak.utama')

@section('title', 'Buat Laporan')

@push('styles')
<style>
    .form-wrap {
        max-width: 850px;
        margin: auto;
        padding: 28px 20px;
        color: #173d31;
    }

    .form-heading {
        margin-bottom: 24px;
    }

    .form-heading h1 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .form-heading p {
        color: #718178;
        margin: 0;
    }

    .form-card {
        background: white;
        border: 1px solid #e3eee7;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 16px rgba(22, 72, 48, .04);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control {
        display: block;
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #d7e4db;
        border-radius: 9px;
        padding: 12px 13px;
        font: inherit;
        background: #fff;
        color: #173d31;
    }

    .form-control:focus {
        outline: 2px solid #b5e5cb;
        border-color: #176b4d;
    }

    textarea.form-control {
        min-height: 130px;
        resize: vertical;
    }

    .form-help {
        display: block;
        color: #718178;
        margin-top: 7px;
        font-size: 13px;
    }

    .error-text {
        color: #bd3030;
        margin-top: 6px;
        font-size: 13px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 25px;
    }

    .btn {
        display: inline-block;
        padding: 12px 18px;
        border-radius: 9px;
        text-decoration: none;
        border: 0;
        cursor: pointer;
        font: inherit;
        font-weight: 600;
    }

    .btn-secondary {
        background: #edf3ef;
        color: #355747;
    }

    .btn-primary {
        background: #176b4d;
        color: white;
    }

    .btn-primary:hover {
        background: #10563d;
    }

    .alert-error {
        border-radius: 10px;
        padding: 14px 18px;
        background: #fff0f0;
        color: #a32929;
        margin-bottom: 20px;
    }

    @media (max-width: 600px) {
        .form-card {
            padding: 18px;
        }
    }
</style>
@endpush

@section('content')
<div class="form-wrap">
    <div class="form-heading">
        <h1>Buat Laporan</h1>
        <p>Laporkan kondisi TPS agar dapat ditindaklanjuti petugas.</p>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            <strong>Periksa kembali data berikut:</strong>
            <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form
            action="{{ route('laporan.simpan') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="form-group">
                <label for="kategori_masalah">Kategori Masalah *</label>
                <select
                    id="kategori_masalah"
                    name="kategori_masalah"
                    class="form-control"
                    required
                >
                    <option value="">Pilih kategori masalah</option>

                    @foreach ([
                        'TPS penuh',
                        'Sampah meluber',
                        'Sampah menumpuk',
                        'Kondisi lainnya'
                    ] as $kategori)
                        <option
                            value="{{ $kategori }}"
                            @selected(old('kategori_masalah') === $kategori)
                        >
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_masalah')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tingkat_kondisi">Tingkat Kondisi *</label>
                <select
                    id="tingkat_kondisi"
                    name="tingkat_kondisi"
                    class="form-control"
                    required
                >
                    <option value="">Pilih tingkat kondisi</option>

                    @foreach (['hampir penuh', 'penuh', 'meluber'] as $kondisi)
                        <option
                            value="{{ $kondisi }}"
                            @selected(old('tingkat_kondisi') === $kondisi)
                        >
                            {{ ucfirst($kondisi) }}
                        </option>
                    @endforeach
                </select>
                @error('tingkat_kondisi')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_tps">Lokasi TPS</label>
                <select id="id_tps" name="id_tps" class="form-control">
                    <option value="">Pilih TPS jika diketahui</option>

                    @foreach ($tps as $item)
                        <option
                            value="{{ $item->id_tps }}"
                            @selected((string) old('id_tps') === (string) $item->id_tps)
                        >
                            {{ $item->nama_tps }}
                            @if ($item->wilayah)
                                — {{ $item->wilayah->nama_wilayah }}
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('id_tps')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan Laporan *</label>
                <textarea
                    id="keterangan"
                    name="keterangan"
                    class="form-control"
                    maxlength="2000"
                    required
                    placeholder="Jelaskan kondisi TPS yang kamu temukan..."
                >{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto Bukti</label>
                <input
                    id="foto"
                    type="file"
                    name="foto"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                >
                <small class="form-help">
                    Format JPG, JPEG, PNG, atau WEBP. Ukuran maksimal 5 MB.
                </small>
                @error('foto')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="latitude">Latitude (opsional)</label>
                <input
                    id="latitude"
                    type="number"
                    name="latitude"
                    class="form-control"
                    step="any"
                    min="-90"
                    max="90"
                    value="{{ old('latitude') }}"
                    placeholder="Contoh: -6.3267"
                >
                @error('latitude')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="longitude">Longitude (opsional)</label>
                <input
                    id="longitude"
                    type="number"
                    name="longitude"
                    class="form-control"
                    step="any"
                    min="-180"
                    max="180"
                    value="{{ old('longitude') }}"
                    placeholder="Contoh: 108.3200"
                >
                @error('longitude')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('laporan.saya') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
