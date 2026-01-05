<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Posyandu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-login {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            max-width: 850px;
            width: 100%;
            overflow: hidden; /* Memastikan border-radius bekerja pada kolom gambar */
        }

        .login-image {
            background: url('https://images.unsplash.com/photo-1555252333-9f8e92e65df9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center/cover;
        }

        .btn-primary {
            background: linear-gradient(to right, #4e73df, #224abe);
            border: none;
        }
    </style>
</head>
<body>

<div class="card card-login">
    <div class="row g-0">
        <div class="col-md-6 d-none d-md-block login-image"></div>

        <div class="col-md-6 p-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">
                    <i class="fas fa-heartbeat me-2"></i> POSYANDU
                </h3>
                <p class="text-muted small">
                    Silakan masuk sebagai admin untuk mengelola data
                </p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger small">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                    <label>Email</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <label>Password</label>
                </div>

                <button class="btn btn-primary w-100 py-2 fw-bold rounded-pill shadow-sm">
                    MASUK
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="mb-0 small text-muted">Belum memiliki akun admin?</p>
                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none small">Daftar Sekarang</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>