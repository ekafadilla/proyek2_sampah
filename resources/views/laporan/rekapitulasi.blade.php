@extends('tata_letak.utama')
@section('title', 'Rekapitulasi Laporan')
@section('content')
<div class="container" style="max-width:1100px;margin:32px auto;padding:0 18px">
    <h1>Rekapitulasi Laporan</h1>
    <p>Ringkasan jumlah laporan berdasarkan status.</p>
    <div style="display:flex;gap:12px;flex-wrap:wrap;margin:20px 0">
        @forelse($rows as $status => $jumlah)
            <div style="background:#fff;border-radius:12px;padding:18px;min-width:140px"><strong>{{ ucfirst($status) }}</strong><div style="font-size:28px;margin-top:8px">{{ $jumlah }}</div></div>
        @empty
            <p>Belum ada laporan untuk direkap.</p>
        @endforelse
    </div>
    <div style="overflow:auto"><table style="width:100%;border-collapse:collapse;background:#fff"><thead><tr><th style="text-align:left;padding:10px">ID</th><th style="text-align:left;padding:10px">Kategori</th><th style="text-align:left;padding:10px">TPS</th><th style="text-align:left;padding:10px">Wilayah</th><th style="text-align:left;padding:10px">Status</th><th style="text-align:left;padding:10px">Waktu Lapor</th></tr></thead><tbody>
    @forelse($laporan as $item)<tr><td style="padding:10px">{{ $item->id_laporan }}</td><td style="padding:10px">{{ $item->kategori_masalah }}</td><td style="padding:10px">{{ $item->tps->nama_tps ?? '-' }}</td><td style="padding:10px">{{ $item->tps->wilayah->nama_wilayah ?? '-' }}</td><td style="padding:10px">{{ ucfirst($item->status) }}</td><td style="padding:10px">{{ optional($item->waktu_lapor)->format('d-m-Y H:i') ?? '-' }}</td></tr>@empty<tr><td colspan="6" style="padding:10px">Belum ada laporan.</td></tr>@endforelse
    </tbody></table></div>
    <div style="margin-top:18px">{{ $laporan->links() }}</div>
</div>
@endsection
