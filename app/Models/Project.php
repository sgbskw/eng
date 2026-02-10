<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = []; // السماح بحفظ جميع الحقول المرسلة من الفورم

    // تحويل النصوص إلى مصفوفات تلقائياً عند التعامل مع قاعدة البيانات
    protected $casts = [
        'partners' => 'array',
        'selected_services' => 'array',
        'payments' => 'array',
        'attachments_data' => 'array',
        'project_date' => 'date',
    ];
}