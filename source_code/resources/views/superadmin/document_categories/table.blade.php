<table class="table table-responsive" id="documentCategories-table">
    <thead>
        <tr>
            <th>Category Id</th>
        <th>Document Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($documentCategories as $documentCategory)
        <tr>
            <td>{!! $documentCategory->category_id !!}</td>
            <td>{!! $documentCategory->document_id !!}</td>
            <td>
                {!! Form::open(['route' => ['superadmin.documentCategories.destroy', $documentCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('superadmin.documentCategories.show', [$documentCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('superadmin.documentCategories.edit', [$documentCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>