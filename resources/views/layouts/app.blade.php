<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'University Course Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%);
            padding-top: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            background: rgba(0,0,0,0.2);
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand h4 {
            color: white;
            margin: 0;
            font-weight: 700;
            font-size: 18px;
        }

        .sidebar-brand p {
            color: #bdc3c7;
            margin: 5px 0 0 0;
            font-size: 12px;
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
        }

        .nav-menu li {
            margin: 0;
        }

        .nav-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-menu a:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: var(--secondary-color);
            color: white;
        }

        .nav-menu a.active {
            background: rgba(52, 152, 219, 0.2);
            border-left-color: var(--secondary-color);
            color: var(--secondary-color);
            font-weight: 600;
        }

        .nav-menu i {
            width: 25px;
            text-align: center;
            margin-right: 12px;
        }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 70px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            padding: 0 30px;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .topbar-left {
            flex: 1;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        /* Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-top: 4px solid var(--secondary-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }

        .stat-card.students { border-top-color: #3498db; }
        .stat-card.courses { border-top-color: #2ecc71; }
        .stat-card.enrollments { border-top-color: #e74c3c; }
        .stat-card.payments { border-top-color: #f39c12; }

        .stat-icon {
            font-size: 36px;
            margin-bottom: 15px;
            display: inline-block;
        }

        .stat-card.students .stat-icon { color: #3498db; }
        .stat-card.courses .stat-icon { color: #2ecc71; }
        .stat-card.enrollments .stat-icon { color: #e74c3c; }
        .stat-card.payments .stat-icon { color: #f39c12; }

        .stat-card h5 {
            color: #7f8c8d;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Tables */
        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-card-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            background: #f8f9fa;
        }

        .table-card-header h5 {
            margin: 0;
            color: var(--primary-color);
            font-weight: 600;
        }

        .table-card-body {
            padding: 0;
        }

        .table-card table {
            margin: 0;
        }

        /* Buttons */
        .btn-primary {
            background: var(--secondary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-graduation-cap"></i> University CMS</h4>
            <p>Course Management</p>
        </div>
        <ul class="nav-menu">
            <li><a href="/dashboard" class="{{ request()->is('dashboard*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
            <li><a href="/enrollments" class="{{ request()->is('enrollments*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Enrollments</a></li>
            <li><a href="/schedules" class="{{ request()->is('schedules*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> Schedules</a></li>
            <li><a href="/grades" class="{{ request()->is('grades*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Grades</a></li>
            <li><a href="/payments" class="{{ request()->is('payments*') ? 'active' : '' }}"><i class="fas fa-credit-card"></i> Payments</a></li>
        </ul>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-left">
            <h6 class="topbar-title">@yield('page-title', 'Dashboard')</h6>
        </div>
        <div class="topbar-right">
            <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>