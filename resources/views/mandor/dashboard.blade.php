@extends('layouts.mobile')

@section('content')
<style>
    .premium-card {
        border-radius: 20px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.02);
        overflow: hidden;
    }
    .pulse-btn {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(232, 119, 34, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(232, 119, 34, 0); }
        100% { box-shadow: 0 0 0 0 rgba(232, 119, 34, 0); }
    }
    .status-badge {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .history-card {
        border-radius: 15px;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 12px;
        border: none;
        transition: transform 0.2s;
    }
    .history-card:hover {
        transform: translateY(-2px);
    }
</style>

<div class="premium-card mb-4 position-relative">
    <div class="position-absolute top-0 end-0 p-3 opacity-25">
        <i class="bi bi-buildings-fill" style="font-size: 6rem; color: var(--primary);"></i>
    </div>
    <div class="card-body text-center py-5 position-relative z-1">
        <!-- Live Clock -->
        <h1 class="fw-bold mb-0" id="live-clock" style="color: var(--primary); font-size: 3rem; letter-spacing: -1px;">--:--</h1>
        <p class="text-muted small mb-4" id="live-date">Memuat tanggal...</p>

        <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
        <p class="text-muted small mb-4"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $lokasi->nama }}</p>

        @if($absensiHariIni && $absensiHariIni->waktu_pulang)
            <div class="status-badge bg-secondary text-white mb-4 d-inline-block"><i class="bi bi-check-all me-1"></i> Selesai Bekerja</div>
        @elseif($absensiHariIni)
            <div class="status-badge bg-success text-white mb-4 d-inline-block shadow-sm"><i class="bi bi-check-circle me-1"></i> Sedang Bekerja</div>
        @else
            <div class="status-badge bg-warning text-dark mb-4 d-inline-block shadow-sm"><i class="bi bi-clock me-1"></i> Belum Absen Masuk</div>
        @endif

        <div id="gps-status" class="alert alert-info py-2 small mb-4 rounded-3 border-0 shadow-sm text-start" style="display:none; font-weight: 600;">
            <span class="spinner-grow spinner-grow-sm me-2" role="status" aria-hidden="true"></span>Mencari lokasi GPS...
        </div>

        @if(!$absensiHariIni)
            <form action="{{ route('mandor.absen.masuk') }}" method="POST" id="formAbsenMasuk">
                @csrf
                <input type="hidden" name="lokasi_id" value="{{ $lokasi->id }}">
                <input type="hidden" name="lat" id="latMasuk">
                <input type="hidden" name="lng" id="lngMasuk">
                <button type="button" onclick="getLocation('masuk')" class="btn btn-accent btn-lg w-100 rounded-pill shadow-lg py-3 pulse-btn" id="btnMasuk">
                    <i class="bi bi-fingerprint fs-3 me-2 align-middle"></i> <span class="fw-bold fs-5 align-middle">ABSEN MASUK</span>
                </button>
            </form>
        @elseif(!$absensiHariIni->waktu_pulang)
            <form action="{{ route('mandor.absen.pulang') }}" method="POST" id="formAbsenPulang">
                @csrf
                <input type="hidden" name="absensi_id" value="{{ $absensiHariIni->id }}">
                <input type="hidden" name="lat" id="latPulang">
                <input type="hidden" name="lng" id="lngPulang">
                <button type="button" onclick="getLocation('pulang')" class="btn btn-danger btn-lg w-100 rounded-pill shadow-lg py-3 pulse-btn" id="btnPulang">
                    <i class="bi bi-box-arrow-left fs-3 me-2 align-middle"></i> <span class="fw-bold fs-5 align-middle">ABSEN PULANG</span>
                </button>
            </form>
        @endif
        
        <div class="alert alert-warning py-2 small mt-4 mb-0 rounded-3 border-0 shadow-sm" id="offline-banner" style="display:none;">
            <i class="bi bi-wifi-off me-1"></i> <strong>Offline Mode</strong> - Data akan dikirim otomatis saat koneksi pulih.
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3 px-2 mt-4">
    <h6 class="fw-bold mb-0 text-muted" style="letter-spacing: 0.5px; text-transform: uppercase; font-size: 0.8rem;">Riwayat 7 Hari Terakhir</h6>
    <i class="bi bi-clock-history text-muted"></i>
