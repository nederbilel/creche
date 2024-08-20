<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="neder" />
        <title>PTIBOO</title>
        <link rel="icon" type="image/x-icon" href="/img/logo.png" />
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0/css/bootstrap.min.css" rel="stylesheet"> --}}

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="/css/styles.css" rel="stylesheet" />
        <link href="/css/bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
<!-- Add this in the <head> section of your layout -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add this before the closing </body> tag of your layout -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
        {{-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> --}}
      <style>
        /* Apply the Roboto font to the body */
/* Apply the Open Sans font to the body */
body {
    font-family: 'Open Sans', sans-serif;
}

/* You can also apply the font to specific elements */
h1, h2, h3 {
    font-family: 'Open Sans', sans-serif;
}


      </style>
      <style>
        .custom-input {
        border: none;
        border-radius: 10px;
        background-color: #f0f0f0;
        padding: 10px;
        margin-bottom: 15px;
    }
    
    .custom-button {
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: bold;
        color: white;
        background-color: #368062;
        transition: background-color 0.3s ease;
    }
    
    .custom-button:hover {
        background-color: #2c6f4a;
    }
    
    </style>
    </head>
    <body class="sb-nav-fixed">
      
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #0077ef;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/home">
                <img src="/img/logo.png" alt="Logo" class="me-2" style="width: 100px;height:100px;margin-top:20px"> <!-- Replace path_to_your_image with the actual path to your image -->
                
            </a>            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                {{-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> --}}
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i> <!-- SVG icon -->
                        @auth
                            {{ Auth::user()->name }} <!-- User's name -->
                        @endauth
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Add Member</a></li>
                        <li><a class="dropdown-item" href="/parents/create">Ajouter Parent</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            
            
        </nav>


   

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #0077ef">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/home">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                                    <path d="M13.573 2.427a1 1 0 0 1 1.414 1.414l-1.05 1.05a8 8 0 1 1-1.414-1.414l1.05-1.05zM8 4a6 6 0 1 0 0 12A6 6 0 0 0 8 4zM8 5a5 5 0 1 1 0 10A5 5 0 0 1 8 5zm2.354 1.646a.5.5 0 1 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L6 9.793l3.646-3.647z"/>
                                    <path d="M7 3h2v5H7V3z"/>
                                </svg>
                                <span class="ms-2">Tableau de bord</span>
                            </a>
                            
                            
                           
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="py-4">
                    @yield('content')
                </main>
        
                {{-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2024</div>
                         
                        </div>
                    </div>
                </footer> --}}
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        {{-- <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        {{-- <script src="public/js/datatables-simple-demo.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

{{-- <script src="./assets/demo/chart-area-demo.js"></script> --}}
{{-- <script src="./assets/demo/chart-bar-demo.js"></script>
<script src="./assets/demo/chart-pie-demo.js"></script> --}}

    </body>
</html>