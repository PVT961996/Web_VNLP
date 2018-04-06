@extends('layouts.frontend.frontend_main')

{{--@section('content')--}}
    {{--@foreach($documents as $key=>$document)--}}
        {{--<div class="col-md-6" style="padding-bottom: 20px;">--}}
            {{--<div id="postlist" style="border: 5px ridge">--}}
                {{--<div class="panel">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<div class="text-center">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-9">--}}
                                    {{--<h3 class="pull-left">{{ $document->name }}</h3>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-3">--}}
                                    {{--<h4 class="pull-right">--}}
                                        {{--<small><em>{{ $document->created_at }}</em></small>--}}
                                    {{--</h4>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--{{ str_limit($document->short_description, $limit = 150, $end = '...') }} <a href="{!! route('post.show', [$document->id]) !!}">Xem thêm</a>--}}
                    {{--</div>--}}

                    {{--<div class="panel-footer">--}}
                        {{--<a href="{!! route("post.edit", [$document->id]) !!}"><span class="label label-default">Đề xuất chỉnh sửa</span></a> <span class="label label-default">Đánh giá</span></span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endforeach--}}
{{--@endsection--}}