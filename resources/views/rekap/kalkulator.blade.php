@extends('Template.Index')

@section('title', 'Konversi - UPZ Masjid At-Taqwa')

@section('content')
<div class="container-fluid">

    <!-- Filter Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Kalkulator Konversi Uang Zakat ke Beras</h6>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('rekap-kalkulator') }}" class="mb-4">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label for="tanggal" class="sr-only">Filter Berdasarkan Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Jumlah Uang Zakat</th>
                            <th>Jumlah Muzaki</th>
                            <th>Jumlah Beras (Kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_uang = 0;
                            $total_muzaki = 0;
                            $total_beras = 0;
                        @endphp
                        @foreach($zakats as $index => $zakat)
                        @php
                            $total_uang += $zakat->zakat_fitrah_uang;
                            $total_muzaki += $zakat->jumlah_muzaki;
                            $total_beras += $zakat->jumlah_beras;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>Rp {{ number_format($zakat->zakat_fitrah_uang, 0, ',', '.') }}</td>
                            <td>{{ $zakat->jumlah_muzaki }}</td>
                            <td>{{ number_format($zakat->jumlah_beras, 0) }} Kg</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-primary text-white">
                        <tr>
                            <th>Total</th>
                            <th>Rp {{ number_format($total_uang, 0, ',', '.') }}</th>
                            <th>{{ $total_muzaki }}</th>
                            <th>{{ number_format($total_beras, 0) }} Kg</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
