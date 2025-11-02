<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @can('dashboard')
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @endcan

       

        @can('update-setting')
        <li class="nav-heading text-secondary">User & Role Management ------------------------</li>
        @endcan

        @if(auth()->user()->type == 'dev')
        @can('list-role')
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'permissions.index' ? '' : 'collapsed' }}"
                href="{{ route('permissions.index') }}">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Permissions</span>
            </a>
        </li>
        @endcan
        @endif

        @can('list-role')
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'role.permissions' ? '' : 'collapsed' }}"
                href="{{ route('roles.index') }}">
                <i class="bi bi-person-lines-fill"></i>
                <span>Roles</span>
            </a>
        </li>
        @endcan

        <!-- Users Nav -->
        @canany(['list-user', 'create-user'])
        <li class="nav-item">
            <a class="nav-link {{ Route::is('users.*') ? '' : 'collapsed' }}" data-bs-target="#users-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-people-fill"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse {{ Route::is('users.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                @can('create-user')
                <li>
                    <a href="{{ route('users.create') }}"
                        class="{{ Route::currentRouteName() == 'users.create' ? 'active nav-link' : '' }}">
                        <i class="bi bi-circle"></i><span>Add User</span>
                    </a>
                </li>
                @endcan
                @can('list-user')
                <li>
                    <a href="{{ route('users.index') }}"
                        class="{{ Route::currentRouteName() == 'users.index' ? 'active nav-link' : '' }}">
                        <i class="bi bi-circle"></i><span>Users List</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
        <!-- End Users Nav -->


        @can('update-setting')
        <li class="nav-heading text-secondary">All Settings --------------------------------------</li>
        @endcan
        {{-- backend setting  --}}

        @can('update-setting')
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'settings.index' ? '' : 'collapsed' }}"
                href="{{ route('settings.index') }}">
                <i class="bi bi-gear-fill"></i>
                <span>Setting</span>
            </a>
        </li>
        @endcan
    </ul>

</aside><!-- End Sidebar-->