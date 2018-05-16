<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('short_description', __('messages.offer_post_description')) !!}
    {!! Form::textarea('short_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('description', 'Description:') !!}--}}
    {{--{!! Form::textarea('description', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Offer Counts Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('offer_counts', 'Offer Counts:') !!}--}}
    {{--{!! Form::number('offer_counts', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- View Counts Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('view_counts', 'View Counts:') !!}--}}
    {{--{!! Form::number('view_counts', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- File Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('file', 'File:') !!}--}}
    {{--{!! Form::file('file') !!}--}}
{{--</div>--}}
{{--<div class="clearfix"></div>--}}

{{--<!-- Link Download Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('link_download', 'Link Download:') !!}--}}
    {{--{!! Form::text('link_download', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Source Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('source', 'Source:') !!}--}}
    {{--{!! Form::text('source', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Post Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_id', 'Tên bài viết: ') !!}
    {!! Form::select('post_id', $documents, isset($selectedDocument) ? $selectedDocument : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', __('messages.status')) !!}
    {!! Form::select('status',[''=>__('messages.selected'),1=>Helper::convertStatus(1), 0=>Helper::convertStatus(0)] ,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{!! route('superadmin.offerPosts.index') !!}" class="btn btn-default"><i
                class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
</div>