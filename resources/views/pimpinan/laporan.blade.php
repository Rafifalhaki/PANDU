@extends('layouts.app')
@section('title', 'Laporan Harian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Rekapitulasi Laporan Harian</h5>
    </div>
    <div>
        <button class="btn btn-outline-danger me-2" onclick="alert('Fitur Export PDF akan segera hadir')"><i class="bi bi-file-earmark-pdf"></i> Export PDF</button>
        <button class="btn btn-outline-success" onclick="alert('Fitur Export Excel akan segera hadir')"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Lokasi Proyek</th>
                        <th>Total Hadir</th>
                        <th>Unit Aktif</th>
                        <th>Unit Idle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporans as $lap)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $lap->tanggal->format('d M Y') }}</td>
                        <td>{{ $lap->lokasi->nama }}</td>
                        <td>{{ $lap->total_hadir }} Orang</td>
                        <td><span class="badge bg-success">{{ $lap->total_unit_aktif }} Unit</span></td>
                        <td><span class="badge bg-warning text-dark">{{ $lap->total_unit_idle }} Unit</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
