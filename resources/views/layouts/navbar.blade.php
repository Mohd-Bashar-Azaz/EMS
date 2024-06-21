<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 ">
        <div class="container">
            <a class="navbar-brand " href="#" style="color: #0318ff; font-weight: bold;">E`M`S</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url('/home') }}"><<|Home|>></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url('roles') }}"><<|Roles & Permissions|>></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url('/employees') }}"><<|Employee List|>></a>
                    </li>
                </ul>
                <!-- Login icon (you can customize this) -->
                <ul>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ url('/register') }}">Register</a>
                        </li>
                    @else
                        <div class="dropdown ms-auto">
                            <button class="btn btn-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown" >
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
