<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="sumit kumar">
    <title>@lang('messages.title')</title>
    {{--<link href="css/bootstrap.css" rel="stylesheet" type="text/css">--}}
    {{--<link href="css/font-awesome.css" rel="stylesheet" type="text/css">--}}
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{--<script src="https://use.fontawesome.com/07b0ce5d10.js"></script>--}}


</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><img
                        src="/uploads/1519181126.hus.jpg" style="height: 32px; width: 40px;"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="/">@lang('messages.home')</a></li>
                {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Page 1-1</a></li>--}}
                        {{--<li><a href="#">Page 1-2</a></li>--}}
                        {{--<li><a href="#">Page 1-3</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                @foreach($documents as $document)
                    <li><a href="{{ route('documents') }}?danh-muc={{ $document->id }}">{!! $document->name !!}</a></li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <li><a href="{!! url('/register') !!}"><span
                                class="glyphicon glyphicon-user"></span> @lang('messages.register')</a></li>
                @if (!Auth::guest())
                    <li><a href="{!! url('/logout') !!}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"></span>@lang('messages.logout')
                        </a></li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <li><a href="{!! url('/login') !!}"><span
                                    class="glyphicon glyphicon-log-in"></span> @lang('messages.login')</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>


<section id="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @yield('content')
            </div>

            <!--           // RECENT POST===========-->
            <div class="col-lg-4">
                <!--=====================
                      CATEGORIES
                 ======================-->
                <div class="widget-sidebar">
                    <h2 class="title-widget-sidebar">@lang('messages.frontend_corpus_categories')</h2>
                    @foreach($documents as $document)
                       <a href="{{ route('documents') }}?danh-muc={{ $document->id }} "> <button class="categories-btn">{{ $document->name }}</button></a>
                    @endforeach
                </div>

                <div class="widget-sidebar">
                    <h2 class="title-widget-sidebar">// RECENT POST</h2>
                    <div class="content-widget-sidebar">
                        <ul>
                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-ndZJOGgvYQ4/WM1ZI8dH86I/AAAAAAAADeo/l67ZqZnRUO8QXIQi38bEXuxqHfVX0TV2gCJoC/w424-h318-n-rw/thumbnail8.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>
                            <hr>

                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-ojLI116-Mxk/WM1ZIwdnuwI/AAAAAAAADeo/4K6VpwIPSfgsmlXJB5o0N8scuI3iW4OpwCJoC/w424-h318-n-rw/thumbnail6.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>
                            <hr>

                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-TrK1csbtHRs/WM1ZI1SIUNI/AAAAAAAADeo/OkiUjuad6skWl9ugxbiIA_436OwsWKBNgCJoC/w424-h318-n-rw/thumbnail3.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>
                            <hr>

                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-UKfIhJSBW9M/WM1ZI8ou34I/AAAAAAAADeo/vlLGY29147AYLaxUW29ZXJlun115BhkhgCJoC/w424-h318-n-rw/thumbnail7.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>


                        </ul>
                    </div>
                </div>

                <div class="widget-sidebar">
                    <h2 class="title-widget-sidebar">// ARCHIVES</h2>
                    <div class="last-post">
                        <button class="accordion">21/4/2016</button>
                        <div class="panel">
                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-13DR8P0-AN4/WM1ZIz1lRNI/AAAAAAAADeo/XMfJ7CM-pQg9qfRuCgSnphzqhaj3SQg6QCJoC/w424-h318-n-rw/thumbnail4.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                    <hr>
                    <div class="last-post">
                        <button class="accordion">5/7/2016</button>
                        <div class="panel">
                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-QlnwuVgbxus/WM1ZI1FKQiI/AAAAAAAADeo/nGSd1ExnnfIfIBF27xs8-EdBdfglqFPZgCJoC/w424-h318-n-rw/thumbnail2.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                    <hr>
                    <div class="last-post">
                        <button class="accordion">15/9/2016</button>
                        <div class="panel">
                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-wRHL_FOH1AU/WM1ZIxQZ3DI/AAAAAAAADeo/lwJr8xndbW4MHI-lOB7CQ-14FJB5f5SWACJoC/w424-h318-n-rw/thumbnail5.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                    <hr>
                    <div class="last-post">
                        <button class="accordion">2/3/2017</button>
                        <div class="panel">
                            <li class="recent-post">
                                <div class="post-img">
                                    <img src="https://lh3.googleusercontent.com/-QlnwuVgbxus/WM1ZI1FKQiI/AAAAAAAADeo/nGSd1ExnnfIfIBF27xs8-EdBdfglqFPZgCJoC/w424-h318-n-rw/thumbnail2.jpg"
                                         class="img-responsive">
                                </div>
                                <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                <p>
                                    <small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014
                                    </small>
                                </p>
                            </li>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                </div>


                <!--=====================
                      NEWSLATTER
               ======================-->
                <div class="widget-sidebar">
                    <h2 class="title-widget-sidebar">// NEWSLATTER</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut .</p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <button type="button" class="btn btn-warning">Warning</button>
                </div>


            </div>
        </div>
    </div>

</section>


{{--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>--}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

{{--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>--}}

{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}

{{--<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>--}}
{{--<script src="js/bootstrap.js"></script>--}}
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });


    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        }
    }
</script>


</body>
</html>