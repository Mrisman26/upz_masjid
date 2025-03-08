@extends('Template.Index')

@section('title', 'Edit Mustahik - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Edit Mustahik</div>
                <div class="card-body">
                    <form action="{{ route('mustahik.update', $mustahik->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $mustahik->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kriteria" class="form-label">Kriteria</label>
                            <select name="kriteria" class="form-control" required>
                                @foreach(['Fakir', 'Miskin', 'Amil', 'Mualaf', 'Gharim', 'Riqab', 'Fi Sabilillah', 'Ibnu Sabil'] as $kriteria)
                                    <option value="{{ $kriteria }}" {{ $mustahik->kriteria == $kriteria ? 'selected' : '' }}>{{ $kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rt_rw_id">RT/RW</label>
                            <select name="rt_rw_id" class="form-control" required>
                                @foreach($rtRws as $rtRw)
                                    <option value="{{ $rtRw->id }}" {{ $mustahik->rt_rw_id == $rtRw->id ? 'selected' : '' }}>{{ $rtRw->rt }}/{{ $rtRw->rw }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('mustahik.index') }}" class="btn btn-secondary">Kembali</a>
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
