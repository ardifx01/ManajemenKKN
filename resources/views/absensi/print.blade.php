<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Absensi Kegiatan KKN</title>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .kop {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            /* border-bottom: 2px solid #000; */
            padding-bottom: 5px;
        }

        .kop img {
            height: 60px;
        }

        .kop .text {
            text-align: center;
            flex: 1;
            margin: 0 10px;
        }

        .kop .text h2,
        .kop .text h3,
        .kop .text p {
            margin: 0;
            line-height: 1.4;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        .info {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        .no {
            width: 30px;
        }

        .signature-col {
            width: 60px;
            height: 60px;
            position: relative;
            border: 1px solid #000;
        }

        .signature-number {
            position: absolute;
            top: 2px;
            left: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .signature-image {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            transform: translate(-50%, -50%);
            opacity: 0.8;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <!-- Kop header -->
    <img src="/politeknik-lp3i.png" alt="Logo LP3I" style="height: 60px; margin-bottom: 8px;">
    <div class="kop" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
        <!-- Logo di atas -->

        <!-- Judul tengah -->
        <div style="font-size: 12px; font-weight: bold; line-height: 0.5;">
            <p>DAFTAR HADIR</p>
            <p>PENGABDIAN KEPADA MASYARAKAT</p>
            <p>"{{ $kegiatan->nama_kegiatan }}"</p>
            <p>Desa Kersamaju, Kec. Cigalontang, Kab. Tasikmalaya</p>
        </div>
    </div>

    <!-- Info tambahan -->
    <div class="info" style="margin-top: 10px; font-size: 12px;">
        <p><strong>Pemateri : {{ $kegiatan->pemimpin_rapat->name ?? '-' }}</p> </strong>
        <p><strong>Hari / Tanggal :
                {{ optional($kegiatan->tgl_kegiatan ? Carbon\Carbon::parse($kegiatan->tgl_kegiatan) : null)->translatedFormat('l, d F Y') ?? '-' }}
        </p> </strong>
    </div>

    <table>
        <thead>
            <tr>
                <th class="no">No</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th colspan="2">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($absensi); $i += 2)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-left">{{ $absensi[$i]->user->name ?? '-' }}</td>
                    <td class="text-center">{{ $absensi[$i]->user->telepon ?? '' }}</td>

                    <td class="signature-col" rowspan="2">
                        <span class="signature-number">{{ $i + 1 }}</span>
                        @if ($absensi[$i]->status === 'H' && !empty($absensi[$i]->user->ttd))
                            <img src="{{ asset('storage/' . $absensi[$i]->user->ttd) }}" class="signature-image"
                                alt="TTD">
                        @endif
                    </td>

                    <td class="signature-col" rowspan="2">
                        <span class="signature-number">{{ $i + 2 }}</span>
                        @if (isset($absensi[$i + 1]) && $absensi[$i + 1]->status === 'H' && !empty($absensi[$i + 1]->user->ttd))
                            <img src="{{ asset('storage/' . $absensi[$i + 1]->user->ttd) }}" class="signature-image"
                                alt="TTD">
                        @endif
                    </td>
                </tr>
                <tr>
                    @if (isset($absensi[$i + 1]))
                        <td>{{ $i + 2 }}</td>
                        <td class="text-left">{{ $absensi[$i + 1]->user->name ?? '-' }}</td>
                        <td class="text-center">{{ $absensi[$i + 1]->user->telepon ?? '' }}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                </tr>
            @endfor
        </tbody>
    </table>
</body>

</html>
