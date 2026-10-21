<?php $__env->startSection('title', 'Buat Laporan'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="form-wrap">
    <div class="form-heading">
        <h1>Buat Laporan</h1>
        <p>Laporkan kondisi TPS agar dapat ditindaklanjuti petugas.</p>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert-error">
            <strong>Periksa kembali data berikut:</strong>
            <ul style="margin-bottom: 0;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="form-card">
        <form
            action="<?php echo e(route('laporan.simpan')); ?>"
            method="POST"
            enctype="multipart/form-data"
        >
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="kategori_masalah">Kategori Masalah *</label>
                <select
                    id="kategori_masalah"
                    name="kategori_masalah"
                    class="form-control"
                    required
                >
                    <option value="">Pilih kategori masalah</option>

                    <?php $__currentLoopData = [
                        'TPS penuh',
                        'Sampah meluber',
                        'Sampah menumpuk',
                        'Kondisi lainnya'
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($kategori); ?>"
                            <?php if(old('kategori_masalah') === $kategori): echo 'selected'; endif; ?>
                        >
                            <?php echo e($kategori); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['kategori_masalah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

                    <?php $__currentLoopData = ['hampir penuh', 'penuh', 'meluber']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kondisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($kondisi); ?>"
                            <?php if(old('tingkat_kondisi') === $kondisi): echo 'selected'; endif; ?>
                        >
                            <?php echo e(ucfirst($kondisi)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['tingkat_kondisi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="id_tps">Lokasi TPS</label>
                <select id="id_tps" name="id_tps" class="form-control">
                    <option value="">Pilih TPS jika diketahui</option>

                    <?php $__currentLoopData = $tps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($item->id_tps); ?>"
                            <?php if((string) old('id_tps') === (string) $item->id_tps): echo 'selected'; endif; ?>
                        >
                            <?php echo e($item->nama_tps); ?>

                            <?php if($item->wilayah): ?>
                                — <?php echo e($item->wilayah->nama_wilayah); ?>

                            <?php endif; ?>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['id_tps'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                ><?php echo e(old('keterangan')); ?></textarea>
                <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    value="<?php echo e(old('latitude')); ?>"
                    placeholder="Contoh: -6.3267"
                >
                <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    value="<?php echo e(old('longitude')); ?>"
                    placeholder="Contoh: 108.3200"
                >
                <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-actions">
                <a href="<?php echo e(route('laporan.saya')); ?>" class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tata_letak.utama', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SI_PANTAU_TPS\resources\views/laporan/buat.blade.php ENDPATH**/ ?>