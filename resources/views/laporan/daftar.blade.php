
@extends('tata_letak.utama')

@section('title', 'Laporan Saya')

@push('styles')
<style>
    .list-wrap {
        max-width: 1200px;
        margin: auto;
        padding: 28px 20px;
        color: #173d31;
    }

    .list-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .list-heading h1 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .list-heading p {
        color: #718178;
        margin: 0;
    }

    .btn-create {
        display: inline-block;
        padding: 12px 18px;
        border-radius: 9px;
        background: #176b4d;
        color: white;
        text-decoration: none;
        font-weight: 600;
    }

    .filter-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .filter-form select {
        min-width: 190px;
        padding: 11px;
        border: 1px solid #d7e4db;
        border-radius: 9px;
        background: white;
    }

    .filter-form button {
        padding: 11px 17px;
        border: 0;
        border-radius: 9px;
        background: #176b4d;
        color: white;
        cursor: pointer;
    }

    .list-panel {
        background: white;
        border: 1px solid #e3eee7;
        border-radius: 15px;
        overflow: hidden;
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
        padding: 15px 18px;
        text-align: left;
        border-bottom: 1px solid #edf2ee;
        font-size: 14px;
        white-space: nowrap;
    }

    .report-table th {
        background: #f8fbf9;
        color: #718178;
    }

    .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        background: #edf2ee;
        font-size: 12px;
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
        padding: 35px 20px;
        color: #718178;
    }

    .pagination-wrap {
        padding: 18px;
    }
</style>
@endpush

@section('content')
<div class="list-wrap">
    <div class="list-heading">
        <div>
            <h1>Laporan Saya</h1>
            <p>Pantau laporan yang telah kamu kirimkan.</p>
        </div>

        @if (auth()->user()->role === 'masyarakat')
            <a href="{{ route('laporan.buat') }}" class="btn-create">
                + Buat Laporan
            </a>
        @endif
    </div>

    <form action="{{ route('laporan.saya') }}" method="GET" class="filter-form">
        <select name="status">
            <option value="">Semua Status</option>

            @foreach ([
                'menunggu',
                'diverifikasi',
                'diproses',
                'ditangani',
                'selesai',
                'ditolak'
            ] as $status)
                <option
                    value="{{ $status }}"
                    @selected(request('status') === $status)
                >
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <button type="submit">Filter</button>
    </form>

    <div class="list-panel">
        <div class="table-responsive">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>TPS</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>#{{ $item->id_laporan }}</td>
                            <td>{{ $item->kategori_masalah }}</td>
                            <td>{{ ucfirst($item->tingkat_kondisi) }}</td>
                            <td>{{ $item->tps?->nama_tps ?? '-' }}</td>
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
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                Belum ada laporan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($laporan, 'links'))
            <div class="pagination-wrap">
                {{ $laporan->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
