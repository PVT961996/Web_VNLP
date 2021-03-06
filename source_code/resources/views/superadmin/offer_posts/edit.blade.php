@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-book"></i> @lang('messages.offer_post')</h1>
        {!! Breadcrumbs::render('superadmin.offerPosts.edit',$offerPost) !!}
    </section>
    <div class="content">
        @include('vendor.flash.errors')

        {!! Form::model($offerPost, ['route' => ['superadmin.offerPosts.update', $offerPost->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-edit"></i> @lang('messages.update')</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="label label-warning">@lang('messages.info')</span>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            @include('superadmin.offer_posts.fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection