@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-file-text-o"></i> @lang('messages.file')</h1>
        {!! Breadcrumbs::render('superadmin.files.edit',$file) !!}
    </section>
    <div class="content">
        @include('vendor.flash.errors')

        {!! Form::model($file, ['route' => ['superadmin.files.update', $file->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-edit"></i> @lang('messages.update')</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="label label-warning">@lang('messages.info')</span>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            @include('superadmin.files.fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection