<li class="treeview {{ (Request::is('*users*')) ? 'active' : '' }}">
    <a href="{!! route('superadmin.users.index') !!}">
        <i class="fa fa-user"></i> <span>@lang('messages.user_management')</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('*users/index*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.users.index') !!}"><i class="fa fa-list"></i><span>@lang('messages.user_list')</span></a>
        </li>
        <li class="{{ Request::is('*users/create*') ? 'active' : '' }}">
            <a href="{!! route('superadmin.users.create') !!}"><i class="fa fa-plus"></i><span>@lang('messages.create')</span></a>
        </li>
    </ul>
</li>