@extends('layouts.master')

@section('content')
<div class="project-container pb-5">
    <form id="aiProjectForm">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded-4 shadow-sm">
            <div>
                <h3 class="fw-bold m-0">تسجيل مشروع ذكي</h3>
                <p class="text-muted m-0">قم بتعبئة البيانات أو ارفع المخطط للاستدعاء الآلي</p>
            </div>
            <div class="text-end">
                <div class="small text-muted">رقم العقد</div>
                <input type="text" class="form-control form-control-sm fw-bold text-primary border-0 bg-light text-center" value="{{ $contract_no }}">
                <input type="date" class="form-control form-control-sm mt-1" value="{{ date('Y-m-d') }}">
            </div>
        </div>

        <div class="section-card mb-4 bg-white p-4 rounded-4 shadow-sm">
            <h5 class="fw-bold border-bottom pb-3 mb-3"><i class="fas fa-user-tie me-2 text-primary"></i> بيانات المالك</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">اسم المالك بالكامل</label>
                    <input type="text" class="form-control rounded-3" placeholder="أدخل الاسم">
                </div>
                <div class="col-md-3">
                    <label class="form-label">الرقم المدني (إجباري)</label>
                    <input type="number" class="form-control rounded-3" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">رقم الهاتف</label>
                    <div id="phone_container">
                        <input type="text" class="form-control rounded-3 mb-2" placeholder="96500000">
                    </div>
                    <button type="button" class="btn btn-sm btn-link p-0" onclick="addPhone()">+ إضافة رقم آخر</button>
                </div>
            </div>
            <div id="partners_area" class="mt-3"></div>
            <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addPartner()">+ إضافة شريك</button>
        </div>

        <div class="section-card mb-4 bg-white p-4 rounded-4 shadow-sm border-start border-4 border-success">
            <h5 class="fw-bold border-bottom pb-3 mb-3 text-success d-flex justify-content-between">
                <span><i class="fas fa-microchip me-2"></i> بيانات القسيمة والذكاء الاصطناعي</span>
                <span class="badge bg-success-soft text-success fs-6">AI Active</span>
            </h5>
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="upload-zone border-dashed p-4 rounded-4 text-center bg-light mb-3">
                        <i class="fas fa-file-pdf fa-2x mb-2 text-muted"></i>
                        <p class="small mb-2">ارفـق المخطط المساحي لاستخراج البيانات فوراً</p>
                        <input type="file" id="survey_pdf" class="form-control w-50 mx-auto" onchange="processAIFile()">
                    </div>
                </div>
                <div class="col-md-3"><label>اسم المنطقة</label><input type="text" class="form-control" id="area_name"></div>
                <div class="col-md-3"><label>رقم القطعة</label><input type="text" class="form-control" id="block_no"></div>
                <div class="col-md-3"><label>رقم القسيمة</label><input type="text" class="form-control" id="parcel_no"></div>
                <div class="col-md-3"><label>الرقم الآلي</label><input type="text" class="form-control" id="paci_no"></div>
                <div class="col-md-3 mt-3"><label>مساحة القسيمة (م2)</label><input type="text" class="form-control fw-bold text-success" id="space_val"></div>
                <div class="col-md-3 mt-3"><label>أبعاد القسيمة</label><input type="text" class="form-control" id="dims_val"></div>
                <div class="col-md-3 mt-3">
                    <label>نوع المشروع</label>
                    <select class="form-select">
                        <option>سكن خاص</option><option>استثماري</option><option>تجاري</option><option>جهة حكومية</option>
                        <option>مزرعة</option><option>جمعية</option><option>نادي</option><option>مستشفي</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label>نوع البناء</label>
                    <select class="form-select"><option>بناء جديد</option><option>ترميم</option><option>توسعة</option></select>
                </div>
            </div>
        </div>

        <div class="section-card mb-4 bg-white p-4 rounded-4 shadow-sm">
            <h5 class="fw-bold border-bottom pb-3 mb-4">اختيار الباقة والخدمات</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="package-box p-3 rounded-4 border text-center cursor-pointer" id="pkg_home" onclick="selectPackage('home')">
                        <i class="fas fa-home fa-2x mb-2 text-primary"></i>
                        <h6 class="fw-bold">خدمة بيتك</h6>
                        <small class="text-muted d-block">معماري - إنشائي - رخصة</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="package-box p-3 rounded-4 border text-center cursor-pointer" id="pkg_consult" onclick="selectPackage('consult')">
                        <i class="fas fa-user-tie fa-2x mb-2 text-info"></i>
                        <h6 class="fw-bold">خدمة الاستشاري</h6>
                        <small class="text-muted d-block">شاملة + كهرباء - صحي - 3D</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="package-box p-3 rounded-4 border text-center cursor-pointer" id="pkg_premium" onclick="selectPackage('premium')">
                        <i class="fas fa-crown fa-2x mb-2 text-warning"></i>
                        <h6 class="fw-bold">خدمة الامتياز</h6>
                        <small class="text-muted d-block">شاملة + داخلي - كميات</small>
                    </div>
                </div>
            </div>

            <div class="row mt-4" id="services_list">
                <div class="col-md-12 mb-2"><label class="fw-bold">تخصيص الخدمات:</label></div>
                @php $srvs = ['معماري','إنشائي','رخصة بلدية','كهرباء','صحي','واجهات 3D','تصميم داخلي','حصر كميات']; @endphp
                @foreach($srvs as $key => $s)
                <div class="col-md-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input srv-check" type="checkbox" id="srv_{{$key}}" data-name="{{$s}}">
                        <label class="form-check-label">{{$s}}</label>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div id="premium_details" class="mt-3 d-none">
                <label class="text-warning fw-bold">تفاصيل التصميم الداخلي يشمل:</label>
                <textarea class="form-control rounded-4" rows="2"></textarea>
            </div>

            <div class="mt-4 border-top pt-3">
                <label class="fw-bold">إضافة خدمات أخرى:</label>
                <div id="custom_services" class="d-flex flex-wrap gap-2 mb-2"></div>
                <div class="input-group w-50">
                    <input type="text" id="other_srv_input" class="form-control" placeholder="اسم الخدمة">
                    <button class="btn btn-dark" type="button" onclick="addOtherService()">إضافة</button>
                </div>
            </div>
        </div>

        <div class="section-card mb-4 bg-white p-4 rounded-4 shadow-sm">
            <h5 class="fw-bold border-bottom pb-3 mb-3">نظام الإشراف</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <select class="form-select" id="supervision_select" onchange="toggleSupervision()">
                        <option value="none">بدون إشراف</option>
                        <option value="free">إشراف مجاني (فترة محدودة)</option>
                        <option value="paid">إشراف مدفوع (من الشهر الأول)</option>
                    </select>
                </div>
                <div id="supervision_config" class="col-md-12"></div>
            </div>
        </div>

        <div class="section-card mb-4 bg-white p-4 rounded-4 shadow-sm">
            <h5 class="fw-bold border-bottom pb-3 mb-3">قيمة العقد والتحصيل</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="fw-bold">قيمة العقد الإجمالية (د.ك)</label>
                    <input type="number" id="total_contract" class="form-control form-control-lg fw-bold text-primary" oninput="calculatePayments()" placeholder="0.000">
                </div>
                <div class="col-md-6">
                    <label>نسخة العقد (PDF)</label>
                    <input type="file" class="form-control">
                </div>
            </div>
            <div id="payment_schedule" class="mt-4">
                <h6 class="fw-bold text-muted mb-3">جدول الدفعات:</h6>
                <div id="payments_list"></div>
                <button type="button" class="btn btn-sm btn-outline-dark mt-2" onclick="addPaymentRow()">+ إضافة دفعة</button>
                <div id="finance_alert" class="mt-2 small"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-4 shadow py-3 fw-bold">حفظ المشروع وإصدار الفاتورة</button>
    </form>
