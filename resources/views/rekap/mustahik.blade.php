@extends('Template.Index')

@section('title', 'Rekap Data Mustahik - UPZ Masjid At-Taqwa')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Data Mustahik</h1>

    <!-- Filter Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('rekap-mustahik') }}" class="form-inline">
                <div class="form-group mr-3">
                    <label for="kriteria" class="mr-2">Kriteria</label>
                    <select name="kriteria" id="kriteria" class="form-control">
                        <option value="">Semua</option>
                        @foreach (['Fakir', 'Miskin', 'Amil', 'Mualaf', 'Gharim', 'Riqab', 'Fi Sabilillah', 'Ibnu Sabil'] as $item)
                            <option value="{{ $item }}" {{ request('kriteria') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="rt_rw" class="mr-2">RT/RW</label>
                    <select name="rt_rw_id" id="rt_rw_id" class="form-control">
                        <option value="">Semua</option>
                        @foreach ($rtRws as $rtRw)
                            <option value="{{ $rtRw->id }}" {{ request('rt_rw_id') == $rtRw->id ? 'selected' : '' }}>
                                RT {{ $rtRw->rt }} / RW {{ $rtRw->rw }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mr-3">
                    <label for="tahun" class="mr-2">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Semua</option>
                        @foreach ($tahun_list as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Tabel Data Mustahik -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Mustahik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kriteria</th>
                            <th>RT/RW</th>
                            <th>Keterangan</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mustahiks as $index => $mustahik)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mustahik->name }}</td>
                            <td>{{ $mustahik->kriteria }}</td>
                            <td>RT {{ optional($mustahik->rtRw)->rt }} / RW {{ optional($mustahik->rtRw)->rw }}</td>
                            <td>{{ $mustahik->keterangan ?? '-' }}</td>
                            {{-- <td>
                                <a href="{{ route('mustahik.edit', $mustahik->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('mustahik.destroy', $mustahik->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
