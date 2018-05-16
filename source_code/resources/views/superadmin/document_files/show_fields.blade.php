<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $documentFile->id !!}</p>
</div>

<!-- File Id Field -->
<div class="form-group">
    {!! Form::label('file_id', 'File Id:') !!}
    <p>{!! $documentFile->file_id !!}</p>
</div>

<!-- Document Id Field -->
<div class="form-group">
    {!! Form::label('document_id', 'Document Id:') !!}
    <p>{!! $documentFile->document_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $documentFile->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $documentFile->updated_at !!}</p>
</div>

