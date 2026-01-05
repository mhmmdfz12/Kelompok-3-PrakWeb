<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Posyandu</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            /* 1. BACKGROUND FOTO (Seragam dengan Login & Dashboard) */
            background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
            background-size: cover;
            /* Overlay Hitam Tipis agar form lebih menonjol */
            box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.2);
            
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        
        .card-register {
            /* Efek Kaca (Glassmorphism) */
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 500px;
            padding: 2.5rem;
        }

        .btn-success {
            background: linear-gradient(to right, #11998e, #38ef7d);
            border: none;
            transition: 0.3s;
        }
        .btn-success:hover {
            background: linear-gradient(to right, #38ef7d, #11998e);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="card card-register">
    <div class="text-center mb-4">
        <h3 class="fw-bold text-success"><i class="fas fa-user-plus me-2"></i> Buat Akun Baru</h3>
        <p class="text-muted small">Bergabunglah menjadi kader posyandu</p>
    </div>
@if ($errors->any())
    <div class="alert alert-danger small py-2">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label small text-secondary fw-bold">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="name" class="form-control border-start-0 ps-0" placeholder="Nama Anda..." required>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label small text-secondary fw-bold">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-at text-muted"></i></span>
                <input type="text" name="username" class="form-control border-start-0 ps-0" placeholder="Username unik..." required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small text-secondary fw-bold">Email</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="email@contoh.com" required>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <label class="form-label small text-secondary fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control border-start-0 ps-0" required>
                </div>
            </div>
            <div class="col-6">
                <label class="form-label small text-secondary fw-bold">Ulangi Pass</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" name="password_confirmation" class="form-control border-start-0 ps-0" required>
                </div>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success rounded-pill py-2 fw-bold shadow-sm">
                DAFTAR SEKARANG <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </div>
    </form>

    <div class="text-center mt-4">
        <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-success">Login disini</a></small>
    </div>
</div>

</body>
</html>