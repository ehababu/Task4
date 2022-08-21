@extends('parent')

@section('title', 'Show Rent Service')

@section('style')
@endsection

@section('content')

    <br>
    <br>
    <h1>بيانات الإستئجار</h1>
    <br>
    <form onsubmit="event.preventDefault();">

        <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">
            <div class="col-md-5">
                <label for="name"> اسم مقدم الطلب</label>
                <input style="text-align: center" type="text" class="form-control" id="name"
                    value="{{ $rentService->name }}" disabled>
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
        <div class="row-md-6" style=" text-align: center;padding-left: 300px ; padding-right: 350px">

            @if ($rentService->status == 'مرفوض')
                <a href="{{ route('rentService.pdf', $rentService) }}" class="btn btn-dark col-md-3">طباعة</a>
            @elseif ($rentService->status == 'مدفوع')
                <a href="{{ route('rentService.pdf', $rentService) }}" class="btn btn-dark col-md-3">طباعة</a>
                <a href="{{ route('booking.create', $rentService->order_id) }}"
                    class="btn btn-outline-warning col-md-3">حجز</a>
            @else
                <a href="{{ route('rentService.pdf', $rentService) }}" class="btn btn-dark col-md-3">طباعة</a>
                <a href="{{ route('bankup.show', $rentService->order_id) }}"
                    class="btn btn-outline-success col-md-3">تحصيل</a>
            @endif

        </div>


    </form>

@endsection

@section('script')
@endsection
