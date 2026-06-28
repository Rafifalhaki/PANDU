<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANDU - Mandor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1F4E79">
    <link rel="apple-touch-icon" href="/icons/icon-192x192.png">
    <style>
        :root {
            --primary: #1F4E79;
            --primary-dark: #123354;
            --accent: #E87722;
            --accent-hover: #cf6619;
            --bg-color: #f4f7f6;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        #app-container {
            width: 100%;
            max-width: 480px;
            background-color: var(--bg-color);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 40px rgba(0,0,0,0.3);
            padding-bottom: 80px;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }
        .navbar-mobile { 
            background: linear-gradient(90deg, var(--primary) 0%, #2a6a9e 100%); 
            color: white; 
            padding: 20px; 
            text-align: center; 
            font-weight: 700; 
            font-size: 1.3rem; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin-bottom: 10px;
        }
        .btn-primary { background-color: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background-color: var(--primary-dark); }
        .btn-accent { background-color: var(--accent); color: white; border: none; }
        .btn-accent:hover { background-color: var(--accent-hover); color: white; }
        
        .bottom-nav { 
            position: fixed; 
            bottom: 0; 
            width: 100%; 
            max-width: 480px;
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px);
            box-shadow: 0 -5px 20px rgba(0,0,0,0.05); 
            display: flex; 
            justify-content: space-around; 
            padding: 12px 0; 
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            z-index: 1000; 
        }
        .bottom-nav a { 
            color: #a0aab5; 
            text-align: center; 
            text-decoration: none; 
            font-size: 0.85rem; 
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .bottom-nav a.active { color: var(--primary); transform: translateY(-3px); }
        .bottom-nav i { font-size: 1.6rem; display: block; margin-bottom: 4px; }
        .bottom-nav a:hover { color: var(--accent); }

        /* Smooth page transition */
        .fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div id="app-container">
        <div class="navbar-mobile d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="bg-white rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                    <i class="bi bi-geo-alt-fill" style="color: var(--accent); font-size: 1.4rem;"></i>
                </div>
                <span>PANDU</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-light rounded-circle shadow-sm" style="width:40px; height:40px;">
                    <i class="bi bi-box-arrow-right text-danger"></i>
                </button>
            </form>
        </div>

        <div class="container mt-2 flex-grow-1 fade-in">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm rounded-3"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}</div>
            @endif
            
            @yield('content')
        </div>

        <div class="bottom-nav">
            <a href="{{ route('mandor.dashboard') }}" class="{{ request()->routeIs('mandor.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i> Beranda
            </a>
            <a href="{{ route('mandor.profil') }}" class="{{ request()->routeIs('mandor.profil') ? 'active' : '' }}">
                <i class="bi bi-person-fill"></i> Profil
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then(registration => {
                    console.log('SW registered');
                }).catch(err => {
                    console.log('SW registration failed: ', err);
                });
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
