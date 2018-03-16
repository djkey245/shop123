<?php $footerSettingFooter = App\Setting::footerSetting();
?>
        <!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/ico/favicon.png">

</head>
<body><div id="touchvpn_icon_container" class="disconnected" draggable="true" style="left: 91.25606469% !important; top: 91.20082816% !important;"><div id="touchvpn_status_icon" class="touchvpn_es"><div class="touchvpn_icon_sign">Best choice for browsing</div></div><div id="touchvpn_icon_selector"><div class="touchvpn_country touchvpn_ca"><div class="touchvpn_icon_sign">Browse from Canada</div></div><div class="touchvpn_country touchvpn_cl"><div class="touchvpn_icon_sign">Browse from Chile</div></div><div class="touchvpn_country touchvpn_es"><div class="touchvpn_icon_sign">Browse from Spain</div></div><div class="touchvpn_country touchvpn_ru"><div class="touchvpn_icon_sign">Browse from Russian Federation</div></div></div></div>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/">НаХаляву</a>
            <ul class="nav">
                @foreach(App\Setting::categoryTopMenu() as $categoryTopMenu)
                    <li><a href="/{{$categoryTopMenu->link}}">{{$categoryTopMenu->name}}</a></li>
                @endforeach
            </ul>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    @if (Route::has('login'))
                        @if (Auth::check())
                            <li><a href="{{ url('/home') }}">{{Auth::user()->name}}</a></li>
                            @if(Auth::user()->role == 2)
                                <li><a href="{{ url('/admin/active') }}">Админка</a></li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выйти
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                </form>
                            </li>
                            </ul>
                        @else
                            <li><a href="{{ url('/login') }}">Вход</a></li>
                            <li><a href="{{ url('/register') }}">Регистрация</a></li>
                        @endif
                    @endif


            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                @include('categories')
            </div>
        </div>
        <div class="span9">
            @yield('content')
        </div>
    </div>
    <hr>
    <footer>
        <p>©
            {{$footerSettingFooter['0']->name}}
            <br>{{$footerSettingFooter['1']->name." -"}}
        {{$footerSettingFooter['2']->name}}

    </footer>
</div>


<script src="/js/jquery.js"></script>
{{--<script src="/js/bootstrap-transition.js"></script>
<script src="/js/bootstrap-alert.js"></script>
<script src="/js/bootstrap-modal.js"></script>
<script src="/js/bootstrap-dropdown.js"></script>
<script src="/js/bootstrap-scrollspy.js"></script>
<script src="/js/bootstrap-tab.js"></script>
<script src="/js/bootstrap-tooltip.js"></script>
<script src="/js/bootstrap-popover.js"></script>
<script src="/js/bootstrap-button.js"></script>
<script src="/js/bootstrap-collapse.js"></script>
<script src="/js/bootstrap-carousel.js"></script>
<script src="/js/bootstrap-typeahead.js"></script>--}}


</body></html>