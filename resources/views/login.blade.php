<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .background-image {
            background-image: url('https://images.unsplash.com/photo-1499346030926-9a72daac6c63');
            background-size: cover;
            background-position: center;
            height: 40%;
            width: 100%;
        }

        .bottom-section {
            height: 60%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 3rem 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            top: -80px;
        }

        .footer {
            text-align: center;
            color: #aaa;
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px;
        }

        .form-control {
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .login-header {
            text-align: left;
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: bold;
        }

        .login-description {
            text-align: left;
            margin-bottom: 20px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="background-image"></div>

<div class="bottom-section">
    <div class="login-card">
        <h3 class="login-header">Login</h3>
        <p class="login-description">Enter your NIK and password to sign in</p>
        <form method="POST" action="{{route('login.post')}}">
            @csrf  <!-- Tambahkan token CSRF -->
            <input type="text" name="nik" class="form-control" placeholder="NIK" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </form>
    </div>
</div>

<div class="footer">
    <p>Copyright © 2024 Pemrograman Terapan | Presensi Mahasiswa.</p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
