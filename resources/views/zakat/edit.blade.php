@extends('Template.Index')

@section('title', 'Edit Zakat - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container">
            <div class="card">
                <div class="card-header">Edit Data Zakat</div>
                <div class="card-body">
                    <form action="{{ route('zakat.update', $zakat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pilih Kepala Keluarga -->
                        <div class="form-group">
                            <label for="kepala_keluarga_id">Kepala Keluarga</label>
                            <select name="kepala_keluarga_id" class="form-control" required>
                                @foreach($kepalaKeluargas as $kk)
                                <option value="{{ $kk->id }}"
                                    {{ $zakat->kepala_keluarga_id == $kk->id ? 'selected' : '' }}>
                                    {{ $kk->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Form Kepala Keluarga -->
                        <div class="form-group">
                            <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
                            <input type="number" class="form-control" name="jumlah_tanggungan"
                                value="{{ old('jumlah_tanggungan', $zakat->kepalaKeluarga->jumlah_tanggungan) }}"
                                required>
                        </div>

                        <!-- Form Jumlah Muzaki -->
                        <div class="form-group">
                            <label for="jumlah_muzaki">Jumlah Muzaki</label>
                            <input type="number" class="form-control" id="jumlah_muzaki" name="jumlah_muzaki"
                                value="{{ old('jumlah_muzaki', $zakat->kepalaKeluarga->jumlah_muzaki) }}" required>
                        </div>

                        <!-- Pilih RT/RW -->
                        <div class="form-group">
                            <label for="rt_rw_id">RT/RW</label>
                            <select name="rt_rw_id" class="form-control" required>
                                @foreach($rtRws as $rtRw)
                                <option value="{{ $rtRw->id }}"
                                    {{ $zakat->kepalaKeluarga->rt_rw_id == $rtRw->id ? 'selected' : '' }}>
                                    RT {{ $rtRw->rt }}/RW {{ $rtRw->rw }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Bentuk Zakat -->
                        <div class="form-group">
                            <label for="bentuk_zakat">Bentuk Zakat</label>
                            <select name="bentuk_zakat" id="bentuk_zakat" class="form-control">
                                <option value="beras" {{ $zakat->zakat_fitrah_beras > 0 ? 'selected' : '' }}>Beras
                                </option>
                                <option value="uang" {{ $zakat->zakat_fitrah_uang > 0 ? 'selected' : '' }}>Uang</option>
                            </select>
                        </div>

                        <!-- Input Zakat Fitrah (Beras) -->
                        <div class="form-group">
                            <label for="zakat_fitrah_beras">Zakat Fitrah (Beras)</label>
                            <input type="text" class="form-control" id="zakat_fitrah_beras" name="zakat_fitrah_beras"
                                value="{{ $zakat->zakat_fitrah_beras }}" readonly>
                        </div>

                        <!-- Input Zakat Fitrah (Uang) -->
                        <div class="form-group">
                            <label for="zakat_fitrah_uang">Zakat Fitrah (Uang)</label>
                            <input type="text" class="form-control" id="zakat_fitrah_uang" name="zakat_fitrah_uang"
                                value="{{ $zakat->zakat_fitrah_uang }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="infaq">Infaq</label>
                            <input type="text" class="form-control" id="infaq" name="infaq" value="{{ $zakat->infaq }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="zakat_mal">Zakat Mal</label>
                            <input type="text" class="form-control" name="zakat_mal" value="{{ $zakat->zakat_mal }}">
                        </div>

                        <div class="form-group">
                            <label for="zakat_penghasilan">Zakat Penghasilan</label>
                            <input type="text" class="form-control" name="zakat_penghasilan"
                                value="{{ $zakat->zakat_penghasilan }}">
                        </div>

                        <!-- Tombol Kembali & Update -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('zakat.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

<script>
    document.getElementById('jumlah_muzaki').addEventListener('input', hitungZakat);
    document.getElementById('bentuk_zakat').addEventListener('change', hitungZakat);

    function hitungZakat() {
        let jumlahMuzaki = document.getElementById('jumlah_muzaki').value;
        let bentukZakat = document.getElementById('bentuk_zakat').value;
        let zakatBeras = (bentukZakat === "beras") ? jumlahMuzaki * 3.25 : 0;
        let zakatUang = (bentukZakat === "uang") ? jumlahMuzaki * 32500 : 0;

        document.getElementById('zakat_fitrah_beras').value = zakatBeras;
        document.getElementById('zakat_fitrah_uang').value = zakatUang;
    }
</script>


@endsection
