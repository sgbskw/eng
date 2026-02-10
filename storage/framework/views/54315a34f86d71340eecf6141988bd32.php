<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>نظام المكتب الهندسي | لوحة التحكم</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  
  <style>
    body { font-family: 'Cairo', sans-serif; }
    .content-wrapper { background-color: #f4f6f9; }
    /* تعديل الاتجاه للغة العربية */
    .main-sidebar { right: 0; left: auto !important; }
    .content-wrapper, .main-footer, .main-header { margin-right: 250px; margin-left: 0 !important; }
    @media (max-width: 992px) {
        .content-wrapper, .main-footer, .main-header { margin-right: 0 !important; }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">الرئيسية</a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link text-center">
      <span class="brand-text font-weight-light">المكتب الهندسي</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>لوحة التحكم</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('projects.create')); ?>" class="nav-link">
              <i class="nav-icon fas fa-plus-circle text-warning"></i>
              <p>تسجيل مشروع جديد</p>
            </a>
          </li>
          <li class="nav-item">
    <a href="/projects/all" class="nav-link">
        <i class="nav-icon fas fa-th-list"></i>
        <p>عرض جميع المشاريع</p>
    </a>
</li>
          <li class="nav-item">
            <a href="<?php echo e(route('employees.index')); ?>" class="nav-link">
              <i class="nav-icon fas fa-users text-info"></i>
              <p>إدارة المهندسين</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content pt-4">
      <div class="container-fluid">
        <?php echo $__env->yieldContent('content'); ?>
      </div>
    </div>
  </div>

  <footer class="main-footer text-center">
    <strong>جميع الحقوق محفوظة &copy; 2026 مكتب هندسي.</strong>
  </footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html><?php /**PATH C:\laragon\www\eng_office\resources\views/layouts/admin.blade.php ENDPATH**/ ?>