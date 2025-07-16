<table>
    <thead>
        <tr>
            <th colspan="4" align="center" style="font-weight: bold; font-size: 16px;">Laporan Kegiatan KKN Kelompok 5
            </th>
        </tr>
        <tr>
            <th colspan="4" align="center">Desa Kersamaju, Kecamatan Cigalontang, Tasikmalaya</th>
        </tr>
        <tr>
            <th colspan="4" align="center">Tahun 2025</th>
        </tr>
        <tr height="20">
            <td colspan="4"></td>
        </tr>

        <tr bgcolor="#f2f2f2">
            <th align="center" style="font-weight:bold;">Nama Kegiatan</th>
            <th align="center" style="font-weight:bold;">Tgl. Kegiatan</th>
            <th align="center" style="font-weight:bold;">Lokasi</th>
            <th align="center" style="font-weight:bold;">Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $val)
            <tr>
                <td>{{ $val->nama_kegiatan ?? '-' }}</td>
                <td>{{ optional($val->tgl_kegiatan ? Carbon\Carbon::parse($val->tgl_kegiatan) : null)->translatedFormat('l, d F Y') ?? '-' }}
                </td>
                <td>{{ $val->lokasi_kegiatan ?? '-' }}</td>
                <td>{{ $val->deskripsi_kegiatan ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
