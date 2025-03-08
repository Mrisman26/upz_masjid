<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPZ Masjid At-Taqwa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg py-4 px-6 flex justify-between items-center fixed w-full top-0 z-10">
        <div class="text-2xl font-bold text-gray-800">UPZ Masjid At-Taqwa</div>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-white bg-blue-600 rounded-full shadow-md hover:bg-blue-700 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-white bg-blue-600 rounded-full shadow-md hover:bg-blue-700 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-3 px-5 py-2 text-white bg-green-600 rounded-full shadow-md hover:bg-green-700 transition">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <header class="flex flex-col items-center justify-center text-center h-screen bg-blue-500 text-white px-6">
        <h1 class="text-5xl font-extrabold">Selamat Datang di UPZ Masjid At-Taqwa</h1>
        <p class="mt-4 text-xl max-w-2xl">Mengelola zakat fitrah, zakat mal, infaq, dan sedekah dengan sistem yang modern dan transparan.</p>
        <a href="#tentang" class="mt-6 px-6 py-3 bg-white text-blue-600 font-semibold rounded-full shadow-lg hover:bg-gray-200 transition">Pelajari Lebih Lanjut</a>
    </header>

    <section id="tentang" class="py-20 px-6 max-w-5xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-800">Tentang Kami</h2>
        <p class="mt-4 text-lg text-gray-600 leading-relaxed">UPZ Masjid At-Taqwa hadir untuk memudahkan umat Islam dalam menunaikan zakat secara amanah. Dengan sistem digital, kami memastikan transparansi dalam setiap transaksi dan pelaporan.</p>
    </section>

    <footer class="text-center py-6 bg-gray-900 text-white">
        <p class="text-sm">&copy; 2025 UPZ Masjid At-Taqwa. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
