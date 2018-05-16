{{--<!-- Summary Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('summary', __('messages.file_summary')) !!}--}}
{{--{!! Form::text('summary', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('messages.file_name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
@if(isset($file) && $file->documents[0]->type == 3)
    <div class="form-group col-sm-12 col-lg-12">
        <div id='jstree_edit_div'>{!! $output !!}</div>
        <input type="text" name="content" id="contentText" class="form-control"
               value="{{ isset($file->content)? $file->content : "" }}">
    </div>
@else
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('content', __('messages.file_content')) !!}
        {{ Form::textarea('content', null, ['class' => 'form-control']) }}
    </div>
@endif

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('messages.file_description')) !!}
    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
</div>

<!-- View Field -->
<div class="form-group col-sm-6">
    {!! Form::label('view', __('messages.file_view')) !!}
    {!! Form::text('view', null, ['class' => 'form-control']) !!}
</div>

<!-- Evaluated Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('evaluated', __('messages.evaluated')) !!}--}}
    {{--{!! Form::select('evaluated',[''=>__('messages.selected'),2 => Helper::convertEvaluated(2), 1=>Helper::convertEvaluated(1), 0=>Helper::convertEvaluated(0)] ,null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('messages.status')) !!}
    {!! Form::select('status',[''=>__('messages.selected'),1=>Helper::convertStatus(1), 0=>Helper::convertStatus(0)] ,null, ['class' => 'form-control']) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', __('messages.file')) !!}
    {!! Form::file('file', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{!! route('superadmin.files.index') !!}" class="btn btn-default"><i
                class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
</div>