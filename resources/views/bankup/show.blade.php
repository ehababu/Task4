@extends('parent')

@section('title', 'Show Service')

@section('style')
@endsection

@section('content')

    <br>
    <br>
    <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">
        <div class="col-md-5">
            <label for="name"> اسم مقدم الطلب</label>
            <input style="text-align: center" type="text" class="form-control" id="name" value="{{ $rentService->name }}"
                disabled>
        </div>

        <div class="col-md-5">
            <label for="name"> تاريخ الطلب</label>
            <input style="text-align: center" type="text" class="form-control" id="name"
                value="{{ $rentService->order_date }}" disabled>
        </div>
    </div>


    <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">

        <div class="col-md-5">
            <label for="service-name"> إسم الخدمة</label>
            <input style="text-align: center" type="text" class="form-control" id="service-name"
                value="{{ $rentService->service->name }}" disabled>
        </div>


        <div class="col-md-5">
            <label for="category"> التصنيف</label>
            <input style="text-align: center" type="text" class="form-control" id="category"
                value="{{ $rentService->category }}" disabled>
        </div>

    </div>


    <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">

        <div class="col-md-5">
            <label for="cost_amount"> التكلفة</label>
            <input style="text-align: center" type="text" class="form-control" id="cost_amount"
                value="{{ $rentService->cost_price }}" disabled>
        </div>

        <div class="col-md-5">
            <label for="coin_id"> العملة</label>
            <input style="text-align: center" type="text" class="form-control" id="coin_id"
                value="{{ $rentService->service->coin->name }}" disabled>
        </div>
    </div>

    <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">

        <div class="col-md-5">
            <label for="start_date"> تاريخ البداية </label>
            <input style="text-align: center" type="date" class="form-control" id="start_date"
                value="{{ $rentService->start_date }}" disabled>
        </div>
        <div class="col-md-5">
            <label for="expiry_date"> تاريخ النهاية </label>
            <input style="text-align: center" type="date" class="form-control" id="expiry_date"
                value="{{ $rentService->expiry_date }}" disabled>
        </div>
    </div>

    <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">

        <div class="col-md-10">
            <label for="status">حالة الطلب </label>
            <input style="text-align: center" type="text" class="form-control" id="status"
                value="{{ $rentService->status }}" disabled>
        </div>
    </div>

    <div style=" margin-bottom: 30px ;text-align: center;padding-left: 49px ; padding-right: 350px" class="col-md-10">

    <table  style = "border: 1px solid;"class="table table-dark">
     
        <thead>
            <tr>
                <th scope="col">رقم الإيصال </th>
                <th scope="col">المبلغ المحصل</th>
                <th scope="col"> تاريخ الإنشاء</th>


             
            </tr>
        </thead>
        <tbody>
            @forelse ($rentService->bankups as $bankUp)
                <tr>
                    <td>{{ $bankUp->receipt_num }}</td>
                    <td>{{ $bankUp->amount_collected }}</td>
                    <td>{{ $bankUp->created_at }}</td>


            @empty
                <td style="text-align: center" colspan="15">لا يوجد مبلغ  محصل..</td>
            @endforelse

        </tbody>
    </table>
    </div>

     @if ($rentService->total_paid < $rentService->cost_price)

    <form id="form" onsubmit="event.preventDefault(); createbankup();">

        <input type="hidden" id='ser_id' value="{{ $rentService->order_id }}">
        <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">

                
            <div class="col-md-5">
                <label for="receipt_num">رقم الإيصال</label>
                <input type="text" class="form-control" id="receipt_num">
            </div>

            <div class="col-md-5">
                <label for="amount_collected">المبلغ المحصل</label>
                <input type="text" class="form-control" id="amount_collected">
            </div>
        </div>



        <div class="row-md-6" style=" text-align: center;padding-left: 300px ; padding-right: 350px">
            <button type="submit" id="button-print" class="btn btn-dark col-md-3">حفظ</button>
            <a href="{{ route('rentService.index') }}" class="btn btn-danger col-md-3">الغاء</a>

        </div>
    </form>

    @endif


@endsection

@section('script')

    <script>
        function createbankup() {
            let data = {
                rentservice: document.getElementById('ser_id').value,
                receipt_num: document.getElementById('receipt_num').value,
                amount_collected: document.getElementById('amount_collected').value,
            }

            $('#form')[0].reset();

            post("{{ route('bankup.store') }}", data, 'button-print');
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    </script>
@endsection
