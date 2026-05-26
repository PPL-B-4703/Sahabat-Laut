<!DOCTYPE html>
<html>
<head>
    <title>Laporan Validasi Pakar</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #004d6b; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #004d6b; font-size: 20px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #666; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px 8px; text-align: left; }
        th { background-color: #0077a9; color: white; font-weight: bold; text-transform: uppercase; font-size: 11px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .status-badge { font-weight: bold; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Rekap Data Validasi Biota Laut</h2>
        <p>Diekspor oleh: <strong>Pakar Sahabat Laut</strong> | Tanggal Unduh: {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal Temuan</th>
                <th>Spesies</th>
                <th>Aktivitas</th>
                <th>Lokasi Spesifik</th>
                <th>Status Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
            <tr>
                <td>{{ is_object($item->tanggal_temuan) ? $item->tanggal_temuan->format('d/m/Y') : date('d/m/Y', strtotime($item->tanggal_temuan)) }}</td>
                <td>{{ $item->species }}</td>
                <td>{{ $item->aktivitas }}</td>
                <td>{{ trim(explode(', Provinsi ', $item->alamat_lokasi ?? '')[0]) }}</td>
                <td class="status-badge" style="color: {{ $item->status == 'Terverifikasi' ? '#16a34a' : ($item->status == 'Ditolak' ? '#dc2626' : '#ca8a04') }}">
                    {{ strtoupper($item->status) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>