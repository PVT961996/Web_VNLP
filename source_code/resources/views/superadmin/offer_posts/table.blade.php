<table class="table table-responsive" id="offerPosts-table">
    <thead>
    <tr>
        <th width="40px">@lang('messages.no')</th>
        <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
        <th>@lang('messages.offer_post_content')</th>
        {{--<th>Mô tả</th>--}}
        {{--<th>Offer Counts</th>--}}
        {{--<th>View Counts</th>--}}
        {{--<th>File</th>--}}
        {{--<th>Link Download</th>--}}
        {{--<th>Source</th>--}}
        <th>@lang('messages.status')</th>
        <th>@lang('messages.offer_post_post')</th>
        <th colspan="3">@lang('messages.actions')</th>
    </tr>
    </thead>
    <tbody>
    @if (count($offerPosts) == 0)
        <tr class="text-center">
            <td colspan="9">@lang('messages.no-items')</td>
        </tr>
    @else
        @foreach($offerPosts as $key=>$offerPost)
            <tr>
                <td width="40px">{!! Helper::number_order($offerPosts->currentPage(), $offerPosts->perPage(), $key) !!}</td>
                <td width="40px"><input type="checkbox" name="ids[]" value="{{ $offerPost->id }}"
                                        class="minimal checkSingle"
                                        form="items"/></td>
                <td>{!! str_limit($offerPost->content, $limit = 150, $end = '...') !!}</td>
                {{--<td>{!! str_limit($offerPost->description, $limit = 150, $end = '...') !!}</td>--}}
                {{--<td>{!! $offerPost->offer_counts !!}</td>--}}
                {{--<td>{!! $offerPost->view_counts !!}</td>--}}
                {{--<td>{!! $offerPost->file !!}</td>--}}
                {{--<td>{!! $offerPost->link_download !!}</td>--}}
                {{--<td>{!! $offerPost->source !!}</td>--}}
                <td>{!! Helper::convertStatus($offerPost->status) !!}</td>
                <td>{!! $offerPost->file->name !!}</td>
                <td style="min-width: 110px;">
                    {!! Form::open(['route' => ['superadmin.offerPosts.destroy', $offerPost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.offerPosts.show', [$offerPost->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.offerPosts.edit', [$offerPost->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>