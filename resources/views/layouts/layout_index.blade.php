<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
    <style>
        .navbar {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            background-color: rgba(33, 37, 41, 0.85) !important;
            transition: background-color 0.3s ease;
        }

        .navbar .nav-link {
            font-weight: 500;
            transition: color 0.25s ease, transform 0.25s ease;
            position: relative;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: #f8c146 !important;
            transform: scale(1.1);
        }

        .navbar .nav-link .bi {
            margin-right: 6px;
            vertical-align: -0.1em;
            font-size: 1.1rem;
        }

        /* Logout button styling */
        .nav-link.logout {
            color: #ff6b6b !important;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .nav-link.logout:hover {
            color: #ff3b3b !important;
            text-decoration: underline;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/f04da0ed90.js" crossorigin="anonymous"></script>

    @if($checkAuth ?? true)
        <script src="{{ asset('js/CheckAuth/checkAuth.js') }}"></script>
    @endif
</head>
<body class="d-none">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fs-3 fw-bold" href="{{route("dashboard")}}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('create-website') ? 'active' : '' }}"
                       href="{{ route('create-website') }}">
                        <i class="bi bi-plus-circle"></i> Create Website
                    </a>
                </li>
                @if(request()->routeIs('show-website.dashboard') && isset($id))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('create-post.dashboard') ? 'active' : '' }}"
                           href="{{ route('create-post.dashboard', ['id' => $id]) }}">
                            <i class="bi bi-plus-circle"></i> Create Post
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <button id="btnLogout" type="submit" class="btn btn-link nav-link">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    @yield('content')
</div>
</body>
</html>
@yield('script_index')


