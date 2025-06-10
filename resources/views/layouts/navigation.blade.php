<!-- Navbar Start -->
<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ url('/') }}" class="navbar-brand">
                <h1 class="text-primary display-6">NesaFood</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                    <!-- <a href="{{ url('/stand') }}" class="nav-item nav-link {{ Request::is('stand') ? 'active' : '' }}">Stand</a> -->

                            <!-- Dropdown Stand Detail -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="standDetailDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    NesaFood Stand
                                </a>
                                <div class="dropdown-menu" aria-labelledby="standDetailDropdown" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($stands as $stand)
                                        <a class="dropdown-item" href="{{ route('stand.show', $stand->id) }}">{{ $stand->name }}</a>
                                    @endforeach
                                </div>
                            </div>

                    <a href="{{ url('/aboutus') }}" class="nav-item nav-link {{ Request::is('aboutus') ? 'active' : '' }}">About Us</a>
                </div>

                <div class="d-flex align-items-center m-3 me-0">
                    <!-- Search Button -->
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-3" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search text-primary"></i>
                    </button>

                    <!-- Cart Icon -->
                    <a href="{{ url('/cart') }}" class="position-relative me-3 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            
                        </span>
                    </a>

                    <!-- Auth Buttons -->
                    @guest
                        <a href="{{ url('auth/login') }}" class="btn btn-outline-primary me-2">Login</a>
                        <a href="{{ url('auth/register') }}" class="btn btn-primary">Register</a>
                    @else
                        @auth
                            <div class="user-dropdown position-relative" id="userDropdownWrapper">
                                <button class="btn btn-outline-primary" onclick="toggleUserDropdown()">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-list" id="userDropdownMenu">
                                    <li><a class="dropdown-item" href="{{ url('user/dashboard') }}">Dashboard</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/auth/logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ url('/auth/logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endauth
                    @endguest
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
