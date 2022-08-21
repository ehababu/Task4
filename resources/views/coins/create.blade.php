@extends('parent')

@section('title', 'Create Coin')

@section('style')
@endsection

@section('content')
    <form onsubmit="event.preventDefault(); createCoin();">
        <div class="form-group col-md-6">
            <label for="name">اسم العملة </label>
            <input type="text" class="form-control" id="name" placeholder="ادخل اسم العملة ">
        </div>
        <div style="margin-bottom: 20px" class="form-check form-switch">
            <input style="direction :rtl "type="checkbox" id="active">
            <label class="form-check-label" for="active">حالة العملة</label>
        </div>
        <button type="submit" id="button-create" class="btn btn-primary col-md-3">انشاء</button>
        <a href="{{route('coins.index')}}" class="btn btn-danger col-md-3">الغاء</a>
    </form>
@endsection

@section('script')
    <script>
        function createCoin() {
            let data = {
                name: document.getElementById('name').value,
                active: document.getElementById('active').checked
            }

            post("{{route('coins.store')}}", data, 'button-create', "{{route('coins.index')}}");
        }
    </script>
@endsection
