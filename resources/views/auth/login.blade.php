<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lana Jati - Login Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #36b9cc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: #333;
            font-weight: bold;
        }

        .login-container .form-control {
            border-radius: 50px;
            padding: 20px;
            font-size: 16px;
        }

        .login-container .btn {
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .login-container .form-check-label {
            font-size: 14px;
        }

        .login-container .forgot-password {
            font-size: 14px;
        }

        .login-container .btn-primary {
            background-color: #4d909b;
            border: none;
        }

        .login-container .btn-primary:hover {
            background-color: #35b8cc;
        }

        .login-container .text-center a {
            color: #258998;
        }

        .login-container .text-center a:hover {
            color: #35b8cc;
        }
    </style>
</head>

<body>

    <div class="login-container">
<h2 class="text-center" style="font-family: 'Poppins-Medium', sans-serif; font-size: 20px; color: #1c3438;">LANA JATI FURNITUR</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Masukan Email..." required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Masukan Password..." required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Ingat Saya?</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="font-family: 'Poppins-Medium', sans-serif; font-size: 16px;">Login</button>
        </form>
        <div class="text-center mt-3">
            @if (Route::has('password.request'))
            <a class="forgot-password" href="{{ route('password.request') }}">Lupa Password?</a>
            @endif
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
