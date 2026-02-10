<div dir="rtl" style="font-family: sans-serif; padding: 30px;">
    <h1 style="color: #2563eb; text-align: center;">عقد اتفاق هندسي</h1>
    <hr>
    <p><strong>رقم العقد:</strong> {{ $contract_no }}</p>
    <p><strong>اسم المالك:</strong> {{ $owner_name }}</p>
    <p><strong>الرقم المدني:</strong> {{ $civil_id }}</p>
    <h3>الخدمات المتعاقد عليها:</h3>
    <ul>
        @foreach($services as $service)
            <li>{{ $service }}</li>
        @endforeach
    </ul>
    <h2 style="text-align: left;">الإجمالي: {{ $total }} د.ك</h2>
</div>