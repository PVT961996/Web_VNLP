<table class="table table-bordered">
    <tbody>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('name', __('messages.users')) !!}</th>
        <td><p>{!! $fileUser->user->name !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('short_description', __('messages.file_name')) !!}</th>
        <td><p>{!! $fileUser->file->name !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('description', __('messages.file_users_phone')) !!}</th>
        <td><p>{!! $fileUser->phone !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('file', __('messages.file_users_email')) !!}</th>
        <td><p>{!! $fileUser->email !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('link_download', __('messages.file_users_description')) !!}</th>
        <td><p>{!! $fileUser->description !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('source', __('messages.status')) !!}</th>

        <td><p>{!! Helper::convertStatus($fileUser->status) !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('created_at', __('messages.created_at')) !!}</th>
        <td><p>{!! $fileUser->created_at !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('updated_at', __('messages.updated_at')) !!}</th>
        <td><p>{!! $fileUser->updated_at !!}</p></td>
    </tr>

    </tbody>
</table>


