@extends('Template.Index')

@section('title', 'Data Zakat - UPZ Masjid At-Taqwa')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Data Zakat</div>
                <div class="card-body">

                    <!-- Notifikasi dengan SweetAlert -->
                    @if(session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: "{{ session('success') }}",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>
                    @endif

                    <!-- Baris untuk tombol Tambah Data Zakat dan Dropdown Filter Tahun -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('kepala-keluarga.create') }}" class="btn btn-primary">Tambah Data Zakat</a>

                        <!-- Dropdown Filter Tahun -->
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownTahun"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $tahun }}
                                <!-- Menampilkan tahun yang sedang dipilih -->
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownTahun">
                                @for ($i = 2019; $i <= date('Y'); $i++) <a class="dropdown-item filter-tahun" href="#"
                                    data-tahun="{{ $i }}">{{ $i }}</a>
                                    @endfor
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Zakat Fitrah (Beras)</th>
                                <th>Zakat Fitrah (Uang)</th>
                                <th>Zakat Mal</th>
                                <th>Zakat Penghasilan</th>
                                <th>Infaq</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($zakats as $key => $zakat)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $zakat->kepalaKeluarga->nama }}</td>
                                <td>{{ fmod($zakat->zakat_fitrah_beras, 1) == 0
                                            ? number_format($zakat->zakat_fitrah_beras, 0)
                                            : rtrim(rtrim(number_format($zakat->zakat_fitrah_beras, 2, '.', ''), '0'), '.')
                                        }} Liter</td>
                                <td>Rp {{ number_format($zakat->zakat_fitrah_uang, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($zakat->zakat_mal, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($zakat->zakat_penghasilan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($zakat->infaq, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('zakat.edit', $zakat->id) }}"
                                        class="btn btn-warning btn-sm mb-2">Edit</a>
                                    <a href="{{ route('zakat.show', $zakat->id) }}"
                                        class="btn btn-primary btn-sm mb-2">Show</a>
                                    <form action="{{ route('zakat.destroy', $zakat->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".filter-tahun").forEach(function (element) {
            element.addEventListener("click", function (e) {
                e.preventDefault();
                var tahun = this.getAttribute("data-tahun");
                var url = new URL(window.location.href);
                url.searchParams.set("tahun", tahun);
                window.location.href = url.href; // Redirect ke URL dengan parameter tahun
            });
        });
    });
</script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection
