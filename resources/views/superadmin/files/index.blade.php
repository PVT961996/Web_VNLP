@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-book"></i> @lang('messages.file_management')</h1>
        {!! Breadcrumbs::render('superadmin.files.index') !!}
    </section>
    <section class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools">
                    <a class="btn btn-primary" href="{!! route('superadmin.files.create') !!}"><i class="fa fa-plus"></i> @lang('messages.create')</a>
                    {{ Form::button('<i class="fa fa-remove"></i> '.Lang::get('messages.delete-all'), array('class'=>'btn btn-danger', 'onclick' => "var r = confirm('".Lang::get('messages.delete_more_confirm')."'); if (r == true) {
$('#items').submit();}")) }}
                </div>

            </div>
            <div class="box-header with-border">
                <div class="box-tools-search">
                    {!! Form::open(['method' => 'GET','route' => 'superadmin.files.index','role' => 'search']) !!}
                    <div class="form-inline text-right">
                        {!!Form::select('search[document_id]', $documents, null, ['class' => 'form-control','id'=> 'document', ])!!}
                        {!! Form::text('search[content]', null, ['class' => 'form-control', 'placeholder' => Lang::get('messages.file_content')]) !!}
                        {!! Form::button('<i class="fa fa-search"></i> '.Lang::get('messages.search'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
                        <a class="btn btn-warning" href="{!! route('superadmin.files.index') !!}"><i class="fa fa-eraser"></i> @lang('messages.reset')</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['id' =>'items', 'route' => ['superadmin.files.destroy', 'MULTI'], 'method' => 'delete']) !!}
                {!! Form::close() !!}
                @include('superadmin.files.table')
            </div>
            @if($files->hasPages())
            <div class="box-footer clearfix">
            {!! $files->appends(['search' => Request::get('search')])->render() !!}
            </div><!-- box-footer -->
            @endif
        </div>
    </section>
@endsection



