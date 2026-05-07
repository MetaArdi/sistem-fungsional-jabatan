<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - BKPSDM Kudus</title>
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

        .register-container {
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

        .title {
            margin-bottom: 25px;
        }

        .title h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 6px;
        }

        .title p {
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

        input, select {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            background: #ffffff;
            transition: all 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2c5f8a;
            box-shadow: 0 0 0 3px rgba(44,95,138,0.1);
        }

        input::placeholder {
            color: #b0b8c8;
        }

        input.error, select.error {
            border-color: #dc2626;
            background: #fef2f2;
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-webkit-clear-button,
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none;
        }

        .error-message {
            color: #dc2626;
            font-size: 11px;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
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

        .btn-register {
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

        .btn-register:hover {
            background: #234d6f;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #6c7a8e;
        }

        .login-link a {
            color: #2c5f8a;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Modal Notifikasi */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            max-width: 380px;
            width: 90%;
            text-align: center;
            padding: 30px 25px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-icon {
            width: 70px;
            height: 70px;
            background: #dcfce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .modal-icon i {
            font-size: 35px;
            color: #16a34a;
        }

        .modal-content h3 {
            font-size: 22px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 10px;
        }

        .modal-content p {
            font-size: 14px;
            color: #6c7a8e;
            margin-bottom: 25px;
        }

        .modal-btn {
            background: #2c5f8a;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background 0.2s;
        }

        .modal-btn:hover {
            background: #234d6f;
        }

        @media (max-width: 700px) {
            .register-container {
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
            .title h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="left-panel">
            <img src="{{ asset('images/logobkpsdm.jpg') }}" alt="Logo BKPSDM" class="logo-img">
            <div class="brand-name">SISTEM JABATAN FUNGSIONAL</div>
            <div class="brand-sub">BKPSDM KABUPATEN KUDUS</div>
            <div class="motto">KUDUS NAGRI CARTA BHAKTI</div>
        </div>

        <div class="right-panel">
            <div class="title">
                <h1>Registrasi</h1>
                <p>Silakan isi formulir di bawah ini</p>
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
                    <span id="errorMessage">Username sudah digunakan</span>
                </div>
            @endif

            <form id="registerForm" method="POST" action="/register">
                @csrf
                <div class="form-group">
                    <label class="label-required">Username</label>
                    <input type="text" id="regUsername" name="username" value="{{ old('username') }}" placeholder="Masukkan username">
                    <small class="error-message" id="usernameError">Username harus diisi</small>
                </div>

                <div class="form-group">
                    <label class="label-required">Password</label>
                    <div class="password-field">
                        <input type="password" id="regPassword" name="password" placeholder="Masukkan password">
                        <i class="far fa-eye" id="togglePassword"></i>
                    </div>
                    <small class="error-message" id="regPasswordError">Password harus diisi</small>
                </div>

                <div class="form-group">
                    <label class="label-required">Konfirmasi Password</label>
                    <div class="password-field">
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Ulangi password">
                        <i class="far fa-eye" id="toggleConfirm"></i>
                    </div>
                    <small class="error-message" id="confirmError">Konfirmasi password harus sama</small>
                </div>

                <!-- ========== TAMBAHAN: PILIHAN ROLE ========== -->
                <div class="form-group">
                    <label class="label-required">Role</label>
                    <select name="role" id="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin_sistem" {{ old('role') == 'admin_sistem' ? 'selected' : '' }}>Admin Sistem</option>
                        <option value="admin_opd" {{ old('role') == 'admin_opd' ? 'selected' : '' }}>Admin OPD</option>
                        <option value="verifikator" {{ old('role') == 'verifikator' ? 'selected' : '' }}>Verifikator</option>
                        <option value="admin_administrasi" {{ old('role') == 'admin_administrasi' ? 'selected' : '' }}>Admin Administrasi</option>
                    </select>
                    <small>Role menentukan hak akses Anda</small>
                </div>

                <!-- ========== TAMBAHAN: PILIHAN OPD (HANYA UNTUK ADMIN OPD) ========== -->
                <div class="form-group" id="opdSelect" style="display: none;">
                    <label class="label-required">OPD</label>
                    <select name="id_opd">
                        <option value="">Pilih OPD</option>
                        @foreach($opd as $item)
                            <option value="{{ $item->id_opd }}" {{ old('id_opd') == $item->id_opd ? 'selected' : '' }}>
                                {{ $item->nama_opd }}
                            </option>
                        @endforeach
                    </select>
                    <small>Wajib dipilih untuk role Admin OPD</small>
                </div>
                <!-- ========== END TAMBAHAN ========== -->

                <button type="submit" class="btn-register">DAFTAR</button>
            </form>

            <div class="login-link">
                Sudah memiliki akun? <a href="/">Masuk ke Sistem</a>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi Sukses -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>Registrasi Berhasil!</h3>
            <p>Akun Anda telah berhasil dibuat. Silakan login menggunakan username dan password yang telah Anda daftarkan.</p>
            <button class="modal-btn" id="closeModal">Login Sekarang</button>
        </div>
    </div>

    <script>
        // Toggle Password
        const togglePass = document.getElementById('togglePassword');
        const passField = document.getElementById('regPassword');

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

        // Toggle Confirm Password
        const toggleConfirm = document.getElementById('toggleConfirm');
        const confirmField = document.getElementById('confirmPassword');

        toggleConfirm.addEventListener('click', function() {
            if (confirmField.type === 'password') {
                confirmField.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                confirmField.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });

        // ========== TAMBAHAN: TAMPIL/SEMBUNYIKAN OPD ==========
        const roleSelect = document.getElementById('role');
        const opdSelect = document.getElementById('opdSelect');

        roleSelect.addEventListener('change', function() {
            if (this.value === 'admin_opd') {
                opdSelect.style.display = 'block';
            } else {
                opdSelect.style.display = 'none';
            }
        });

        // Trigger on page load jika ada old value
        if (roleSelect.value === 'admin_opd') {
            opdSelect.style.display = 'block';
        }
        // ========== END TAMBAHAN ==========

        // Form validation
        const form = document.getElementById('registerForm');
        const regUsername = document.getElementById('regUsername');
        const regPassword = document.getElementById('regPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const alertBox = document.getElementById('alertError');
        const usernameError = document.getElementById('usernameError');
        const regPasswordError = document.getElementById('regPasswordError');
        const confirmError = document.getElementById('confirmError');
        const successModal = document.getElementById('successModal');
        const closeModal = document.getElementById('closeModal');
        
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Reset
            usernameError.classList.remove('show');
            regPasswordError.classList.remove('show');
            confirmError.classList.remove('show');
            regUsername.classList.remove('error');
            regPassword.classList.remove('error');
            confirmPassword.classList.remove('error');
            alertBox.classList.remove('show');

            // Validasi username
            if (regUsername.value.trim() === '') {
                isValid = false;
                usernameError.classList.add('show');
                regUsername.classList.add('error');
            }

            // Validasi password
            if (regPassword.value === '') {
                isValid = false;
                regPasswordError.classList.add('show');
                regPassword.classList.add('error');
            }

            // Validasi konfirmasi password
            if (confirmPassword.value !== regPassword.value) {
                isValid = false;
                confirmError.classList.add('show');
                confirmPassword.classList.add('error');
            }

            // Validasi OPD jika role admin_opd
            const role = roleSelect.value;
            const opd = document.querySelector('select[name="id_opd"]').value;
            
            if (role === 'admin_opd' && !opd) {
                isValid = false;
                alert('Silakan pilih OPD untuk role Admin OPD');
                e.preventDefault();
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
        
        // Tombol close modal
        closeModal.addEventListener('click', function() {
            successModal.classList.remove('show');
            window.location.href = '/';
        });
        
        // Klik di luar modal untuk menutup
        successModal.addEventListener('click', function(e) {
            if (e.target === successModal) {
                successModal.classList.remove('show');
                window.location.href = '/';
            }
        });
    </script>
</body>
</html>