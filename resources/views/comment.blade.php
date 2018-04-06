@extends('layouts/app')
@section('content')
<script>

    // Init application
    window.fbAsyncInit = function () {
        FB.init({
            appId: '397253290706252', // Đổi App ID của bạn ở đây
            cookie: true,
            xfbml: true,
            version: 'v2.11'
        });
        // Kiểm tra trạng thái hiện tại
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });

    };

    // Xử lý trạng thái đăng nhập
    function statusChangeCallback(response) {
        // Người dùng đã đăng nhập FB và đã đăng nhập vào ứng dụng
        if (response.status === 'connected') {
            var accessToken = response.authResponse.accessToken;
            // FB.getAuthResponse();
            console.log(response);
            ShowWelcome();
        }
        // Người dùng đã đăng nhập FB nhưng chưa đăng nhập ứng dụng
        else if (response.status === 'not_authorized') {
            ShowLoginButton();
        }
        // Người dùng chưa đăng nhập FB
        else {
            ShowLoginButton();
        }
    }

    // Gửi yêu cầu đăng nhập tới FB
    function RequestLoginFB() {
        window.location = 'http://graph.facebook.com/oauth/authorize?'
                + 'client_id=397253290706252&scopes=' + // Đổi App ID của bạn ở đây
                'public_profile,email,user_likes&redirect_uri=http://demokl.com:8000/test';
    }

    function RequestLogoutFB(){
        FB.logout();
        location.reload();
    }

    // Hiển thị nút đăng nhập
    function ShowLoginButton() {
        document.getElementById('btb').setAttribute('style', 'display:block');
        document.getElementById('lbl').setAttribute('style', 'display:none');
    }

    // Chào mừng người dùng đã đăng nhập
    function ShowWelcome() {
        document.getElementById('btb').setAttribute('style', 'display:none');
        document.getElementById('lbl').setAttribute('style', 'display:block');

        FB.api('/me', function (response) {
            console.log(response);
            var name = response.name;
            var id = response.id;
            document.getElementById('lbl').innerHTML =
                    '<h4>You are logged with:</h4>Name: ' +
                    name + ' <br/>Facebook ID: ' + id;
            document.getElementById('lbl').setAttribute('style', 'display:block');
//            document.getElementById('logout').innerHTML = '<input id="btb" class="form-control" type="button" onclick="RequestLogoutFB()" value="Đăng xuất"/></div>';
        });

    }
    var posts = [];
    var comments = [];
    function getPath() {
        path = $("#path_text").val();
        FB.api(path, function (response) {
            posts = response.data;
        });
        window.setTimeout(function () {
            (function myLoop (i) {
                setTimeout(function () {
                    url = posts[i].id+"/comments";
                    FB.api(url, function (response) {
//                        console.log(url);
                        comments[i] = {post_name: posts[i].message, comments: response.data};
                        if (i<posts.length-1) myLoop(++i);
                        else {
                            console.log(comments);
                            text = "";
                            for(i = 0; i< posts.length; i++){
                                text+="Bai viet: \r\n"+comments[i].post_name+"\r\nComments: \r\n";
                                for(j = 0; j<comments[i].comments.length; j++){
                                    text+=comments[i].comments[j].message+"\r\n";
                                }
                            }
                            download('data.txt',text);
                        }
                    });
                }, 50)
            })(0);
        }, 500);
    }

    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }

</script>
<div id="fb-root"></div>
<div id="logout"></div>
<div class="clearfix"></div>
<div class="col-md-6">
    <div class="col-md-4"><input class="form-control" type="text" id="path_text" value="qtv.fan/posts/"/></div>
    <div class="col-md-2"><input class="btn btn-primary" type="button" onclick="getPath()" value="Gửi"/></div>
</div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=397253290706252';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>



<!-- Nút đăng nhập -->
<div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="true" data-auto-logout-link="true" data-use-continue-as="true" auto_logout_link="true"></div>
<div class="col-md-3">
<input id="btb" type="button" class="form-control"
       value="Login with Facebook" onclick="RequestLoginFB()" style="display:none" />
<p id="lbl" style="display:none">BẠN ĐÃ ĐĂNG NHẬP THÀNH CÔNG!</p>
</div>
@endsection