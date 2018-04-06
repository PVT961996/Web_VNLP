<table class="table table-bordered">
    <tbody>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('name', __('messages.document_name')) !!}</th>
        <td><p>{!! $document->name !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('short_description', __('messages.document_short_description')) !!}</th>
        <td><p>{!! $document->short_description !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('description', __('messages.document_description')) !!}</th>
        <td><p>{!! $document->description !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('file', __('messages.document_file')) !!}</th>
        <td><p>{!! $document->file !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('link_download', __('messages.document_link_download')) !!}</th>
        <td><p>{!! $document->link_download !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('source', __('messages.document_source')) !!}</th>

        <td><p>{!! $document->source !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('source', __('messages.document_user')) !!}</th>

        <td><p>{!! $document->user->name !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('created_at', __('messages.created_at')) !!}</th>
        <td><p>{!! $document->created_at !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('updated_at', __('messages.updated_at')) !!}</th>
        <td><p>{!! $document->updated_at !!}</p></td>
    </tr>

    </tbody>
</table>
