@extends('parent')

@section('title', 'All Coins')

@section('style')
@endsection

@section('content')


<br>
    <a href="{{ route('coins.create') }}" class="btn btn-primary">+ انشاء عملة </a>
    <br>    
    <br>
    <table class="table table-sm table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">اسم العملة </th>
                <th scope="col">حالة العملة </th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($coins as $coin)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $coin->name }}</td>
                    <td>
                        <button class="btn @if ($coin->is_active) btn-success @else btn-danger @endif"
                            onclick="   ({{ $coin->id }})" id="{{ $coin->id }}">
                            {{ $coin->active_status }}
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('coins.edit', $coin) }}" class="btn btn-outline-primary">تعديل</a>
                        <button type="button" onclick="deleteCoin({{ $coin->id }}, this)"
                            class="btn btn-outline-danger">حذف</button>
                    </td>
                </tr>
            @empty
                <td style="text-align: center" colspan="7">لا يوجد عملات مدخلة</td>
            @endforelse

        </tbody>
    </table>
@endsection

@section('script')
    <script>
       
        function deleteCoin(id, reference) {
            confirmDelete('/coins', id, reference);
        }
    </script>
@endsection



