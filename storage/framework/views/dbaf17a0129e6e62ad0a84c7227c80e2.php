<aside class="w-72 bg-gray-900 text-white flex flex-col h-full overflow-y-auto" dir="rtl">
    <div class="p-8 border-b border-gray-800">
        <h1 class="text-2xl font-bold flex items-center gap-2">
            <span class="bg-blue-600 p-2 rounded-xl text-lg">🏢</span> المكتب الهندسي
        </h1>
    </div>

    <nav class="p-6 space-y-4 flex-1">
        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-gray-800 transition">
            <span class="text-xl">📊</span> لوحة التحكم
        </a>
        
        <div class="pt-4 text-xs font-bold text-gray-500 uppercase tracking-widest px-4">إدارة المشاريع</div>
        
        <a href="<?php echo e(route('projects.create')); ?>" class="flex items-center gap-4 p-4 rounded-2xl bg-blue-600 shadow-lg shadow-blue-900/20">
            <span class="text-xl">➕</span> تسجيل مشروع جديد
        </a>

        <a href="#" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-gray-800 transition">
            <span class="text-xl">🏠</span> السكن الخاص
        </a>
        <a href="#" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-gray-800 transition">
            <span class="text-xl">🏢</span> السكن الاستثماري
        </a>
    </nav>
</aside><?php /**PATH C:\laragon\www\eng_office\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>