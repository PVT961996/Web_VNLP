@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-file"></i> @lang('messages.document')
        </h1>
        {!! Breadcrumbs::render('superadmin.documents.create') !!}
    </section>
    <div class="content">
        @include('vendor.flash.errors')
        {!! Form::open(['route' => 'superadmin.documents.store','enctype'=>'multipart/form-data']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-plus"></i> @lang('messages.create')</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="label label-warning">@lang('messages.info')</span>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            @include('superadmin.documents.fields')
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-3">--}}
                {{--@include('shared.categories', ['categories' => $categories, 'selectedCategories' => $selectedCategories])--}}
            {{--</div>--}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

