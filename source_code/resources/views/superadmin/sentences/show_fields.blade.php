<table class="table table-bordered">
    <tbody>
    @if($sentence->file->documents[0]->type == 3)
        <div id='jstree_demo_div'>{!! $output !!}</div>
    @else
        <tr>
            <th style="width: 150px" scope="row">{!! Form::label('content', __('messages.sentence_content')) !!}</th>
            <td><p>{{ $sentence->content }}</p></td>
        </tr>
    @endif

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('post_id', __('messages.sentence_file')) !!}</th>
        <td><p>{!! $sentence->file->name !!}</p></td>
    </tr>


    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('created_at', __('messages.created_at')) !!}</th>
        <td><p>{!! $sentence->created_at !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('updated_at', __('messages.updated_at')) !!}</th>
        <td><p>{!! $sentence->updated_at !!}</p></td>
    </tr>

    </tbody>
</table>
