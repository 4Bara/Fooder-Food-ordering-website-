<!DOCTYPE HTML>
<html>
<head>
    @include('includes.head')
    @yield('style')
</head>
<body>
        @include('includes.header')
        <div class="@if(Route::getCurrentRoute()->getActionName()=='App\Http\Controllers\HomeController@index') main @else pages @endif">
            @yield('content')
        </div>
        @include('includes.footer')
</body>
</html>