<table class="table table-bordered" id="documents-table">
    <thead>
    <th width="40px">@lang('messages.no')</th>
    <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
    <th>@lang('messages.document_name')</th>
    {{--<th>@lang('messages.document_description')</th>--}}
    <th>@lang('messages.document_short_description')</th>
    <th>@lang('messages.document_file')</th>
    <th>@lang('messages.document_source')</th>
    <th>@lang('messages.document_category')</th>
    <th>@lang('messages.document_user')</th>
    <th>@lang('messages.actions')</th>
    </thead>
    <tbody>
    @if (count($documents) == 0)
        <tr class="text-center">
            <td colspan="9">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($documents as $key=>$document)
            <tr>
                <td width="40px">{!! Helper::number_order($documents->currentPage(), $documents->perPage(), $key) !!}</td>
                <td width="40px"><input type="checkbox" name="ids[]" value="{{ $document->id }}" class="minimal checkSingle"
                               form="items"/></td>
                <td><a href="{!! route('superadmin.files.index') !!}?search[document_id]={{ $document->id }}">{{$document->name}}</a></td>
                {{--<td>{{str_limit($document->description, $limit = 150, $end = '...')}}</td>--}}
                <td>{{str_limit($document->short_description, $limit = 150, $end = '...')}}</td>
                <td>{{$document->file}}</td>
                <td>{{$document->source}}</td>
                <td>{!! Helper::formatCategories($document->categories,"<br>") !!}</td>
                <td>{!! $document->user->name !!}</td>
                <td style="min-width: 110px">
                    {!! Form::open(['route' => ['superadmin.documents.destroy', $document->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.documents.show', [$document->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.documents.edit', [$document->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.delete_confirm')."')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<input type="hidden" id="user_id">