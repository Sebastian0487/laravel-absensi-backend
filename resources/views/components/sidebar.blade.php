
<div class="main-sidebar sidebar-style-2">
    @push('style')
    <style>
        .main-sidebar {
            width: 200px; /* Lebar sidebar */
            transition: all 0.3s ease;
        }

        .main-sidebar.sidebar-style-2 {
            background-color: #343a40;
            color: #fff;
        }

        .sidebar-menu .nav-item a {
            font-size: 14px;
            padding: 10px 15px;
        }

        .sidebar-menu .nav-item .nav-link span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-brand {
            font-size: 18px;
            padding: 15px;
        }
    </style>
@endpush
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">SEBASTIAN GUNAWAN</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">

            <!-- Dashboard -->
            <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Users -->
            <li class="nav-item {{ Request::routeIs('users.index') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>

            <!-- Company -->
            <li class="nav-item {{ Request::routeIs('companies.show') ? 'active' : '' }}">
                <a href="{{ route('companies.show', 1) }}" class="nav-link">
                    <i class="fas fa-building"></i>
                    <span>Company</span>
                </a>
            </li>

            <!-- Attendances -->
            <li class="nav-item {{ Request::routeIs('attendances.index') ? 'active' : '' }}">
                <a href="{{ route('attendances.index') }}" class="nav-link">
                    <i class="fas fa-calendar-check"></i>
                    <span>Attendances</span>
                </a>
            </li>

            <!-- Permissions -->
            <li class="nav-item {{ Request::routeIs('permissions.index') ? 'active' : '' }}">
                <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="fas fa-file-signature"></i>
                    <span>Permissions</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
