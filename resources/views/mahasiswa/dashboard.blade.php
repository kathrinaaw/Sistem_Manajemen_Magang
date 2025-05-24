<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Dashboard Mahasiswa'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            opacity: 0.9;
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .welcome-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .welcome-card h2 {
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .menu-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: #333;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .menu-card h3 {
            color: #667eea;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .menu-card p {
            color: #666;
            line-height: 1.6;
        }
        
        .icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-label {
            color: #666;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo isset($title) ? $title : 'Dashboard Mahasiswa'; ?></h1>
        <p>Sistem Manajemen Magang</p>
    </div>
    
    <div class="container">
        <div class="welcome-card">
            <h2>👋 Selamat Datang!</h2>
            <p><?php echo isset($welcome_message) ? $welcome_message : 'Selamat datang di sistem manajemen magang'; ?></p>
        </div>
        
        <!-- Quick Stats -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number">3</div>
                <div class="stat-label">Total Perusahaan</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">2</div>
                <div class="stat-label">Pembimbing Tersedia</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">1</div>
                <div class="stat-label">Magang Aktif</div>
            </div>
        </div>
        
        <!-- Menu Cards -->
        <div class="menu-grid">
            <a href="{{ route('mahasiswa.perusahaan.index') }}" class="menu-card">
                <div class="icon">🏢</div>
                <h3>Data Perusahaan</h3>
                <p>Lihat daftar perusahaan yang tersedia untuk magang. Cari informasi lengkap tentang perusahaan mitra.</p>
            </a>
            
            <a href="{{ route('mahasiswa.pembimbing.index') }}" class="menu-card">
                <div class="icon">👨‍🏫</div>
                <h3>Data Pembimbing</h3>
                <p>Lihat informasi pembimbing yang akan membantu dan membimbing selama proses magang berlangsung.</p>
            </a>
            
            <a href="{{ route('mahasiswa.magang.index') }}" class="menu-card">
                <div class="icon">📝</div>
                <h3>Daftar Magang</h3>
                <p>Daftarkan diri untuk program magang. Pilih perusahaan dan pembimbing yang sesuai dengan minat Anda.</p>
            </a>
            
            <!-- <a href="?controller=document&action=index" class="menu-card">
                <div class="icon">📄</div>
                <h3>Download Dokumen</h3>
                <p>Download sertifikat, surat pengantar, dan dokumen lainnya yang terkait dengan program magang.</p>
            </a> -->
        </div>
    </div>
</body>
</html>