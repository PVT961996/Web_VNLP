<!-- Summary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('summary', __('messages.file_summary')) !!}
    {!! Form::text('summary', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', __('messages.file_content')) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('messages.file_description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- File Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document_id', __('messages.file_document')) !!}
    {!! Form::select('document_id', $documents, isset($selectedDocument) ? $selectedDocument : null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{!! route('superadmin.files.index') !!}" class="btn btn-default"><i
                class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
</div>
