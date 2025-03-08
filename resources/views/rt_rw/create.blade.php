@extends('Template.Index')

@section('title', 'Tambah Data RT/RW - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Tambah RT/RW</div>
                <div class="card-body">

                    <form action="{{ route('rt-rw.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control" required>
                        </div>
                        <a href="{{ route('rt-rw.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

@endsection
