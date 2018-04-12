<table class="table table-responsive" id="documentFiles-table">
    <thead>
        <tr>
            <th>File Id</th>
        <th>Document Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($documentFiles as $documentFile)
        <tr>
            <td>{!! $documentFile->file_id !!}</td>
            <td>{!! $documentFile->document_id !!}</td>
            <td>
                {!! Form::open(['route' => ['superadmin.documentFiles.destroy', $documentFile->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('superadmin.documentFiles.show', [$documentFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('superadmin.documentFiles.edit', [$documentFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>