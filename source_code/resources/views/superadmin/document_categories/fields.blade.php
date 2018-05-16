<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::text('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Document Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document_id', 'Document Id:') !!}
    {!! Form::text('document_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('superadmin.documentCategories.index') !!}" class="btn btn-default">Cancel</a>
</div>
