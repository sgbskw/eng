<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام المكتب الهندسي الذكي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #f8fafc; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: true }">
    <aside :class="sidebarOpen ? 'w-72' : 'w-20'" class="bg-[#1e1e2d] text-gray-300 transition-all duration-300 flex flex-col shadow-2xl">
        <div class="p-6 flex items-center justify-between border-b border-gray-700">
            <span x-show="sidebarOpen" class="font-bold text-xl text-white">🏢 المكتب الهندسي</span>
            <button @click="sidebarOpen = !sidebarOpen" class="p-1 hover:bg-gray-700 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
        <nav class="flex-1 mt-6 px-4 space-y-2 overflow-y-auto">
            <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-4 p-3 rounded-xl hover:bg-blue-600 hover:text-white transition">
                <span>📊</span> <span x-show="sidebarOpen">لوحة التحكم</span>
            </a>
            <a href="<?php echo e(route('projects.create')); ?>" class="flex items-center gap-4 p-3 rounded-xl bg-blue-600 text-white shadow-lg">
                <span>➕</span> <span x-show="sidebarOpen">تسجيل مشروع جديد</span>
            </a>
            <div class="pt-4 pb-2 border-b border-gray-700" x-show="sidebarOpen">
                <span class="text-xs font-bold text-gray-500 px-3 uppercase">الروابط الذكية</span>
            </div>
            <a href="https://kuwaitfinder.paci.gov.kw/" target="_blank" class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-700 transition">
                <span>📍</span> <span x-show="sidebarOpen">كويت فايندر</span>
            </a>
        </nav>
    </aside>
    <main class="flex-1 overflow-y-auto p-8">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html><?php /**PATH C:\laragon\www\eng_office\resources\views/layouts/app.blade.php ENDPATH**/ ?>