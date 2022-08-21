<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('layouts.css')

    @yield('style')
    <style>
        
        h1 {text-align: center;

            /* background-color :rgb(0, 206, 45); */
        }
        body {
            margin: 20px;
            background: rgb(255, 255, 255);
            direction: rtl;
        }

        div {
            margin-top: 10px;
            
        }
      
    </style>
</head>
<body>


 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn " href="{{route('parent')}}">الصفحة الرئيسية </a>
                  </li>
              <li class="nav-item">
                <a class="nav-link btn  " href="{{route('coins.index')}}">العملات </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn " href="{{route('service.index')}}">إنشاء الخدمات  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn " href="{{route('rentService.index')}}">إستئجار خدمة </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn " href="{{route('booking.index')}}"> الحجوزات </a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>  
      
    @yield('content')


    @include('layouts.js')
    @yield('script')
</body>
</html>