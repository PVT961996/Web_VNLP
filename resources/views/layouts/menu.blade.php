<li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>@lang('messages.dashboard')</span>
    </a>
</li>

@if (Auth::user()->group_id == 1)
    @include('layouts.menu_admin')
@endif

<li class="treeview {{ (Request::is('*categoryDocs*')) ? 'active' : '' }}">
    <a href="{!! route('superadmin.categoryDocs.index') !!}">
        <i class="fa fa-list-ul"></i> <span>@lang('messages.category_doc_management')</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('*categoryDocs/index*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.categoryDocs.index') !!}"><i class="fa fa-list"></i><span>@lang('messages.category_docs')</span></a>
        </li>
        <li class="{{ Request::is('*categoryDocs/create*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.categoryDocs.create') !!}"><i class="fa fa-plus"></i><span>@lang('messages.create')</span></a>
        </li>
    </ul>
</li>

{{--<li class="{{ Request::is('documentCategories*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('superadmin.documentCategories.index') !!}"><i class="fa fa-edit"></i><span>Document Categories</span></a>--}}
{{--</li>--}}


<li class="treeview {{ (Request::is('*documents*')) ? 'active' : '' }}">
    <a href="{!! route('superadmin.documents.index') !!}">
        <i class="fa fa-file"></i> <span>@lang('messages.document_management')</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('*documents/index*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.documents.index') !!}"><i class="fa fa-list"></i><span>@lang('messages.document_list')</span></a>
        </li>
        <li class="{{ Request::is('*documents/create*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.documents.create') !!}"><i class="fa fa-plus"></i><span>@lang('messages.create')</span></a>
        </li>
    </ul>
</li>

<li class="treeview {{ (Request::is('*offerPosts*')) ? 'active' : '' }}">
    <a href="{!! route('superadmin.offerPosts.index') !!}">
        <i class="fa fa-book"></i> <span>@lang('messages.offer_post_management')</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('*offerPosts/index*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.offerPosts.index') !!}"><i class="fa fa-list"></i><span>@lang('messages.offer_post_list')</span></a>
        </li>
        <li class="{{ Request::is('*offerPosts/create*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.offerPosts.create') !!}"><i class="fa fa-plus"></i><span>@lang('messages.create')</span></a>
        </li>
    </ul>
</li>

<li class="treeview {{ (Request::is('*files*')) ? 'active' : '' }}">
    <a href="{!! route('superadmin.files.index') !!}">
        <i class="fa fa-file-text-o"></i> <span>@lang('messages.file_management')</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('*files/index*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.files.index') !!}"><i class="fa fa-list"></i><span>@lang('messages.file_list')</span></a>
        </li>
        <li class="{{ Request::is('*files/create*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.files.create') !!}"><i class="fa fa-plus"></i><span>@lang('messages.create')</span></a>
        </li>
    </ul>
</li>

<li class="treeview {{ (Request::is('*sentences*')) ? 'active' : '' }}">
    <a href="{!! route('superadmin.sentences.index') !!}">
        <i class="fa fa-commenting-o"></i> <span>@lang('messages.sentence_management')</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('*sentences/index*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.sentences.index') !!}"><i class="fa fa-list"></i><span>@lang('messages.sentence_list')</span></a>
        </li>
        <li class="{{ Request::is('*sentences/create*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.sentences.create') !!}"><i class="fa fa-plus"></i><span>@lang('messages.create')</span></a>
        </li>
    </ul>
</li>
{{--<li class="{{ Request::is('documentFiles*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('superadmin.documentFiles.index') !!}"><i class="fa fa-edit"></i><span>Document Files</span></a>--}}
{{--</li>--}}

