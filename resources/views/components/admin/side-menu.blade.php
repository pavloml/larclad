<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column vertical-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'admin' ? 'active' : '' }}"
                           href="{{ route('admin') }}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'admin.users' ? 'active' : '' }}" href="{{ route('admin.users') }}">
                            <i class="fas fa-users"></i>Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'admin.complains' ? 'active' : '' }}"
                           href="{{ route('admin.complains') }}">
                            <i class="fas fa-exclamation-triangle"></i>Complains
                            <span class="badge text-white bg-primary unreviewed-complains-badge"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'admin.bans' ? 'active' : '' }}"
                           href="{{ route('admin.bans') }} ">
                            <i class="fas fa-user-slash"></i>Bans
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'admin.cities' ? 'active' : '' }}"
                           href="{{ route('admin.cities') }}">
                            <i class="fas fa-globe-americas"></i>Cities
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'admin.categories' ? 'active' : '' }}"
                           href="{{ route('admin.categories') }}">
                            <i class="fas fa-table"></i>Categories
                        </a>
                    </li>
                </ul>


{{--                <ul class="nav flex-column mt-3 mb-1">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ @route('home') }}">--}}
{{--                            <i class="fas fa-chevron-left"></i>--}}
{{--                            Back to the website--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </div>
        </nav>
    </div>
</div>
