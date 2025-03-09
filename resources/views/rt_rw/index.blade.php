@extends('Template.Index')

@section('title', 'Data RT/RW - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Data RT/RW</div>
                <div class="card-body">

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
                        <a href="{{ route('rt-rw.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah RT/RW
                        </a>
                    </div>

                    <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>RW</th>
                                    <th>RT</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rtRws as $index => $rtRw)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $rtRw->rw }}</td>
                                    <td>{{ $rtRw->rt }}</td>
                                    <td>
                                        <a href="{{ route('rt-rw.edit', $rtRw->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form id="delete-form-{{ $rtRw->id }}" action="{{ route('rt-rw.destroy', $rtRw->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $rtRw->id }})">
                                                Delete
                                            </button>
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
</div>

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
