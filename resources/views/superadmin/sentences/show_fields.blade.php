<table class="table table-bordered">
    <tbody>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('short_description', __('messages.sentence_content')) !!}</th>
        <td><p>{{ $sentence->content }}</p></td>
    </tr>

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
