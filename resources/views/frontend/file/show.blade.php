@extends('layouts.frontend.frontend_main')

@section('content')
    <div class="content">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('frontend.file.show_fields')
                        <a href="{!! route('files') !!}" class="btn btn-default"><i class="fa fa-mail-reply"></i> @lang('messages.back')</a>
                    </div>
                </div>
            </div>
        </div>
@endsection