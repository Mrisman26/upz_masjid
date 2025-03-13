<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPZ Masjid At-Taqwa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg py-4 px-6 fixed w-full top-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl md:text-2xl font-bold text-gray-800">UPZ Masjid At-Taqwa</div>
            @if (Route::has('login'))
            <div class="flex space-x-3">
                @auth
                <a href="{{ url('/dashboard') }}"
                    class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition">Dashboard</a>
                @else
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition">Log
                    in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="px-4 py-2 text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 transition">Register</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="flex flex-col items-center justify-center text-center h-screen bg-blue-500 text-white px-6 pt-16">
        <h1 class="text-4xl md:text-5xl font-extrabold">Selamat Datang di UPZ Masjid At-Taqwa</h1>
        <p class="mt-4 text-lg md:text-xl max-w-3xl">Mengelola zakat fitrah, zakat mal, infaq, dan sedekah dengan sistem
            yang modern dan transparan.</p>
        <a href="#tentang"
            class="mt-6 px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:bg-gray-200 transition">Pelajari
            Lebih Lanjut</a>
    </header>

    <!-- Materi Zakat -->
    <section class="py-24 px-6 mt-1 bg-gray-400">
        <div class="container mx-auto max-w-4xl bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-4xl font-bold text-center text-blue-700">Materi Zakat</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed text-center">
                Zakat adalah kewajiban bagi setiap Muslim yang mampu untuk membantu mereka yang berhak menerimanya.
                Zakat terbagi menjadi zakat fitrah dan zakat mal.
            </p>

            <div class="mt-10 space-y-6">
                <div>
                    <h3 class="text-2xl font-semibold text-blue-700">Dalil Zakat dalam Al-Qur'an</h3>
                    <p class="mt-2 text-lg text-gray-600">Allah SWT berfirman dalam Al-Qur'an:</p>
                    <blockquote class="italic text-gray-700 bg-gray-200 p-4 rounded-lg border-l-4 border-blue-500">
                        “Ambillah zakat dari sebagian harta mereka, dengan zakat itu kamu membersihkan dan mensucikan
                        mereka.” (QS. At-Taubah: 103)
                    </blockquote>
                    <blockquote class="italic text-gray-700 bg-gray-200 p-4 rounded-lg border-l-4 border-blue-500 mt-2">
                        “Dan dirikanlah shalat, tunaikanlah zakat, dan ruku’lah beserta orang-orang yang ruku’.” (QS.
                        Al-Baqarah: 43)
                    </blockquote>
                </div>

                <div>
                    <h3 class="text-2xl font-semibold text-blue-700">Hadits Tentang Zakat</h3>
                    <p class="mt-2 text-lg text-gray-600">Rasulullah SAW bersabda:</p>
                    <blockquote class="italic text-gray-700 bg-gray-200 p-4 rounded-lg border-l-4 border-blue-500">
                        “Islam dibangun di atas lima perkara: bersaksi bahwa tidak ada Tuhan selain Allah dan Muhammad
                        adalah utusan-Nya,
                        mendirikan shalat, menunaikan zakat, berpuasa di bulan Ramadan, dan menunaikan haji bagi yang
                        mampu.” (HR. Bukhari dan Muslim)
                    </blockquote>
                </div>

                <div>
                    <h3 class="text-2xl font-semibold text-blue-700">Asnaf (Golongan Penerima Zakat)</h3>
                    <p class="mt-2 text-lg text-gray-600">Allah SWT menetapkan delapan golongan penerima zakat dalam
                        Al-Qur'an:</p>
                    <blockquote class="italic text-gray-700 bg-gray-200 p-4 rounded-lg border-l-4 border-blue-500">
                        “Sesungguhnya zakat-zakat itu hanyalah untuk orang-orang fakir, orang-orang miskin, para amil
                        zakat,
                        para muallaf yang dibujuk hatinya, untuk (memerdekakan) hamba sahaya, orang-orang yang
                        berhutang,
                        untuk jalan Allah dan untuk mereka yang sedang dalam perjalanan, sebagai kewajiban dari Allah.
                        Dan Allah Maha Mengetahui lagi Maha Bijaksana.” (QS. At-Taubah: 60)
                    </blockquote>
                    <ul class="mt-4 space-y-2 text-lg text-gray-700">
                        <li><strong>Fakir</strong> - Tidak memiliki penghasilan yang mencukupi kebutuhan dasar.</li>
                        <li><strong>Miskin</strong> - Memiliki penghasilan tetapi masih kurang untuk hidup.</li>
                        <li><strong>Amil</strong> - Pengelola zakat yang mengumpulkan dan mendistribusikan zakat.</li>
                        <li><strong>Muallaf</strong> - Orang yang baru masuk Islam dan membutuhkan dukungan.</li>
                        <li><strong>Gharim</strong> - Orang yang memiliki hutang dan tidak mampu melunasinya.</li>
                        <li><strong>Riqab</strong> - Budak atau hamba sahaya yang ingin merdeka.</li>
                        <li><strong>Fi Sabilillah</strong> - Orang yang berjuang di jalan Allah, termasuk pendidikan dan
                            dakwah.</li>
                        <li><strong>Ibnu Sabil</strong> - Musafir yang kehabisan bekal dalam perjalanan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang" class="py-20 px-6 mt-1 bg-blue-600 text-white">
        <div class="container mx-auto max-w-5xl text-center">
            <h2 class="text-3xl font-bold">Tentang Kami</h2>
            <p class="mt-4 text-lg leading-relaxed">
                UPZ Masjid At-Taqwa hadir untuk memudahkan umat Islam dalam menunaikan zakat secara amanah.
                Dengan sistem digital, kami memastikan transparansi dalam setiap transaksi dan pelaporan.
            </p>
        </div>
    </section>


    <!-- Footer -->
    <footer class="text-center py-6 mt-1 bg-gray-900 text-white">
        <p class="text-sm">&copy; 2025 UPZ Masjid At-Taqwa. Hak Cipta Dilindungi.</p>
    </footer>
</body>

</html>
