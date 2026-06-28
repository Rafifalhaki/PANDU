@extends('layouts.app')
@section('title', 'Manajemen Absensi')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('pimpinan.absensi') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-auto">
                <label class="col-form-label">Filter Lokasi:</label>
            </div>
            <div class="col-auto">
                <select name="lokasi_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Lokasi</option>
                    @foreach($lokasis as $loc)
                        <option value="{{ $loc->id }}" {{ request('lokasi_id') == $loc->id ? 'selected' : '' }}>{{ $loc->nama }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Nama Mandor</th>
                        <th>Lokasi Proyek</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Pulang</th>
                        <th>Koordinat Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensis as $absen)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $absen->user->name }}</td>
                        <td>{{ $absen->lokasi->nama }}</td>
                        <td>{{ $absen->waktu_masuk->format('d/m/Y H:i') }}</td>
                        <td>{{ $absen->waktu_pulang ? $absen->waktu_pulang->format('d/m/Y H:i') : '-' }}</td>
                        <td><small class="text-muted">{{ $absen->koordinat_masuk }}</small></td>
                        <td>
                            @if($absen->is_offline)
                                <span class="badge bg-warning text-dark"><i class="bi bi-wifi-off"></i> Sync Offline</span>
                            @else
                                <span class="badge bg-success"><i class="bi bi-wifi"></i> Online</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
