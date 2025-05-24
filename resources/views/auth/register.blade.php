<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Manajemen Magang</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 40px 20px;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="60" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="30" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="90" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .register-container {
            position: relative;
            z-index: 1;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 48px 40px;
            width: 440px;
            max-width: 90vw;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .logo-icon i {
            font-size: 32px;
            color: white;
        }

        .logo-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .logo-subtitle {
            font-size: 16px;
            color: #6b7280;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            background: #fafafa;
            transition: all 0.3s ease;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
        }

        .form-input:focus, .form-select:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-input:focus + i, .form-select:focus + i {
            color: #667eea;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        .role-option {
            position: relative;
        }

        .role-option input[type="radio"] {
            display: none;
        }

        .role-card {
            padding: 16px 12px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .role-card:hover {
            border-color: #667eea;
            background: white;
        }

        .role-option input[type="radio"]:checked + .role-card {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .role-card i {
            font-size: 24px;
            margin-bottom: 8px;
            color: #6b7280;
            transition: color 0.3s ease;
        }

        .role-option input[type="radio"]:checked + .role-card i {
            color: white;
        }

        .role-card .role-name {
            font-size: 12px;
            font-weight: 500;
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #ef4444; width: 33%; }
        .strength-medium { background: #f59e0b; width: 66%; }
        .strength-strong { background: #10b981; width: 100%; }

        .register-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 8px;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.4);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .divider {
            text-align: center;
            margin: 32px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 20px;
            color: #6b7280;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Error states */
        .form-input.error, .form-select.error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .form-input.error + .error-message,
        .form-select.error + .error-message {
            display: block;
        }

        /* Loading animation */
        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-loading .loading {
            display: inline-block;
        }

        .btn-loading .btn-text {
            opacity: 0.7;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-card {
                padding: 32px 24px;
                margin: 20px;
            }
            
            .logo-title {
                font-size: 24px;
            }

            .role-grid {
                grid-template-columns: 1fr;
            }

            .role-card {
                display: flex;
                align-items: center;
                text-align: left;
                padding: 16px;
            }

            .role-card i {
                margin-right: 12px;
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="logo-title">Daftar Akun</h1>
                <p class="logo-subtitle">Sistem Manajemen Magang</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               name="username" 
                               id="username"
                               class="form-input" 
                               placeholder="Masukkan username unik"
                               required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="error-message">Username wajib diisi</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="form-input" 
                               placeholder="Minimal 8 karakter"
                               required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="error-message">Password minimal 8 karakter</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               class="form-input" 
                               placeholder="Ulangi password Anda"
                               required>
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="error-message">Password tidak cocok</div>
                </div>

                <div class="form-group">
                    <label>Pilih Role</label>
                    <div class="role-grid">
                        <div class="role-option">
                            <input type="radio" name="role" value="admin" id="admin" required>
                            <label for="admin" class="role-card">
                                <i class="fas fa-user-cog"></i>
                                <div class="role-name">Admin</div>
                            </label>
                        </div>
                        <div class="role-option">
                            <input type="radio" name="role" value="pembimbing" id="pembimbing" required>
                            <label for="pembimbing" class="role-card">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <div class="role-name">Pembimbing</div>
                            </label>
                        </div>
                        <div class="role-option">
                            <input type="radio" name="role" value="mahasiswa" id="mahasiswa" required>
                            <label for="mahasiswa" class="role-card">
                                <i class="fas fa-user-graduate"></i>
                                <div class="role-name">Mahasiswa</div>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="register-btn" id="registerBtn">
                    <div class="loading"></div>
                    <span class="btn-text">Daftar Sekarang</span>
                </button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="login-link">
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    Sudah punya akun? Masuk sekarang
                </a>
            </div>
        </div>
    </div>

    <script>
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            
            strengthBar.className = 'password-strength-bar';
            if (strength >= 3) {
                strengthBar.classList.add('strength-strong');
            } else if (strength >= 2) {
                strengthBar.classList.add('strength-medium');
            } else if (strength >= 1) {
                strengthBar.classList.add('strength-weak');
            }
        });

        // Password confirmation validation
        const confirmPassword = document.getElementById('password_confirmation');
        confirmPassword.addEventListener('input', function() {
            if (this.value !== passwordInput.value) {
                this.classList.add('error');
            } else {
                this.classList.remove('error');
            }
        });

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('registerBtn');
            btn.classList.add('btn-loading');
            btn.disabled = true;
        });

        // Input validation
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('error');
                } else {
                    this.classList.remove('error');
                }
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('error') && this.value.trim() !== '') {
                    this.classList.remove('error');
                }
            });
        });

        // Role selection validation
        const roleInputs = document.querySelectorAll('input[name="role"]');
        roleInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Remove error state from all role cards when one is selected
                document.querySelectorAll('.role-card').forEach(card => {
                    card.classList.remove('error');
                });
            });
        });