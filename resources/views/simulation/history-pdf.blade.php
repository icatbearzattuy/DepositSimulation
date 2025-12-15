<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>History Simulasi Deposito</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f2f2f2;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body>

<h2>Riwayat Simulasi Deposito</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Bank</th>
            <th>Nominal</th>
            <th>Jangka Waktu</th>
            <th>Bunga</th>
            <th>Total Akhir</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($simulations as $i => $sim)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $sim->bank->nama_bank }}</td>
            <td class="right">Rp {{ number_format($sim->nominal_deposito, 0, ',', '.') }}</td>
            <td>{{ $sim->jangka_waktu_bulan }} bln</td>
            <td class="right">Rp {{ number_format($sim->bunga_diterima, 0, ',', '.') }}</td>
            <td class="right">Rp {{ number_format($sim->total_akhir, 0, ',', '.') }}</td>
            <td>{{ date('d/m/Y', strtotime($sim->waktu_simulasi)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Dicetak pada {{ date('d M Y, H:i') }}
</div>

</body>
</html>
