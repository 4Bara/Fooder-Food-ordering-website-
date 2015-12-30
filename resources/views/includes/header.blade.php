<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/fooder/public">Fooder</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(empty($data['logged']) || $data['logged']!='yes')
                    <li><a href="{{URL::asset('registration')}}"><button type="button" id="sign-up-button" class="btn">Sign up</button></a></li>
                    <li><a href="{{URL::asset('login')}}"><button type="button" id="login-button" class="btn">Login</button></a></li>
                @elseif(!empty($data['logged']) && $data['logged']=='yes')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            <i class="glyphicon glyphicon-user"></i> {{$data['username']}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::asset('p/'.$data['username'])}}">
                                    <i class="glyphicon glyphicon-user"></i>Profile</a></li>
                            <li>
                                @if(isset($data['user_type']) && $data['user_type']=='restaurant')
                                    <a href="{{URL::asset('showRestaurantsOrders')}}">
                                        <i class="glyphicon glyphicon-arrow-up"></i>My Orders
                                    </a>
                                @else
                                    <a href="{{URL::asset('showOrders')}}">
                                        <i class="glyphicon glyphicon-arrow-up"></i>My Orders
                                    </a>
                                @endif
                            </li>
                            <li><a href="#">
                                    <i class="glyphicon glyphicon-edit"></i>Settings</a></li>
                            <li><a href="{{URL::asset('logout')}}"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
                @if(isset($data['user_type']) && $data['user_type']!='restaurant')
                    <li>
                        <a class="cart" href="{{URL::asset('showCart')}}">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                           <span id="shopping_cart_button">@if(isset($data['items_count'])){{$data['items_count']}}@endif</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->