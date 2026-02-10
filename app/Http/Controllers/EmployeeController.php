<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // عرض قائمة الموظفين
    public function index() {
        $employees = Employee::all(); 
        return view('staff_list', compact('employees'));
    }

    // حفظ موظف جديد
    public function store(Request $request) {
        Employee::create($request->all());
        return redirect()->back()->with('success', 'تم إضافة الموظف بنجاح');
    }

    // عرض التقرير المنفصل للموظف
    public function showReport($id) {
        // جلب الموظف مع مشاريعه المرتبطة به
        $employee = Employee::findOrFail($id);
        $projects = Project::where('employee_id', $id)->get();
        
        return view('employee_report', compact('employee', 'projects'));
    }
}