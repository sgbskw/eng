

<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div x-data="projectWizard()" class="max-w-6xl mx-auto space-y-8 pb-20">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">تسجيل مشروع هندسي جديد</h1>
            <p class="text-gray-500">التحكم الذكي بالباقات والمخططات المساحية</p>
        </div>
        <div class="flex items-center gap-4 bg-white p-2 rounded-2xl shadow-sm border border-blue-100">
            <div class="p-3 bg-blue-600 text-white rounded-xl font-bold">عقد رقم: <span x-text="contractNumber"></span></div>
            <div class="px-4">
                <label class="block text-[10px] text-gray-400">تاريخ التسجيل</label>
                <input type="date" x-model="registrationDate" class="font-bold text-gray-700 border-none p-0 focus:ring-0 cursor-pointer">
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
        <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
            <span class="p-2 bg-blue-100 text-blue-600 rounded-lg text-sm">👤</span> بيانات المالك والشركاء
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-600">بيانات المالك الرئيسي</label>
<div class="w-full">
    <input type="text" 
           placeholder="اسم المالك بالكامل *"
                     :class="errors.owner_name ? 'border-2 border-red-500 bg-red-50' : 'border-none'"
           class="w-full p-4 bg-gray-50 rounded-2xl outline-none">
           
    <p x-show="errors.owner_name" x-text="errors.owner_name" class="text-red-500 text-xs mt-1 font-bold"></p>
</div>
<div class="w-full mt-4">
    <input type="number" 
           x-model="ownerCivilId"
           placeholder="الرقم المدني (12 رقم) *"
           :class="errors.civil_id ? 'border-2 border-red-500 bg-red-50' : 'border-none'"
           class="w-full p-4 bg-gray-50 rounded-2xl outline-none">
           
    <p x-show="errors.civil_id" x-text="errors.civil_id" class="text-red-500 text-xs mt-1 font-bold"></p>
