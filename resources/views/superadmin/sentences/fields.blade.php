<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', __('messages.sentence_content')) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- File Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_id', __('messages.sentence_file')) !!}
    {!! Form::select('file_id', $fileCorpus, isset($selectedFile) ? $selectedFile : null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{!! route('superadmin.sentences.index') !!}" class="btn btn-default"><i
                class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
</div>