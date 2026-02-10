

<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-bold"><i class="fas fa-list-alt"></i> سجل المشاريع والقسائم</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-success shadow-sm">
                    <i class="fas fa-plus"></i> تسجيل قسيمة جديدة
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>الرقم الآلي</th>
                            <th>المنطقة / القسيمة</th>
                            <th>المهندس المسؤول</th>
                            <th>المخطط المساحي</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $projects = \App\Models\Project::with('employee')->get(); ?>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="badge badge-secondary p-2"><?php echo e($project->paci_number ?? 'غير مسجل'); ?></span></td>
                            <td>
                                <b><?php echo e($project->area); ?></b><br>
                                <small>قطعة: <?php echo e($project->block); ?> - قسيمة: <?php echo e($project->parcel_number); ?></small>
                            </td>
                            <td><?php echo e($project->employee->name ?? 'غير محدد'); ?></td>
                            <td>
                                <?php if($project->cadastral_plan): ?>
                                    <a href="<?php echo e(asset('storage/' . $project->cadastral_plan)); ?>" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-file-pdf"></i> عرض المخطط
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">لا يوجد ملف</span>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge badge-info">قيد الدراسة</span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\eng_office\resources\views/projects_index.blade.php ENDPATH**/ ?>