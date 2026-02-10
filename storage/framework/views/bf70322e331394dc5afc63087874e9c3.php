<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل مشروع جديد</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Cairo', sans-serif; background: #f4f7f6; display: flex; }
        .sidebar { width: 260px; height: 100vh; position: fixed; right: 0; background: #1a237e; color: white; z-index: 1000; }
        .sidebar a { color: white; text-decoration: none; padding: 15px 20px; display: block; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .main-content { margin-right: 260px; padding: 30px; width: 100%; }
        .section-card { background: white; border-radius: 15px; padding: 25px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .section-title { border-right: 5px solid #1a237e; padding-right: 15px; margin-bottom: 20px; color: #1a237e; font-weight: bold; }
        .package-card { cursor: pointer; border: 2px solid #eee; border-radius: 12px; padding: 15px; text-align: center; transition: 0.3s; }
        .package-active { border-color: #1a237e; background: #e8eaf6; }
        #loader { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); z-index:9999; justify-content:center; align-items:center; flex-direction:column; }
    </style>
</head>
<body>

<div id="loader">
    <div class="spinner-border text-primary"></div>
    <h5 class="mt-3">جاري الاستدعاء الآلي...</h5>
</div>

<div class="sidebar">
    <div class="p-4 text-center border-bottom"><h4>المكتب الهندسي</h4></div>
    <div class="nav flex-column">
        <a href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-home me-2"></i> الرئيسية</a>
        <a href="<?php echo e(route('projects.create')); ?>" class="bg-primary"><i class="fas fa-plus-circle me-2"></i> تسجيل مشروع</a>
    </div>
</div>

<div class="main-content">
    <form action="#" id="projectForm">
        <div class="d-flex justify-content-between mb-4">
            <h3 class="fw-bold">تسجيل مشروع جديد</h3>
            <div class="bg-white p-3 rounded border shadow-sm">
                رقم العقد: <b class="text-primary"><?php echo e($contract_no); ?></b>
            </div>
        </div>

        <div class="section-card">
            <h5 class="section-title">بيانات المالك والشركاء</h5>
            <div class="row g-3">
                <div class="col-md-6"><label>اسم المالك</label><input type="text" class="form-control" required></div>
                <div class="col-md-3"><label>الرقم المدني</label><input type="text" class="form-control" required></div>
                <div class="col-md-3">
                    <label>أرقام الهاتف</label>
                    <div id="phone-inputs"><input type="text" class="form-control mb-2" placeholder="رقم أساسي"></div>
                    <button type="button" class="btn btn-sm btn-link p-0" onclick="addPhone()">+ رقم إضافي</button>
                </div>
            </div>
            <div id="partners-section" class="mt-3"></div>
            <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="addPartner()">+ إضافة شركاء</button>
        </div>

        <div class="section-card">
            <h5 class="section-title text-success">بيانات القسيمة (AI الاستدعاء)</h5>
            <div class="alert alert-light border mb-3">
                <label class="fw-bold mb-2 text-primary">ارفق المخطط (PDF/Image) للاستدعاء:</label>
                <input type="file" id="survey_pdf" class="form-control border-primary" onchange="runSmartScan()">
            </div>
            <div class="row g-3">
                <div class="col-md-3"><label>المنطقة</label><input type="text" id="area" class="form-control"></div>
                <div class="col-md-2"><label>القطعة</label><input type="text" id="block" class="form-control"></div>
                <div class="col-md-2"><label>القسيمة</label><input type="text" id="parcel" class="form-control"></div>
                <div class="col-md-2"><label>المساحة</label><input type="text" id="space" class="form-control"></div>
                <div class="col-md-3"><label>الأبعاد</label><input type="text" id="dims" class="form-control fw-bold"></div>
                <div class="col-md-6 mt-3">
                    <label>نوع المشروع</label>
                    <select class="form-select"><option>سكن خاص</option><option>استثماري</option><option>تجاري</option></select>
                </div>
                <div class="col-md-6 mt-3">
                    <label>نوع البناء</label>
                    <select class="form-select"><option>بناء جديد</option><option>ترميم</option><option>توسعة</option></select>
                </div>
            </div>
        </div>

        <div class="section-card">
            <h5 class="section-title">نظام الإشراف الهندسي</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label>اختر النظام</label>
                    <select class="form-select" id="sup_mode" onchange="updateSupUI()">
                        <option value="none">بدون إشراف</option>
                        <option value="free">إشراف مجاني لفترة</option>
                        <option value="paid">إشراف مدفوع فوراً</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <div id="sup_config_area"></div>
                </div>
            </div>
        </div>

        <div class="section-card border-primary border-2">
            <h5 class="section-title">المالية (تدقيق الدفعات)</h5>
            <div class="row g-3">
                <div class="col-md-4 text-center border-end">
                    <label class="fw-bold">إجمالي قيمة العقد</label>
                    <input type="number" id="total_contract" class="form-control form-control-lg text-center text-primary" value="0" oninput="checkFinance()">
                    <div id="fin_status" class="mt-2 badge bg-danger w-100 p-2">الدفعات غير متطابقة</div>
                </div>
                <div class="col-md-8">
                    <div id="payment-rows"></div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addPaymentRow()">+ إضافة دفعة</button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 mt-4 shadow">حفظ المشروع</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // الاستدعاء الآلي
    function runSmartScan() {
        $('#loader').css('display', 'flex');
        let fd = new FormData();
        fd.append('survey_pdf', $('#survey_pdf')[0].files[0]);
        fd.append('_token', '<?php echo e(csrf_token()); ?>');
        
        $.ajax({
            url: '<?php echo e(route("projects.scan")); ?>',
            method: 'POST', data: fd, processData: false, contentType: false,
            success: function(res) {
                $('#loader').hide();
                if(res.success) {
                    $('#area').val(res.data.area); $('#block').val(res.data.block);
                    $('#parcel').val(res.data.parcel); $('#space').val(res.data.space);
                    $('#dims').val(res.data.dims);
                } else { alert("لم ينجح الاستدعاء: " + res.message); }
            },
            error: function() { $('#loader').hide(); alert("خطأ في الاتصال بالسيرفر"); }
        });
    }

    // نظام الإشراف
    function updateSupUI() {
        let mode = $('#sup_mode').val();
        let area = $('#sup_config_area');
        area.empty();
        if(mode === 'free') {
            area.append(`
                <div class="row g-2">
                    <div class="col-4"><label>شهور المجاني</label><select class="form-select"><option>1 شهر</option><option>3 شهور</option><option>6 شهور</option></select></div>
                    <div class="col-4"><label>القيمة اللاحقة</label><input type="number" class="form-control" placeholder="د.ك"></div>
                    <div class="col-4"><label>المدة (شهر)</label><input type="number" class="form-control"></div>
                </div>
                <div id="extra_rates" class="mt-2"></div>
                <button type="button" class="btn btn-link btn-sm p-0 mt-2" onclick="addExtraRate()">+ إضافة قيمة لاحقة أخرى</button>
            `);
        } else if(mode === 'paid') {
            area.append(`
                <div class="row g-2">
                    <div class="col-6"><label>قيمة الإشراف من أول شهر</label><input type="number" class="form-control"></div>
                    <div class="col-6"><label>لمدة (شهر)</label><input type="number" class="form-control"></div>
                </div>
            `);
        }
    }

    function addExtraRate() { $('#extra_rates').append('<div class="row g-2 mt-2"><div class="col-6"><input class="form-control" placeholder="القيمة"></div><div class="col-6"><input class="form-control" placeholder="لعدد شهور"></div></div>'); }

    // تدقيق المالية
    function checkFinance() {
        let total = parseFloat($('#total_contract').val()) || 0;
        let sum = 0;
        $('.p-amount').each(function() { sum += parseFloat($(this).val()) || 0; });
        let status = $('#fin_status');
        if(sum === total && total > 0) {
            status.text("✓ الدفعات متطابقة").removeClass('bg-danger').addClass('bg-success');
        } else {
            status.text("⚠ المتبقي: " + (total - sum) + " د.ك").removeClass('bg-success').addClass('bg-danger');
        }
    }

    function addPaymentRow() {
        $('#payment-rows').append('<div class="input-group mb-2"><input class="form-control" placeholder="وصف الدفعة"><input type="number" class="form-control p-amount" placeholder="المبلغ" oninput="checkFinance()"></div>');
    }

    function addPartner() { $('#partners-section').append('<div class="row g-2 mb-2"><div class="col-7"><input class="form-control" placeholder="اسم الشريك"></div><div class="col-5"><input class="form-control" placeholder="المدني"></div></div>'); }
    function addPhone() { $('#phone-inputs').append('<input class="form-control mb-2" placeholder="رقم إضافي">'); }

    // تهيئة الدفعة الأولى
    addPaymentRow();
</script>
</body>
</html><?php /**PATH C:\laragon\www\eng_office\resources\views/projects_create.blade.php ENDPATH**/ ?>