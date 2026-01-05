<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Posyandu - @yield('title', 'Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Background */
        body {
            background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.1);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, rgba(78, 115, 223, 0.95) 10%, rgba(34, 74, 190, 0.95) 100%);
            color: white;
            backdrop-filter: blur(5px);
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .nav-link { 
            color: rgba(255,255,255,0.8); 
            margin-bottom: 8px; 
            padding: 12px 15px; 
            border-radius: 10px; 
            transition: 0.3s; 
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.2);
            font-weight: bold;
            transform: translateX(5px);
        }
        
        /* Card Glass Effect */
        .card-glass {
            background: rgba(255, 255, 255, 0.92);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }
        .card-glass:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .page-title {
            color: white;
            text-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }
    </style>
    @yield('extra_css')
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <!-- SIDEBAR MENU -->
        <div class="col-md-2 col-lg-2 sidebar p-3">
            <h5 class="text-center fw-bold mb-4 mt-2">
                <i class="fas fa-heartbeat me-1"></i> POSYANDU
            </h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-2" style="width: 25px;"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ibu.*') ? 'active' : '' }}" href="{{ route('ibu.index') }}">
                        <i class="fas fa-female me-2" style="width: 25px;"></i> Data Ibu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kader.*') ? 'active' : '' }}" href="{{ route('kader.index') }}">
                        <i class="fas fa-users me-2" style="width: 25px;"></i> Data Kader
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('balita.*') ? 'active' : '' }}" href="{{ route('balita.index') }}">
                        <i class="fas fa-child me-2" style="width: 25px;"></i> Data Balita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('penimbangan.*') ? 'active' : '' }}" href="{{ route('penimbangan.index') }}">
                        <i class="fas fa-weight me-2" style="width: 25px;"></i> Penimbangan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('imunisasi.*') ? 'active' : '' }}" href="{{ route('imunisasi.index') }}">
                        <i class="fas fa-syringe me-2" style="width: 25px;"></i> Imunisasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('vitamin.*') ? 'active' : '' }}" href="{{ route('vitamin.index') }}">
                        <i class="fas fa-pills me-2" style="width: 25px;"></i> Vitamin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}" href="{{ route('jadwal.index') }}">
                        <i class="fas fa-calendar me-2" style="width: 25px;"></i> Jadwal Posyandu
                    </a>
                </li>
                
                <li class="nav-item mt-5 pt-3 border-top border-light">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link bg-danger text-white w-100 text-start border-0 shadow-sm">
                            <i class="fas fa-sign-out-alt me-2" style="width: 25px;"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="col-md-10 col-lg-10 p-4 p-md-5">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('extra_js')
</body>
</html>