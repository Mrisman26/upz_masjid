@extends('Template.Index')

@section('title', 'Detail Zakat - UPZ Masjid At-Taqwa')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Detail Informasi Zakat
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $zakat->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kepala Keluarga</th>
                            <td>{{ $zakat->kepalaKeluarga->nama }}</td>
                        </tr>
                        <tr>
                            <th>RT/RW</th>
                            <td>{{ $zakat->kepalaKeluarga->rtRw->rt }} / {{ $zakat->kepalaKeluarga->rtRw->rw }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Tanggungan</th>
                            <td>{{ $zakat->kepalaKeluarga->jumlah_tanggungan }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Muzaki</th>
                            <td>{{ $zakat->kepalaKeluarga->jumlah_muzaki }}</td>
                        </tr>
                        <tr>
                            <th>Zakat Fitrah (Beras)</th>
                            <td>{{ $zakat->zakat_fitrah_beras ? $zakat->zakat_fitrah_beras . ' Liter' : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Zakat Fitrah (Uang)</th>
                            <td>{{ $zakat->zakat_fitrah_uang ? 'Rp ' . number_format($zakat->zakat_fitrah_uang, 0, ',', '.') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Zakat Mal</th>
                            <td>{{ $zakat->zakat_mal ? 'Rp ' . number_format($zakat->zakat_mal, 0, ',', '.') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Zakat Penghasilan</th>
                            <td>{{ $zakat->zakat_penghasilan ? 'Rp ' . number_format($zakat->zakat_penghasilan, 0, ',', '.') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Infaq</th>
                            <td>Rp {{ number_format($zakat->infaq, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($zakat->created_at)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Petugas</th>
                            <td>{{ $zakat->user->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <a href="{{ route('zakat.index') }}" class="btn btn-primary mt-3">Kembali</a>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

@endsection
