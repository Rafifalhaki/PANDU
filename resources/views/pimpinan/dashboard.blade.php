@extends('layouts.app')
@section('title', 'Dashboard Utama')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-semibold">Mandor Hadir Hari Ini</h6>
                <h3 class="fw-bold">{{ $totalHadir }} <i class="bi bi-person-check-fill text-success fs-4 float-end"></i></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-semibold">Total Lokasi Aktif</h6>
                <h3 class="fw-bold">{{ $totalLokasi }} <i class="bi bi-geo-alt-fill text-primary fs-4 float-end"></i></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-semibold">Unit Alat Berat Aktif</h6>
                <h3 class="fw-bold">{{ $totalUnitAktif }} <i class="bi bi-truck text-info fs-4 float-end"></i></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm {{ $idleCount > 0 ? 'bg-danger text-white' : '' }}">
            <div class="card-body">
                <h6 class="{{ $idleCount > 0 ? 'text-white' : 'text-muted' }} fw-semibold">Unit Idle (> 3 Jam)</h6>
                <h3 class="fw-bold">{{ $idleCount }} <i class="bi bi-exclamation-triangle-fill {{ $idleCount > 0 ? 'text-warning' : 'text-secondary' }} fs-4 float-end"></i></h3>
            </div>
        </div>
    </div>
</div>

@if($idleCount > 0)
<div class="alert alert-danger shadow-sm border-0 mb-4">
    <h5 class="alert-heading"><i class="bi bi-exclamation-octagon-fill"></i> Peringatan Unit Idle!</h5>
    <p class="mb-0">Terdapat unit alat berat yang berstatus idle lebih dari 3 jam:</p>
    <ul class="mb-0 mt-2">
        @foreach($idleAlerts as $alert)
            <li><strong>{{ $alert->nama_unit }}</strong> ({{ $alert->lokasi->nama }}) - Terakhir terlihat: {{ $alert->last_seen->diffForHumans() }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row g-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="fw-bold">Kehadiran Mandor per Lokasi</h5>
            </div>
            <div class="card-body">
                <canvas id="kehadiranChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="fw-bold">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentAbsensi as $absen)
                    <div class="list-group-item py-3 border-bottom-0">
                        <div class="d-flex w-100 justify-content-between mb-1">
                            <h6 class="mb-0 fw-bold">{{ $absen->user->name }}</h6>
                            <small class="text-muted">{{ $absen->waktu_masuk->format('H:i') }}</small>
                        </div>
                        <p class="mb-1 small">{{ $absen->lokasi->nama }}</p>
                        @if($absen->waktu_pulang)
                            <span class="badge bg-secondary">Sudah Pulang</span>
                        @else
                            <span class="badge bg-success">Hadir</span>
                        @endif
                    </div>
                    @empty
                    <div class="p-4 text-center text-muted">Belum ada aktivitas hari ini.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('kehadiranChart').getContext('2d');
    const chartData = @json($chartData);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Aktual Hadir',
                    data: chartData.actual,
                    backgroundColor: '#1F4E79',
                },
                {
                    label: 'Target Mandor',
                    data: chartData.planned,
                    backgroundColor: '#E87722',
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endsection
