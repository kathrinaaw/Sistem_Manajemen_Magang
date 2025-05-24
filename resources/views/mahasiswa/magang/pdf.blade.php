<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Magang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { line-height: 1.6; }
        .field { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Pengajuan Magang</h2>
    </div>
    
    <div class="content">
        <div class="field">
            <strong>Mahasiswa:</strong> 
            {{ $magang->mahasiswa->nama_mhs ?? 'Data mahasiswa tidak ditemukan' }}
        </div>
        
        <div class="field">
            <strong>NPM:</strong> 
            {{ $magang->mahasiswa->npm_mhs ?? 'NPM tidak ditemukan' }}
        </div>
        
        <div class="field">
            <strong>Perusahaan:</strong> 
            {{ $magang->perusahaan->nama_perusahaan ?? 'Data perusahaan tidak ditemukan' }}
        </div>
        
        <div class="field">
            <strong>Pembimbing:</strong> 
            {{ $magang->pembimbing->nama_pembimbing ?? 'Data pembimbing tidak ditemukan' }}
        </div>
        
        <div class="field">
            <strong>Tanggal Mulai:</strong> 
            {{ \Carbon\Carbon::parse($magang->tgl_mulai)->format('d F Y') }}
        </div>
        
        <div class="field">
            <strong>Tanggal Selesai:</strong> 
            {{ \Carbon\Carbon::parse($magang->tgl_selesai)->format('d F Y') }}
        </div>
        
        <div class="field">
            <strong>Status Magang:</strong> 
            {{ $magang->status_magang }}
        </div>
    </div>
</body>
</html>