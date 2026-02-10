<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office AI - النظام الهندسي</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Cairo', sans-serif; background: #f4f7fa; }
        #sidebar { width: 260px; height: 100vh; position: fixed; background: #fff; transition: 0.3s; border-left: 1px solid #eee; z-index: 1000; }
        #sidebar.collapsed { width: 80px; }
        #content { margin-right: 260px; transition: 0.3s; padding: 20px; }
        #content.expanded { margin-right: 80px; }
        .nav-link { color: #555; padding: 12px 20px; border-radius: 12px; margin: 5px 15px; }
        .nav-link.active { background: #f0f4ff; color: #0d6efd; font-weight: bold; }
        .sidebar-toggle { cursor: pointer; padding: 20px; text-align: left; }
        .hide-on-collapse { display: inline; }
        .collapsed .hide-on-collapse { display: none; }
    </style>
</head>
<body>

<div id="sidebar">
    <div class="sidebar-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></div>
    <div class="nav flex-column mt-3">
        <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>">
            <i class="fas fa-home me-2"></i> <span class="hide-on-collapse">الرئيسية</span>
        </a>
        <a href="<?php echo e(route('projects.create')); ?>" class="nav-link <?php echo e(request()->is('projects/create') ? 'active' : ''); ?>">
            <i class="fas fa-plus-circle me-2"></i> <span class="hide-on-collapse">تسجيل مشروع</span>
        </a>
    </div>
</div>

<div id="content">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.getElementById('content').classList.toggle('expanded');
    }
</script>
</body>
</html><?php /**PATH C:\laragon\www\eng_office\resources\views/layouts/master.blade.php ENDPATH**/ ?>