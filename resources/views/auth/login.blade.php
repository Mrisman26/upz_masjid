<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UPZ Masjid At-Taqwa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6 relative">

        <!-- Notifikasi Flash -->
        @if (session('success'))
            <div id="alert-success" class="mb-4 flex items-center p-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-md">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4a1 1 0 102 0V9a1 1 0 10-2 0v5zm1-8a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
                <button type="button" class="ml-auto text-green-700 hover:text-green-900 focus:outline-none" onclick="closeAlert('alert-success')">
                    &times;
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error" class="mb-4 flex items-center p-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded-md">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4a1 1 0 102 0V9a1 1 0 10-2 0v5zm1-8a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
                <button type="button" class="ml-auto text-red-700 hover:text-red-900 focus:outline-none" onclick="closeAlert('alert-error')">
                    &times;
                </button>
            </div>
        @endif

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login ke Akun Anda</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input id="email"
                    class="block w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input id="password"
                    class="block w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mt-4">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <label for="remember_me" class="ml-2 text-gray-600 text-sm">Remember me</label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
                @endif
                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition">
                    Log in
                </button>
            </div>
        </form>
    </div>

    <script>
        // Tutup notifikasi otomatis setelah 5 detik
        setTimeout(function () {
            document.getElementById('alert-success')?.classList.add('hidden');
            document.getElementById('alert-error')?.classList.add('hidden');
        }, 5000);

        // Fungsi untuk menutup notifikasi secara manual
        function closeAlert(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>

</body>

</html>
