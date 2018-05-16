<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('messages.title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="js/app.js"></script>
    <link href="css/app.css" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Times New Roman';
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        #div1, #div2 {
            float: left;
            width: 100px;
            height: 35px;
            margin: 10px;
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
{{--@include('flash::message')--}}
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/') }}">@lang('messages.home')</a>
            <div class="pull-right">
                <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    @lang('messages.logout')
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
            @else
                <a href="{{ route('login') }}">@lang('messages.login')</a>
                <a href="{{ route('register') }}">@lang('messages.register')</a>
                @endauth
        </div>
    @endif

    <form method="get" action="/api/products">
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-primary">Tìm kiếm</button>
            </div>
            <div class="col-md-8">
                <input type="text" placeholder="Nhập tiêu chí tìm kiếm" name="name" class="form-control">
            </div>
        </div>
    </div></form>
    <div class="clearfix"></div>
    <h2 style="margin-left: 20px;">Kéo thả</h2>

    <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
        <img src="img/img_w3slogo.gif" style="padding-bottom: 10px;" draggable="true" ondragstart="drag(event)" id="drag1" width="88" height="31">
    </div>

    <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        <span class="context-menu-one btn btn-neutral">right click me</span>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/github.min.css">
<link href="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.css" rel="stylesheet" type="text/css">

<script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.js" type="text/javascript"></script>
<script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.ui.position.min.js" type="text/javascript"></script>
<script src="https://swisnl.github.io/jQuery-contextMenu/js/main.js" type="text/javascript"></script>
</body>
<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }

    $(function() {
        $.contextMenu({
            selector: '.flex-center',
            callback: function(key, options) {
                var m = "clicked: " + key;
                window.console && console.log(m) || alert(m);
            },
            items: {
                "edit": {name: "Edit", icon: "edit"},
                "cut": {name: "Cut", icon: "cut"},
                copy: {name: "Copy", icon: "copy"},
                "paste": {name: "Paste", icon: "paste"},
                "delete": {name: "Delete", icon: "delete"},
                "sep1": "---------",
                "quit": {name: "Quit", icon: function(){
                    return 'context-menu-icon context-menu-icon-quit';
                }}
            }
        });

        $('.flex-center').on('click', function(e){
            console.log('clicked', this);
        })
    });
</script>
</html>
