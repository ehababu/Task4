@extends('parent')

@section('title', 'All Bookings')

@section('style')
@endsection

@section('content')


<br>
    <table class="table table-sm table-striped ">
        <thead>
            <tr>
                <th scope="col">رقم الحجز </th>
                <th scope="col"> تاريخ الحجز </th>
                <th scope="col"> تصنيف الخدمة </th>
                <th scope="col"> اسم الخدمة </th>
                <th scope="col"> اسم طالب الخدمة </th>
                <th scope="col"> تاريخ البداية </th>
                <th scope="col"> تاريخ النهاية </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $booking->order_date }}</td>
                    <td>{{ $booking->rentService->category }}</td>
                    <td>{{ $booking->rentService->service->name }}</td>
                    <td>{{ $booking->rentService->name }}</td>
                    <td>{{ $booking->rentService->start_date }}</td>
                    <td>{{ $booking->rentService->expiry_date }}</td>
                </tr>
            @empty
                <td style="text-align: center" colspan="10">لا يوجد حجوزات متوفرة</td>
            @endforelse

        </tbody>
    </table>
@endsection

@section('script')
@endsection