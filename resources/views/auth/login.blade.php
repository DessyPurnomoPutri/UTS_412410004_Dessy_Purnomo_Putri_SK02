
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | ASTRA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 20px;
            font-family: 'DM Sans', sans-serif;
            color: #443653;

            background:
    linear-gradient(
        120deg,
        rgba(111, 79, 145, .38),
        rgba(173, 143, 199, .32),
        rgba(111, 139, 184, .30)
    ),
    url('https://images.unsplash.com/photo-1462331940025-496dfbfc7564?w=2000&q=90')
    center center / cover no-repeat fixed;
        }

        .login-wrapper {
            width: 100%;
            max-width: 445px;
            padding: 42px 42px 32px;

            background: rgba(244, 237, 255, .88);
            border: 1px solid rgba(255, 255, 255, .75);
            border-radius: 22px;

            box-shadow:
                0 25px 70px rgba(10, 8, 35, .30),
                inset 0 1px 0 rgba(255, 255, 255, .8);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            animation: appear .7s ease;
        }

        @keyframes appear {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-symbol {
            width: 62px;
            height: 62px;
            display: grid;
            place-items: center;
            margin: 0 auto 12px;

            border: 1px solid rgba(105, 76, 142, .65);
            border-radius: 50%;

            color: #72538f;
            font-size: 34px;
        }

        .brand h1 {
            font-family: 'Playfair Display', serif;
            font-size: 37px;
            letter-spacing: 4px;
            color: #59416f;
        }

        .brand p {
            margin-top: 5px;
            color: #74618b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 25px 0;
            color: #8568a3;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: rgba(120, 90, 145, .35);
        }

        .login-heading {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-heading h2 {
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            color: #49365f;
            margin-bottom: 8px;
        }

        .login-heading p {
            color: #776b88;
            font-size: 12px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #59486f;
            font-size: 12px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper span {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #856ba2;
            font-size: 16px;
            pointer-events: none;
        }

        .form-group input {
            width: 100%;
            height: 49px;
            padding: 0 15px 0 43px;

            border: 1px solid #ded3eb;
            border-radius: 10px;
            outline: none;

            background: rgba(255, 255, 255, .78);
            color: #443653;

            font-family: inherit;
            font-size: 13px;

            transition: .2s ease;
        }

        .form-group input::placeholder {
            color: #a197ae;
        }

        .form-group input:focus {
            border-color: #9473b5;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(146, 117, 178, .13);
        }

        .password-input {
            padding-right: 45px !important;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #856ba2;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .error-message {
            margin-top: 7px;
            color: #b83f59;
            font-size: 11px;
        }

        .login-button {
            width: 100%;
            height: 49px;
            margin-top: 5px;

            border: none;
            border-radius: 30px;

            background: linear-gradient(100deg, #80619f, #9a79b8);
            color: white;

            font-family: inherit;
            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
            transition: .25s ease;
            box-shadow: 0 7px 18px rgba(112, 79, 145, .20);
        }

        .login-button:hover {
            background: linear-gradient(100deg, #6e508e, #8867a7);
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(112, 79, 145, .25);
        }

        .login-note {
            margin-top: 25px;
            padding-top: 19px;
            border-top: 1px solid rgba(120, 90, 145, .20);

            text-align: center;
            color: #81748f;
            font-size: 10px;
            line-height: 1.7;
        }

        @media (max-width: 480px) {
            .login-wrapper {
                padding: 35px 25px 27px;
            }

            .brand h1 {
                font-size: 32px;
            }

            .login-heading h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <!-- BRAND -->
        <div class="brand">
            <div class="brand-symbol">✦</div>

            <h1>ASTRA.</h1>

            <p>OBSERVATORIUM LANGIT GELAP</p>
        </div>

        <div class="divider">✦</div>

        <!-- LOGIN HEADING -->
        <div class="login-heading">
            <h2>Administrator Login</h2>

            <p>
                Masuk untuk mengakses dashboard
                pengelolaan data observatorium.
            </p>
        </div>

        <!-- LOGIN FORM -->
        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Administrator</label>

                <div class="input-wrapper">
                    <span>✉</span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email admin"
                        required
                        autofocus
                    >
                </div>

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <div class="input-wrapper">
                    <span>♙</span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="password-input"
                        placeholder="Masukkan password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                    >
                        LIHAT
                    </button>
                </div>

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-button">
                Masuk ke Dashboard
            </button>

        </form>

        <div class="login-note">
            © {{ date('Y') }} ASTRA. — Observatorium Langit Gelap
            <br>
            Halaman khusus administrator.
        </div>

    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';
            this.textContent = isPassword ? 'SEMBUNYIKAN' : 'LIHAT';
        });
    </script>

</body>
</html>
