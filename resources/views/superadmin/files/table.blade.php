<table class="table table-bordered" id="files-table">
    <thead>
    <th width="40px">@lang('messages.no')</th>
    <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
    <th>@lang('messages.file_summary')</th>
    <th>@lang('messages.file_content')</th>
    <th>@lang('messages.file_description')</th>
    <th>@lang('messages.file_document')</th>
    <th>@lang('messages.actions')</th>
    </thead>
    <tbody>
    @if (count($files) == 0)
        <tr class="text-center">
            <td colspan="9">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($files as $key=>$file)
            <tr>
                <td width="40px">{!! Helper::number_order($files->currentPage(), $files->perPage(), $key) !!}</td>
                <td width="40px"><input type="checkbox" name="ids[]" value="{{ $file->id }}" class="minimal checkSingle"
                                        form="items"/></td>
                <td>{{$file->summary}}</td>
                <td>{{str_limit($file->content, $limit = 150, $end = '...')}}</td>
                <td>{{str_limit($file->description, $limit = 150, $end = '...')}}</td>
                <td>{{$file->document->name}}</td>
                <td style="min-width: 110px">
                    {!! Form::open(['route' => ['superadmin.files.destroy', $file->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.files.show', [$file->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.files.edit', [$file->id]) !!}" class='btn btn-default btn-xs'><i
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