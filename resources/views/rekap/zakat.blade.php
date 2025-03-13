@extends('Template.Index')

@section('title', 'Rekap Data Zakat - UPZ Masjid At-Taqwa')

@section('content')

<!-- Main Content -->
<div id="content">
    <div class="container-fluid">
        <div class="card shadow mb-8">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><span id="dropdownTahun">{{ $tahun }}</span></h6>

                <!-- Dropdown Filter Tahun -->
                <div class="d-flex align-items-center gap-2">
                    <div class="dropdown mr-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="btnDropdownTahun"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih Tahun
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnDropdownTahun">
                            @for ($i = 2020; $i <= date('Y'); $i++)
                                <a class="dropdown-item filter-tahun" href="{{ route('rekap-zakat', ['tahun' => $i]) }}">{{ $i }}</a>
                            @endfor
                        </div>
                    </div>

                    <!-- Cetak PDF hanya untuk admin -->
                    @role('admin')
                        <a href="{{ route('rekap-zakat.cetak', ['tahun' => $tahun]) }}" class="btn btn-danger d-inline-block" target="_blank">
                            <i class="fas fa-file-pdf"></i> Cetak PDF
                        </a>
                    @endrole
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="rekapTable">
                        <thead class="thead-dark">
                            <tr>
                                <th rowspan="2" class="text-center align-middle">NO</th>
                                <th rowspan="2" class="text-center align-middle">TANGGAL</th>
                                <th colspan="3" class="text-center">RW 08</th>
                                <th colspan="3" class="text-center">RW 10</th>
                                <th rowspan="2" class="text-center align-middle">RW 01</th>
                                <th colspan="2" class="text-center">ZAKAT FITRAH YANG DIBERIKAN</th>
                                <th rowspan="2" class="text-center align-middle">ZAKAT MAL</th>
                                <th rowspan="2" class="text-center align-middle">ZAKAT PENGHASILAN</th>
                                <th rowspan="2" class="text-center align-middle">INFAQ</th>
                                <th rowspan="2" class="text-center align-middle">JUMLAH</th>
                            </tr>
                            <tr>
                                <th class="text-center">RT 24</th>
                                <th class="text-center">RT 25</th>
                                <th class="text-center">RT 26</th>
                                <th class="text-center">RT 31</th>
                                <th class="text-center">RT 32</th>
                                <th class="text-center">RT 33</th>
                                <th class="text-center">BERAS</th>
                                <th class="text-center">UANG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekapitulasi as $rekap)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($rekap['tanggal'])->translatedFormat('d F Y') }}</td>
                                <td class="text-center">{{ $rekap->rt_24 }}</td>
                                <td class="text-center">{{ $rekap->rt_25 }}</td>
                                <td class="text-center">{{ $rekap->rt_26 }}</td>
                                <td class="text-center">{{ $rekap->rt_31 }}</td>
                                <td class="text-center">{{ $rekap->rt_32 }}</td>
                                <td class="text-center">{{ $rekap->rt_33 }}</td>
                                <td class="text-center">{{ $rekap->rw_01 }}</td>
                                <td class="text-right">{{ number_format($rekap['total_beras'] ?? 0, 1) }} Liter</td>
                                <td class="text-right">Rp {{ number_format($rekap['total_uang'] ?? 0, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($rekap['total_mal'] ?? 0, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($rekap['total_penghasilan'] ?? 0, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($rekap['total_infaq'] ?? 0, 0, ',', '.') }}</td>
                                <td class="text-right font-weight-bold">Rp {{ number_format($rekap['total_jumlah'] ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-primary text-white">
                            <tr>
                                <th colspan="2" class="text-center">TOTAL</th>
                                <th class="text-center" id="totalRT24">0</th>
                                <th class="text-center" id="totalRT25">0</th>
                                <th class="text-center" id="totalRT26">0</th>
                                <th class="text-center" id="totalRT31">0</th>
                                <th class="text-center" id="totalRT32">0</th>
                                <th class="text-center" id="totalRT33">0</th>
                                <th class="text-center" id="totalRW01">0</th>
                                <th class="text-right" id="totalBeras">0 Liter</th>
                                <th class="text-right" id="totalUang">Rp 0</th>
                                <th class="text-right" id="totalMal">Rp 0</th>
                                <th class="text-right" id="totalPenghasilan">Rp 0</th>
                                <th class="text-right" id="totalInfaq">Rp 0</th>
                                <th class="text-right font-weight-bold" id="totalJumlah">Rp 0</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#rekapTable').DataTable({
            responsive: true,
            drawCallback: function () {
                updateFooter();
            }
        });

        function updateFooter() {
            var total = {
                RT24: 0, RT25: 0, RT26: 0, RT31: 0, RT32: 0, RT33: 0, RW01: 0,
                Beras: 0, Uang: 0, Mal: 0, Penghasilan: 0, Infaq: 0, Jumlah: 0
            };

            // Loop hanya pada baris yang terlihat (telah difilter)
            $('#rekapTable tbody tr:visible').each(function () {
                var row = $(this).find("td");

                total.RT24 += parseInt(row.eq(2).text().trim()) || 0;
                total.RT25 += parseInt(row.eq(3).text().trim()) || 0;
                total.RT26 += parseInt(row.eq(4).text().trim()) || 0;
                total.RT31 += parseInt(row.eq(5).text().trim()) || 0;
                total.RT32 += parseInt(row.eq(6).text().trim()) || 0;
                total.RT33 += parseInt(row.eq(7).text().trim()) || 0;
                total.RW01 += parseInt(row.eq(8).text().trim()) || 0;
                total.Beras += parseFloat(row.eq(9).text().replace(" Liter", "").trim()) || 0;
                total.Uang += parseInt(row.eq(10).text().replace(/[^0-9]/g, "")) || 0;
                total.Mal += parseInt(row.eq(11).text().replace(/[^0-9]/g, "")) || 0;
                total.Penghasilan += parseInt(row.eq(12).text().replace(/[^0-9]/g, "")) || 0;
                total.Infaq += parseInt(row.eq(13).text().replace(/[^0-9]/g, "")) || 0;
                total.Jumlah += parseInt(row.eq(14).text().replace(/[^0-9]/g, "")) || 0;
            });

            // Update footer
            $("#totalRT24").text(total.RT24);
            $("#totalRT25").text(total.RT25);
            $("#totalRT26").text(total.RT26);
            $("#totalRT31").text(total.RT31);
            $("#totalRT32").text(total.RT32);
            $("#totalRT33").text(total.RT33);
            $("#totalRW01").text(total.RW01);
            $("#totalBeras").text(total.Beras.toFixed(1) + " Liter");
            $("#totalUang").text("Rp " + total.Uang.toLocaleString("id-ID"));
            $("#totalMal").text("Rp " + total.Mal.toLocaleString("id-ID"));
            $("#totalPenghasilan").text("Rp " + total.Penghasilan.toLocaleString("id-ID"));
            $("#totalInfaq").text("Rp " + total.Infaq.toLocaleString("id-ID"));
            $("#totalJumlah").text("Rp " + total.Jumlah.toLocaleString("id-ID"));
        }

        // Jalankan saat ada perubahan filter
        table.on('search.dt draw.dt', function () {
            updateFooter();
        });

        updateFooter(); // Panggil pertama kali setelah halaman dimuat
    });
</script>

@endsection
