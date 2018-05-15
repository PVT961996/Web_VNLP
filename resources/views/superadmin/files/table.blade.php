<table class="table table-bordered" id="files-table">
    <thead>
    <th width="40px">@lang('messages.no')</th>
    <th><input type="checkbox" name="checkedAll" id="checkedAll" class="minimal checkAll"/></th>
    <th>@lang('messages.file_name')</th>
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
                <td>
                    <a href="{!! route('superadmin.sentences.index') !!}?search[file_id]={{ $file->id }}">{{$file->name}}</a>
                </td>
                <td>{{str_limit($file->content, $limit = 150, $end = '...')}}</td>
                <td>{{str_limit($file->description, $limit = 150, $end = '...')}}</td>
                <td>{!! Helper::formatCategories($file->documents,"<br>") !!}</td>
                <td style="min-width: 110px">
                    {!! Form::open(['route' => ['superadmin.files.destroy', $file->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('superadmin.files.show', [$file->id]) !!}"
                           class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('superadmin.files.edit', [$file->id]) !!}"
                           class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".Lang::get('messages.delete_confirm')."')"]) !!}
                        @if ($file->documents[0]->type == 5)
                            <button id="{{ $file->id }}" type="button"
                                    class='btn btn-default btn-xs evaluatedCmt' data-toggle="modal"
                                    data-target="#myModal"><i class="glyphicon glyphicon-comment"></i></button>
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
            {!! Form::open(['route' => ['superadmin.files.evaluated'], 'method' => 'post']) !!}
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('messages.comments_modal_title')</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="evaluatedCmt" name="id" value="0">
                        {!! Form::select('evaluated',[''=>__('messages.selected'),2 => Helper::convertEvaluated(2), 1=>Helper::convertEvaluated(1), 0=>Helper::convertEvaluated(0)] ,null, ['class' => 'form-control']) !!}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="glyphicon glyphicon-remove"></i> @lang('messages.comments_modal_close')
                            </button>
                            <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-save"></i> @lang('messages.comments_modal_save')</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endif
    </tbody>
</table>