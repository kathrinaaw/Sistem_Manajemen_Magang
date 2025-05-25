<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - Sistem Manajemen Magang</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 30px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar-title {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-title {
            opacity: 0;
        }

        .user-info {
            padding: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 12px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar.collapsed .user-details {
            display: none;
        }

        .nav-menu {
            padding: 20px 0;
            flex: 1;
        }

        .nav-item {
            margin: 5px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #4a5568;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            gap: 15px;
        }

        .nav-link:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-text {
            font-size: 14px;
            font-weight: 500;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
        }

        .toggle-btn {
            position: absolute;
            right: -15px;
            top: 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 80px;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-btn {
            position: relative;
            background: transparent;
            border: none;
            font-size: 20px;
            color: #4a5568;
            cursor: pointer;
            padding: 10px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 8px;
            height: 8px;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            padding-bottom: 50px;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .stat-title {
            font-size: 14px;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            color: #10b981;
        }

        /* Quick Actions */
        .quick-actions {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        /* Recent Activity */
        .recent-activity {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .activity-time {
            font-size: 12px;
            color: #718096;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .content-area {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="sidebar-header">
            <div class="logo">PNC</div>
            <div class="sidebar-title">Admin Panel</div>
        </div>

        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr($user->nama ?? 'AD', 0, 2)) }}</div>
            <div class="user-details">
                <div class="user-name">{{ $user->nama ?? 'Administrator' }}</div>
                <div class="user-role">{{ ucfirst($user->role ?? 'Admin') }}</div>
            </div>
        </div>

        <nav class="nav-menu">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link" data-page="mahasiswa">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <span class="nav-text">Data Mahasiswa</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.perusahaan.index') }}" class="nav-link" data-page="perusahaan">
                    <i class="nav-icon fas fa-building"></i>
                    <span class="nav-text">Data Perusahaan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.pembimbing.index') }}" class="nav-link" data-page="pembimbing">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <span class="nav-text">Data Pembimbing</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.magang.index') }}" class="nav-link" data-page="magang">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <span class="nav-text">Magang</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="header">
            <h1 class="page-title">Dashboard Admin</h1>
            <div class="header-actions">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge"></span>
                </button>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="notification-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="content-area">
            <!-- Dashboard Stats -->
            <div class="dashboard-grid">
                <a href="{{ route('admin.mahasiswa.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-header">
                        <span class="stat-title">Total Mahasiswa</span>
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['mahasiswa']) }}</div>
                    <div class="stat-change">
                        <i class="fas fa-users"></i>
                        <span>Mahasiswa terdaftar</span>
                    </div>
                </a>

                <a href="{{ route('admin.perusahaan.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-header">
                        <span class="stat-title">Perusahaan Mitra</span>
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['perusahaan']) }}</div>
                    <div class="stat-change">
                        <i class="fas fa-handshake"></i>
                        <span>Mitra aktif</span>
                    </div>
                </a>

                <a href="{{ route('admin.pembimbing.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-header">
                        <span class="stat-title">Pembimbing</span>
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['pembimbing']) }}</div>
                    <div class="stat-change">
                        <i class="fas fa-user-tie"></i>
                        <span>Pembimbing aktif</span>
                    </div>
                </a>

                <!-- <a href="{{ route('admin.magang.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-header">
                        <span class="stat-title">Program Magang</span>
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['magang']) }}</div>
                    <div class="stat-change">
                        <i class="fas fa-chart-line"></i>
                        <span>Program berjalan</span>
                    </div>
                </a> -->
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2 class="section-title">Aksi Cepat</h2>
                <div class="action-grid">
                    <a href="{{ route('admin.mahasiswa.create') }}" class="action-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>Tambah Mahasiswa</span>
                    </a>
                    <a href="{{ route('admin.perusahaan.create') }}" class="action-btn">
                        <i class="fas fa-building"></i>
                        <span>Tambah Perusahaan</span>
                    </a>
                    <a href="{{ route('admin.pembimbing.create') }}" class="action-btn">
                        <i class="fas fa-user-tie"></i>
                        <span>Tambah Pembimbing</span>
                    </a>
                    <a href="{{ route('admin.magang.create') }}" class="action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>Tambah Program Magang</span>
                    </a>
                </div>
            </div>

            <!-- Statistics Summary -->
            <div class="recent-activity">
                <h2 class="section-title">Ringkasan Sistem</h2>
                <div class="activity-item">
                    <div class="activity-icon" style="background: linear-gradient(135deg, #48bb78, #38a169);">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Total Mahasiswa: {{ $stats['mahasiswa'] }} orang</div>
                        <div class="activity-time">Data mahasiswa yang terdaftar dalam sistem</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Perusahaan Mitra: {{ $stats['perusahaan'] }} perusahaan</div>
                        <div class="activity-time">Perusahaan yang bermitra untuk program magang</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: linear-gradient(135deg, #ed8936, #dd6b20);">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pembimbing: {{ $stats['pembimbing'] }} dosen</div>
                        <div class="activity-time">Dosen pembimbing yang aktif membimbing mahasiswa</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: linear-gradient(135deg, #9f7aea, #805ad5);">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Program Magang: {{ $stats['magang'] }} program</div>
                        <div class="activity-time">Total program magang yang sedang berjalan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            
            const toggleBtn = document.querySelector('.toggle-btn i');
            if (sidebar.classList.contains('collapsed')) {
                toggleBtn.className = 'fas fa-chevron-right';
            } else {
                toggleBtn.className = 'fas fa-chevron-left';
            }
        }

        // Mobile responsiveness
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.add('collapsed');
            }
        });

        // Add active state to current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>