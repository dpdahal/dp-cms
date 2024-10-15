@section('aside')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{route('dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->account_type->name=='admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-rp" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-lock-fill"></i><span>Role & Permission</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-rp" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        @can('roles_list')
                            <li>
                                <a href="{{route('roles.index')}}">
                                    <i class="bi bi-circle"></i><span>Manage Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('permissions_list')
                            <li>
                                <a href="{{route('manage-permission')}}">
                                    <i class="bi bi-circle"></i><span>Manage Permissions</span>
                                </a>
                            </li>
                        @endcan


                    </ul>
                </li>
            @endif

            @if(auth()->user()->account_type->name=='admin')

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-account" data-bs-toggle="collapse"
                       href="#">
                        <i class="bi bi-people-fill"></i><span>Admin</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-account" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{route('manage-account-type')}}">
                                <i class="bi bi-circle"></i><span> Account Types</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('manage-member-type')}}">
                                <i class="bi bi-circle"></i><span> Member Types</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.index')}}">
                                <i class="bi bi-circle"></i><span> Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('manage-team.index')}}">
                                <i class="bi bi-circle"></i><span> Our Teams</span>
                            </a>
                        </li>


                    </ul>
                </li>
            @endif


            @can('activity_log_list')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{route('manage-activity')}}">
                        <i class="bi bi-grid"></i>
                        <span>Activity Log</span>
                    </a>
                </li>
            @endcan


            @if(auth()->user()->account_type->name=='admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-address" data-bs-toggle="collapse"
                       href="#">
                        <i class="bi bi-globe"></i><span>Manage Address</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-address" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{route('continents.index')}}">
                                <i class="bi bi-circle"></i><span> Manage Continents</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('countries.index')}}">
                                <i class="bi bi-circle"></i><span> Manage Country</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-media" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-image"></i><span>Media</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-media" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('manage-media.index')}}">
                            <i class="bi bi-circle"></i><span>Library</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('manage-media.create')}}">
                            <i class="bi bi-circle"></i><span>Add New</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('manage-album')}}">
                            <i class="bi bi-circle"></i><span>Manage Album</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->

        </ul>

    </aside><!-- End Sidebar-->
@endsection
