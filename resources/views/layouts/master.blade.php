<!-- resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tambahkan link ke CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<!-- Header -->
<header>
    <nav>
        <ul>
            <li><a href="/admin">Admin Dashboard</a></li>
            <li><a href="/dosen">Dosen Dashboard</a></li>
            <li><a href="/user">User Dashboard</a></li>
        </ul>
    </nav>
</header>

<!-- Sidebar (Opsional) -->
<aside>
    <ul>
        <li><a href="#">Link 1</a></li>
        <li><a href="#">Link 2</a></li>
    </ul>
</aside>

<!-- Konten Utama -->
<main>
    <div class="content">
        @yield('content')  <!-- Bagian ini akan diganti dengan konten halaman yang spesifik -->
    </div>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

<!-- Tambahkan link ke JS -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
