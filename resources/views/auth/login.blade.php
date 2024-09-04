<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - Créche PtiBoo</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="/img/logo-ETShipi2R-transformed.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/css/main.css" rel="stylesheet">
</head>

<body class="login-page">

  <!-- Navbar from the welcome blade -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        {{-- <h1 class="sitename">PtiBoo</h1><span>.</span> --}}
        {{-- <a href="/"><img src="/img/logo-ETShipi2R-transformed.png" alt="" style="width: 150px"></a> --}}
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/#hero" >Accueil</a></li>
          <li><a href="/#about">À Propos</a></li>
          <li><a href="/#services">Services</a></li>
          <li><a href="/#portfolio">Clubs</a></li>
          <li><a href="/#team">Équipe</a></li>
          <li><a href="/#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="/login">Login</a>

    </div>
  </header>

  <!-- Login form section -->
  <div class="container mt-5 pt-5">
    <div class="row">
      <!-- Left Side Blank -->

      <!-- Right Side Form -->
      <div class="col-lg-6 d-flex align-items-center justify-content-center right-side">
        <div class="form-2-wrapper">
          <div class="logo text-center">
            <img src="/img/logo-ETShipi2R-transformed.png" alt="Logo" class="me-2">
          </div>
          <h2 class="text-center mb-4">Connectez-vous à votre compte</h2>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3 form-box">
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Entrez votre mot de passe" required>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Souvenez-vous de moi</label>
              </div>
            </div>
            <button type="submit" class="btn btn-outline-secondary login-btn w-100 mb-3">{{ __('Login') }}</button>
          </form>
        </div>
      </div>
      <div class="col-lg-6"></div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="/js/main.js"></script>
</body>
<style>
  body{
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: url('/img/R.jpg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
  font-family: 'Roboto', sans-serif;
}

.form-2-wrapper {
  background: #F8E8EE;
  ;
  padding: 50px;
  border-radius: 8px;
  opacity: 0.9;
}
input.form-control{
  padding: 11px;
  border: none;
  border: 2px solid #f8f8f8b8;
  border-radius: 30px;
  background-color: transparent;
  font-family: Arial, Helvetica, sans-serif;
 
 
}
input.form-control:focus{
  box-shadow: none !important;
  outline: 0px !important;
  background-color: transparent;
}
button.login-btn{
  background: #be6f9c;
  color: #fff;
  border: none;
  padding: 10px;
  border-radius: 30px;
}
.register-test a{
  color: #a38f8f;
}
.header{
  background-color: #efbb9f
}
</style>
</html>
