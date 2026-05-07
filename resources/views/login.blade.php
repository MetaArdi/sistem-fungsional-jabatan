<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Sistem - BKPSDM Kudus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/logobkpsdm.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            max-width: 860px;
            width: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }

        .left-panel {
            flex: 1;
            background: #2c5f8a;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .logo-img {
            max-width: 160px;
            width: 100%;
            height: auto;
            margin-bottom: 25px;
        }

        .brand-name {
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-top: 15px;
            margin-bottom: 6px;
        }

        .brand-sub {
            color: rgba(255,255,255,0.85);
            font-size: 11px;
            font-weight: 500;
        }

        .motto {
            margin-top: 30px;
            font-size: 10px;
            color: rgba(255,255,255,0.6);
            letter-spacing: 1px;
        }

        .right-panel {
            flex: 1;
            padding: 40px 35px;
            background: white;
        }

        .greeting {
            margin-bottom: 25px;
        }

        .greeting h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 6px;
        }

        .greeting p {
            font-size: 13px;
            color: #6c7a8e;
        }

        .alert-error {
            background: #fee2e2;
            border-left: 4px solid #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            align-items: center;
            gap: 10px;
        }

        .alert-error.show {
            display: flex;
        }

        .alert-error i {
            color: #dc2626;
            font-size: 16px;
        }

        .alert-error span {
            color: #991b1b;
            font-size: 12px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1e2a3e;
            margin-bottom: 6px;
        }

        .label-required::after {
            content: '*';
            color: #dc2626;
            margin-left: 4px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            background: #ffffff;
            transition: all 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #2c5f8a;
            box-shadow: 0 0 0 3px rgba(44,95,138,0.1);
        }

        input::placeholder {
            color: #b0b8c8;
        }

        input.error {
            border-color: #dc2626;
            background: #fef2f2;
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-webkit-clear-button,
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none;
        }

        .password-field {
            position: relative;
        }

        .password-field input {
            width: 100%;
            padding-right: 45px;
        }

        .password-field i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9aa4b8;
            font-size: 18px;
            z-index: 2;
            background: #ffffff;
        }

        .password-field i:hover {
            color: #2c5f8a;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #2c5f8a;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: #234d6f;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #6c7a8e;
        }

        .register-link a {
            color: #2c5f8a;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 700px) {
            .login-container {
                flex-direction: column;
                max-width: 380px;
            }
            .left-panel {
                padding: 30px 20px;
            }
            .right-panel {
                padding: 30px 25px;
            }
            .logo-img {
                max-width: 100px;
            }
            .greeting h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-panel">
            <img src="{{ asset('images/logobkpsdm.jpg') }}" alt="Logo BKPSDM" class="logo-img">
            <div class="brand-name">SISTEM JABATAN FUNGSIONAL</div>
            <div class="brand-sub">BKPSDM KABUPATEN KUDUS</div>
            <div class="motto">KUDUS NAGRI CARTA BHAKTI</div>
        </div>

        <div class="right-panel">
            <div class="greeting">
                <h1>Masuk ke Sistem</h1>
                <p>Silakan masukkan kredensial Anda</p>
            </div>

            @if(session('success'))
                <div class="alert-success show">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @elseif($errors->any())
                <div class="alert-error show">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @elseif(session('error'))
                <div class="alert-error show">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @else
                <div class="alert-error" id="alertError">
                    <i class="fas fa-exclamation-circle"></i>
                    <span id="errorMessage">Username atau password salah</span>
                </div>
            @endif

            <form id="loginForm" method="POST" action="/login">
                @csrf
                <div class="form-group">
                    <label class="label-required">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="label-required">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="Masukkan password">
                        <i class="far fa-eye" id="togglePassword"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login">MASUK KE SISTEM</button>
            </form>

            <!--
            <div class="register-link">
               Belum memiliki akun? <a href="/register">Daftar</a>
            </div>-->
        </div>
    </div>

    <script>
        // Toggle password
        const togglePass = document.getElementById('togglePassword');
        const passField = document.getElementById('password');

        togglePass.addEventListener('click', function() {
            if (passField.type === 'password') {
                passField.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                passField.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });

        // Form login
        const form = document.getElementById('loginForm');
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const alertBox = document.getElementById('alertError');
        const errorMsg = document.getElementById('errorMessage');

        form.addEventListener('submit', function(e) {
            const user = username.value.trim();
            const passw = password.value;

            // Reset error state
            alertBox.classList.remove('show');
            username.classList.remove('error');
            password.classList.remove('error');

            // Validasi input kosong
            if (user === '') {
                e.preventDefault();
                errorMsg.innerText = 'Username harus diisi';
                alertBox.classList.add('show');
                username.classList.add('error');
                return;
            }

            if (passw === '') {
                e.preventDefault();
                errorMsg.innerText = 'Password harus diisi';
                alertBox.classList.add('show');
                password.classList.add('error');
                return;
            }

            // Lanjutkan submit ke server
        });
    </script>
</body>
</html>