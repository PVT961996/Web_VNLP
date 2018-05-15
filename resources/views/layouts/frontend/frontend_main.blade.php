<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="sumit kumar">
    <title>@lang('messages.title')</title>
    {{--<link href="css/bootstrap.css" rel="stylesheet" type="text/css">--}}
    {{--<link href="css/font-awesome.css" rel="stylesheet" type="text/css">--}}
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{--<script src="https://use.fontawesome.com/07b0ce5d10.js"></script>--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/custorm.css">

    @yield('css')

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
                @foreach($category_docs as $category_doc)
                    <li><a href="{{ route('categoryDoc') }}?danh-muc={{ $category_doc->id }}">{!! $category_doc->name !!}</a></li>
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
                @include('shared/menu')
            </div>
        </div>
    </div>

</section>


{{--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>--}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery 3.1.1 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>

<!-- TinyMCE4 -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

{{-- select2--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="/frontend/js/app.js"></script>

@yield('scripts')

<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea",
        language: "vi_VN",
        language_url : '/js/tinymce/langs/vi_VN.js',
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);

    $(document).ready(function() {
        $('input').attr('autocomplete', 'off');

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        var checkAll = $('input[type="checkbox"].checkAll');
        var checkboxes = $('input[type="checkbox"].checkSingle');

        checkAll.on('ifChecked ifUnchecked', function(event) {
            if (event.type == 'ifChecked') {
                checkboxes.iCheck('check');
            } else {
                checkboxes.iCheck('uncheck');
            }
        });

        checkboxes.on('ifChanged', function(event){
            console.log(checkboxes);

            if(checkboxes.filter(':checked').length == checkboxes.length) {
                checkAll.prop('checked', true);
            } else {
                checkAll.prop('checked', false);
            }
            checkAll.iCheck('update');
        });
    });
</script>
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