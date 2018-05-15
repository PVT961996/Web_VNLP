<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('messages.users')) !!}
    {!! Form::select('user_id', $users, isset($selectedUser) ? $selectedUser : null, ['class' => 'form-control']) !!}
</div>

<!-- File Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_id', __('messages.file_name')) !!}
    {!! Form::select('file_id',[''=>__('messages.selected'), $selectedFile => $nameSelectedFile], isset($selectedFile) ? $selectedFile : null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('messages.file_users_phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('messages.file_users_email')) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('messages.file_users_description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('messages.status')) !!}
    {!! Form::select('status',[''=>__('messages.selected'),1=>Helper::convertStatus(1), 0=>Helper::convertStatus(0)] ,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{!! route('superadmin.fileUsers.index') !!}" class="btn btn-default"><i
                class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
</div>