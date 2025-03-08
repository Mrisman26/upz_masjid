@extends('Template.Index')

@section('title', 'Data Zakat - UPZ Masjid At-Taqwa')

@section('content')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Dashboard Zakat UPZ Masjid At-Taqwa</h1>

                    <div class="form-group">
                        <label for="filterTahun">Pilih Tahun:</label>
                        <select id="filterTahun" class="form-control">
                            @for ($i = now()->year; $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Grafik Zakat -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Grafik Total Zakat Fitrah (Beras & Uang)</h5>
                                    <canvas id="zakatFitrahChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-warning">Grafik Total Infaq</h5>
                                    <canvas id="infaqChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-success">Grafik Zakat Mal & Penghasilan</h5>
                                    <canvas id="zakatMalPenghasilanChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-info">Grafik Kepala Keluarga per RT/RW</h5>
                                    <canvas id="kepalaKeluargaChart"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <!-- Grafik Mustahik berdasarkan Kriteria -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-danger">Grafik Mustahik berdasarkan Kriteria</h5>
                                    <canvas id="mustahikKriteriaChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik Mustahik berdasarkan RT/RW -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-info">Grafik Mustahik berdasarkan RT/RW</h5>
                                    <canvas id="mustahikRtRwChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function checkCanvas(id) {
                var canvas = document.getElementById(id);
                if (!canvas) {
                    console.error("Canvas " + id + " tidak ditemukan!");
                    return false;
                }
                return canvas;
            }

            var zakatFitrahData = @json([$rekapitulasi->total_beras ?? 0, $rekapitulasi->total_uang ?? 0]);
            var infaqData = @json([$rekapitulasi->total_infaq ?? 0]);
            var zakatMalPenghasilanData = @json([$rekapitulasi->total_mal ?? 0, $rekapitulasi->total_penghasilan ?? 0]);
            var kepalaKeluargaLabels = @json($kepalaKeluargaStats->pluck('rt_rw'));
            var kepalaKeluargaData = @json($kepalaKeluargaStats->pluck('total_kepala_keluarga'));

            var ctx1 = checkCanvas("zakatFitrahChart");
            if (ctx1) {
                new Chart(ctx1.getContext("2d"), {
                    type: "bar",
                    data: {
                        labels: ["Beras", "Uang"],
                        datasets: [{
                            label: "Total Zakat Fitrah (Liter)",
                            data: [zakatFitrahData[0], 0],
                            backgroundColor: "#4e73df",
                            yAxisID: "y-liter"
                        }, {
                            label: "Total Zakat Fitrah (Rupiah)",
                            data: [0, zakatFitrahData[1]],
                            backgroundColor: "#1cc88a",
                            yAxisID: "y-rupiah"
                        }]
                    }
                });
            }

            var ctx2 = checkCanvas("infaqChart");
            if (ctx2) {
                new Chart(ctx2.getContext("2d"), {
                    type: "bar",
                    data: {
                        labels: ["Total Infaq"],
                        datasets: [{
                            label: "Total Infaq",
                            data: infaqData,
                            backgroundColor: "#f6c23e"
                        }]
                    }
                });
            }

            var ctx3 = checkCanvas("zakatMalPenghasilanChart");
            if (ctx3) {
                new Chart(ctx3.getContext("2d"), {
                    type: "bar",
                    data: {
                        labels: ["Zakat Mal", "Zakat Penghasilan"],
                        datasets: [{
                            label: "Total Zakat Mal",
                            data: zakatMalPenghasilanData,
                            backgroundColor: ["#36b9cc", "#e74a3b"]
                        }, {
                            label: "Total Zakat",
                            backgroundColor: ["#36b9cc", "#e74a3b"]
                        }]
                    }
                });
            }

            var ctx4 = checkCanvas("kepalaKeluargaChart");
            if (ctx4) {
                new Chart(ctx4.getContext("2d"), {
                    type: "bar",
                    data: {
                        labels: kepalaKeluargaLabels,
                        datasets: [{
                            label: "Jumlah Kepala Keluarga",
                            data: kepalaKeluargaData,
                            backgroundColor: "#4e73df"
                        }]
                    }
                });
            }

            document.getElementById("filterTahun").addEventListener("change", function () {
                window.location.href = "/dashboard?tahun=" + this.value;
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
        function checkCanvas(id) {
            var canvas = document.getElementById(id);
            if (!canvas) {
                console.error("Canvas " + id + " tidak ditemukan!");
                return false;
            }
            return canvas;
        }

        // Data Mustahik berdasarkan Kriteria
        var mustahikKriteriaLabels = @json($mustahikStats->pluck('kriteria'));
        var mustahikKriteriaData = @json($mustahikStats->pluck('total_mustahik'));

        var ctx5 = checkCanvas("mustahikKriteriaChart");
        if (ctx5) {
            new Chart(ctx5.getContext("2d"), {
                type: "bar",
                data: {
                    labels: mustahikKriteriaLabels,
                    datasets: [{
                        label: "Jumlah Mustahik",
                        data: mustahikKriteriaData,
                        backgroundColor: "#e74a3b"
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Data Mustahik berdasarkan RT/RW
        var mustahikRtRwLabels = @json($mustahikRtRwStats->pluck('rt_rw'));
        var mustahikRtRwData = @json($mustahikRtRwStats->pluck('total_mustahik'));

        var ctx6 = checkCanvas("mustahikRtRwChart");
        if (ctx6) {
            new Chart(ctx6.getContext("2d"), {
                type: "bar",
                data: {
                    labels: mustahikRtRwLabels,
                    datasets: [{
                        label: "Jumlah Mustahik",
                        data: mustahikRtRwData,
                        backgroundColor: "#36b9cc"
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Filter tahun
        document.getElementById("filterTahun").addEventListener("change", function () {
            window.location.href = "/dashboard?tahun=" + this.value;
        });
    });

    </script>

@endsection
