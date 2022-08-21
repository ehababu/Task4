@extends('parent')

@section('title','Edit Coin')

@section('style')
    
@endsection

@section('content')

        <form onsubmit="event.preventDefault(); updateCoin();">
            <div class="form-group col-md-6">
                <label for="name">اسم العملة</label>
                <input type="text" class="form-control" id="name" placeholder="ادخل اسم العملة " value="{{$coin->name}}">
            </div>

            <div class="form-check form-switch">
                <input  style="direction :rtl "type="checkbox" id="active" @checked($coin->is_active)>
                <label class="form-check-label" for="active">حالة العملة </label>
            </div>
            <button type="submit" id="button-update" class="btn btn-primary col-md-3">تعديل</button>
            <a href="{{route('coins.index')}}" class="btn btn-danger col-md-3">الغاء</a>
        </form>
            
@endsection


@section('script')
    <script>
            function updateCoin() {
                let data = {
                    name: document.getElementById('name').value,
                    active: document.getElementById('active').checked

                }
                update("{{route('coins.update', $coin)}}", data, "button-update", "{{route('coins.index')}}")
            }
        </script>
@endsection