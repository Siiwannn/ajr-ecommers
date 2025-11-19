<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Anugrah Jaya Retailindo</title>

    <style>
        body {
            background: white;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* CENTER WRAPPER */
        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            flex-direction: column;
            margin-top: 0;
        }

        /* LOGO + TITLE */
        .top-logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .top-logo img {
            height: 40px;
        }

        .company-title {
            font-weight: bold;
            font-size: 22px;
            margin-top: 5px;
        }

        /* LOGIN BOX BORDER */
        .login-box {
            width: 420px;
            border: 6px solid #000;
            border-radius: 5px;
            padding: 40px;
            text-align: center;
            margin-top: 15px;
        }

        .login-title {
            font-size: 22px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 25px;
        }

        /* LABEL */
        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-bottom: 6px;
        }

        /* INPUT STYLE MIRIP GAMBAR */
        .input-field {
            width: 100%;
            border: none;
            background: #eaeaea;
            padding: 14px;
            border-radius: 30px;
            margin-bottom: 18px;
            font-size: 15px;
        }

        /* BUTTON MIRIP GAMBAR */
        .btn-login {
            background: #4d4d4d;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-login:hover {
            opacity: 0.85;
        }
    </style>

</head>
<body>

    <div class="wrapper">

        <!-- LOGO DI ATAS -->
        <div class="top-logo">
            <img src="{{ asset('logo.png') }}" alt="Logo" onerror="this.src='https://via.placeholder.com/40x40'">
            <div class="company-title">PT. ANUGRAH JAYA RETAILINDO</div>
        </div>

        <!-- LOGIN BOX -->
        <div class="login-box">

            <div class="login-title">Log In</div>

            @if ($errors->any())
                <div style="color:red; margin-bottom:10px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>Email</label>
                <input type="email" name="email" class="input-field" required>

                <label>Password</label>
                <input type="password" name="password" class="input-field" required>

                <button type="submit" class="btn-login">Masuk</button>
            </form>

        </div>

    </div>

</body>
</html>