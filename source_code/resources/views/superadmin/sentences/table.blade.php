<table class="table table-responsive" id="sentences-table">
    <thead>
    <tr>
        <th width="40px">@lang('messages.no')</th>
        <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
        <th>@lang('messages.sentence_content')</th>
        <th>@lang('messages.sentence_file')</th>
        <th colspan="3">@lang('messages.actions')</th>
    </tr>
    </thead>
    <tbody>
    @if (count($sentences) == 0)
        <tr class="text-center">
            <td colspan="9">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($sentences as $key=>$sentence)
            <tr>
                <td width="40px">{!! Helper::number_order($sentences->currentPage(), $sentences->perPage(), $key) !!}</td>
                <td width="40px"><input type="checkbox" name="ids[]" value="{{ $sentence->id }}"
                                        class="minimal checkSingle"
                                        form="items"/></td>
                <td>{{ str_limit($sentence->content, $limit = 100, $end = '...') }}</td>
                <td>{!! $sentence->file->name !!}</td>
                <td>
                    {!! Form::open(['route' => ['superadmin.sentences.destroy', $sentence->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.sentences.show', [$sentence->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.sentences.edit', [$sentence->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        @if($sentence->file->documents[0]->type == 1)
                            <a href="{!! route('superadmin.sentences.edit_high', [$sentence->id]) !!}"
                               class='btn btn-default btn-xs'><i class="fa fa-pencil"></i></a>
                        @endif
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>