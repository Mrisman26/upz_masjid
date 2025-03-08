@extends('Template.Index')

@section('title', 'Data RT/RW - UPZ Masjid At-Taqwa')

@section('content')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">Edit RT/RW</div>
                    <div class="card-body">
                        <form action="{{ route('rt-rw.update', $rt_rw->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>RW</label>
                                <input type="text" class="form-control" name="rw" value="{{ $rt_rw->rw }}" required>
                            </div>
                            <div class="form-group">
                                <label>RT</label>
                                <input type="text" class="form-control" name="rt" value="{{ $rt_rw->rt }}" required>
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
