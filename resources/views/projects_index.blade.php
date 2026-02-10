@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-bold"><i class="fas fa-list-alt"></i> سجل المشاريع والقسائم</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('projects.create') }}" class="btn btn-success shadow-sm">
                    <i class="fas fa-plus"></i> تسجيل قسيمة جديدة
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>الرقم الآلي</th>
                            <th>المنطقة / القسيمة</th>
                            <th>المهندس المسؤول</th>
                            <th>المخطط المساحي</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $projects = \App\Models\Project::with('employee')->get(); @endphp
                        @foreach($projects as $project)
                        <tr>
                            <td><span class="badge badge-secondary p-2">{{ $project->paci_number ?? 'غير مسجل' }}</span></td>
                            <td>
                                <b>{{ $project->area }}</b><br>
                                <small>قطعة: {{ $project->block }} - قسيمة: {{ $project->parcel_number }}</small>
                            </td>
                            <td>{{ $project->employee->name ?? 'غير محدد' }}</td>
                            <td>
                                @if($project->cadastral_plan)
                                    <a href="{{ asset('storage/' . $project->cadastral_plan) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-file-pdf"></i> عرض المخطط
                                    </a>
                                @else
                                    <span class="text-muted">لا يوجد ملف</span>
                                @endif
                            </td>
                            <td><span class="badge badge-info">قيد الدراسة</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection