@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Label Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($labelType, ['route' => ['superadmin.labelTypes.update', $labelType->id], 'method' => 'patch']) !!}

                        @include('superadmin.label_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection