@extends('Template.Index')

@section('title', 'Tambah Mustahik - UPZ Masjid At-Taqwa')

@section('content')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">Tambah Mustahik</div>
                    <div class="card-body">
                        <form action="{{ route('mustahik.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="kriteria" class="form-label">Kriteria</label>
                                <select name="kriteria" class="form-control" required>
                                    <option value="Fakir">Fakir</option>
                                    <option value="Miskin">Miskin</option>
                                    <option value="Amil">Amil</option>
                                    <option value="Mualaf">Mualaf</option>
                                    <option value="Gharim">Gharim</option>
                                    <option value="Riqab">Riqab</option>
                                    <option value="Fi Sabilillah">Fi Sabilillah</option>
                                    <option value="Ibnu Sabil">Ibnu Sabil</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rt_rw_id">RT/RW</label>
                                <select name="rt_rw_id" class="form-control" required>
                                    @foreach($rtRws as $rtRw)
                                        <option value="{{ $rtRw->id }}">{{ $rtRw->rt }}/{{ $rtRw->rw }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <a href="{{ route('mustahik.index') }}" class="btn btn-secondary">Kembali</a>
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
