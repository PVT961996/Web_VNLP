<table class="table table-bordered" id="users-table">
    <thead>
    <th width="40px">@lang('messages.no')</th>
    <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
    <th>@lang('messages.user_name')</th>
    <th>@lang('messages.user_avatar')</th>
    <th>@lang('messages.user_email')</th>
    <th>@lang('messages.user_group')</th>
    <th>@lang('messages.user_actived')</th>
    <th>@lang('messages.actions')</th>
    </thead>
    <tbody>
    @if (count($users) == 0)
        <tr class="text-center">
            <td colspan="9">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($users as $key=>$user)
            <tr>
                <td width="40px">{!! Helper::number_order($users->currentPage(), $users->perPage(), $key) !!}</td>
                <td width="40px">@if($user->group_id != 1)
                        <input type="checkbox" name="ids[]" value="{{ $user->id }}" class="minimal checkSingle"
                               form="items"/></td>
                @endif
                <td>{{$user->name}}</td>
                <td>
                    @if(!empty($user->avatar) && (file_exists(public_path($user->avatar)) || (filter_var($user->avatar, FILTER_VALIDATE_URL) && getimagesize($user->avatar))))
                        <img src="{!! $user->avatar !!}" alt="{!! $user->name !!}" width="100px" height="100px">
                    @else
                        <img src="/uploads/default-avatar.png" alt="{!! $user->name !!}" width="100px" height="100px">
                    @endif
                </td>
                <td>{{$user->email}}</td>
                <td>{{Helper::convertGroupUser($user->group_id)}}</td>
                <td>{{Helper::convertActived($user->confirmed)}}</td>
                <td style="min-width: 110px">
                    {!! Form::open(['route' => ['superadmin.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        @if($user->group_id != 1)
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.delete_confirm')."')"]) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<input type="hidden" id="user_id">