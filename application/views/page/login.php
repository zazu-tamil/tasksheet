<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Task Management System - Trekking Edition</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0c94c1 0%, #095e72 100%);
            --accent-gold: #f6c46d;
            --glass-bg: rgba(255, 255, 255, 0.12);
            --glass-border: rgba(255, 255, 255, 0.18);
            --text-light: #e8f4f0;
            --text-muted: #b8d9cc;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                linear-gradient(rgba(13, 36, 23, 0.65), rgba(13, 36, 23, 0.75)),
                url("https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80") center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated mountain silhouette */
        .mountain-overlay {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIyMDAiIHZpZXdCb3g9IjAgMCAxMjAwIDIwMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTSAwIDE5MCBMIDEyMDAgMTkwIEwgMTIwMCAyMDAgTCA2MDAgOTAgTCAwIDIwMCBaIiBmaWxsPSIjMDAwMDAwIiBvcGFjaXR5PSIwLjMiLz4KPHBhdGggZD0iTSAwIDE4NSBMIDYwMCAxMTUgTCAxMjAwIDE4NSBMIDEyMDAgMTkwIEwgMCAxOTAgWiIgZmlsbD0iIzAwMDAwMCIgb3BhY2l0eT0iMC4yNSIvPgo8L3N2Zz4K") repeat-x bottom;
            animation: mountainFloat 20s ease-in-out infinite;
            pointer-events: none;
            z-index: 1;
        }

        @keyframes mountainFloat {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(10px);
            }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transition: all 0.4s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow:
                0 35px 70px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .card-header {
            background: var(--primary-gradient);
            color: #fff;
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .card-header h3 {
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0 0 0.5rem;
            position: relative;
            z-index: 1;
        }

        .card-header p {
            margin: 0;
            opacity: 0.9;
            font-weight: 400;
            position: relative;
            z-index: 1;
        }

        .header-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 2.5rem 2rem;
            color: var(--text-light);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: var(--text-light) !important;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.25rem rgba(246, 196, 109, 0.25);
            background: rgba(255, 255, 255, 0.2) !important;
            color: var(--text-light) !important;
            transform: translateY(-2px);
        }

        .input-group-text.password-toggle {
            background: rgba(255, 255, 255, 0.1) !important;
            border-left: 0 !important;
            border-color: var(--glass-border) !important;
            color: var(--text-light);
            border-radius: 0 16px 16px 0 !important;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            background: var(--accent-gold) !important;
            color: #000 !important;
            transform: scale(1.05);
        }

        .btn-login {
            width: 100%;
            background: var(--primary-gradient);
            border: none;
            padding: 1.1rem;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(12, 148, 193, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(12, 148, 193, 0.6);
        }

        /* Enhanced Toast Styles */
        .colored-toast {
            border-radius: 16px !important;
            backdrop-filter: blur(15px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3) !important;
        }

        .swal2-success {
            border-color: #fff !important;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                margin: 10px;
                border-radius: 20px;
            }

            .card-body {
                padding: 2rem 1.5rem;
            }
        }

        /* Floating particles effect */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(246, 196, 109, 0.6);
            border-radius: 50%;
            animation: float 6s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-10vh) scale(1);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Mountain Overlay -->
    <div class="mountain-overlay"></div>

    <!-- Floating Particles -->
    <div class="particles" id="particles"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <i class="bi bi-check2-square header-icon" style="color: var(--accent-gold);"></i>
                <h3><?php echo PG_HEAD ?? 'Task Management System'; ?></h3>
                <p>Secure access to your trekking & project dashboard</p>
            </div>

            <div class="card-body">
                <form action="<?php echo site_url('login'); ?>" method="post" novalidate>
                    <div class="mb-4">
                        <label class="form-label">Username or Email</label>
                        <input type="text" name="user_name" class="form-control"
                            placeholder="Enter your username or email" value="<?php echo set_value('user_name'); ?>"
                            required>
                        <?php echo form_error('user_name', '<div class="text-warning small mt-1">', '</div>'); ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="user_pwd" id="user_pwd" class="form-control"
                                placeholder="Enter your password" required>
                            <span class="input-group-text password-toggle" id="togglePassword">
                                <i class="bi bi-eye-slash" id="eyeIcon"></i>
                            </span>
                        </div>
                        <?php echo form_error('user_pwd', '<div class="text-warning small mt-1">', '</div>'); ?>
                    </div>

                    <button type="submit" class="btn btn-login mt-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Enter Dashboard
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // ✅ Password toggle
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            if (togglePassword) {
                togglePassword.addEventListener('click', function () {
                    const pwd = document.getElementById('user_pwd');
                    const icon = document.getElementById('eyeIcon');
                    if (pwd && icon) {
                        if (pwd.type === 'password') {
                            pwd.type = 'text';
                            icon.classList.replace('bi-eye-slash', 'bi-eye');
                        } else {
                            pwd.type = 'password';
                            icon.classList.replace('bi-eye', 'bi-eye-slash');
                        }
                    }
                });
            }
        });

        // ✅ Particles (optimized)
        let particleInterval;
        document.addEventListener('DOMContentLoaded', function () {
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
                particle.style.animationDelay = Math.random() * 2 + 's';
                const particles = document.getElementById('particles');
                if (particles) particles.appendChild(particle);
                setTimeout(() => particle.remove(), 7000);
            }
            particleInterval = setInterval(createParticle, 300);
        });
    </script>
    <!-- Custom Toast Notification Script (Top-Right, Beautiful Design) -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            background: '#0c94c1a6',
            color: '#ffffff',
            padding: '1rem 1.5rem'
        });

        <?php if ($this->session->flashdata('login_success')): ?>
            Toast.fire({
                icon: 'success',
                title: 'Login Successful',
                text: '<?= addslashes($this->session->flashdata('login_success')); ?>'
            }).then(() => {
                window.location.href = "<?= site_url('dash'); ?>";
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('login_error')): ?>
            Toast.fire({
                icon: 'error',
                title: 'Login Failed',
                text: '<?= addslashes($this->session->flashdata('login_error')); ?>'
            });
        <?php endif; ?>
    </script>

    <style>
        div:where(.swal2-icon).swal2-success {
            border-color: #ffffffff !important;
            color: #ffffffff !important;
        }
    </style>
    <!-- Optional: Extra styling for toast (rounded + glow) -->
    <style>
        .colored-toast {
            border-radius: 12px !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.6) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(79, 138, 90, 0.3);
        }

        .toast-title {
            font-weight: 600 !important;
            font-size: 1.1rem !important;
        }

        .toast-icon {
            font-size: 1.8rem !important;
        }
    </style>

</body>

</html>