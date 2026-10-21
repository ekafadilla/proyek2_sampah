
@extends('tata_letak.utama')

@section('title', 'Detail Laporan')

@push('styles')
<style>
    .detail-wrap {
        max-width: 900px;
        margin: auto;
        padding: 28px 20px;
        color: #173d31;
    }

    .detail-card {
        background: white;
        border: 1px solid #e3eee7;
        border-radius: 15px;
        padding: 24px;
        margin-bottom: 20px;
    }

    .detail-title {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .detail-title h1 {
        font-size: 26px;
        margin: 0;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        margin-top: 22px;
    }

    .detail-label {
        color: #718178;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .detail-value {
        overflow-wrap: anywhere;
        font-weight: 500;
    }

    .status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        background: #edf2ee;
        font-size: 13px;
    }

    .status-menunggu {
        background: #fff3d5;
        color: #8b6410;
    }

    .status-diproses,
    .status-diverifikasi,
    .status-ditangani {
        background: #dff0ff;
        color: #205b89;
    }

    .status-selesai {
        background: #dcf7e6;
        color: #176b4d;
    }

    .photo-list {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .photo-list img {
        width: 100%;
        max-width: 260px;
        max-height: 260px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e3eee7;
    }

    .history-item {
        padding: 15px 0;
        border-bottom: 1px solid #edf2ee;
    }

    .history-item:last-child {
        border-bottom: 0;
    }

    .history-item p {
        margin: 6px 0 0;
        color: #718178;
    }

    .btn-back {
        display: inline-block;
        padding: 11px 17px;
        border-radius: 9px;
        background: #176b4d;
        color: white;
        text-decoration: none;
        margin-bottom: 20px;
    }

    @media (max-width: 600px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-card {
            padding: 18px;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-wrap">
    <a href="{{ route('laporan.saya') }}" class="btn-back">
        ← Kembali ke Laporan
    </a>

    <div class="detail-card">
        <div class="detail-title">
            <h1>Laporan #{{ $laporan->id_laporan }}</h1>

            <span class="status status-{{ $laporan->status }}">
                {{ ucfirst($laporan->status) }}
            </span>
        </div>

        <div class="detail-grid">
            <div>
                <div class="detail-label">Kategori Masalah</div>
                <div class="detail-value">{{ $laporan->kategori_masalah }}</div>
            </div>

            <div>
                <div class="detail-label">Tingkat Kondisi</div>
                <div class="detail-value">{{ ucfirst($laporan->tingkat_kondisi) }}</div>
            </div>

            <div>
                <div class="detail-label">Tingkat Urgensi</div>
                <div class="detail-value">{{ ucfirst($laporan->tingkat_urgensi) }}</div>
            </div>

            <div>
                <div class="detail-label">Tanggal Laporan</div>
                <div class="detail-value">
                    {{ $laporan->waktu_lapor
                        ? \Carbon\Carbon::parse($laporan->waktu_lapor)->format('d/m/Y H:i')
                        : '-' }}
                </div>
            </div>

            <div>
                <div class="detail-label">Pelapor</div>
                <div class="detail-value">{{ $laporan->pelapor?->name ?? '-' }}</div>
            </div>

            <div>
                <div class="detail-label">Lokasi TPS</div>
                <div class="detail-value">{{ $laporan->tps?->nama_tps ?? '-' }}</div>
            </div>

            <div>
                <div class="detail-label">Latitude</div>
                <div class="detail-value">{{ $laporan->latitude ?? '-' }}</div>
            </div>

            <div>
                <div class="detail-label">Longitude</div>
                <div class="detail-value">{{ $laporan->longitude ?? '-' }}</div>
            </div>
        </div>

        <hr style="border: 0; border-top: 1px solid #edf2ee; margin: 24px 0;">

        <div class="detail-label">Keterangan Laporan</div>
        <div style="white-space: pre-line; overflow-wrap: anywhere;">
            {{ $laporan->keterangan }}
        </div>

        @if ($laporan->alasan_ditolak)
            <div style="margin-top: 20px;">
                <div class="detail-label">Alasan Penolakan</div>
                <div>{{ $laporan->alasan_ditolak }}</div>
            </div>
        @endif
    </div>

    <div class="detail-card">
        <h2 style="margin-top: 0;">Foto Bukti</h2>

        @if ($laporan->foto->isNotEmpty())
            <div class="photo-list">
                @foreach ($laporan->foto as $foto)
                    <a
                        href="{{ asset('storage/' . $foto->nama_file) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <img
                            src="{{ asset('storage/' . $foto->nama_file) }}"
                            alt="Foto bukti laporan"
                        >
                    </a>
                @endforeach
            </div>
        @else
            <p style="color: #718178;">Tidak ada foto bukti untuk laporan ini.</p>
        @endif
    </div>

    <div class="detail-card">
        <h2 style="margin-top: 0;">Riwayat Status</h2>

        @forelse ($laporan->riwayat->sortBy('waktu_status') as $riwayat)
            <div class="history-item">
                <strong>{{ ucfirst($riwayat->status) }}</strong>

                <div class="detail-label">
                    {{ $riwayat->waktu_status
                        ? \Carbon\Carbon::parse($riwayat->waktu_status)->format('d/m/Y H:i')
                        : '-' }}
                </div>

                @if ($riwayat->catatan)
                    <p>{{ $riwayat->catatan }}</p>
                @endif
            </div>
        @empty
            <p style="color: #718178;">Belum ada riwayat status.</p>
        @endforelse
    </div>
</div>
@endsection
