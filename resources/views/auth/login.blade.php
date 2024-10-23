<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto h-full flex justify-center items-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- NIK -->
                    <div class="mb-4">
                        <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">NIK</label>
                        <input type="text" id="nik" name="nik" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember" class="form-checkbox">
                            <span class="ml-2 text-gray-700">Remember Me</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
