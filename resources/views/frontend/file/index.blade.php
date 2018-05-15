@extends('layouts.frontend.frontend_main')

@section('content')
    <div class="row">
    @foreach($files as $file)
        <div class="col-lg-6 col-md-6">
            <aside>
                <img src="/uploads/default-image.png"
                     class="img-responsive">
                <div class="content-title">
                    <div class="text-center">
                        <h3><a href="{{ route("files.show", [$file->id]) }}">{{ str_limit($file->name, $limit = 100, $end = '...') }}</a>
                        </h3>
                    </div>
                </div>
                <div class="content-footer">
                    @if(!empty($file->user->avatar) && (file_exists(public_path($file->user->avatar)) || (filter_var($file->user->avatar, FILTER_VALIDATE_URL) && getimagesize($file->user->avatar))))
                        <img src="{!! $file->user->avatar !!}" alt="{!! $file->user->avatar !!}"
                             width="270" height="263">
                    @else
                        <img class="user-small-img"
                             src="/uploads/default-avatar.png">
                    @endif
                    <span style="font-size: 16px;color: #fff;">{!! $file->user->name !!}</span>
                        <span class="pull-right">
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Lượt xem"><i
                                    class="fa fa-eye"></i> {!! empty($file->view)? 0 : $file->view !!}</a>
                            @include('shared.download')
                    </span>
                </div>
            </aside>
        </div>
    @endforeach
    </div>
    @if($files->hasPages())
        <div class="box-footer clearfix">
            {!! $files->appends(['search' => Request::get('search')])->render() !!}
        </div>
    @endif
@endsection