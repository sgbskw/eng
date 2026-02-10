

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header"> <h3 class="card-title">إضافة موظف جديد للمكتب</h3> </div>
        <form action="<?php echo e(route('employees.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card-body row">
                <div class="form-group col-md-3">
                    <label>اسم المهندس</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>التخصص</label>
                    <select name="specialization" class="form-control">
                        <option value="معماري">هندسة معمارية</option>
                        <option value="إنشائي">هندسة إنشائية</option>
                        <option value="كهرباء">هندسة كهرباء</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>المسمى الوظيفي</label>
                    <input type="text" name="job_title" class="form-control" placeholder="مثلاً: مهندس تصميم">
                </div>
                <div class="form-group col-md-2" style="margin-top: 32px;">
                    <button type="submit" class="btn btn-primary">حفظ الموظف</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card mt-4">
        <div class="card-header"> <h3 class="card-title">قائمة الموظفين والمتابعة الحالية</h3> </div>
        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>التخصص</th>
                        <th>الحالة</th>
                        <th>المهام</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($emp->name); ?></td>
                        <td><span class="badge bg-info"><?php echo e($emp->specialization); ?></span></td>
                        <td><span class="badge bg-success"><?php echo e($emp->status); ?></span></td>
                        <td><?php echo e($emp->tasks_count); ?> مهام</td>
                        <td>
                            <a href="<?php echo e(route('employees.report', $emp->id)); ?>" class="btn btn-sm btn-outline-primary">تقرير منفصل</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\eng_office\resources\views/staff_list.blade.php ENDPATH**/ ?>