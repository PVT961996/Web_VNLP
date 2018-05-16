@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-tag"></i> @lang('messages.label_type_management')</h1>
        {!! Breadcrumbs::render('superadmin.labelTypes.index') !!}
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
                    <a class="btn btn-primary" href="{!! route('superadmin.labelTypes.create') !!}"><i
                                class="fa fa-plus"></i> @lang('messages.create')</a>
                    {{ Form::button('<i class="fa fa-remove"></i> '.Lang::get('messages.delete-all'), array('class'=>'btn btn-danger', 'onclick' => "var r = confirm('".Lang::get('messages.delete_more_confirm')."'); if (r == true) {
$('#items').submit();}")) }}
                </div>

            </div>
            <div class="box-header with-border">
                <div class="box-tools-search">
                    {!! Form::open(['method' => 'GET','route' => 'superadmin.labelTypes.index','role' => 'search']) !!}
                    <div class="form-inline text-right">
                        {!! Form::select('search[type]', [''=>__('messages.selected'),1 => Helper::convertType(1), 0=>Helper::convertType(0)], null, ['class' => 'form-control','id'=> 'type', ])!!}
                        {!! Form::text('search[name]', null, ['class' => 'form-control', 'placeholder' => Lang::get('messages.label_type_name')]) !!}
                        {!! Form::button('<i class="fa fa-search"></i> '.Lang::get('messages.search'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
                        <a class="btn btn-warning" href="{!! route('superadmin.labelTypes.index') !!}"><i
                                    class="fa fa-eraser"></i> @lang('messages.reset')</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['id' =>'items', 'route' => ['superadmin.labelTypes.destroy', 'MULTI'], 'method' => 'delete']) !!}
                {!! Form::close() !!}
                @include('superadmin.label_types.table')
            </div>
            @if($labelTypes->hasPages())
                <div class="box-footer clearfix">
                    {!! $labelTypes->appends(['search' => Request::get('search')])->render() !!}
                </div>
            @endif
        </div>
    </section>
@endsection



