<div dir="rtl" style="font-family: 'XBRiyaz', sans-serif;">
    <h1 style="text-align: center;">عقد اتفاق هندسي</h1>
    <p>رقم العقد: {{ $contract_no }}</p>
    <p>طرف أول: مكتب هندسي</p>
    <p>طرف ثاني: {{ $owner_name }} (الرقم المدني: {{ $civil_id }})</p>
    <hr>
    <h3>الخدمات المختارة:</h3>
    <ul>
        @foreach($services as $service)
            <li>{{ $service }}</li>
        @endforeach
    </ul>
    <h3>إجمالي العقد: {{ $total }} د.ك</h3>
</div>