<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; // تأكد من وجود موديل Project

class ProjectController extends Controller
{
    // دالة عرض صفحة الإنشاء
    public function create()
    {
        return view('projects.create');
    }

    // دالة الحفظ وإرسال الواتساب
    public function store(Request $request)
    {
        try {
            // 1. حفظ البيانات الأساسية (يمكنك توسيع الحقول حسب قاعدة بياناتك)
            // $project = Project::create($request->all()); 

            // 2. تجهيز نص رسالة الواتساب
            $ownerName = $request->owner_name;
            $contractNo = $request->contract_no;
            $phone = $request->phone;
            
            $message = "تم تسجيل مشروع جديد بنجاح ✅%0A";
            $message .= "رقم العقد: " . $contractNo . "%0A";
            $message .= "اسم المالك: " . $ownerName;

            // 3. تنظيف رقم الهاتف (إزالة أي مسافات أو رموز)
            $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
            
            // إضافة كود الدولة إذا لم يكن موجوداً (مثال للكويت 965)
            if (!str_starts_with($cleanPhone, '965')) {
                $cleanPhone = '965' . $cleanPhone;
            }

            $whatsappUrl = "https://wa.me/" . $cleanPhone . "?text=" . $message;

            return response()->json([
                'status' => 'success',
                'whatsapp_url' => $whatsappUrl
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ أثناء الحفظ: ' . $e->getMessage()
            ], 500);
        }
    }
}