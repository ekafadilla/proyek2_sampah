


<?php $__env->startSection('title', 'Detail Laporan'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="detail-wrap">
    <a href="<?php echo e(route('laporan.saya')); ?>" class="btn-back">
        ← Kembali ke Laporan
    </a>

    <div class="detail-card">
        <div class="detail-title">
            <h1>Laporan #<?php echo e($laporan->id_laporan); ?></h1>

            <span class="status status-<?php echo e($laporan->status); ?>">
                <?php echo e(ucfirst($laporan->status)); ?>

            </span>
        </div>

        <div class="detail-grid">
            <div>
                <div class="detail-label">Kategori Masalah</div>
                <div class="detail-value"><?php echo e($laporan->kategori_masalah); ?></div>
            </div>

            <div>
                <div class="detail-label">Tingkat Kondisi</div>
                <div class="detail-value"><?php echo e(ucfirst($laporan->tingkat_kondisi)); ?></div>
            </div>

            <div>
                <div class="detail-label">Tingkat Urgensi</div>
                <div class="detail-value"><?php echo e(ucfirst($laporan->tingkat_urgensi)); ?></div>
            </div>

            <div>
                <div class="detail-label">Tanggal Laporan</div>
                <div class="detail-value">
                    <?php echo e($laporan->waktu_lapor
                        ? \Carbon\Carbon::parse($laporan->waktu_lapor)->format('d/m/Y H:i')
                        : '-'); ?>

                </div>
            </div>

            <div>
                <div class="detail-label">Pelapor</div>
                <div class="detail-value"><?php echo e($laporan->pelapor?->name ?? '-'); ?></div>
            </div>

            <div>
                <div class="detail-label">Lokasi TPS</div>
                <div class="detail-value"><?php echo e($laporan->tps?->nama_tps ?? '-'); ?></div>
            </div>

            <div>
                <div class="detail-label">Latitude</div>
                <div class="detail-value"><?php echo e($laporan->latitude ?? '-'); ?></div>
            </div>

            <div>
                <div class="detail-label">Longitude</div>
                <div class="detail-value"><?php echo e($laporan->longitude ?? '-'); ?></div>
            </div>
        </div>

        <hr style="border: 0; border-top: 1px solid #edf2ee; margin: 24px 0;">

        <div class="detail-label">Keterangan Laporan</div>
        <div style="white-space: pre-line; overflow-wrap: anywhere;">
            <?php echo e($laporan->keterangan); ?>

        </div>

        <?php if($laporan->alasan_ditolak): ?>
            <div style="margin-top: 20px;">
                <div class="detail-label">Alasan Penolakan</div>
                <div><?php echo e($laporan->alasan_ditolak); ?></div>
            </div>
        <?php endif; ?>
    </div>

    <div class="detail-card">
        <h2 style="margin-top: 0;">Foto Bukti</h2>

        <?php if($laporan->foto->isNotEmpty()): ?>
            <div class="photo-list">
                <?php $__currentLoopData = $laporan->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a
                        href="<?php echo e(asset('storage/' . $foto->nama_file)); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <img
                            src="<?php echo e(asset('storage/' . $foto->nama_file)); ?>"
                            alt="Foto bukti laporan"
                        >
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p style="color: #718178;">Tidak ada foto bukti untuk laporan ini.</p>
        <?php endif; ?>
    </div>

    <div class="detail-card">
        <h2 style="margin-top: 0;">Riwayat Status</h2>

        <?php $__empty_1 = true; $__currentLoopData = $laporan->riwayat->sortBy('waktu_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $riwayat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="history-item">
                <strong><?php echo e(ucfirst($riwayat->status)); ?></strong>

                <div class="detail-label">
                    <?php echo e($riwayat->waktu_status
                        ? \Carbon\Carbon::parse($riwayat->waktu_status)->format('d/m/Y H:i')
                        : '-'); ?>

                </div>

                <?php if($riwayat->catatan): ?>
                    <p><?php echo e($riwayat->catatan); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="color: #718178;">Belum ada riwayat status.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tata_letak.utama', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SI_PANTAU_TPS\resources\views/laporan/detail.blade.php ENDPATH**/ ?>