<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $document->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('messages.document_name')) !!}
    <p>{!! $document->name !!}</p>
</div>

<!-- Short Description Field -->
<div class="form-group">
    {!! Form::label('short_description', __('messages.document_short_description')) !!}
    <p>{!! $document->short_description !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('messages.document_description')) !!}
    <p>{!! $document->description !!}</p>
</div>

<!-- Slug Field -->

{{--<div class="form-group">--}}
    {{--{!! Form::label('slug', 'Slug:') !!}--}}
    {{--<p>{!! $document->slug !!}</p>--}}
{{--</div>--}}

<!-- Comment Counts Field -->

{{--<div class="form-group">--}}
    {{--{!! Form::label('comment_counts', 'Comment Counts:') !!}--}}
    {{--<p>{!! $document->comment_counts !!}</p>--}}
{{--</div>--}}

<!-- View Counts Field -->

{{--<div class="form-group">--}}
    {{--{!! Form::label('view_counts', 'View Counts:') !!}--}}
    {{--<p>{!! $document->view_counts !!}</p>--}}
{{--</div>--}}

<!-- Image Field -->

{{--<div class="form-group">--}}
    {{--{!! Form::label('image', 'Image:') !!}--}}
    {{--<p>{!! $document->image !!}</p>--}}
{{--</div>--}}

<!-- File Field -->
<div class="form-group">
    {!! Form::label('file', __('messages.document_file')) !!}
    <p>{!! $document->file !!}</p>
</div>

<!-- Link Download Field -->
<div class="form-group">
    {!! Form::label('link_download', __('messages.document_link_download')) !!}
    <p>{!! $document->link_download !!}</p>
</div>

<!-- Source Field -->
<div class="form-group">
    {!! Form::label('source', __('messages.document_source')) !!}
    <p>{!! $document->source !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('messages.document_user')) !!}
    <p>{!! $document->user->name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Ngày tạo:') !!}
    <p>{!! $document->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Ngày cập nhật:') !!}
    <p>{!! $document->updated_at !!}</p>
</div>

