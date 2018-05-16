@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-commenting-o"></i> @lang('messages.sentences')</h1>
        {!! Breadcrumbs::render('superadmin.sentences.edit',$sentence) !!}
    </section>
    <div class="content">
        @include('vendor.flash.errors')

        {!! Form::model($sentence, ['route' => ['superadmin.sentences.update_high', $sentence->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}
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
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('content', __('messages.sentence_content')) !!}
                                <input type="text" name="content" id="contentText" class="form-control"
                                       value="{{ isset($sentence->content)? $sentence->content : "" }}">
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                <div id="containment-wrapper">
                                    @foreach($words as $key => $word)
                                        <div class="draggable draggable2 ui-widget-content active" id="{{ $key }}">
                                            <div class="col-sm-1">
                                                <button class="btn btn-default" type="button">{{ $word }}</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- File_Id Field -->
                            <input type="hidden" name="file_id" value="{{ $sentence->file->id }}">

                            <!-- Submit Field -->
                            <div class="form-group col-sm-12">
                                {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
                                <a href="{!! route('superadmin.sentences.index') !!}" class="btn btn-default"><i
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