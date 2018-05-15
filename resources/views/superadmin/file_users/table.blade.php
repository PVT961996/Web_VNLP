<table class="table table-bordered" id="fileUsers-table">
    <thead>
    <th width="40px">@lang('messages.no')</th>
    <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
    <th>@lang('messages.users')</th>
    <th>@lang('messages.file_name')</th>
    <th>@lang('messages.file_users_phone')</th>
    <th>@lang('messages.file_users_email')</th>
    <th>@lang('messages.file_users_description')</th>
    <th>@lang('messages.file_users_status')</th>
    <th>@lang('messages.actions')</th>
    </thead>
    <tbody>
    @if (count($fileUsers) == 0)
        <tr class="text-center">
            <td colspan="9">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($fileUsers as $key=>$fileUser)
            <tr>
                <td width="40px">{!! Helper::number_order($fileUsers->currentPage(), $fileUsers->perPage(), $key) !!}</td>
                <td width="40px"><input type="checkbox" name="ids[]" value="{{ $fileUser->id }}" class="minimal checkSingle"
                                        form="items"/></td>
                <td>{{$fileUser->user->name}}</td>
                <td>{{$fileUser->file->name}}</td>
                <td>{{$fileUser->phone}}</td>
                <td>{{$fileUser->email}}</td>
                <td>{!! str_limit($fileUser->description, $limit = 150, $end = '...') !!}</td>
                <td>{!! Helper::convertStatus($fileUser->status) !!}</td>
                <td style="min-width: 110px">
                    {!! Form::open(['route' => ['superadmin.fileUsers.destroy', $fileUser->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.fileUsers.show', [$fileUser->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.fileUsers.edit', [$fileUser->id]) !!}" class='btn btn-default btn-xs'><i
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