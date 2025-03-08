@extends('Template.Index')

@section('title', 'Data Mustahik - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Data Mustahik</div>
                <div class="card-body">

                    <!-- Notifikasi dengan SweetAlert -->
                    @if(session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: "{{ session('success') }}",
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            });
                        </script>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('mustahik.create') }}" class="btn btn-primary">Tambah Mustahik</a>

                        <!-- Dropdown Filter Tahun -->
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownTahun"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $tahun }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownTahun">
                                @for ($i = 2020; $i <= date('Y'); $i++) <a class="dropdown-item filter-tahun" href="#"
                                    data-tahun="{{ $i }}">{{ $i }}</a>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kriteria</th>
                                <th>RW</th>
                                <th>RT</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mustahiks as $key => $mustahik)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $mustahik->name }}</td>
                                <td>{{ $mustahik->kriteria }}</td>
                                <td>{{ $mustahik->rtRw->rw ?? '-' }}</td>
                                <td>{{ $mustahik->rtRw->rt ?? '-' }}</td>
                                <td>{{ $mustahik->keterangan }}</td>
                                <td>
                                    <a href="{{ route('mustahik.edit', $mustahik->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                        <form id="delete-form-{{ $mustahik->id }}" action="{{ route('mustahik.destroy', $mustahik->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $mustahik->id }})">Hapus</button>
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

<script>
    document.querySelectorAll('.filter-tahun').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            let selectedYear = this.getAttribute('data-tahun');
            let url = new URL(window.location.href);
            url.searchParams.set('tahun', selectedYear);
            window.location.href = url.toString();
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
