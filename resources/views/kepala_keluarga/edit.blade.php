@extends('Template.Index')

@section('title', 'Tambah KK - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Edit Kepala Keluarga</div>
                <div class="card-body">
                    <form action="{{ route('kepala-keluarga.update', $kepalaKeluarga->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama Kepala Keluarga</label>
                            <input type="text" class="form-control" name="nama" value="{{ $kepalaKeluarga->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="rt_rw_id">RT/RW</label>
                            <select name="rt_rw_id" class="form-control" required>
                                @foreach($rtRws as $rtRw)
                                    <option value="{{ $rtRw->id }}" {{ $rtRw->id == $kepalaKeluarga->rt_rw_id ? 'selected' : '' }}>{{ $rtRw->rt }}/{{ $rtRw->rw }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_muzaki">Jumlah Muzaki</label>
                            <input type="number" class="form-control" name="jumlah_muzaki" value="{{ $kepalaKeluarga->jumlah_muzaki }}" required>
                        </div>
                        <a href="{{ route('kepala-keluarga.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

@endsection
