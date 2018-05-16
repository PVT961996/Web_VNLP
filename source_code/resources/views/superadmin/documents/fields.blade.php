<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::textarea('short_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Counts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment_counts', 'Comment Counts:') !!}
    {!! Form::number('comment_counts', null, ['class' => 'form-control']) !!}
</div>

<!-- View Counts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('view_counts', 'View Counts:') !!}
    {!! Form::number('view_counts', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'File:') !!}
    {!! Form::file('file') !!}
</div>
<div class="clearfix"></div>

<!-- Link Download Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_download', 'Link Download:') !!}
    {!! Form::text('link_download', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Loại:') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>


<!-- Source Field -->
<div class="form-group col-sm-6">
    {!! Form::label('source', 'Source:') !!}
    {!! Form::text('source', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('user_id', 'User Id:') !!}--}}
    {{--{!! Form::text('user_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->

<div class="form-group col-sm-12">
    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{!! route('superadmin.documents.index') !!}" class="btn btn-default"><i
                class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
</div>