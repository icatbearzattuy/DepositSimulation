<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>
    <h2>Hasil Simulasi Deposito</h2>

    <table>
        <tr>
            <th>Bank</th>
            <td>{{ $bank->nama_bank }}</td>
        </tr>
        <tr>
            <th>Suku Bunga</th>
            <td>{{ $bank->suku_bunga_dasar }}%</td>
        </tr>
        <tr>
            <th>Nominal</th>
            <td>Rp {{ number_format($nominal, 0) }}</td>
        </tr>
        <tr>
            <th>Jangka Waktu</th>
            <td>{{ $jangka_waktu }} bulan</td>
        </tr>
        <tr>
            <th>Bunga Diterima</th>
            <td>Rp {{ number_format($bunga_diterima, 0) }}</td>
        </tr>
        <tr>
            <th>Total Akhir</th>
            <td>Rp {{ number_format($total_akhir, 0) }}</td>
        </tr>
    </table>
</body>
</html>
