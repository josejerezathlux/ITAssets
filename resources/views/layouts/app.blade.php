<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ session('dark_mode') ? 'dark' : 'light' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/corporate.css') }}" rel="stylesheet">
<<<<<<< HEAD
=======
    @stack('styles')
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
</head>
<body class="{{ session('dark_mode') ? 'dark-mode' : '' }}">
    <div class="app-wrap">
        @auth
        <aside class="app-sidebar" id="appSidebar">
            <a class="app-sidebar-brand" href="{{ route('dashboard') }}"><i class="bi bi-box-seam me-2"></i>{{ config('app.name') }}</a>
            <nav class="app-sidebar-nav">
                @if(auth()->user()->hasPermission('dashboard.view'))
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 nav-icon"></i>Dashboard</a>
                @endif
<<<<<<< HEAD
                @if(auth()->user()->can('viewAny', App\Models\Asset::class) || auth()->user()->can('viewAny', App\Models\AssetCategory::class))
                <div class="nav-dropdown {{ request()->routeIs('assets.*', 'categories.*') ? 'open' : '' }}">
                    <a class="nav-link nav-link-dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#navInventory" aria-expanded="{{ request()->routeIs('assets.*', 'categories.*') ? 'true' : 'false' }}"><i class="bi bi-box-seam nav-icon"></i>Inventory</a>
                    <div class="collapse {{ request()->routeIs('assets.*', 'categories.*') ? 'show' : '' }}" id="navInventory">
                        <div class="nav-dropdown-inner">
                            @can('viewAny', App\Models\Asset::class)
                                <a class="nav-link {{ request()->routeIs('assets.*') ? 'active' : '' }}" href="{{ route('assets.index') }}">Assets</a>
                            @endcan
                            @can('viewAny', App\Models\AssetCategory::class)
                                <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a>
=======
                @can('viewAny', App\Models\Asset::class)
                    <a class="nav-link {{ request()->routeIs('find-assets.*') ? 'active' : '' }}" href="{{ route('find-assets.index') }}"><i class="bi bi-search nav-icon"></i>Find Assets</a>
                @endcan
                @if(auth()->user()->can('viewAny', App\Models\Asset::class) || auth()->user()->can('viewAny', App\Models\AssetCategory::class) || auth()->user()->can('viewAny', App\Models\DigitalAsset::class))
                <div class="nav-dropdown open">
                    <a class="nav-link nav-link-dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#navInventory" aria-expanded="true"><i class="bi bi-box-seam nav-icon"></i>Inventory</a>
                    <div class="collapse show" id="navInventory">
                        <div class="nav-dropdown-inner">
                            @can('viewAny', App\Models\Asset::class)
                                <a class="nav-link {{ request()->routeIs('assets.*') ? 'active' : '' }}" href="{{ route('assets.index') }}"><i class="bi bi-laptop nav-icon"></i>Assets</a>
                            @endcan
                            @can('viewAny', App\Models\AssetCategory::class)
                                <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}"><i class="bi bi-tags nav-icon"></i>Categories</a>
                            @endcan
                            @can('viewAny', App\Models\DigitalAsset::class)
                                <a class="nav-link {{ request()->routeIs('digital-assets.*') ? 'active' : '' }}" href="{{ route('digital-assets.index') }}"><i class="bi bi-cloud-check nav-icon"></i>Digital assets</a>
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
                            @endcan
                        </div>
                    </div>
                </div>
                @endif
                @if(auth()->user()->can('viewAny', App\Models\Employee::class) || auth()->user()->can('viewAny', App\Models\Department::class))
<<<<<<< HEAD
                <div class="nav-dropdown {{ request()->routeIs('employees.*', 'departments.*') ? 'open' : '' }}">
                    <a class="nav-link nav-link-dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#navPeople" aria-expanded="{{ request()->routeIs('employees.*', 'departments.*') ? 'true' : 'false' }}"><i class="bi bi-people nav-icon"></i>People</a>
                    <div class="collapse {{ request()->routeIs('employees.*', 'departments.*') ? 'show' : '' }}" id="navPeople">
                        <div class="nav-dropdown-inner">
                            @can('viewAny', App\Models\Employee::class)
                                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">Employees</a>
                            @endcan
                            @can('viewAny', App\Models\Department::class)
                                <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}">Departments</a>
=======
                <div class="nav-dropdown open">
                    <a class="nav-link nav-link-dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#navPeople" aria-expanded="true"><i class="bi bi-people nav-icon"></i>People</a>
                    <div class="collapse show" id="navPeople">
                        <div class="nav-dropdown-inner">
                            @can('viewAny', App\Models\Employee::class)
                                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}"><i class="bi bi-person nav-icon"></i>Employees</a>
                            @endcan
                            @can('viewAny', App\Models\Department::class)
                                <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}"><i class="bi bi-building nav-icon"></i>Departments</a>
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
                            @endcan
                        </div>
                    </div>
                </div>
                @endif
                @can('viewAny', App\Models\Room::class)
                    <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}"><i class="bi bi-building nav-icon"></i>Rooms</a>
                @endcan
                @if(auth()->user()->hasPermission('reports.view'))
                    <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}"><i class="bi bi-graph-up nav-icon"></i>Reports</a>
                @endif
                @if(auth()->user()->can('viewAny', App\Models\User::class) || auth()->user()->can('viewAny', App\Models\Role::class))
