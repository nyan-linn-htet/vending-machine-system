@role('User')
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="{{ url("/") }}">
                    <i class="bi bi-basket"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('transactions*') ? '' : 'collapsed' }}" href="{{ route('transactions.index') }}">
                    <i class="bi bi-coin"></i>
                    <span>Transactions</span>
                </a>
            </li>
        </ul>
    </aside>
@else
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin') ? '' : 'collapsed' }}" href="{{ route('admin.') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('product_management')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/products') ? '' : 'collapsed' }}" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-basket"></i>
                        <span>Products</span>
                    </a>
                </li>
            @endcan
            @can('transaction_access')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/transactions') ? '' : 'collapsed' }}" href="{{ route('admin.transactions.index') }}">
                        <i class="bi bi-coin"></i>
                        <span>Transactions</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link collapsed " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-users"></i><span>{{ trans('cruds.user_management.title') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav"
                    class="nav-content collapse {{ request()->is('admin/users*') || request()->is('admin/roles*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('user_management')
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>{{ trans('cruds.user.title') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('role_management')
                        <li>
                            <a href="{{ route('admin.roles.index') }}" class="{{ request()->is('admin/roles*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>{{ trans('cruds.role.title') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </aside>
@endrole
