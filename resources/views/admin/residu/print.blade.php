<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Residu Sampah {{ $monthName }} {{ $year }}</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --light-gray: #f8f9fa;
            --dark-gray: #495057;
            --success: #27ae60;
            --danger: #e74c3c;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 30px;
            color: var(--dark-gray);
            background: #fff;
            line-height: 1.5;
        }

        /* Header styles tetap sama */
        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--secondary), transparent);
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .header p {
            font-size: 16px;
            margin-top: 8px;
            color: var(--dark-gray);
            opacity: 0.8;
        }

        /* Horizontal Summary Cards */
        .summary-horizontal {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .summary-horizontal .summary-card {
            flex: 1;
            min-width: 200px;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .summary-horizontal .summary-card:hover {
            transform: translateY(-3px);
        }

        .summary-horizontal .summary-card h3 {
            font-size: 15px;
            color: var(--dark-gray);
            margin: 0 0 12px;
            font-weight: 500;
        }

        .summary-horizontal .summary-card p {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .summary-horizontal .total-waste {
            border-top: 4px solid var(--primary);
        }

        .summary-horizontal .total-waste p {
            color: var(--primary);
        }

        .summary-horizontal .total-residue {
            border-top: 4px solid var(--danger);
        }

        .summary-horizontal .total-residue p {
            color: var(--danger);
        }

        .summary-horizontal .clean-waste {
            border-top: 4px solid var(--success);
        }

        .summary-horizontal .clean-waste p {
            color: var(--success);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .summary-horizontal {
                flex-direction: column;
            }
            
            .summary-horizontal .summary-card {
                min-width: 100%;
            }
        }

        /* Style lainnya tetap sama seperti sebelumnya */
        .section-title {
            margin: 25px 0 15px;
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            position: relative;
            padding-bottom: 8px;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--secondary);
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .data-table th {
            background-color: var(--primary);
            color: white;
            text-align: left;
            padding: 12px 15px;
            font-weight: 500;
        }

        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:nth-child(even) {
            background-color: var(--light-gray);
        }

        .data-table tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
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
            margin-top: 40px;
            color: var(--dark-gray);
            opacity: 0.7;
        }

        .total-row {
            font-weight: 600;
            background-color: rgba(52, 152, 219, 0.15) !important;
        }

        @media print {
            body {
                padding: 10mm;
                font-size: 12px;
            }

            .summary-horizontal {
                page-break-inside: avoid;
                flex-direction: row !important;
            }

            .summary-horizontal .summary-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .footer {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Residu Sampah</h1>
        @if (strtolower($monthName) === 'Semua Bulan')
            <p>Bulan {{ $monthName }} {{ $year }}</p>
        @else
            <p>Tahun {{ $year }}</p>
        @endif
    </div>

    <!-- Horizontal Summary Cards -->
    <div class="summary-horizontal">
        <div class="summary-card total-waste">
            <h3>Total Sampah Masuk</h3>
            <p>{{ number_format($totalDeposit, 2) }} kg</p>
        </div>
        <div class="summary-card total-residue">
            <h3>Total Residu</h3>
            <p>{{ number_format($totalResidu, 2) }} kg</p>
        </div>
        <div class="summary-card clean-waste">
            <h3>Sampah Terpilah</h3>
            <p>{{ number_format($cleanWaste, 2) }} kg</p>
        </div>
    </div>

    <h3 class="section-title">Detail Residu</h3>
    <table class="data-table">
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
            <tr class="total-row">
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