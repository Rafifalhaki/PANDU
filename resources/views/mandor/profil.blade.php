@extends('layouts.mobile')

@section('content')
<div class="card shadow-sm border-0 mb-4" style="border-radius: 15px; margin-top: 10px;">
    <div class="card-body text-center py-5">
        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 100px; height: 100px; border: 3px solid var(--primary);">
            <i class="bi bi-person-fill text-primary" style="font-size: 4rem;"></i>
        </div>
        <h4 class="fw-bold mb-1" style="color: var(--primary);">{{ $user->name }}</h4>
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm">{{ $user->role }}</span>
        
        <p class="text-muted mb-0"><i class="bi bi-envelope-fill me-2 text-warning"></i>{{ $user->email }}</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center">
                <h5 class="fw-bold text-success mb-1">{{ $totalHadir }} Hari</h5>
                <small class="text-muted fw-semibold">Total Kehadiran</small>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center">
                <h5 class="fw-bold text-primary mb-1">Aktif</h5>
                <small class="text-muted fw-semibold">Status Akun</small>
            </div>
        </div>
    </div>
</div>

<h6 class="fw-bold mb-3 ms-1 text-muted" style="letter-spacing: 0.5px; text-transform: uppercase; font-size: 0.8rem;">Pengaturan Akun</h6>
<div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-bottom" style="border-color: #f0f0f0 !important;">
                <span class="fw-semibold"><i class="bi bi-phone text-primary me-3 fs-5 align-middle"></i> ID Perangkat</span>
                <span class="text-muted small text-truncate" style="max-width: 130px;">{{ $user->device_id ?: 'Belum terdaftar' }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-bottom" style="border-color: #f0f0f0 !important;" onclick="alert('Fitur ganti password segera hadir')" style="cursor: pointer;">
                <span class="fw-semibold"><i class="bi bi-shield-lock text-primary me-3 fs-5 align-middle"></i> Ganti Password</span>
                <i class="bi bi-chevron-right text-muted"></i>
            </li>
            <li class="list-group-item py-4 text-center border-0 bg-light">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill fw-bold py-2"><i class="bi bi-box-arrow-right me-2"></i>KELUAR AKUN</button>
                </form>
            </li>
        </ul>
    </div>
</div>
@endsection
