<table class="table table-bordered">
    <tbody>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('short_description', __('messages.offer_post_description')) !!}</th>
        <td><p>{!! $offerPost->short_description !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('post_id', __('messages.offer_post_post')) !!}</th>
        <td><p>{!! $offerPost->document->name !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('status', __('messages.status')) !!}</th>
        <td><p>{!! Helper::convertStatus($offerPost->status) !!}</p></td>
    </tr>


    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('created_at', __('messages.created_at')) !!}</th>
        <td><p>{!! $offerPost->created_at !!}</p></td>
    </tr>

    <tr>
        <th style="width: 150px" scope="row">{!! Form::label('updated_at', __('messages.updated_at')) !!}</th>
        <td><p>{!! $offerPost->updated_at !!}</p></td>
    </tr>

    </tbody>
</table>