</div>

<script>
    // نظام الباقات التفاعلي
    function selectPackage(pkg) {
        const pkgDiv = document.getElementById('pkg_' + (pkg === 'home' ? 'home' : pkg === 'consult' ? 'consult' : 'premium'));
        const isAlreadySelected = pkgDiv.classList.contains('package-active');

        // إعادة ضبط الكل
        document.querySelectorAll('.package-box').forEach(b => b.classList.remove('package-active'));
        document.querySelectorAll('.srv-check').forEach(c => c.checked = false);
        document.getElementById('premium_details').classList.add('d-none');

        if (isAlreadySelected) {
            // إذا ضغط مرة أخرى يتم الإلغاء
            return;
        }

        pkgDiv.classList.add('package-active');
        if(pkg === 'home') {
            document.getElementById('srv_0').checked = true;
            document.getElementById('srv_1').checked = true;
            document.getElementById('srv_2').checked = true;
        } else if(pkg === 'consult') {
            [0,1,2,3,4,5].forEach(i => document.getElementById('srv_'+i).checked = true);
        } else if(pkg === 'premium') {
            [0,1,2,3,4,5,6,7].forEach(i => document.getElementById('srv_'+i).checked = true);
            document.getElementById('premium_details').classList.remove('d-none');
        }
    }

    // نظام الإشراف
    function toggleSupervision() {
        const val = document.getElementById('supervision_select').value;
        const config = document.getElementById('supervision_config');
        config.innerHTML = '';
        if(val === 'free') {
            config.innerHTML = `
                <div class="row g-2 mt-2 p-3 bg-light rounded-4">
                    <div class="col-md-4"><label>المدة المجانية</label><select class="form-select"><option>شهر واحد</option><option>شهرين</option><option>3 شهور</option></select></div>
                    <div class="col-md-4"><label>القيمة بعد المجاني</label><input type="number" class="form-control"></div>
                    <div class="col-md-4"><label>لمدة (شهور)</label><input type="number" class="form-control"></div>
                    <div id="extra_sup_area" class="col-12 mt-2"></div>
                    <button type="button" class="btn btn-sm btn-link text-start" onclick="addExtraSup()">+ إضافة قيمة لاحقة أخرى</button>
                </div>
            `;
        } else if(val === 'paid') {
            config.innerHTML = `
                <div class="row g-2 mt-2 p-3 bg-light rounded-4">
                    <div class="col-md-6"><label>قيمة الإشراف الشهرية</label><input type="number" class="form-control"></div>
                    <div class="col-md-6"><label>لمدة (شهور)</label><input type="number" class="form-control"></div>
                </div>
            `;
        }
    }

    // تدقيق المالية (الدفعات)
    function calculatePayments() {
        const total = parseFloat(document.getElementById('total_contract').value) || 0;
        let sum = 0;
        document.querySelectorAll('.pay-input').forEach(i => sum += parseFloat(i.value) || 0);
        
        const alert = document.getElementById('finance_alert');
        if(sum === total && total > 0) {
            alert.innerHTML = '<span class="text-success">✓ الدفعات مطابقة تماماً للقيمة</span>';
        } else {
            alert.innerHTML = `<span class="text-danger">⚠ المجموع الحالي (${sum}) لا يساوي العقد (${total})</span>`;
        }
    }

    function addPaymentRow() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `<input type="text" class="form-control" placeholder="وصف الدفعة"><input type="number" class="form-control pay-input" placeholder="المبلغ" oninput="calculatePayments()">`;
        document.getElementById('payments_list').appendChild(div);
    }
</script>

<style>
    .cursor-pointer { cursor: pointer; }
    .package-box { transition: 0.3s; border: 2px solid #eee !important; }
    .package-box:hover { background: #f8f9fa; transform: translateY(-3px); }
    .package-active { border-color: #0d6efd !important; background: #e7f1ff; }
    .border-dashed { border: 2px dashed #ccc; }
    .bg-success-soft { background: #e8f5e9; }
</style>
@endsection