<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | UPZ Masjid At-Taqwa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Daftar Akun Baru</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-700 font-medium">Nama Lengkap</label>
                <input id="name" class="block w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input id="email" class="block w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input id="password" class="block w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Konfirmasi Password</label>
                <input id="password_confirmation" class="block w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-blue-500 hover:underline" href="{{ route('login') }}">
                    Sudah punya akun?
                </a>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</body>
</html>
