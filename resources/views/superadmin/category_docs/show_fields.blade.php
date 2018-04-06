<table class="table table-bordered">
    <tbody>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('name', __('messages.category_doc_name')) !!}</th>
        <td><p>{!! $categoryDoc->name !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('description', __('messages.category_doc_description')) !!}</th>
        <td><p>{!! $categoryDoc->description !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('parent_id', __('messages.category_doc_parent_id')) !!}</th>
        <td><p>{!! $categoryDoc->parent['name'] !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('created_at', __('messages.created_at')) !!}</th>
        <td><p>{!! $categoryDoc->created_at !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('updated_at', __('messages.updated_at')) !!}</th>
        <td><p>{!! $categoryDoc->updated_at !!}</p></td>
    </tr>

    </tbody>
</table>