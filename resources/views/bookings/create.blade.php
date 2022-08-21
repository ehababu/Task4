@extends('parent')

@section('title', 'Create Booking Service')

@section('style')
@endsection

@section('content')
    <br>
    <form onsubmit="event.preventDefault(); createbooking();">

        <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px">

            <div class="row">
                <div class="col-md-5">
                    <label for="order_id"> رقم الطلب </label>
                    <input type="text" class="form-control" id="order_id" value="{{ $rentService->order_id }}" disabled>
                </div>
                <div class="col-md-5">
                    <label for="order_date"> تاريخ الحجز </label>
                    <input type="text" class="form-control" id="order_date" value="{{ now() }}" disabled>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <label> التصنيف </label>
                    <input type="text" value="{{ $rentService->category }}" class="form-control" disabled>
                </div>
                <div class="col-md-5">
                    <label> الخدمة </label>
                    <input type="text" value="{{ $rentService->service->name }}" class="form-control" disabled>
                </div>
            </div>
            <br>

            <div class="col-md-10">
                <label for="name">اسم طالب الخدمة</label>
                <input type="text" class="form-control" id="name" value="{{$rentService->name}}" disabled>
            </div>
            <br>

            <div class="row">
                <div class="col-md-5">
                    <label for="start_date"> تاريخ البداية </label>
                    <input type="date" class="form-control" id="start_date">
                </div>
                <div class="col-md-5">
                    <label for="expiry_date"> تاريخ النهاية </label>
                    <input type="date" class="form-control" id="expiry_date">
                </div>
            </div>



            <br>


            <div class="row-md-6" style=" text-align: center;padding-left: 300px ; padding-right: 150px">
                <button type="submit" id="button-create" class="btn btn-primary col-md-3">حفظ</button>
                <a href="{{ route('rentService.index') }}" class="btn btn-danger col-md-3">الغاء</a>

            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        function createbooking() {
            let data = {
                start_date: document.getElementById('start_date').value,
                expiry_date: document.getElementById('expiry_date').value,
            }

            post("{{ route('booking.store', $rentService) }}", data, 'button-create', "{{ route('booking.index') }}");
        }
    </script>
@endsection