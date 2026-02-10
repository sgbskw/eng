@extends('layouts.app')
@section('content')
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">لوحة القيادة الذكية 📊</h1>
        <div class="px-4 py-2 bg-white rounded-2xl shadow-sm border border-gray-100 text-sm font-bold text-gray-500">فبراير 2026</div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-[2rem] border-b-4 border-blue-600 shadow-sm">
            <div class="text-2xl font-black">24</div><div class="text-gray-400 text-xs uppercase font-bold">مشاريع جارية</div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border-b-4 border-green-600 shadow-sm">
            <div class="text-2xl font-black">12</div><div class="text-gray-400 text-xs uppercase font-bold">رخص صادرة</div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border-b-4 border-orange-600 shadow-sm">
            <div class="text-2xl font-black">8</div><div class="text-gray-400 text-xs uppercase font-bold">قيد الإشراف</div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border-b-4 border-indigo-600 shadow-sm">
            <div class="text-2xl font-black">5</div><div class="text-gray-400 text-xs uppercase font-bold">بانتظار البلدية</div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-4 rounded-[2.5rem] shadow-lg border border-gray-100 h-[450px] flex flex-col">
            <div class="p-4 flex justify-between items-center"><h3 class="font-bold">📍 كويت فايندر الذكي</h3></div>
            <iframe src="https://kuwaitfinder.paci.gov.kw/" class="flex-1 rounded-3xl border-none"></iframe>
        </div>
        <div class="bg-[#1e1e2d] p-8 rounded-[2.5rem] shadow-xl text-white">
            <h3 class="text-xl font-bold mb-6">🤖 تنبيهات المحرك الذكي</h3>
            <div class="space-y-4">
                <div class="p-4 bg-gray-800 rounded-2xl border-r-4 border-blue-500 italic text-sm">تم استلام تحديث من نظام البلدية لمشروع جاسم...</div>
                <div class="p-4 bg-gray-800 rounded-2xl border-r-4 border-red-500 italic text-sm">عقد المالك فيصل شارف على الانتهاء ولم يتم سداد الدفعة الثالثة.</div>
            </div>
        </div>
    </div>
</div>
@endsection