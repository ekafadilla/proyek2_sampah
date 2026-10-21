
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun | SI PANTAU TPS</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        .container {
            max-width: 460px;
            margin: 45px auto;
            padding: 28px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 28px #00000012;
        }
        h1 { margin-top: 0; font-size: 25px; }
        p { color: #64748b; }
        label {
            display: block;
            margin: 16px 0 7px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }
        button {
            width: 100%;
            padding: 13px;
            margin-top: 22px;
            border: 0;
            border-radius: 8px;
            background: #15803d;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .error {
            color: #b91c1c;
            font-size: 14px;
            margin-top: 5px;
        }
        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
        }
        a { color: #15803d; }
    </style>
</head>
<body>
<div class="container">
    <h1>Buat Akun</h1>
    <p>Daftar sebagai masyarakat di SI PANTAU TPS.</p>

    <?php if($errors->any()): ?>
        <div class="alert">
            <strong>Pendaftaran belum berhasil.</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('register.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <label for="name">Nama lengkap</label>
        <input id="name" name="name" type="text"
               value="<?php echo e(old('name')); ?>" maxlength="255" required>
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label for="email">Email</label>
        <input id="email" name="email" type="email"
               value="<?php echo e(old('email')); ?>" maxlength="255" required>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label for="no_hp">Nomor HP</label>
        <input id="no_hp" name="no_hp" type="text"
               value="<?php echo e(old('no_hp')); ?>" maxlength="25">
        <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label for="password">Kata sandi</label>
        <input id="password" name="password" type="password"
               minlength="8" required>
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label for="password_confirmation">Konfirmasi kata sandi</label>
        <input id="password_confirmation" name="password_confirmation"
               type="password" minlength="8" required>

        <button type="submit">Daftar Sekarang</button>
    </form>

    <p>Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Masuk</a></p>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\SI_PANTAU_TPS\resources\views/autentikasi/daftar.blade.php ENDPATH**/ ?>