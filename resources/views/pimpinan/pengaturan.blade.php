@extends('layouts.app')
@section('title', 'Pengaturan')

@section('content')
<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-4">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Manajemen Pengguna</h5>
                    <button class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($users as $user)
                    <div class="list-group-item d-flex justify-content-between align-items-center px-0 border-bottom-0" style="border-bottom: 1px solid #eee !important;">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                            <small class="text-muted">{{ $user->email }}</small>
                        </div>
                        <span class="badge bg-{{ $user->role == 'pimpinan' ? 'primary' : 'secondary' }}">{{ ucfirst($user->role) }}</span>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-4">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Manajemen Lokasi Proyek</h5>
                    <button class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($lokasis as $loc)
                    <div class="list-group-item px-0 border-bottom-0" style="border-bottom: 1px solid #eee !important;">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="mb-0 fw-bold">{{ $loc->nama }}</h6>
                            <small class="text-muted">{{ $loc->radius_meter }}m</small>
                        </div>
                        <small class="text-muted">{{ $loc->lat }}, {{ $loc->lng }}</small>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
