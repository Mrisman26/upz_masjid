<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | UPZ Masjid At-Taqwa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6 relative">

        <!-- Notifikasi Flash -->
        @if (session('status') == 'verification-link-sent')
            <div id="alert-success" class="mb-4 flex items-center p-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-md">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4a1 1 0 102 0V9a1 1 0 10-2 0v5zm1-8a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd" />
                </svg>
                <p>Email verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.</p>
                <p><strong>Jika tidak ditemukan, silakan cek folder Spam!</strong></p>
                <button type="button" class="ml-auto text-green-700 hover:text-green-900 focus:outline-none" onclick="closeAlert('alert-success')">
                    &times;
                </button>
            </div>
        @endif

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Verifikasi Email Anda</h2>

        <div class="text-gray-600 text-center">
            <p>Terima kasih telah mendaftar di <strong>UPZ Masjid</strong>!</p>
            <p>Silakan periksa email Anda dan klik tautan verifikasi yang telah kami kirim.</p>
        </div>

        <div class="mt-6 text-center text-gray-700">
            <p>Belum menerima email?</p>
        </div>

        <div class="mt-4 flex flex-col items-center gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Keluar
                </button>
            </form>
        </div>
    </div>

    <script>
        // Tutup notifikasi otomatis setelah 5 detik
        setTimeout(function () {
            document.getElementById('alert-success')?.classList.add('hidden');
        }, 5000);

        // Fungsi untuk menutup notifikasi secara manual
        function closeAlert(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>

</body>

</html>
