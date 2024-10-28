<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
  
<div class="bg-pattern"></div> <!-- Background pattern -->

        <div class="l-form">
            <div class="form">

                <form method="POST" action="{{ route('login') }}" class="form__content">
                @csrf
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo"> <!-- Logo image -->

                    <h1 class="form__title">Connection</h1>

                    <div class="form__div form__div-one">
                        <div class="form__icon">
                            <i class='bx bx-user-circle'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="" class="form__label">Email</label>
                            <input type="text" class="form__input" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-lock' ></i>
                        </div>

                        <div class="form__div-input">
                            <label for="" class="form__label" >Mot de passe</label>
                            <input type="password" class="form__input"  id="password" name="password" required>
                        </div>
                    </div>
                    <a href="{{ route('password.request') }}" class="form__forgot">Mot de passe oublié?</a>

                    <input type="submit" class="form__button" value="Se connecter">


                </form>
            </div>

        </div>
        <script src="assets/js/main.js"></script>

</body>
</html>
