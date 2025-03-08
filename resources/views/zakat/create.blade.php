@extends('Template.Index')

@section('title', 'Tambah Zakat - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card-body">
                <form action="{{ route('zakat.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kepala_keluarga_id">Kepala Keluarga</label>
                        <select name="kepala_keluarga_id" id="kepala_keluarga_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Kepala Keluarga</option>
                            @foreach($kepalaKeluargas as $kk)
                                <option value="{{ $kk->id }}" data-muzaki="{{ $kk->jumlah_muzaki }}">{{ $kk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Muzaki ke UPZ Masjid:</label>
                        <input type="number" class="form-control" name="jumlah_muzaki" id="jumlah_muzaki" required oninput="hitungZakat()" readonly>
                    </div>

                    <div class="form-group">
                        <label>Zakat Fitrah yang Diberikan:</label>
                        <select name="jenis_zakat_fitrah" id="jenis_zakat_fitrah" class="form-control" required onchange="hitungZakat()">
                            <option value="uang">Uang</option>
                            <option value="beras">Beras</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Zakat Fitrah (Beras)</label>
                        <input type="text" class="form-control" name="zakat_fitrah_beras" id="zakat_fitrah_beras">
                    </div>

                    <div class="form-group">
                        <label>Zakat Fitrah (Uang)</label>
                        <input type="text" class="form-control" name="zakat_fitrah_uang" id="zakat_fitrah_uang">
                    </div>

                    <div class="form-group">
                        <label>Infaq</label>
                        <input type="text" class="form-control" name="infaq" id="infaq" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

@endsection
