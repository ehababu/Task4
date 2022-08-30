@extends('parent')

@section('title', 'Statistics')

@section('style')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">

            <br>
            <br>
            <br>
            <br>
            <table class="table table-striped"">
                <thead class="thead-dark">
                    <tr>
                        <th>نوع الخدمة </th>
                        <th>مباني</th>
                        <th>مياه </th>
                        <th>مولد</th>
                        <th>صالة</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>عدد الطلبات </th>
                    </tr>
                    <tr>
                        <th>عدد الحجوزات </th>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div id="columnchart_material" style="width: 800px; height: 600px;"></div>
        <div class="col-md-6"></div>
    </div>

@endsection

@section('script')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['نوع الخدمة', 'عدد الطلبات', 'عدد الحجوزات'],
                ['صالة', 1000, 250],
                ['مولد', 1170, 250],
                ['مياه', 660, 250],
                ['مباني', 500 , 250]
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                }
            };
            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endsection
