<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// المسار الرئيسي (اختياري)
Route::get('/', function () {
    return redirect()->route('projects.create');
});

// مسار لوحة التحكم (الذي يسبب الخطأ في الصورة)
Route::get('/dashboard', function () {
    return view('dashboard'); // تأكد من وجود ملف dashboard.blade.php
})->name('dashboard');

// مسارات المشاريع
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');