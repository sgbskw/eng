
<?php $__env->startSection('content'); ?>
<div class="invoice p-3 mb-3">
    <div class="row">
        <div class="col-12">
            <h4> <i class="fas fa-user"></i> تقرير أداء المهندس: <?php echo e($employee->name); ?>

                <small class="float-right">التاريخ: <?php echo e(date('Y-m-d')); ?></small>
            </h4>
        </div>
    </div>
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            تخصص: <strong><?php echo e($employee->specialization); ?></strong><br>
            الحالة: <span class="badge bg-success"><?php echo e($employee->status); ?></span>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead> <tr> <th>المشروع</th> <th>نسبة الإنجاز</th> <th>الحالة</th> </tr> </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $employee->projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($project->name); ?></td>
                        <td><?php echo e($project->progress); ?>%</td>
                        <td><?php echo e($project->status); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" class="text-center">لا توجد مشاريع مسندة حالياً</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <i class="fas fa-user-tie fa-5x text-muted"></i>
                    </div>
                    <h3 class="profile-username text-center"><?php echo e($employee->name); ?></h3>
                    <p class="text-muted text-center"><?php echo e($employee->specialization); ?></p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>المسمى الوظيفي</b> <a class="float-right"><?php echo e($employee->job_title); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>الحالة</b> <a class="float-right"><span class="badge bg-success"><?php echo e($employee->status); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title">المشاريع المسندة والتقارير</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>اسم المشروع</th>
                                <th>نسبة الإنجاز</th>
                                <th>الحالة</th>
                                <th>آخر تحديث</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($project->name); ?></td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: <?php echo e($project->progress); ?>%"></div>
                                    </div>
                                    <small><?php echo e($project->progress); ?>%</small>
                                </td>
                                <td><span class="badge bg-info"><?php echo e($project->status); ?></span></td>
                                <td><?php echo e($project->updated_at->format('Y-m-d')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">لا توجد مشاريع مسندة لهذا المهندس حالياً</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <button onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> طباعة التقرير</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h3 class="profile-username text-center"><?php echo e($employee->name); ?></h3>
                    <p class="text-muted text-center"><?php echo e($employee->specialization); ?></p>
                    <hr>
                    <strong><i class="fas fa-briefcase mr-1"></i> المسمى الوظيفي</strong>
                    <p class="text-muted"><?php echo e($employee->job_title); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-secondary"> <h3 class="card-title">إسناد مشروع جديد</h3> </div>
                <div class="card-body">
                    <form action="<?php echo e(route('projects.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="employee_id" value="<?php echo e($employee->id); ?>">
                        <div class="form-group">
                            <label>اسم المشروع</label>
                            <input type="text" name="name" class="form-control" placeholder="مثلاً: فيلا اليرموك" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>نسبة الإنجاز</label>
                            <input type="number" name="progress" class="form-control" value="0" max="100">
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-3 w-100">حفظ المشروع</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h3 class="card-title">المشاريع التي يعمل عليها حالياً</h3> </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>المشروع</th>
                                <th>نسبة الإنجاز</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($project->name); ?></td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-success" style="width: <?php echo e($project->progress); ?>%"></div>
                                    </div>
                                    <small><?php echo e($project->progress); ?>%</small>
                                </td>
                                <td><span class="badge bg-info"><?php echo e($project->status); ?></span></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="3" class="text-center">لا توجد مشاريع مسندة</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\eng_office\resources\views/employee_report.blade.php ENDPATH**/ ?>