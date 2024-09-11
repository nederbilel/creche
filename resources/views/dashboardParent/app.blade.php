<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="neder" />
    <title>PTIBOO</title>
    <link rel="icon" type="image/x-icon" href="/img/logo-ETShipi2R-transformed.png" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .navbar {
            background-color: #3778b9;
            padding: 0.5rem 1rem;
        }
        .navbar-brand img {
            max-width: 100px; /* Adjust width to better fit the screen */
            height: auto;
        }
        .navbar-nav .nav-item {
            margin-left: 10px;
        }
        .custom-button {
            border: none;
            border-radius: 20px; /* Rounded corners */
            padding: 10px 20px;
            font-weight: bold;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .navbar-nav .nav-item {
                margin-left: 0;
                margin-right: 0;
            }
            .navbar-brand img {
                max-width: 80px; /* Adjust width for smaller screens */
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark">
        <!-- Navbar Brand -->
        <a class="navbar-brand" href="/home">
            <img src="/img/logo-ETShipi2R-transformed.png" alt="Logo">
        </a>
        <!-- Toggler/collapsibe Button for Mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link custom-button" href="/activiteparent">
                        Activité
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-button" href="/homeparent">
                        Paiement Mensuel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-button" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
