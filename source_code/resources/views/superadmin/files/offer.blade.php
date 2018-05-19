@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-bolt"></i> @lang('messages.file')</h1>
        {!! Breadcrumbs::render('superadmin.files.offer',$file) !!}
    </section>
    <div class="content">
        @include('vendor.flash.errors')

        {!! Form::model($file, ['route' => ['superadmin.files.edit_offer'],'enctype'=>'multipart/form-data']) !!}
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
                            <input type="hidden" name="id" value="{{$file->id}}">
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('content', __('messages.file_content')) !!}
                                {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group col-sm-12">
                                {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
                                <a href="{!! route('superadmin.files.index') !!}" class="btn btn-default"><i
                                            class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection