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
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/ico/favicon.png">

</head>
<body><div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">

            <a class="brand " href="/">НаХаляву</a>
            <ul class="nav">
                @foreach(App\Setting::categoryTopMenu() as $categoryTopMenu)
                    <li class="col-xs-12"><a href="/{{$categoryTopMenu->link}}">{{$categoryTopMenu->name}}</a></li>
                    @endforeach


            </ul>


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
            <form class="navbar-search pull-right">
                <input type="text" class="search-query" placeholder="Search">
            </form>



        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3 ">
            <div class="well sidebar-nav">
                @include('admin.categories')
            </div>
        </div>
        <div class="span9 ">
            <div id="alert_info">
                <div id="alert_info_text">

                </div>
                <div class="x-exit" onclick="$('#alert_info').hide();">X</div>
            </div>
            @yield('content')
        </div>
    </div>
    <hr>
    <footer>
        <p>© <?php $footerSettingFooter = App\Setting::footerSetting();
        ?>
            {{$footerSettingFooter['0']->name}}
            <br>{{$footerSettingFooter['1']->name." -"}}
            {{$footerSettingFooter['2']->name}}

    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.js"         integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="        crossorigin="anonymous"></script>



</body></html>