<table class="table table-bordered">
    <tbody>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('summary', __('messages.file_summary')) !!}</th>
        <td><p>{!! $file->summary !!}</p></td>
    </tr>

    @if($file->documents[0]->type == 3)
        {{--<tr>--}}
            {{--<th style="width: 150px" scope="row">{!! Form::label('content', __('messages.file_content')) !!}</th>--}}
            <div id='jstree_demo_div'>{!! $output !!}</div>
        {{--</tr>--}}
    @else
        <tr>
            <th style="width: 150px" scope="row">{!! Form::label('content', __('messages.file_content')) !!}</th>
            <td><p>{{ $file->content }}</p></td>
        </tr>
    @endif

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('description', __('messages.file_description')) !!}</th>
        <td><p>{{ $file->description }}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('category', __('messages.document_category')) !!}</th>
        <td>{!! Helper::formatCategories($file->documents) !!}</td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('view', __('messages.file_view')) !!}</th>
        <td><p>{!! $file->view !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('file', __('messages.file')) !!}</th>
        <td><p>{!! $file->file !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('evaluated', __('messages.evaluated')) !!}</th>
        <td><p>{!! Helper::convertEvaluated($file->evaluated) !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('status', __('messages.status')) !!}</th>
        <td><p>{!! Helper::convertStatus($file->status) !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('created_at', __('messages.created_at')) !!}</th>
        <td><p>{!! $file->created_at !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('updated_at', __('messages.updated_at')) !!}</th>
        <td><p>{!! $file->updated_at !!}</p></td>
    </tr>

    </tbody>
</table>