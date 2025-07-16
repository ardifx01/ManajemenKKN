<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan KKN 05 Desa Kersamaju</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .report-container {
            max-width: 1000px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .letterhead {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #4e7b99;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #4e7b99;
            margin-bottom: 5px;
        }

        .company-details {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .report-title {
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .report-date {
            text-align: right;
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }

        .report-table th {
            background-color: #4e7b99;
            color: white;
            padding: 12px 10px;
            text-align: center;
            font-weight: bold;
        }

        .report-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .report-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .report-table tr:hover {
            background-color: #f1f1f1;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .payment-cash {
            color: #27ae60;
            font-weight: bold;
        }

        .payment-transfer {
            color: #2980b9;
            font-weight: bold;
        }

        .payment-credit {
            color: #f39c12;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #7f8c8d;
        }

        .total-row {
            font-weight: bold;
            background-color: #ecf0f1 !important;
        }

        .summary-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <!-- Kop Surat -->
        <div class="letterhead">
            <div class="company-name">Laporan Kegiatan KKN Kelompok 5</div>
            <div class="company-details">
                Desa Kersamaju, Kecamatan Cigalontang, Tasikmalaya
            </div>
            <div class="company-details">
                Tahun 2025
            </div>
        </div>

        <!-- Tabel Data -->
        <table class="report-table">
            <thead>
                <tr>
                    <th width="15%">Nama Kegiatan</th>
                    <th width="15%">Tgl. Kegiatan</th>
                    <th width="20%">Lokasi</th>
                    <th width="25%">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $val)
                    <tr>
                        <td>
                            {{ $val->nama_kegiatan }}</td>
                        <td>
                            {{ optional($val->tgl_kegiatan ? Carbon\Carbon::parse($val->tgl_kegiatan) : null)->translatedFormat('l, d F Y') ?? '-' }}
                        </td>
                        <td class="text-center">{{ $val->lokasi_kegiatan }}</td>
                        <td>{{ $val->deskripsi_kegiatan }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</body>

</html>
