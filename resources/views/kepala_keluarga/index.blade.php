@extends('Template.Index')

@section('title', 'Data Kepala Keluarga')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Data Kepala Keluarga</div>
                <div class="card-body">

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

                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <a href="{{ route('kepala-keluarga.create') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownTahun" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $tahun }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownTahun">
                                @for ($i = 2020; $i <= date('Y'); $i++)
                                    <a class="dropdown-item filter-tahun" href="#" data-tahun="{{ $i }}">{{ $i }}</a>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kepala Keluarga</th>
                                    <th>Jumlah Muzaki</th>
                                    <th>Jumlah Tanggungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kepalaKeluargas as $key => $keluarga)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $keluarga->nama }}</td>
                                    <td>{{ $keluarga->jumlah_muzaki }}</td>
                                    <td>{{ $keluarga->jumlah_tanggungan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                window.location.href = url.href;
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
