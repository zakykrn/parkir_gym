<nav class="admin-navbar">
    <div class="navbar-brand">
        <span class="brand-icon">🚗</span>
        <span class="brand-text">Admin Parkir</span>
    </div>
    <div class="navbar-menu">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            Dashboard
        </a>
        <a href="<?php echo e(route('admin.data')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.data') ? 'active' : ''); ?>">
            Data Parkir
        </a>
        <a href="<?php echo e(route('admin.settings')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings') ? 'active' : ''); ?>">
            Pengaturan
        </a>
        <div class="nav-user">
            <span class="user-name"><?php echo e(Auth::guard('admin')->user()->nama); ?></span>
            <form action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-link logout" style="background: none; border: none; cursor: pointer;">Logout</button>
            </form>
        </div>
    </div>
</nav>

<?php /**PATH C:\xampp\htdocs\smartparking-main\resources\views/admin/navbar.blade.php ENDPATH**/ ?>