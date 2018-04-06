@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-file"></i> @lang('messages.document_management')</h1>
        {!! Breadcrumbs::render('superadmin.documents.index') !!}
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
                    <a class="btn btn-primary" href="{!! route('superadmin.documents.create') !!}"><i class="fa fa-plus"></i> @lang('messages.create')</a>
                    {{ Form::button('<i class="fa fa-remove"></i> '.Lang::get('messages.delete-all'), array('class'=>'btn btn-danger', 'onclick' => "var r = confirm('".Lang::get('messages.delete_more_confirm')."'); if (r == true) {
$('#items').submit();}")) }}
                </div>

            </div>
            <div class="box-header with-border">
                <div class="box-tools-search">
                    {!! Form::open(['method' => 'GET','route' => 'superadmin.documents.index','role' => 'search']) !!}
                    <div class="form-inline text-right">
                        {!! Form::text('search[name]', null, ['class' => 'form-control', 'placeholder' => Lang::get('messages.document_name')]) !!}
                        {!! Form::text('search[source]', null, ['class' => 'form-control', 'placeholder' => Lang::get('messages.document_source')]) !!}
                        {!! Form::button('<i class="fa fa-search"></i> '.Lang::get('messages.search'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
                        <a class="btn btn-warning" href="{!! route('superadmin.documents.index') !!}"><i class="fa fa-eraser"></i> @lang('messages.reset')</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['id' =>'items', 'route' => ['superadmin.documents.destroy', 'MULTI'], 'method' => 'delete']) !!}
                {!! Form::close() !!}
                @include('superadmin.documents.table')
            </div>
            @if($documents->hasPages())
                <div class="box-footer clearfix">
                    {!! $documents->appends(['search' => Request::get('search')])->render() !!}
                </div><!-- box-footer -->
            @endif
        </div>
    </section>
@endsection

