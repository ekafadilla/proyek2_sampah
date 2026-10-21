


<?php $__env->startSection('title', 'Data TPS - SI PANTAU TPS Indramayu'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .data-tps-page {
        width: min(1500px, 92%);
        margin: 45px auto;
        color: #123f38;
    }

    .data-tps-page h1 {
        margin: 0 0 22px;
        color: #073f38;
        font-size: clamp(26px, 3vw, 36px);
        line-height: 1.3;
    }

    .data-tps-description {
        margin-bottom: 35px;
    }

    .data-tps-search {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 30px;
    }

    .data-tps-search input,
    .data-tps-search select {
        min-height: 48px;
        padding: 12px 15px;
        border: 1px solid #b8c9c7;
        border-radius: 5px;
        background: white;
        color: #123f38;
        font: inherit;
    }

    .data-tps-search input {
        flex: 1 1 300px;
        min-width: 0;
    }

    .data-tps-search select {
        flex: 0 1 220px;
    }

    .data-tps-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        padding: 11px 20px;
        border: 1px solid #07594f;
        border-radius: 5px;
        background: #07594f;
        color: white;
        font: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    .data-tps-reset {
        display: inline-flex;
        align-items: center;
        padding: 10px;
        color: #07594f;
        text-decoration: none;
    }

    .data-tps-table-wrap {
        overflow-x: auto;
        margin-top: 20px;
    }

    .data-tps-table {
        width: 100%;
        border-collapse: collapse;
        background: transparent;
    }

    .data-tps-table th,
    .data-tps-table td {
        padding: 15px;
        border: 1px solid #cce5e2;
        text-align: left;
        vertical-align: top;
    }

    .data-tps-table th {
        background: #d8f3f2;
        color: #456b65;
        font-size: 12px;
        letter-spacing: .4px;
    }

    .data-tps-table td {
        font-size: 14px;
        overflow-wrap: anywhere;
    }

    .data-tps-table tbody tr:hover {
        background: #f0ffff;
    }

    .data-tps-count {
        margin-bottom: 12px;
    }

    .data-tps-message {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 6px;
        background: #d1fae5;
        color: #065f46;
    }

    .data-tps-pagination {
        margin-top: 22px;
        overflow-x: auto;
    }

    .data-tps-back {
        display: inline-block;
        margin-top: 30px;
        color: #07594f;
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .data-tps-page { margin: 30px auto; }
        .data-tps-search > * { width: 100%; }
        .data-tps-table th,
        .data-tps-table td { padding: 10px; }
    }
</style>

<div class="data-tps-page">

    <h1>Data Tempat Pemungutan Sampah</h1>

    <p class="data-tps-description">
        Daftar TPS aktif beserta alamat dan wilayahnya.
    </p>

    <?php if(session('success')): ?>
        <div class="data-tps-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form
        method="GET"
        action="<?php echo e(route('data_tps.daftar')); ?>"
        class="data-tps-search">

        <input
            type="search"
            name="q"
            value="<?php echo e(request('q')); ?>"
            placeholder="Cari nama TPS atau alamat..."
            aria-label="Cari nama TPS atau alamat">

        <select name="wilayah" aria-label="Filter wilayah">
            <option value="">Semua Wilayah</option>

            <?php $__currentLoopData = ($wilayah ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemWilayah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($itemWilayah->id_wilayah); ?>"
                    <?php echo e((string) request('wilayah') === (string) $itemWilayah->id_wilayah ? 'selected' : ''); ?>>
                    <?php echo e($itemWilayah->nama_wilayah); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button type="submit" class="data-tps-button">
            Cari TPS
        </button>

        <a href="<?php echo e(route('data_tps.daftar')); ?>" class="data-tps-reset">
            Reset
        </a>
    </form>

    <p class="data-tps-count">
        Jumlah TPS ditemukan:
        <strong><?php echo e($tps->total()); ?></strong>
    </p>

    <div class="data-tps-table-wrap">
        <table class="data-tps-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama TPS</th>
                    <th>Alamat</th>
                    <th>Wilayah</th>
                    <th>Koordinat</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($tps->firstItem() + $loop->index); ?></td>
                        <td><?php echo e($item->nama_tps); ?></td>
                        <td><?php echo e($item->alamat); ?></td>
                        <td>
                            <?php echo e($item->wilayah?->nama_wilayah ?? 'Belum ditentukan'); ?>

                        </td>
                        <td>
                            <?php if($item->latitude !== null && $item->longitude !== null): ?>
                                <?php echo e($item->latitude); ?>, <?php echo e($item->longitude); ?>

                            <?php else: ?>
                                Belum tersedia
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding:30px;">
                            Tidak ada data TPS yang cocok dengan pencarian.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="data-tps-pagination">
        <?php echo e($tps->links()); ?>

    </div>

    <a href="<?php echo e(route('home')); ?>" class="data-tps-back">
        &larr; Kembali ke Beranda
    </a>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tata_letak.utama', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SI_PANTAU_TPS\resources\views/data_tps/daftar.blade.php ENDPATH**/ ?>