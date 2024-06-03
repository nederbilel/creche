
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="container">
  <div class="row">
    <!-- Left Blank Side -->
    <div class="col-lg-6"></div>

    <!-- Right Side Form -->
    <div class="col-lg-6 d-flex align-items-center justify-content-center left-side">
      <div class="form-2-wrapper">
        <div class="logo text-center">
            <img src="/img/logo.png" alt="Logo" class="me-2" style=""> 

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
              @if (Route::has('password.request'))
                {{-- <a href="{{ route('password.request') }}" class="text-decoration-none float-end">Mot de passe oublié</a> --}}
              @endif
            </div>
          </div>
          <button type="submit" class="btn btn-outline-secondary login-btn w-100 mb-3">{{ __('Login') }}</button>
        </form>

        <!-- Register Link -->
        <p class="text-center register-test mt-3">Vous n’avez pas de compte ? <a href="{{ route('register') }}" class="text-decoration-none">Inscrivez-vous ici</a></p>
      </div>
    </div>
  </div>
</div>
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
    background: #a663d0b0;
    padding: 50px;
    border-radius: 8px;
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
    background: #9b26cd;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 30px;
}
.register-test a{
    color: #000;
}

</style>

