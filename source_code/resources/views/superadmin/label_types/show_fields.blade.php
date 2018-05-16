<table class="table table-bordered">
    <tbody>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('summary', __('messages.label_type_name')) !!}</th>
        <td><p>{!! $labelType->name !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('description', __('messages.label_type_description')) !!}</th>
        <td><p>{!! $labelType->description !!} </p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('category', __('messages.label_type_type')) !!}</th>
        <td>{!! Helper::convertType($labelType->type) !!}</td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('created_at', __('messages.created_at')) !!}</th>
        <td><p>{!! $labelType->created_at !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('updated_at', __('messages.updated_at')) !!}</th>
        <td><p>{!! $labelType->updated_at !!}</p></td>
    </tr>

    </tbody>
</table>