</div>               
                <div x-show="aiFoundContract" x-transition class="p-4 bg-indigo-50 rounded-2xl border border-indigo-100 flex items-center gap-4">
                    <span class="text-2xl animate-bounce">🤖</span>
                    <p class="text-sm text-indigo-700 font-bold">
                        تم العثور على عقد سابق (رقم: 2023-085) مسجل بهذا الرقم المدني. <a href="#" class="underline">عرض السجل</a>
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-600">الشركاء وأرقام التواصل</label>
                <template x-for="(partner, index) in partners" :key="index">
                    <div class="flex gap-2 mb-2 animate-fade-in">
                        <input type="text" x-model="partner.name" placeholder="اسم الشريك" class="flex-1 p-3 bg-gray-50 border-none rounded-xl text-sm">
                        <input type="number" x-model="partner.civilId" placeholder="المدني" class="w-32 p-3 bg-gray-50 border-none rounded-xl text-sm">
                        <button @click="removePartner(index)" type="button" class="text-red-400 px-1">✕</button>
                    </div>
                </template>
                <button @click="addPartner()" type="button" class="text-blue-600 text-xs font-bold">+ إضافة شريك</button>

                <div class="mt-4 pt-4 border-t">
                    <template x-for="(phone, index) in phones" :key="index">
                        <div class="flex gap-2 mb-2">
                            <input type="tel" x-model="phones[index]" placeholder="رقم الهاتف" class="flex-1 p-3 bg-gray-50 border-none rounded-xl text-sm">
                            <button @click="removePhone(index)" type="button" class="text-red-400 px-1" x-show="phones.length > 1">✕</button>
                        </div>
                    </template>
                    <button @click="addPhone()" type="button" class="text-blue-600 text-xs font-bold">+ إضافة هاتف آخر</button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#1e1e2d] text-white p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
        <h3 class="text-xl font-bold mb-6 flex items-center gap-2">🤖 معالج المخطط المساحي الذكي</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="border-2 border-dashed border-gray-600 rounded-[2rem] p-8 text-center hover:border-blue-500 transition cursor-pointer bg-gray-800/50" @click="$refs.pdfInput.click()">
                <input type="file" x-ref="pdfInput" class="hidden" @change="processPdf($event)">
                <div x-show="!isProcessing" class="animate-pulse">
                    <div class="mb-4 text-4xl">📄</div>
                    <p class="font-bold">ارفق المخطط المساحي (PDF)</p>
                    <p class="text-xs text-gray-400 mt-2 italic">سيتم جلب الأبعاد والمساحة آلياً من الملف المرفق</p>
                </div>
                <div x-show="isProcessing" class="text-blue-400">
                    <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                    <p class="font-bold">جاري قراءة الملف واستخراج البيانات...</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-[10px] text-gray-500 uppercase">المنطقة</label><input type="text" x-model="siteData.area" class="w-full bg-gray-800 border-none rounded-xl p-3"></div>
                <div><label class="text-[10px] text-gray-500 uppercase">قطعة</label><input type="text" x-model="siteData.block" class="w-full bg-gray-800 border-none rounded-xl p-3"></div>
                <div><label class="text-[10px] text-gray-500 uppercase">قسيمة</label><input type="text" x-model="siteData.plot" class="w-full bg-gray-800 border-none rounded-xl p-3"></div>
                <div><label class="text-[10px] text-gray-500 uppercase">الرقم الآلي</label><input type="text" x-model="siteData.paci" class="w-full bg-gray-800 border-none rounded-xl p-3"></div>
                <div class="col-span-2 p-3 bg-blue-900/20 rounded-xl border border-blue-900/50">
                    <label class="text-[10px] text-blue-400 font-bold uppercase block mb-1">الأبعاد والمساحة (مستخرج آلياً من المخطط)</label>
                    <div class="text-lg font-bold text-white tracking-widest" x-text="siteData.dimensions"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
            <select class="w-full bg-gray-800 border-none rounded-xl p-4 text-gray-300">
                <option value="">-- نوع المشروع --</option>
                <template x-for="type in projectTypes" :key="type">
                    <option :value="type" x-text="type"></option>
                </template>
            </select>
            <select class="w-full bg-gray-800 border-none rounded-xl p-4 text-gray-300">
                <option value="">-- نوع البناء --</option>
                <template x-for="build in buildTypes" :key="build">
                    <option :value="build" x-text="build"></option>
                </template>
            </select>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
        <h3 class="text-xl font-bold mb-6">📦 باقات الخدمات</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div @click="togglePackage('home')" :class="selectedPackage === 'home' ? 'border-blue-600 bg-blue-50' : 'border-gray-100'" class="p-6 border-2 rounded-[2rem] cursor-pointer transition-all">
                <h4 class="font-bold text-blue-800">خدمة بيتك</h4>
                <p class="text-xs text-gray-500 mt-2 italic">معماري + إنشائي + رخصة</p>
            </div>
            <div @click="togglePackage('expert')" :class="selectedPackage === 'expert' ? 'border-purple-600 bg-purple-50' : 'border-gray-100'" class="p-6 border-2 rounded-[2rem] cursor-pointer transition-all">
                <h4 class="font-bold text-purple-800">خدمة الاستشاري</h4>
                <p class="text-xs text-gray-500 mt-2 italic">+ كهرباء، صحي، واجهات 3D</p>
            </div>
            <div @click="togglePackage('premium')" :class="selectedPackage === 'premium' ? 'border-orange-600 bg-orange-50' : 'border-gray-100'" class="p-6 border-2 rounded-[2rem] cursor-pointer transition-all">
                <h4 class="font-bold text-orange-800">خدمة الامتياز</h4>
                <p class="text-xs text-gray-500 mt-2 italic">+ تصميم داخلي وحصر كميات</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-3xl">
            <h4 class="text-sm font-bold text-gray-400 uppercase mb-4 tracking-widest">الخدمات المختارة حالياً</h4>
            <div class="flex flex-wrap gap-3 mb-6">
                <template x-for="(service, index) in allServices" :key="index">
                    <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-gray-200">
                        <input type="checkbox" x-model="service.selected" class="rounded text-blue-600">
                        <span class="text-sm font-medium text-gray-700" x-text="service.name"></span>
                    </div>
                </template>
            </div>
            <div class="flex gap-2 max-w-md">
                <input type="text" x-model="newServiceName" placeholder="أدخل اسم خدمة أخرى..." class="flex-1 p-3 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                <button @click="addCustomService()" type="button" class="bg-gray-800 text-white px-6 rounded-xl text-sm font-bold hover:bg-black transition">إضافة +</button>
            </div>
            <div x-show="isInteriorSelected()" x-transition class="animate-fade-in p-6 bg-orange-50 rounded-2xl border border-orange-100">
                <label class="block text-sm font-bold text-orange-700 mb-2">ماذا يشمل التصميم الداخلي؟</label>
                <textarea class="w-full p-4 border-none rounded-xl focus:ring-0 bg-white" placeholder="مثلاً: يشمل الصالات، غرف النوم الرئيسية، وتوزيع الإضاءة..."></textarea>
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
        <h3 class="text-xl font-bold mb-6 flex items-center gap-3">👮 نظام الإشراف (تدرج 3 مراحل)</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 bg-blue-50 rounded-2xl">
                <label class="block text-xs font-bold text-blue-600 mb-2 underline">المرحلة 1: الإشراف المجاني</label>
                <select class="w-full p-3 bg-white border-none rounded-xl text-sm">
                    <option value="0">بدون مجاني</option>
                    <template x-for="n in 5" :key="n">
                        <option :value="n" x-text="n + ' شهور مجانية'"></option>
                    </template>
                </select>
            </div>
            <div class="p-4 bg-gray-50 rounded-2xl">
                <label class="block text-xs font-bold text-gray-600 mb-2 underline">المرحلة 2: القيمة الأولى</label>
                <div class="flex gap-2">
                    <input type="number" placeholder="القيمة" class="w-20 p-3 bg-white border-none rounded-xl text-sm">
                    <input type="text" placeholder="المدة (مثلاً: 6 شهور)" class="flex-1 p-3 bg-white border-none rounded-xl text-sm">
                </div>
            </div>
            <div class="p-4 bg-gray-50 rounded-2xl">
                <label class="block text-xs font-bold text-gray-600 mb-2 underline">المرحلة 3: القيمة اللاحقة</label>
                <div class="flex gap-2">
                    <input type="number" placeholder="القيمة" class="w-20 p-3 bg-white border-none rounded-xl text-sm">
                    <input type="text" placeholder="المرحلة (مثلاً: حتى التسليم)" class="flex-1 p-3 bg-white border-none rounded-xl text-sm">
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-xl font-bold">📄 العقد والمالية</h3>
            <div class="p-6 bg-green-50 rounded-3xl border border-green-100">
                <label class="block text-sm font-bold text-green-700 mb-2">قيمة العقد الإجمالية (د.ك):</label>
                <input type="number" x-model="totalContract" class="w-full p-4 text-3xl font-bold bg-white text-green-700 border-none rounded-2xl outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div class="space-y-3 pt-4">
                <div class="flex justify-between items-center text-xs font-bold">
                    <span class="text-gray-400 uppercase tracking-widest">تقسيم الدفعات</span>
                    <span :class="(totalContract - totalPayments()) === 0 ? 'text-green-600' : 'text-red-500'" x-text="'المتبقي: ' + (totalContract - totalPayments()) + ' د.ك'"></span>
                </div>
                <template x-for="(payment, index) in payments" :key="index">
                    <div class="flex gap-2">
                        <input type="text" x-model="payment.name" class="flex-1 p-3 bg-gray-50 border-none rounded-xl text-sm">
                        <input type="number" x-model.number="payment.amount" class="w-24 p-3 bg-gray-50 border-none rounded-xl text-sm font-bold">
                        <button @click="removePayment(index)" class="text-red-400 px-1">✕</button>
                    </div>
                </template>
                <button @click="addPayment()" type="button" class="text-xs font-bold text-blue-600">+ إضافة دفعة</button>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-xl font-bold">📎 المرفقات (تحميل ذكي)</h3>
            <div class="space-y-3">
                <template x-for="(att, index) in attachments" :key="index">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <input type="text" x-model="att.name" class="bg-transparent border-none p-0 text-sm font-bold focus:ring-0 w-1/2">
                        <div class="flex items-center gap-2">
                            <input type="file" class="hidden" :id="'file-'+index">
                            <label :for="'file-'+index" class="cursor-pointer text-xs bg-white px-3 py-1 rounded-lg border shadow-sm">ارفق الملف</label>
                            <button @click="removeAttachment(index)" class="text-red-400">✕</button>
                        </div>
                    </div>
                </template>
                <button @click="addAttachment()" type="button" class="w-full p-4 border-2 border-dashed border-gray-200 rounded-2xl text-gray-400 text-sm hover:border-blue-300 transition">+ إضافة مرفق يدوي</button>
            </div>
        </div>
    </div>

