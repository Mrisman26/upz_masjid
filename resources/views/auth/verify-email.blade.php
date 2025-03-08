<x-guest-layout>
    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
        <h2 class="text-xl font-semibold text-gray-800 text-center">Verifikasi Email Anda</h2>

        <div class="mt-4 text-gray-600 text-center">
            <p>Terima kasih telah mendaftar di <strong>{{ config('app.name') }}</strong>!</p>
            <p>Silakan periksa email Anda dan klik tautan verifikasi yang telah kami kirim.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-md text-center">
                <p>Email verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.</p>
                <p><strong>Jika tidak ditemukan, silakan cek folder Spam!</strong></p>
            </div>
        @endif

        <div class="mt-6 text-center text-gray-700">
            <p>Belum menerima email?</p>
        </div>

        <div class="mt-4 flex flex-col items-center gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Keluar') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
