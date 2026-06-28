<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANDU - Pimpinan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #1F4E79;
            --accent: #E87722;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: var(--primary); color: white; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background-color: rgba(255,255,255,0.1); color: white; border-left: 4px solid var(--accent); }
        .navbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .btn-primary { background-color: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background-color: #153856; }
        .text-primary { color: var(--primary) !important; }
        .badge-accent { background-color: var(--accent); color: white; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0 p-3" style="width: 250px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none border-bottom pb-3">
                <i class="bi bi-geo-alt-fill fs-4 me-2" style="color: var(--accent)"></i>
                <span class="fs-4 fw-bold">Platform PANDU</span>
            </a>
            <ul class="nav nav-pills flex-column mb-auto mt-3">
                <li class="nav-item">
                    <a href="{{ route('pimpinan.dashboard') }}" class="nav-link {{ request()->routeIs('pimpinan.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('pimpinan.tracking') }}" class="nav-link {{ request()->routeIs('pimpinan.tracking') ? 'active' : '' }}">
                        <i class="bi bi-truck me-2"></i> Tracking Unit
                    </a>
                </li>
                <li>
                    <a href="{{ route('pimpinan.absensi') }}" class="nav-link {{ request()->routeIs('pimpinan.absensi') ? 'active' : '' }}">
                        <i class="bi bi-person-check me-2"></i> Absensi
                    </a>
                </li>
                <li>
                    <a href="{{ route('pimpinan.laporan') }}" class="nav-link {{ request()->routeIs('pimpinan.laporan') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('pimpinan.pengaturan') }}" class="nav-link {{ request()->routeIs('pimpinan.pengaturan') ? 'active' : '' }}">
                        <i class="bi bi-gear me-2"></i> Pengaturan
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-expand-lg px-4 py-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 fw-bold text-primary">@yield('title')</span>
                    <div class="d-flex align-items-center">
                        <span class="me-3 fw-semibold">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
