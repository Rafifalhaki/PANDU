@extends('layouts.app')
@section('title', 'Tracking Unit Alat Berat')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-4">
            <h5 class="fw-bold">Daftar Unit</h5>
            <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Unit</button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Unit</th>
                        <th>Tipe</th>
                        <th>Lokasi Terakhir</th>
                        <th>Status</th>
                        <th>Terakhir Terlihat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                    <tr class="{{ ($unit->status == 'idle' && $unit->last_seen && $unit->last_seen->diffInHours(now()) >= 3) ? 'table-warning' : '' }}">
                        <td class="fw-bold">{{ $unit->nama_unit }}</td>
                        <td>{{ $unit->tipe }}</td>
                        <td>{{ $unit->lokasi->nama }}</td>
                        <td>
                            @if($unit->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @elseif($unit->status == 'idle')
                                <span class="badge bg-warning text-dark">Idle</span>
                            @else
                                <span class="badge bg-danger">Offline</span>
                            @endif
                        </td>
                        <td>{{ $unit->last_seen ? $unit->last_seen->diffForHumans() : '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
