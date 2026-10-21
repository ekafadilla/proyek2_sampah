<?php $__env->startSection('title', 'Beranda - SI PANTAU TPS Indramayu'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $daftarTps = ($tps ?? collect())->take(4);

    $totalTps = \App\Models\Tps::where('status_aktif', true)->count();
    $totalWilayah = \App\Models\Wilayah::count();
    $totalLaporan = \App\Models\Laporan::count();
    $selesai = \App\Models\Laporan::where('status', 'selesai')->count();

    $persentase = $totalLaporan > 0
        ? round(($selesai / $totalLaporan) * 100, 1)
        : 0;

    $daftarWilayah = $wilayah ?? \App\Models\Wilayah::all();
?>

<style>
    .home-page {
        color: #123f38;
    }

    .home-container {
        width: min(1180px, 92%);
        margin: auto;
    }

    .home-hero {
        padding: 48px 0 35px;
        background: linear-gradient(135deg, #e1fbfa, #f4ffff);
    }

    .home-hero-grid {
        display: grid;
        grid-template-columns: 1.05fr .95fr;
        align-items: center;
        gap: 40px;
    }

    .home-eyebrow {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 15px;
        border-radius: 30px;
        background: #c8f0eb;
        color: #07594f;
        font-size: 10px;
        font-weight: 800;
    }

    .home-hero h1 {
        margin: 0 0 16px;
        color: #073f38;
        font-size: clamp(30px, 4vw, 44px);
        line-height: 1.2;
    }

    .home-description {
        margin-bottom: 22px;
        color: #56736e;
        font-size: 14px;
        line-height: 1.7;
    }

    .home-search {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 10px;
        background: white;
        border: 1px solid #d7efeb;
        border-radius: 12px;
    }

    .home-search input,
    .home-search select {
        flex: 1 1 130px;
        min-width: 0;
        padding: 10px;
        border: 1px solid #e4efed;
        border-radius: 6px;
        background: white;
        color: #123f38;
        font: inherit;
        font-size: 12px;
    }

    .home-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        border: 0;
        border-radius: 8px;
        background: #07594f;
        color: white;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s;
    }

    .home-button:hover {
        background: #043f38;
        color: white;
    }

    .home-quick {
        margin-top: 12px;
        font-size: 11px;
        color: #66827e;
    }

    .home-quick a {
        display: inline-block;
        margin: 4px;
        padding: 4px 9px;
        border-radius: 20px;
        background: #d4f3ef;
        color: #07594f;
        text-decoration: none;
    }

    .home-quick a:hover {
        background: #bce9e3;
    }

    .home-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
        margin-top: 22px;
    }

    .home-stat {
        padding: 14px;
        border: 1px solid #e0f1ef;
        border-radius: 10px;
        background: white;
    }

    .home-stat strong {
        display: block;
        color: #07594f;
        font-size: 23px;
    }

    .home-stat span {
        display: block;
        color: #66827e;
        font-size: 10px;
        line-height: 1.5;
    }

    .home-hero-image {
        position: relative;
        min-width: 0;
    }

    .home-hero-image img {
        display: block;
        width: 100%;
        height: 310px;
        object-fit: cover;
        border-radius: 15px;
    }

    .home-image-caption {
        position: absolute;
        right: 12px;
        bottom: 12px;
        left: 12px;
        padding: 12px;
        border-radius: 9px;
        background: rgba(6, 63, 56, .91);
        color: white;
        font-size: 11px;
        line-height: 1.6;
    }

    .home-image-caption strong {
        display: block;
        font-size: 13px;
    }

    .home-notice {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin: 28px auto 42px;
        padding: 23px;
        border-radius: 12px;
        background: #043f38;
        color: white;
    }

    .home-notice h3 {
        margin: 0 0 4px;
        font-size: 15px;
    }

    .home-notice p {
        margin: 0;
        color: #c4e3de;
        font-size: 11px;
        line-height: 1.7;
    }

    .home-notice-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        flex-shrink: 0;
    }

    .home-button-light {
        background: white;
        color: #07594f;
    }

    .home-button-light:hover {
        background: #e5f6f3;
        color: #043f38;
    }

    .home-section {
        padding: 8px 0 48px;
    }

    .home-section-heading {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 18px;
        margin-bottom: 22px;
    }

    .home-section-heading h2 {
        margin: 5px 0;
        color: #073f38;
        font-size: clamp(22px, 3vw, 29px);
    }

    .home-section-heading p {
        margin: 0;
        color: #66827e;
        font-size: 12px;
        line-height: 1.6;
    }

    .home-label {
        color: #138c7f;
        font-size: 10px;
        font-weight: 800;
    }

    .home-text-link {
        color: #07594f;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        white-space: nowrap;
    }

    .home-text-link:hover {
        color: #138c7f;
    }

    .home-tps-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .home-tps-card {
        overflow: hidden;
        border: 1px solid #e0efed;
        border-radius: 12px;
        background: white;
        transition: transform .2s, box-shadow .2s;
    }

    .home-tps-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(7, 89, 79, .08);
    }

    .home-tps-top {
        display: flex;
        justify-content: space-between;
        gap: 5px;
        padding: 12px 12px 8px;
        font-size: 10px;
    }

    .home-status {
        padding: 4px 7px;
        border-radius: 20px;
        background: #d8f7e9;
        color: #07836f;
        font-weight: 800;
    }

    .home-tps-body {
        padding: 0 12px 13px;
    }

    .home-tps-body h3 {
        margin: 0 0 6px;
        font-size: 14px;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .home-tps-body p {
        color: #66827e;
        font-size: 11px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .home-tps-address {
        min-height: 38px;
    }

    .home-tps-button {
        display: block;
        padding: 9px;
        border-radius: 7px;
        background: #d8f5f3;
        color: #07594f;
        font-size: 11px;
        font-weight: 800;
        text-align: center;
        text-decoration: none;
    }

    .home-tps-button:hover {
        background: #bce9e3;
        color: #043f38;
    }

    .home-empty {
        grid-column: 1 / -1;
        padding: 30px;
        border: 1px dashed #b8ded9;
        border-radius: 12px;
        background: white;
        text-align: center;
    }

    .home-empty h3 {
        margin-bottom: 8px;
        font-size: 16px;
    }

    .home-empty p {
        margin: 0;
        color: #66827e;
        font-size: 12px;
    }

    .home-all {
        margin-top: 25px;
        text-align: center;
    }

    .home-features {
        padding: 38px 0;
        background: #e0f8f7;
    }

    .home-features-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .home-feature {
        padding: 21px;
        border-radius: 11px;
        background: #f5ffff;
    }

    .home-feature h3 {
        margin: 0 0 7px;
        font-size: 14px;
    }

    .home-feature p {
        margin: 0;
        color: #66827e;
        font-size: 11px;
        line-height: 1.7;
    }

    @media (max-width: 900px) {
        .home-hero-grid {
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .home-tps-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .home-notice-actions {
            flex-shrink: 1;
        }
    }

    @media (max-width: 600px) {
        .home-hero {
            padding: 32px 0;
        }

        .home-hero-grid {
            grid-template-columns: 1fr;
        }

        .home-hero-image img {
            height: 230px;
        }

        .home-notice {
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
        }

        .home-notice-actions {
            width: 100%;
        }

        .home-notice-actions .home-button {
            flex: 1;
        }

        .home-section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .home-features-grid,
        .home-tps-grid {
            grid-template-columns: 1fr;
        }

        .home-stats {
            gap: 7px;
        }

        .home-stat {
            padding: 10px;
        }

        .home-stat strong {
            font-size: 20px;
        }

        .home-stat span {
            font-size: 10px;
        }

        .home-search input,
        .home-search select {
            flex-basis: 100%;
        }

        .home-search .home-button {
            width: 100%;
        }
    }
</style>

<div class="home-page">

    
    <section class="home-hero">
        <div class="home-container home-hero-grid">

            <div>
                <span class="home-eyebrow">
                    PORTAL INFORMASI TPS INDRAMAYU
                </span>

                <h1>Sistem Pengaduan dan Monitoring TPS Sampah</h1>

                <p class="home-description">
                    Portal informasi lokasi Tempat Penampungan Sampah (TPS)
                    dan layanan monitoring kebersihan lingkungan Kabupaten
                    Indramayu.
                </p>

                <form
                    method="GET"
                    action="<?php echo e(route('data_tps.daftar')); ?>"
                    class="home-search"
                >
                    <input
                        type="search"
                        name="q"
                        value="<?php echo e(request('q')); ?>"
                        placeholder="Cari nama TPS atau alamat..."
                        aria-label="Cari TPS"
                    >

                    <select name="wilayah" aria-label="Pilih wilayah">
                        <option value="">Semua Wilayah</option>

                        <?php $__currentLoopData = $daftarWilayah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemWilayah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($itemWilayah->id_wilayah); ?>"
                                <?php echo e((string) request('wilayah') === (string) $itemWilayah->id_wilayah ? 'selected' : ''); ?>

                            >
                                <?php echo e($itemWilayah->nama_wilayah); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <button class="home-button" type="submit">
                        Cari TPS
                    </button>
                </form>

                <div class="home-quick">
                    Pencarian cepat:
                    <a href="<?php echo e(route('data_tps.daftar', ['q' => 'pasar'])); ?>">Pasar</a>
                    <a href="<?php echo e(route('data_tps.daftar', ['q' => 'sindang'])); ?>">Sindang</a>
                    <a href="<?php echo e(route('data_tps.daftar', ['q' => 'jatibarang'])); ?>">Jatibarang</a>
                </div>

                <div class="home-stats">
                    <div class="home-stat">
                        <strong><?php echo e($totalTps); ?></strong>
                        <span>TPS Aktif Terdata</span>
                    </div>

                    <div class="home-stat">
                        <strong><?php echo e($totalWilayah); ?></strong>
                        <span>Wilayah Terdata</span>
                    </div>

                    <div class="home-stat">
                        <strong><?php echo e($persentase); ?>%</strong>
                        <span>Laporan Terselesaikan</span>
                    </div>
                </div>
            </div>

            <div class="home-hero-image">
                <img
                    src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=1000&q=85"
                    alt="Kegiatan pengelolaan sampah"
                >

                <div class="home-image-caption">
                    <strong>Pengelolaan Lingkungan Terintegrasi</strong>
                    Mendukung pemantauan TPS secara transparan.
                </div>
            </div>

        </div>
    </section>

    
    <section class="home-container">
        <div class="home-notice">
            <div>
                <h3>Layanan Aduan Kebersihan Warga</h3>
                <p>
                    Menemukan TPS bermasalah? Masuk atau buat akun untuk
                    menyampaikan pengaduan.
                </p>
            </div>

            <div class="home-notice-actions">
                <?php if(auth()->guard()->check()): ?>
                    <a
                        href="<?php echo e(route('dashboard')); ?>"
                        class="home-button home-button-light"
                    >
                        Buka Dashboard
                    </a>
                <?php else: ?>
                    <a
                        href="<?php echo e(route('login')); ?>"
                        class="home-button home-button-light"
                    >
                        Masuk untuk Melapor
                    </a>

                    <a href="<?php echo e(route('register')); ?>" class="home-button">
                        Daftar Akun
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="home-section" id="daftar-tps">
        <div class="home-container">

            <div class="home-section-heading">
                <div>
                    <span class="home-label">DISTRIBUSI DATA TPS</span>
                    <h2>Daftar Titik TPS Terpantau</h2>
                    <p>
                        Informasi lokasi dan wilayah TPS di Kabupaten
                        Indramayu.
                    </p>
                </div>

                <a
                    href="<?php echo e(route('data_tps.daftar')); ?>"
                    class="home-text-link"
                >
                    Lihat Semua Data TPS →
                </a>
            </div>

            <div class="home-tps-grid">
                <?php $__empty_1 = true; $__currentLoopData = $daftarTps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="home-tps-card">

                        <div class="home-tps-top">
                            <span class="home-status">TPS AKTIF</span>
                            <span>#<?php echo e($item->id_tps); ?></span>
                        </div>

                        <div class="home-tps-body">
                            <h3><?php echo e($item->nama_tps); ?></h3>

                            <p class="home-tps-address">
                                <?php echo e($item->alamat); ?>

                            </p>

                            <p>
                                Wilayah:
                                <?php echo e($item->wilayah?->nama_wilayah ?? 'Belum ditentukan'); ?>

                            </p>

                            <a
                                href="<?php echo e(route('data_tps.daftar', ['q' => $item->nama_tps])); ?>"
                                class="home-tps-button"
                            >
                                Lihat Detail →
                            </a>
                        </div>

                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="home-empty">
                        <h3>Belum Ada Data TPS</h3>
                        <p>Data TPS aktif belum tersedia.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="home-all">
                <a
                    href="<?php echo e(route('data_tps.daftar')); ?>"
                    class="home-button"
                >
                    Lihat Semua Data TPS →
                </a>
            </div>

        </div>
    </section>

    
    <section class="home-features">
        <div class="home-container home-features-grid">

            <article class="home-feature">
                <h3>Transparansi Publik</h3>
                <p>
                    Masyarakat dapat melihat informasi TPS dan wilayah
                    untuk mendukung keterbukaan informasi.
                </p>
            </article>

            <article class="home-feature">
                <h3>Respons Cepat UPTD</h3>
                <p>
                    Informasi laporan membantu mendukung tindak lanjut
                    petugas sesuai prosedur.
                </p>
            </article>

            <article class="home-feature">
                <h3>Verifikasi Lapangan</h3>
                <p>
                    Penanganan laporan dapat dipantau sesuai hak akses
                    pengguna sistem.
                </p>
            </article>

        </div>
    </section>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tata_letak.utama', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SI_PANTAU_TPS\resources\views/beranda.blade.php ENDPATH**/ ?>