</div>

<div class="mb-5 pb-3">
    @forelse($history as $hist)
        <div class="card history-card">
            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-light rounded p-2 me-3 text-center" style="width: 50px;">
                        <span class="d-block fw-bold text-primary" style="font-size: 1.1rem; line-height: 1;">{{ $hist->waktu_masuk->format('d') }}</span>
                        <span class="d-block text-muted" style="font-size: 0.7rem;">{{ $hist->waktu_masuk->format('M') }}</span>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;">{{ $hist->lokasi->nama }}</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Radius {{ $hist->lokasi->radius_meter }}m</small>
                    </div>
                </div>
                <div class="text-end">
                    <div class="small fw-bold text-success mb-1">
                        <i class="bi bi-arrow-down-circle-fill me-1"></i>{{ $hist->waktu_masuk->format('H:i') }}
                    </div>
                    <div class="small fw-bold {{ $hist->waktu_pulang ? 'text-danger' : 'text-warning' }}">
                        <i class="bi bi-arrow-up-circle-fill me-1"></i>{{ $hist->waktu_pulang ? $hist->waktu_pulang->format('H:i') : '--:--' }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-journal-x text-muted fs-1"></i>
            </div>
            <h6 class="fw-bold text-muted">Belum ada riwayat</h6>
            <p class="text-muted small">Riwayat absensi Anda akan muncul di sini.</p>
        </div>
    @endforelse
</div>
@endsection

@section('scripts')
<script>
    // Live Clock
    function updateClock() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        const dateStr = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('live-clock').innerText = timeStr.replace('.', ':');
        document.getElementById('live-date').innerText = dateStr;
    }
    setInterval(updateClock, 1000);
    updateClock();

    function getLocation(type) {
        const statusEl = document.getElementById('gps-status');
        const btn = type === 'masuk' ? document.getElementById('btnMasuk') : document.getElementById('btnPulang');
        
        statusEl.style.display = 'block';
        statusEl.className = 'alert alert-info py-2 small mb-4 rounded-3 border-0 shadow-sm text-start';
        statusEl.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Mencari koordinat GPS Anda...';
        
        const originalBtnContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Memproses...';
        btn.classList.remove('pulse-btn');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                statusEl.className = 'alert alert-success py-2 small mb-4 rounded-3 border-0 shadow-sm text-start fade-in';
                statusEl.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Lokasi GPS Terkunci. Memverifikasi...';
                
                if(type === 'masuk') {
                    document.getElementById('latMasuk').value = position.coords.latitude;
                    document.getElementById('lngMasuk').value = position.coords.longitude;
                    setTimeout(() => document.getElementById('formAbsenMasuk').submit(), 800);
                } else {
                    document.getElementById('latPulang').value = position.coords.latitude;
                    document.getElementById('lngPulang').value = position.coords.longitude;
                    setTimeout(() => document.getElementById('formAbsenPulang').submit(), 800);
                }
            }, function(error) {
                statusEl.className = 'alert alert-danger py-2 small mb-4 rounded-3 border-0 shadow-sm text-start fade-in';
                statusEl.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-2"></i>Gagal mendapatkan GPS. Pastikan GPS diizinkan browser.';
                btn.disabled = false;
                btn.innerHTML = originalBtnContent;
                if(type === 'masuk' || type === 'pulang') btn.classList.add('pulse-btn');
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
            btn.disabled = false;
            btn.innerHTML = originalBtnContent;
        }
    }

    // Offline detection
    window.addEventListener('online',  updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);

    function updateOnlineStatus() {
        const offlineBanner = document.getElementById('offline-banner');
        if (!navigator.onLine) {
            offlineBanner.style.display = 'block';
            offlineBanner.classList.add('fade-in');
        } else {
            offlineBanner.style.display = 'none';
        }
    }
    updateOnlineStatus();
</script>
@endsection
