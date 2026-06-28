<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Platform PANDU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1F4E79; display: flex; align-items: center; justify-content: center; height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .login-card { background: white; padding: 2.5rem; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        .btn-primary { background-color: #E87722; border: none; font-size: 1.1rem; }
        .btn-primary:hover { background-color: #d16b1e; }
    </style>
</head>
<body>
    <div class="login-card text-center">
        <h2 class="fw-bold mb-2" style="color: #1F4E79;">Platform PANDU</h2>
        <p class="text-muted mb-4 small">Pantau Alokasi Naker & Distribusi Unit</p>

        @if($errors->any())
            <div class="alert alert-danger text-start">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
            </div>
            <div class="mb-4 text-start">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">MASUK</button>
        </form>
    </div>
</body>
</html>
