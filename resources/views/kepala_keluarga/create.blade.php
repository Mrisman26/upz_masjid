@extends('Template.Index')

@section('title', 'Tambah KK - UPZ Masjid At-Taqwa')

@section('content')
 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        {{-- @yield('content') --}}

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Tambah Kepala Keluarga</div>
                <div class="card-body">
                    <form action="{{ route('kepala-keluarga.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Kepala Keluarga</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="rt_rw_id">RT/RW</label>
                            <select name="rt_rw_id" class="form-control" required>
                                @foreach($rtRws as $rtRw)
                                    <option value="{{ $rtRw->id }}">{{ $rtRw->rt }}/{{ $rtRw->rw }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_muzaki">Jumlah Muzaki</label>
                            <input type="number" class="form-control" name="jumlah_muzaki" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_muzaki">Jumlah Tanggungan</label>
                            <input type="number" class="form-control" name="jumlah_tanggungan" required>
                        </div>
                        <a href="{{ route('zakat.index') }}" class="btn btn-secondary">Kembali</a>
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
