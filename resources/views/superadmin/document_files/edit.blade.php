@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Document File
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($documentFile, ['route' => ['superadmin.documentFiles.update', $documentFile->id], 'method' => 'patch']) !!}

                        @include('superadmin.document_files.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection