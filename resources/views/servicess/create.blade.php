@extends('parent')

@section('title', 'Create Service')

@section('style')
@endsection

@section('content')
<br>
<br>
<div>
    <form onsubmit="event.preventDefault(); createservice();">

        <div  style = " margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class = "row"> 
        <div class="col-md-5">
            <label for="name">اسم الخدمة </label>
            <input type="text" class="form-control" id="name" placeholder="ادخل اسم الخدمة ">
        </div>

        <div class="col-md-5">
            <label for="main_classification"> التصنيف الرئيسي </label>
            <select  id = "main_classification" class="form-select" aria-label="Default select example">
                
                <option value="0">اختار التصنيف</option>
                <option value="مباني">مباني</option>
                <option value="صالة">صالة</option>
                <option value="مولد">مولد</option>
                <option value="مياه">مياه</option>

              </select>  
     
            </div>

        </div>
        <div id = "subcategories"  class = "col-md-7" style = " margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px">
            <label for="subcategories">  التصنيف الفرعي </label>
            <select  id = "subcategorie" class="form-select" aria-label="Default select example">
                
                <option value="">اختار التصنيف</option>
                <option value="شقة">شقة</option>
                <option value="حاصل">حاصل</option>
                <option value="اخرى">اخرى</option>

              </select> 

              <div class="row">
                    <label for="name_building">اسم البناء </label>
                    <input type="text" class="form-control" id="name_building" placeholder="ادخل اسم البناء">
                </div>
                
                <div class="row">
                    <label for="area">المساحة </label>
                    <input type="number" class="form-control" id="area" placeholder="ادخل المساحة  ">
                </div>
                
                <div class="row">
                    <label for="rent_value"> قيمة الإيجار بالمتر </label>
                    <input type="number" class="form-control" id="rent_value" placeholder="ادخل قيمة الإيجار ">
            </div>


            
            </div>
        


        <div  style = " margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class = "row"> 

            <div class="col-md-5">
                <label for="service_description">وصف الخدمة </label>
                <input type="text" class="form-control" id="service_description" placeholder="ادخل وصف الخدمة">
            </div>

            

            <div class= "col-md-5" >
                <label for="cost_amount">مبلغ التكلفة </label>
                <input type="text" class="form-control" id="cost_amount" placeholder="ادخل مبلغ التكلفة ">
            </div>

        </div>

        <div  style = " margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class = "row"> 

                <div class="col-md-5">
                    <label for="cost_type">نوع التكلفة  </label>
                    <select  id = "cost_type" class="form-select" aria-label="Default select example">
                            <option value="0">اختار نوع التكلفة  </option>
                            <option value="يومي">يومي</option>
                            <option value="شهري">شهري</option>
                            <option value="سنوي">سنوي</option>

                      </select>       
                    
                    </div>

                    
                <div class="col-md-5">
                    <label for="coin">العملة </label>
                    <select  id = "coin" class="form-select" aria-label="Default select example">
                     @foreach ($coins as $coin )
                     <option value="{{$coin->id}}">{{$coin->name}}</option>
                     @endforeach
                      </select>       
                    
                    </div>

        </div>

        <div  style = " margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class = "row">
        <div class="col-md-10">
            <label for="notes">ملاحظات </label>
            <input type="text" class="form-control" id="notes" placeholder="ادخل ملاحظات حول الخدمة ">
            <div style="margin-bottom: 20px" class="form-check form-switch">
                <input style="direction :rtl "type="checkbox" id="active">
                <label class="form-check-label" for="active">حالة الخدمة </label>
            </div>
        </div>
        </div>
        <div class="row-md-6" style=" text-align: center;padding-left: 300px ; padding-right: 350px">
        <button type="submit" id="button-create" class="btn btn-primary col-md-3">حفظ</button>
        <a href="{{route('service.index')}}" class="btn btn-danger col-md-3">الغاء</a>
    
        </div>
    </form>

@endsection

@section('script')
    <script>

                $(document).ready(function()
                {
                    $("#subcategories").hide();
                    $("#main_classification").change(function() {
                        if($(this).val() == "مباني") {
                            $("#subcategories").show();
                        }
                        else {
                            $("#subcategories").hide();
                        }
                    });
                });

        function createservice() {
            let data = {

                name: document.getElementById('name').value,
                main_classification: document.getElementById('main_classification').value,
                subcategories: document.getElementById('subcategorie').value,
                service_description: document.getElementById('service_description').value,
                cost_amount: document.getElementById('cost_amount').value,
                cost_type: document.getElementById('cost_type').value,
                coin: document.getElementById('coin').value,
                notes: document.getElementById('notes').value,
                name_building: document.getElementById('name_building').value,
                area: document.getElementById('area').value,
                rent_value: document.getElementById('rent_value').value,
                active: document.getElementById('active').checked
            }

            post("{{route('service.store')}}", data, 'button-create', "{{route('service.index')}}");
        }
    </script>
@endsection
