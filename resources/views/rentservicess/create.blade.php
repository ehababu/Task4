@extends('parent')

@section('title', 'Create Rent Service')

@section('style')
@endsection

@section('content')
    <br>
    <div>
        <form onsubmit="event.preventDefault(); createRentService();">

            <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">
                <div class="col-md-10">
                    <label for="name"> اسم مقدم الطلب</label>
                    <input type="text" class="form-control" id="name" placeholder=" ادخل اسم مقدم الطلب ">
                </div>

            </div>
            <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">
                <div class="col-md-5">
                    <label for="id_num"> رقم هوية مقدم الطلب</label>
                    <input type="text" class="form-control" id="id_num" placeholder=" ادخل رقم هوية مقدم الطلب ">
                </div>

                <div class="col-md-5">
                    <label for="mobile_num"> رقم جوال مقدم الطلب</label>
                    <input type="text" class="form-control" id="mobile_num" placeholder=" ادخل رقم جوال مقدم الطلب ">
                </div>
            </div>

            <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">

                <div class="col-md-5">
                    <label for="category"> التصنيف</label>
                    <select id="category" class="form-select" aria-label="Default select example">

                        <option value="">اختار التصنيف</option>
                        <option value="صالة">صالة</option>
                        <option value="مولد">مولد</option>
                        <option value="مياه">مياه</option>
                        <option value="مباني">مباني</option>

                    </select>
                    <div class="row" id="halls">
                        <div>
                            <label for="num_attendees"> عدد الحضور </label>
                            <input type="number" class="form-control" id="num_attendees" placeholder=" ادخل عدد الحضور ">
                        </div>

                        <div>
                            <label for="additional_services">خدمات اضافية </label>
                            <input type="text" class="form-control" id="additional_services"
                                placeholder=" ادخل الخدمات الإضافية للخدمة  ">
                        </div>
                    </div>

                    <div class="row" id="generators">
                        <div>
                            <label for="add_generator"> العنوان </label>
                            <input type="text" class="form-control" id="add_generator" placeholder=" ادخل العنوان ">
                        </div>

                        <div>

                            <label for="subscription"> الاشتراك المطلوب </label>
                            <input type="number" class="form-control" id="subscription"
                                placeholder=" ادخل الاشتراك المطلوب ">
                        </div>
                        <div>
                            <label for="amps"> مقدار الامبير</label>
                            <input type="number" class="form-control" id="amps" placeholder=" ادخل مقدار  الامبير ">
                        </div>
                    </div>
                    <div class="row" id="waters">
                        <div>
                            <label for="add_water"> العنوان </label>
                            <input type="text" class="form-control" id="add_water" placeholder=" ادخل العنوان ">
                        </div>

                        <div>
                            <label for="required_quantity"> الكمية المطلوبة </label>
                            <input type="number" class="form-control" id="required_quantity"
                                placeholder=" ادخل الكمية المطلوبة ">
                        </div>
                    </div>

                </div>


                <div class="col-md-5">
                    <label for="service-name"> إسم الخدمة</label>
                    <select id="service-name" class="form-select" onchange="getServiceData()"
                        aria-label="Default select example">
                        <option value="0"> اسم الخدمة </option>
                    </select>
                </div>

            </div>


            <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px" class="row">
                <div class="col-md-3">
                    <label for="cost_amount">التكلفة</label>
                    <input type="text" class="form-control" id="cost_amount" disabled>
                </div>
                <div class="col-md-3">
                    <label for="cost_type"> نوع التكلفة</label>
                    <input type="text" class="form-control" id="cost_type" disabled>
                </div>
                <div class="col-md-3">
                    <label for="coin_id"> العملة</label>
                    <input type="text" class="form-control" id="coin_id" disabled>
                </div>
            </div>

            <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px"
                class="row">

                <div class="col-md-5">
                    <label for="start_date"> تاريخ البداية </label>
                    <input type="date" onchange="calcData()" class="form-control" id="start_date">
                </div>
                <div class="col-md-5">
                    <label for="expiry_date"> تاريخ النهاية </label>
                    <input type="date" onchange="calcData()" class="form-control" id="expiry_date">
                </div>
            </div>


            <div style=" margin-bottom: 30px ;text-align: center;padding-left: 120px ; padding-right: 350px"
                class="row">

                <div class="col-md-5">
                    <label for="duration">المدة</label>
                    <input type="text" class="form-control" id="duration" disabled>
                </div>
                <div class="col-md-5">
                    <label for="cost_price">التكلفة</label>
                    <input type="text" class="form-control" id="cost_price" disabled>
                </div>
            </div>



            <div class="row-md-6" style=" text-align: center;padding-left: 300px ; padding-right: 350px">
                <button type="submit" id="button-create" class="btn btn-primary col-md-3">حفظ</button>
                <a href="{{ route('rentService.index') }}" class="btn btn-danger col-md-3">الغاء</a>

            </div>
        </form>

    @endsection

    @section('script')
        <script>
            let costAmount = 0;
            let costType = "";
            $(document).ready(function() {
                $("#halls").hide();
                $("#generators").hide();
                $("#waters").hide();
                $("#category").change(function() {

                    if ($(this).val() == "صالة") {
                        $("#halls").show();
                        $("#generators").hide();
                        $("#waters").hide();
                    }
                    if ($(this).val() == "مولد") {
                        $("#generators").show();
                        $("#halls").hide();
                        $("#waters").hide();
                    }
                    if ($(this).val() == "مياه") {
                        $("#waters").show();
                        $("#halls").hide();
                        $("#generators").hide();

                    }
                    if ($(this).val() == 'مباني') {
                        $("#halls").hide();
                        $("#generators").hide();
                        $("#waters").hide();
                    }

                    getSericesByCategory($(this).val());

                });
            });

            function getServiceData() {
                let serviceId = document.getElementById('service-name').value;
                let url = `/rentService/service/${serviceId}/data`;
                axios.get(url).then((response) => {
                    console.log(response);
                    document.getElementById('cost_amount').value = response.data.cost_amount;
                    document.getElementById('cost_type').value = response.data.cost_type;
                    document.getElementById('coin_id').value = response.data.coin;
                    costAmount = response.data.cost_amount;
                    costType = response.data.cost_type;
                }).catch((error) => {
                    console.log(error);
                });
            }

            function getSericesByCategory(category) {
                axios.get(`/services/category/${category}`).then((response) => {
                    $("#service-name").empty();
                    var firstOption = $('<option></option>').attr('value', '0').text('إسم الخدمة');
                    $("#service-name").append(firstOption);
                    response.data.map((element) => {
                        var option = $('<option></option>').attr("value", element.id).text(element.name);
                        $("#service-name").append(option);
                    })
                }).catch((error) => {
                    console.log(error);
                });
            }

            function createRentService() {
                let data = {
                    name: document.getElementById('name').value,
                    id_num: document.getElementById('id_num').value,
                    mobile_num: document.getElementById('mobile_num').value,
                    category: document.getElementById('category').value,
                    name_service: document.getElementById('service-name').value,
                    start_date: document.getElementById('start_date').value,
                    expiry_date: document.getElementById('expiry_date').value,
                    num_attendees: document.getElementById('num_attendees').value,
                    additional_services: document.getElementById('additional_services').value,
                    add_generator: document.getElementById('add_generator').value,
                    subscription: document.getElementById('subscription').value,
                    amps: document.getElementById('amps').value,
                    add_water: document.getElementById('add_water').value,
                    required_quantity: document.getElementById('required_quantity').value,

                }

                post("{{ route('rentService.store') }}", data, 'button-create', "{{ route('rentService.index') }}");
            }

            function calcData() {
                if (document.getElementById('start_date').value != '' && document.getElementById('expiry_date').value != '') {
                    if (costAmount != 0 && costType != '') {
                        let date1 = new Date(document.getElementById('start_date').value);
                        let date2 = new Date(document.getElementById('expiry_date').value);
                        let diffTime = Math.abs(date2 - date1);
                        let diffDays = 0;
                        switch (costType) {
                            case 'يومي':
                                diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                console.log(diffDays + " days");
                                break;

                            case 'شهري':
                                diffDays = (diffTime / (1000.0 * 60.0 * 60.0 * 24.0)) / 30.0;
                                console.log(diffDays + " months");
                                break;

                            case 'سنوي':
                                diffDays = (diffTime / (1000.0 * 60.0 * 60.0 * 24.0)) / 365.0;
                                console.log(diffDays + " years");
                                break;
                        }

                        diffDays = Math.round(diffDays * 100) / 100;
                        document.getElementById('duration').value = diffDays;
                        document.getElementById('cost_price').value = costAmount * diffDays;
                    }
                }
            }

        </script>
    @endsection