<<<<<<< HEAD
                <div class="nav-dropdown {{ request()->routeIs('users.*', 'roles.*') ? 'open' : '' }}">
                    <a class="nav-link nav-link-dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#navSystem" aria-expanded="{{ request()->routeIs('users.*', 'roles.*') ? 'true' : 'false' }}"><i class="bi bi-gear nav-icon"></i>System</a>
                    <div class="collapse {{ request()->routeIs('users.*', 'roles.*') ? 'show' : '' }}" id="navSystem">
                        <div class="nav-dropdown-inner">
                            @can('viewAny', App\Models\User::class)
                                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">System Users</a>
                            @endcan
                            @can('viewAny', App\Models\Role::class)
                                <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles</a>
=======
                <div class="nav-dropdown open">
                    <a class="nav-link nav-link-dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#navSystem" aria-expanded="true"><i class="bi bi-gear nav-icon"></i>System</a>
                    <div class="collapse show" id="navSystem">
                        <div class="nav-dropdown-inner">
                            @can('viewAny', App\Models\User::class)
                                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}"><i class="bi bi-person-badge nav-icon"></i>System Users</a>
                            @endcan
                            @can('viewAny', App\Models\Role::class)
                                <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}"><i class="bi bi-shield-lock nav-icon"></i>Roles</a>
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
                            @endcan
                        </div>
                    </div>
                </div>
                @endif
            </nav>
            <div class="app-sidebar-footer">
                <div class="app-sidebar-user">
                    <i class="bi bi-person-circle app-sidebar-user-icon"></i>
                    <span class="app-sidebar-user-name">{{ auth()->user()->name }}</span>
                </div>
                <div class="app-sidebar-footer-actions">
                    <form method="POST" action="{{ route('toggle-dark-mode') }}" class="app-sidebar-footer-form app-sidebar-footer-form--icon">
                        @csrf
                        <button type="submit" class="app-sidebar-btn-icon" aria-label="{{ session('dark_mode') ? 'Switch to light mode' : 'Switch to dark mode' }}" title="{{ session('dark_mode') ? 'Light mode' : 'Dark mode' }}">
                            <i class="bi bi-{{ session('dark_mode') ? 'sun' : 'moon-stars' }}"></i>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" class="app-sidebar-footer-form app-sidebar-footer-form--icon">
                        @csrf
                        <button type="submit" class="app-sidebar-btn-icon" aria-label="Log out" title="Log out">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        <div class="app-sidebar-overlay" id="sidebarOverlay"></div>
        @endauth

        <div class="app-main">
            @auth
            <header class="app-topbar">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-link d-lg-none p-0 text-body" id="sidebarToggler" aria-label="Open menu"><i class="bi bi-list fs-4"></i></button>
                </div>
            </header>
            @endauth

            <main class="app-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    @stack('modals')

    @guest
    <div class="app-main">
        <main class="app-content container py-5">
            @yield('content')
        </main>
    </div>
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggler')?.addEventListener('click', function() {
            document.getElementById('appSidebar')?.classList.toggle('show');
            document.getElementById('sidebarOverlay')?.classList.toggle('show');
        });
        document.getElementById('sidebarOverlay')?.addEventListener('click', function() {
            document.getElementById('appSidebar')?.classList.remove('show');
            this.classList.remove('show');
        });
        (function() {
            var storageKey = 'fluent_dismissed_cards';
            function getDismissed() {
                try {
                    var raw = localStorage.getItem(storageKey);
                    return raw ? JSON.parse(raw) : {};
                } catch (e) { return {}; }
            }
            function setDismissed(key) {
                var o = getDismissed();
                o[key] = true;
                try { localStorage.setItem(storageKey, JSON.stringify(o)); } catch (e) {}
            }
            document.querySelectorAll('.fluent-dismissible[data-dismiss-key]').forEach(function(card) {
                var key = card.getAttribute('data-dismiss-key');
                if (getDismissed()[key]) { card.style.display = 'none'; return; }
                var btn = card.querySelector('.fluent-card-close');
                if (btn) btn.addEventListener('click', function() {
                    setDismissed(key);
                    card.style.display = 'none';
                });
            });
        })();
<<<<<<< HEAD
=======
        // Keep sidebar dropdown chevron in sync when user toggles collapse
        document.querySelectorAll('#appSidebar .collapse').forEach(function(el) {
            el.addEventListener('hidden.bs.collapse', function() {
                var dropdown = this.closest('.nav-dropdown');
                if (dropdown) dropdown.classList.remove('open');
            });
            el.addEventListener('shown.bs.collapse', function() {
                var dropdown = this.closest('.nav-dropdown');
                if (dropdown) dropdown.classList.add('open');
            });
        });
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
    </script>
    @stack('scripts')
</body>
</html>
