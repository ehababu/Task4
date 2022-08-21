@extends('parent')

@section('title', 'All Services')

@section('style')
@endsection

@section('content')


    <br>
    <a href="{{ route('service.create') }}" class="btn btn-primary"> + انشاء خدمة </a>

    <form method="GET" style="text-align: center;padding-left: 120px ; padding-right: 350px" class="row">
        <div class="col-md-4">
            <label for="name">التصنيف</label>
            <select id="main_classification" name="category" class="form-select" aria-label="Default select example">
                <option value="all">جميع التصنيفات</option>
                @foreach (['مياه', 'مولد', 'صالة', 'مباني'] as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="barcode">الخدمة</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="إسم الخدمة">
        </div>
        <div style="margin-top: 23px ; padding-left: 150px" class="col-md-2">
            <button type="submit" class="btn btn-primary">بحث</button>
        </div>
    </form>
    <br>
    <br>

    <table class="table table-sm table-striped ">
        <thead>
            <tr>
                <th scope="col">رقم الخدمة </th>
                <th scope="col">اسم الخدمة </th>
                <th scope="col">التصنيف </th>
                <th scope="col">وصف الخدمة </th>
                <th scope="col">حالة الخدمة </th>
                <th scope="col">التكلفة </th>
                <th scope="col">نوع التكلفة </th>
                <th scope="col"> العملة </th>
                <th scope="col"> العمليات </th>


            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->main_classification }}</td>
                    <td>{{ $service->service_description }}</td>
                    <td>
                        <button class="btn @if ($service->is_active) btn-success @else btn-danger @endif"
                            onclick="   ({{ $service->id }})" id="{{ $service->id }}">
                            {{ $service->active_status }}
                        </button>
                    </td>
                    <td>{{ $service->cost_amount }}</td>
                    <td>{{ $service->cost_type }}</td>
                    <td>{{ $service->coin->name }}</td>
                    <td>
                        <a href="{{ route('service.edit', $service) }}" class="btn btn-outline-primary">تعديل</a>
                        <button type="button" onclick="deleteservice({{ $service->id }}, this)"
                            class="btn btn-outline-danger">حذف</button>
                    </td>
                </tr>
            @empty
                <td style="text-align: center" colspan="10">لا يوجد خدمات متوفرة</td>
            @endforelse

        </tbody>
    </table>
@endsection

@section('script')
    <script>
        function deleteservice(id, reference) {
            confirmDelete('/service', id, reference);
        }
    </script>
@endsection