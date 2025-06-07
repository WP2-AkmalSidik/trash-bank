<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Residu Sampah {{ $monthName }} {{ $year }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            color: #333;
            background: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #444;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
            font-size: 16px;
            margin-top: 5px;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-box {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .summary-box h3 {
            font-size: 16px;
            color: #555;
            margin: 0 0 10px;
        }

        .summary-box p {
            font-size: 22px;
            font-weight: bold;
            color: #000;
            margin: 0;
        }

        h3 {
            margin-bottom: 10px;
            font-size: 18px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 30px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        table th {
            background-color: #f1f1f1;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            text-align: right;
            font-size: 13px;
            margin-top: 50px;
            color: #555;
        }

        @media print {
            body {
                padding: 10mm;
                font-size: 12px;
            }

            .summary {
                page-break-inside: avoid;
            }

            .summary-box {
                background: none;
                border: 1px solid #000;
            }

            .footer {
                text-align: right;
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Residu Sampah</h1>
        @if (strtolower($monthName) === 'Semua Bulan')
            <h3>Bulan {{ $monthName }} {{ $year }}</h3>
        @else
            <h3>Tahun {{ $year }}</h3>
        @endif
    </div>


    <div class="summary">
        <div class="summary-box">
            <h3>Total Sampah Masuk</h3>
            <p>{{ number_format($totalDeposit, 2) }} kg</p>
        </div>
        <div class="summary-box">
            <h3>Total Residu</h3>
            <p>{{ number_format($totalResidu, 2) }} kg</p>
        </div>
        <div class="summary-box">
            <h3>Sampah Terpilih</h3>
            <p>{{ number_format($cleanWaste, 2) }} kg</p>
        </div>
    </div>

    <h3>Detail Residu</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 40%;">Nama Residu</th>
                <th style="width: 25%;">Tanggal</th>
                <th class="text-right" style="width: 20%;">Berat (kg)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residues as $index => $residu)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $residu->name }}</td>
                    <td>{{ $residu->created_at->format('d M Y') }}</td>
                    <td class="text-right">{{ number_format($residu->weight_kg, 2) }}</td>
                </tr>
            @endforeach
            <tr style="background-color: #f9f9f9;">
                <td colspan="3" class="text-right"><strong>Total Residu</strong></td>
                <td class="text-right"><strong>{{ number_format($totalResidu, 2) }} kg</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>
</body>

</html>
