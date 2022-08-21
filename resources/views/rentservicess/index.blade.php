@extends('parent')

@section('title', 'All Rent Service')

@section('style')
@endsection

@section('content')


    <br>
    <a href="{{ route('rentService.create') }}" class="btn btn-primary"> + إستئجار خدمة </a>
    <form method="GET" style="text-align: center;padding-left: 120px ; padding-right: 350px" class="row">

        <div class="col-md-4">
            <label for="searchId">رقم الطلب</label>
            <input type="number" name="searchId" id="searchId" class="form-control" value="{{ request()->searchId }}">
        </div>

        <div class="col-md-4">
            <label for="name">الخدمة</label>
            <select id="main_classification" name="searchService" class="form-select" aria-label="Default select example">
                <option value="all">جميع الخدمات</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" @selected($service->id == request()->searchService)>{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="start_date">التاريخ</label>
                <input type="date" name="startDateSearch" class="form-control" id="start_date" value="{{request()->startDateSearch}}">
            </div>
            <div class="col-md-4">
                <label for="expiry_date">إلى</label>
                <input type="date" name="endDateSearch" class="form-control" id="expiry_date" value="{{request()->endDateSearch}}">
            </div>
        </div>

        <div class="col-md-8">
            <label for="searchName">مقدم الطلب</label>
            <input type="text" name="searchName" id="searchName" class="form-control"
                value="{{ request()->searchName }}">
        </div>


        <div class="row" style=" text-align: center;padding-left: 300px ; padding-right: 350px; margin-top: 10px">
            <button type="submit" class="btn btn-primary col-md-4">بحث</button>
        </div>
    </form>
    <br>
    <br>

    <table class="table table-sm table-striped ">
        <thead>
            <tr>
                <th scope="col">رقم الطلب </th>
                <th scope="col">مقدم الطلب </th>
                <th scope="col">تاريخ الطلب </th>
                <th scope="col"> الخدمة المطلوبة </th>
                <th scope="col">تاريخ البداية </th>
                <th scope="col">تاريخ النهاية </th>
                <th scope="col">التكلفة</th>
                <th scope="col"> العملة </th>
                <th scope="col">حالة الطلب </th>
                <th scope="col"> عمليات</th>



            </tr>
        </thead>
        <tbody>
            @forelse ($rentService as $rentservice)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $rentservice->name }}</td>
                    <td>{{ $rentservice->order_date }}</td>
                    <td>{{ $rentservice->service->name }}</td>
                    <td>{{ $rentservice->start_date }}</td>
                    <td>{{ $rentservice->expiry_date }}</td>
                    <td>{{ round($rentservice->cost_price) }}</td>
                    <td>{{ $rentservice->service->coin->name }}</td>
                    <td>{{ $rentservice->status }}</td>
                    <td>
                        <a href="{{ route('rentService.show', $rentservice->order_id) }}"
                            class="btn btn-outline-primary">عرض</a>
                        @if ($rentservice->status == 'جديد')
                            <button type="button" onclick="responseOffer({{ $rentservice->order_id }}, 'مقبول')"
                                class="btn btn-outline-success">قبول</button>
                            <button type="button" onclick="responseOffer({{ $rentservice->order_id }}, 'مرفوض')"
                                class="btn btn-outline-danger">رفض</button>
                        @elseif ($rentservice->status == 'مقبول')
                            <a href="{{ route('bankup.show', $rentservice->order_id) }}"
                                class="btn btn-outline-success">تحصيل</a>
                        @elseif ($rentservice->status == 'مدفوع')
                            <a href="{{route('booking.create', $rentservice)}}" class="btn btn-outline-warning">حجز</a>
                        @endif
                    </td>
                </tr>
            @empty
                <td style="text-align: center" colspan="15">لا يوجد خدمات مستئجرة</td>
            @endforelse

        </tbody>
    </table>
@endsection

@section('script')
    <script>
        function responseOffer(id, status) {
            console.log(`/rentService/${id}/status`);
            axios.put(`/rentService/${id}/status`, {
                    status: status
                })
                .then((response) => {
                    toastr.success(response.data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }).catch((error) => {
                    console.log(error);
                })
        }
    </script>
@endsection