<button 
    type="button" 
    @click="submitProject()" 
    :disabled="isProcessing"
    class="w-full py-6 bg-blue-600 text-white rounded-[2rem] font-bold text-xl shadow-2xl hover:bg-blue-700 transition flex items-center justify-center gap-3"
>
    <span x-show="!isProcessing">اعتماد وتسجيل العقد نهائياً 🚀</span>
    <span x-show="isProcessing">جاري المعالجة... ⏳</span>
</button>
</div>

<script>
function projectWizard() {
    return {
        showSuccessMessage: false,
        errors: {}, 
        newServiceName: '', 
        isProcessing: false,
        savedProjectDetails: { id: '', date: '' },
        // ------------------------------
               
        contractNumber: 'KWT-2026-' + Math.floor(Math.random() * 9000 + 1000),
        registrationDate: new Date().toISOString().split('T')[0],
        ownerCivilId: '',
        aiFoundContract: false,
        isProcessing: false,
        selectedPackage: null,
        totalContract: 0,
        phones: [''],
        partners: [],
        projectTypes: ['سكن خاص', 'استثماري', 'تجاري', 'جهة حكومية', 'مزرعة', 'جمعية', 'نادي', 'مستشفي', 'مسجد', 'أخرى'],
        buildTypes: ['جديد', 'إضافة', 'تعديل', 'هدم', 'ترميم', 'تعديل واضافة', 'حديقة', 'تجديد ترخيص', 'أخرى'],
        siteData: { area: '', block: '', plot: '', paci: '', dimensions: '-- بانتظار الملف --' },
        allServices: [
            { name: 'تصميم معماري', selected: false }, { name: 'تصميم انشائي', selected: false },
            { name: 'رخصة بلدية', selected: false }, { name: 'كهرباء', selected: false },
            { name: 'صحي', selected: false }, { name: 'واجهات 3D', selected: false },
            { name: 'تصميم داخلي', selected: false }, { name: 'حصر كميات', selected: false }, { name: 'الاشراف الهندسي ', selected: false }
        ],
        payments: [{ name: 'دفعة أولى عند التوقيع', amount: 0 }],
        attachments: [{ name: 'المخطط المساحي' }, { name: 'وثيقة الملكية' }, { name: 'البطاقة المدنية' }],


// دالة التحقق من الخانات
    validate() {
        this.errors = {}; // تصغير الأخطاء
        
        // التحقق من الاسم (نبحث عنه بواسطة placeholder)
        const nameInput = document.querySelector('input[placeholder*="اسم المالك"]');
        if (!nameInput.value.trim()) {
            this.errors.owner_name = "يرجى كتابة الاسم";
        }

        // التحقق من الرقم المدني (يجب أن يكون 12 رقم)
        if (!this.ownerCivilId || this.ownerCivilId.toString().length !== 12) {
            this.errors.civil_id = "الرقم المدني ناقص";
        }

        // التحقق من الهاتف (8 أرقام ويبدأ بـ 5 أو 6 أو 9)
        const phoneRegex = /^[569]\d{7}$/;
        if (!this.phones[0] || !phoneRegex.test(this.phones[0])) {
            this.errors.phone = "رقم الهاتف خطأ";
        }

        return Object.keys(this.errors).length === 0;
    },

    // دالة الحفظ
    async submitProject() {
    if (!this.validate()) return;

    this.isProcessing = true;
    try {
        const response = await fetch('/projects/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                contract_no: this.contractNumber,
                owner_name: document.querySelector('input[placeholder*="اسم المالك"]').value,
                civil_id: this.ownerCivilId,
                phone: this.phones[0]
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            // أولاً: ثبت البيانات في الرسالة
            this.savedProjectDetails = { 
                id: this.contractNumber, 
                date: new Date().toLocaleDateString('ar-KW') 
            };
            
            // ثانياً: أظهر الرسالة
            this.showSuccessMessage = true;

            // ثالثاً: انتظر قليلاً ثم افتح الواتساب ليرى المستخدم الرسالة أولاً
            setTimeout(() => {
                window.open(result.whatsapp_url, '_blank');
            }, 1000); 
        }
    } catch (e) { alert('خطأ في الاتصال'); }
    finally { this.isProcessing = false; }
},
        
        
        // وظائف الشركاء والهاتف
        addPartner() { this.partners.push({ name: '', civilId: '' }) },
        removePartner(i) { this.partners.splice(i, 1) },
        addPhone() { this.phones.push('') },
        removePhone(i) { this.phones.splice(i, 1) },

        // محاكاة الذكاء الاصطناعي لفحص العقود السابقة
        checkPreviousContracts() {
            // عملياً: سيظهر السجل إذا كان الرقم المدني يبدأ بـ '2' أو '3' (كمحاكاة للبحث في الداتابيز)
            this.aiFoundContract = this.ownerCivilId.length > 5;
        },

        // معالجة ملف الـ PDF (AI Extraction)
        processPdf(e) {
            this.isProcessing = true;
            this.siteData.dimensions = 'جاري تحليل المربعات...';
            setTimeout(() => {
                this.siteData.area = 'الخالدية';
                this.siteData.block = '2';
                this.siteData.plot = '45';
                this.siteData.paci = '984521003';
                this.siteData.dimensions = 'المساحة: 500 م2 | الأبعاد: 20 م × 25 م';
                this.isProcessing = false;
            }, 2000);
        },

        // منطق الباقات والخدمات
        isInteriorSelected() {
            let s = this.allServices.find(x => x.name === 'تصميم داخلي');
            return s ? s.selected : false;
        },
        togglePackage(pkg) {
            if (this.selectedPackage === pkg) {
                this.selectedPackage = null;
                this.allServices.forEach(s => s.selected = false);
            } else {
                this.selectedPackage = pkg;
                const mapping = {
                    'home': ['تصميم معماري', 'تصميم انشائي', 'رخصة بلدية'],
                    'expert': ['تصميم معماري', 'تصميم انشائي', 'كهرباء', 'صحي', 'رخصة بلدية', 'واجهات 3D'],
                    'premium': ['تصميم معماري', 'تصميم انشائي', 'كهرباء', 'صحي', 'رخصة بلدية', 'واجهات 3D', 'تصميم داخلي', 'حصر كميات', 'الاشراف الهندسي' ]
                };
                this.allServices.forEach(s => s.selected = mapping[pkg].includes(s.name));
            }
        },

        // المالية
        addPayment() { this.payments.push({ name: 'دفعة مرحلية', amount: 0 }) },
        removePayment(i) { this.payments.splice(i, 1) },
        totalPayments() { return this.payments.reduce((acc, p) => acc + (p.amount || 0), 0) },
        
        // المرفقات
        addAttachment() { this.attachments.push({ name: '' }) },
       removeAttachment(index) {
            this.attachments.splice(index, 1);
        }, // <--- وضعنا فاصلة هنا (ضروري جداً لعدم الاختفاء)

        

    } // إغلاق الـ return
} // إغلاق الـ projectWizard


</script>
<div x-show="showSuccessMessage" 
     class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60 backdrop-blur-sm"
     x-transition>
    <div class="bg-white p-10 rounded-[3rem] shadow-2xl text-center max-w-md border-4 border-blue-50">
        <div class="text-7xl mb-4">✅</div>
        <h2 class="text-2xl font-black mb-2">تم تسجيل المشروع!</h2>
        <p class="text-gray-500">
            رقم العقد: <span class="text-blue-600 font-bold" x-text="savedProjectDetails.id"></span><br>
            تاريخ التسجيل: <span class="font-bold" x-text="savedProjectDetails.date"></span>
        </p>
        <button @click="showSuccessMessage = false" class="mt-6 w-full py-4 bg-blue-600 text-white rounded-2xl font-bold">
            موافق، إغلاق
        </button>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\eng_office\resources\views/projects/create.blade.php ENDPATH**/ ?>