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

        @can('list-class')
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'classes.index' ? '' : 'collapsed' }}"
                href="{{ route('classes.index') }}">
                <i class="bi bi-building-fill"></i>
                <span>Class</span>
            </a>
        </li>
        @endcan

        @can('list-section')
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'sections.index' ? '' : 'collapsed' }}"
                href="{{ route('sections.index') }}">
                <i class="bi bi-layout-text-sidebar-reverse"></i>
                <span>Section</span>
            </a>
        </li>
        @endcan

        @can('list-subject')
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'subjects.index' ? '' : 'collapsed' }}"
                href="{{ route('subjects.index') }}">
                <i class="bi bi-book-fill"></i>
                <span>Subject</span>
            </a>
        </li>
        @endcan

        <!-- Students Nav -->
        @canany(['list-student', 'create-student'])
        <li class="nav-item">
            <a class="nav-link {{ Route::is('students.*') ? '' : 'collapsed' }}" data-bs-target="#students-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-people-fill"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="students-nav" class="nav-content collapse {{ Route::is('students.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                @can('create-student')
                <li>
                    <a href="{{ route('students.bulk-upload.form') }}"
                        class="{{ Route::currentRouteName() == 'students.bulk-upload.form' ? 'active nav-link' : '' }}">
                        <i class="bi bi-circle"></i><span>Bulk Upload Students</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('students.create') }}"
                        class="{{ Route::currentRouteName() == 'students.create' ? 'active nav-link' : '' }}">
                        <i class="bi bi-circle"></i><span>Add Student</span>
                    </a>
                </li>
                @endcan
                @can('list-student')
                <li>
                    <a href="{{ route('students.index') }}"
                        class="{{ Route::currentRouteName() == 'students.index' ? 'active nav-link' : '' }}">
                        <i class="bi bi-circle"></i><span>Students List</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
        <!-- End Students Nav -->

        <!--Teacher Nav -->
        @canany(['list-teacher', 'create-teacher'])
        <li class="nav-item">
            <a class="nav-link {{ Route::is('teachers.*') ? '' : 'collapsed' }}" data-bs-target="#teachers-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-people-fill"></i><span>Teachers</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="teachers-nav" class="nav-content collapse {{ Route::is('teachers.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                @can('create-teacher')
                <li>
                    <a href="{{ route('teachers.create') }}"
                        class="{{ Route::currentRouteName() == 'teachers.create' ? 'active nav-link' : '' }}">
                        <i class="bi bi-circle"></i><span>Add Teacher</span>
                    </a>
                </li>
                @endcan
                @can('list-teacher')
                <li>
                    <a href="{{ route('teachers.index') }}"
                        class="{{ Route::currentRouteName() == 'teachers.index' ? 'active nav-link' : '' }}">
                        <i class="bi bi-circle"></i><span>Teachers List</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany


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
        {{-- backend setting --}}

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