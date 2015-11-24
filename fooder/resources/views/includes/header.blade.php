<div id="nav_bar_content">
    <div id="nav_bar_left">
        <div class="col-md-4">
            <p id="main_logo">
                <a href="/fooder/public">Fooder</a>
            </p>
        </div>
    </div>
    <div class="col-md-8">
        <div id="nav_bar_right">
            @if(!empty($data['logged']) && $data['logged']!='yes')
                <a href="{{URL::asset('login')}}"><button type="button" id="login-button" class="btn">Login</button></a>
                <a href="{{URL::asset('registration')}}"><button type="button" id="sign-up-button" class="btn">Sign up</button></a>
            @elseif(!empty($data['logged']) && $data['logged']=='yes')
                <a href="{{URL::asset('logout')}}"><button type="button" id="logout-button" class="btn">Logout</button></a>
            @endif
        </div>
    </div>
</div>
<div class="row">
    @if(!empty($data['logged']) && $data['logged']=='yes')
        <div id="profilelink">
            <img id="profilelinkimg" src="https://cdn3.iconfinder.com/data/icons/black-easy/512/535106-user_512x512.png"/>
            <a href="{{URL::asset('p/'.$data['username'])}}">{{$data['username']}}</a>
        </div>
    @endif
    <div id="shopping_cart">
        <img id="img" src="https://d30y9cdsu7xlg0.cloudfront.net/png/28468-200.png"/>
    </div>
</div>