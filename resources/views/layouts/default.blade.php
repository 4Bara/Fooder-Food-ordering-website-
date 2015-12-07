<!DOCTYPE HTML>
<html>
<head>
    @include('includes.head')
    @yield('style')
</head>
<body>
    <div class="container-fluid">
        <div class="navbar">
         @include('includes.header')
        </div>
        <div class="main">
         @yield('content')
        </div>
    </div>
    <div class="row">
        @include('includes.footer')
    </div>
</body>
</html>