<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin - Sistem Parkir'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body>
    <?php echo $__env->make('admin.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="admin-container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\smartparking-main\resources\views/layouts/admin.blade.php ENDPATH**/ ?>