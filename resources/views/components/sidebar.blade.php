<div id="sidebar" class="col-md-3 col-lg-2 sidebar collapse d-md-flex px-0 flex-column vh-100">
    <!-- Brand -->
    <a class="sidebar-brand text-decoration-none px-3 py-4 fs-4 fw-bold border-bottom d-none d-md-block" href="#">
        Finwise
    </a>

    <!-- Mobile Brand + Close Button -->
    <div class="d-md-none d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
        <span class="fs-4 fw-bold">Finwise</span>
        <button class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- Menu -->
    <div id="sidebarMenu" class="collapse d-md-block h-100 flex-grow-1">
        <ul class="nav flex-column px-3 pt-3">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('transactions') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                    <i class="bi bi-currency-dollar me-3"></i> Transactions
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('categoris') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    <i class="bi bi-tags me-3"></i> Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('budgets') ? 'active' : '' }}" href="{{ route('budgets.index') }}">
                    <i class="bi bi-piggy-bank me-3"></i> Budgets
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                    <i class="bi bi-person me-3"></i> Profile
                </a>
            </li>
        </ul>
    </div>

    <!-- Logout (always at bottom) -->
    <div class="border-top mt-auto px-3 py-3">
        <a href="#" class="logout-link d-flex align-items-center text-danger fw-medium">
            <i class="bi bi-box-arrow-right me-3"></i> Logout
        </a>
    </div>

</div>
