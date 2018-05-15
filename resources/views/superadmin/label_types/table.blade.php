<table class="table table-bordered" id="labelTypes-table">
    <thead>
    <th width="40px">@lang('messages.no')</th>
    <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
    <th>@lang('messages.label_type_name')</th>
    <th>@lang('messages.label_type_description')</th>
    <th>@lang('messages.label_type_type')</th>
    <th>@lang('messages.actions')</th>
    </thead>
    <tbody>
    @if (count($labelTypes) == 0)
        <tr class="text-center">
            <td colspan="9">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($labelTypes as $key=>$labelType)
            <tr>
                <td width="40px">{!! Helper::number_order($labelTypes->currentPage(), $labelTypes->perPage(), $key) !!}</td>
                <td width="40px"><input type="checkbox" name="ids[]" value="{{ $labelType->id }}" class="minimal checkSingle"
                                        form="items"/></td>
                <td><a href="{!! route('superadmin.labelTypes.show',[$labelType->id]) !!}">{{$labelType->name}}</a></td>
                <td>{!! str_limit($labelType->description, $limit = 150, $end = '...') !!}</td>
                <td>{!! Helper::convertType($labelType->type) !!}</td>
                <td style="min-width: 110px">
                    {!! Form::open(['route' => ['superadmin.labelTypes.destroy', $labelType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.labelTypes.show', [$labelType->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.labelTypes.edit', [$labelType->id]) !!}" class='btn btn-default btn-xs'><i
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