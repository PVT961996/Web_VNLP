<!--=====================
                    CATEGORIES
               ======================-->
<div class="widget-sidebar">
    <h2 class="title-widget-sidebar">@lang('messages.frontend_corpus_categories')</h2>
    @foreach($documents as $document)
        <a href="{{ route('documents') }}?danh-muc={{ $document->id }} ">
            <button class="categories-btn">{{ $document->name }}</button>
        </a>
    @endforeach
</div>

<div class="widget-sidebar">
    <h2 class="title-widget-sidebar">BÀI ĐĂNG GẦN ĐÂY</h2>
    <div class="content-widget-sidebar">
        <ul>
            @foreach($recent_posts as $key => $recent_post)
                <li class="recent-post">
                    <div class="post-img">
                        <img src="/uploads/default-image.png"
                             class="img-responsive">
                    </div>
                    <a href="{{ route('files.show',[$recent_post->id]) }}"><h5>{{ $recent_post->name }}</h5></a>
                    <p>
                        <small><i class="fa fa-calendar" data-original-title=""
                                  title=""></i> {{ $recent_post->updated_at }}
                        </small>
                    </p>
                </li>
                    <hr>
            @endforeach
        </ul>
    </div>
</div>

{{--<div class="widget-sidebar">--}}
    {{--<h2 class="title-widget-sidebar">// ARCHIVES</h2>--}}
    {{--<div class="last-post">--}}
        {{--<button class="accordion">21/4/2016</button>--}}
        {{--<div class="panel">--}}
            {{--<li class="recent-post">--}}
                {{--<div class="post-img">--}}
                    {{--<img src="https://lh3.googleusercontent.com/-13DR8P0-AN4/WM1ZIz1lRNI/AAAAAAAADeo/XMfJ7CM-pQg9qfRuCgSnphzqhaj3SQg6QCJoC/w424-h318-n-rw/thumbnail4.jpg"--}}
                         {{--class="img-responsive">--}}
                {{--</div>--}}
                {{--<a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>--}}
                {{--<p>--}}
                    {{--<small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014--}}
                    {{--</small>--}}
                {{--</p>--}}
            {{--</li>--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor--}}
                {{--incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="last-post">--}}
        {{--<button class="accordion">5/7/2016</button>--}}
        {{--<div class="panel">--}}
            {{--<li class="recent-post">--}}
                {{--<div class="post-img">--}}
                    {{--<img src="https://lh3.googleusercontent.com/-QlnwuVgbxus/WM1ZI1FKQiI/AAAAAAAADeo/nGSd1ExnnfIfIBF27xs8-EdBdfglqFPZgCJoC/w424-h318-n-rw/thumbnail2.jpg"--}}
                         {{--class="img-responsive">--}}
                {{--</div>--}}
                {{--<a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>--}}
                {{--<p>--}}
                    {{--<small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014--}}
                    {{--</small>--}}
                {{--</p>--}}
            {{--</li>--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor--}}
                {{--incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="last-post">--}}
        {{--<button class="accordion">15/9/2016</button>--}}
        {{--<div class="panel">--}}
            {{--<li class="recent-post">--}}
                {{--<div class="post-img">--}}
                    {{--<img src="https://lh3.googleusercontent.com/-wRHL_FOH1AU/WM1ZIxQZ3DI/AAAAAAAADeo/lwJr8xndbW4MHI-lOB7CQ-14FJB5f5SWACJoC/w424-h318-n-rw/thumbnail5.jpg"--}}
                         {{--class="img-responsive">--}}
                {{--</div>--}}
                {{--<a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>--}}
                {{--<p>--}}
                    {{--<small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014--}}
                    {{--</small>--}}
                {{--</p>--}}
            {{--</li>--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor--}}
                {{--incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="last-post">--}}
        {{--<button class="accordion">2/3/2017</button>--}}
        {{--<div class="panel">--}}
            {{--<li class="recent-post">--}}
                {{--<div class="post-img">--}}
                    {{--<img src="https://lh3.googleusercontent.com/-QlnwuVgbxus/WM1ZI1FKQiI/AAAAAAAADeo/nGSd1ExnnfIfIBF27xs8-EdBdfglqFPZgCJoC/w424-h318-n-rw/thumbnail2.jpg"--}}
                         {{--class="img-responsive">--}}
                {{--</div>--}}
                {{--<a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>--}}
                {{--<p>--}}
                    {{--<small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014--}}
                    {{--</small>--}}
                {{--</p>--}}
            {{--</li>--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor--}}
                {{--incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}


{{--<!--=====================--}}
      {{--NEWSLATTER--}}
{{--======================-->--}}
{{--<div class="widget-sidebar">--}}
    {{--<h2 class="title-widget-sidebar">// NEWSLATTER</h2>--}}
    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut .</p>--}}
    {{--<div class="input-group">--}}
        {{--<span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>--}}
        {{--<input id="email" type="text" class="form-control" name="email" placeholder="Email">--}}
    {{--</div>--}}
    {{--<button type="button" class="btn btn-warning">Warning</button>--}}
{{--</div>--}}