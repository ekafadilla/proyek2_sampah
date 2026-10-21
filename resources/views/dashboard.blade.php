
@extends('tata_letak.utama')

@section('title', 'Dashboard Masyarakat')

@push('styles')
<style>
    .dashboard-wrap {
        max-width: 1200px;
        margin: auto;
        padding: 28px 20px;
        color: #173d31;
    }

    .dashboard-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .dashboard-heading h1 {
        font-size: 28px;
        margin: 0 0 8px;
        font-weight: 750;
    }

    .dashboard-heading p {
        color: #6b8177;
        margin: 0;
    }

    .btn-laporan {
        background: #176b4d;
        color: white;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-laporan:hover {
        background: #10563d;
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e3eee7;
        border-radius: 15px;
        padding: 22px;
        box-shadow: 0 4px 16px rgba(22, 72, 48, .04);
    }

    .stat-card span {
        color: #6b8177;
        font-size: 14px;
    }

    .stat-card h2 {
        margin: 12px 0 0;
        font-size: 30px;
        color: #176b4d;
    }

    .panel {
        background: white;
        border: 1px solid #e3eee7;
        border-radius: 15px;
        overflow: hidden;
    }

    .panel-heading {
        padding: 20px;
        border-bottom: 1px solid #e8efe9;
    }

    .panel-heading h2 {
        margin: 0;
        font-size: 19px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
    }

    .report-table th,
    .report-table td {
        text-align: left;
        padding: 15px 20px;
        border-bottom: 1px solid #edf2ee;
        font-size: 14px;
        white-space: nowrap;
    }

    .report-table th {
        color: #718178;
        background: #f8fbf9;
    }

    .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        background: #edf2ee;
        color: #40564a;
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

    .detail-link {
        color: #176b4d;
        font-weight: 600;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        color: #718178;
        padding: 35px 20px;
    }

    @media (max-width: 800px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-wrap">
    <div class="dashboard-heading">
        <div>
            <h1>Dashboard Masyarakat</h1>
            <p>Ringkasan laporan kebersihan dan kondisi TPS.</p>
        </div>

        @if (auth()->user()->role === 'masyarakat')
            <a href="{{ route('laporan.buat') }}" class="btn-laporan">
                + Buat Laporan
            </a>
        @endif
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <span>Total Laporan</span>
            <h2>{{ $stats['total'] ?? 0 }}</h2>
        </div>

        <div class="stat-card">
            <span>Menunggu</span>
            <h2>{{ $stats['menunggu'] ?? 0 }}</h2>
        </div>

        <div class="stat-card">
            <span>Diproses</span>
            <h2>{{ $stats['diproses'] ?? 0 }}</h2>
        </div>

        <div class="stat-card">
            <span>Selesai</span>
            <h2>{{ $stats['selesai'] ?? 0 }}</h2>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h2>Laporan Terbaru</h2>
        </div>

        <div class="table-responsive">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Tingkat Kondisi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>#{{ $item->id_laporan }}</td>
                            <td>{{ $item->kategori_masalah }}</td>
                            <td>{{ ucfirst($item->tingkat_kondisi) }}</td>
                            <td>
                                {{ $item->waktu_lapor
                                    ? \Carbon\Carbon::parse($item->waktu_lapor)->format('d/m/Y H:i')
                                    : '-' }}
                            </td>
                            <td>
                                <span class="status status-{{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <a
                                    class="detail-link"
                                    href="{{ route('laporan.detail', $item->id_laporan) }}"
                                >
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                Belum ada laporan yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="padding: 18px 20px;">
            <a href="{{ route('laporan.saya') }}" class="detail-link">
                Lihat Semua Laporan →
            </a>
        </div>
    </div>
</div>
@endsection
