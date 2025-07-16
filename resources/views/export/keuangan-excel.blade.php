<table>
    <thead>
        <tr>
            <th colspan="4" align="center" style="font-weight: bold; font-size: 16px;">Laporan Keuangan KKN Kelompok 5
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
            <th align="center" style="font-weight:bold;">Tgl. Transaksi</th>
            <th align="center" style="font-weight:bold;">Jenis Transaksi</th>
            <th align="center" style="font-weight:bold;">Keterangan</th>
            <th align="center" style="font-weight:bold;">Nominal</th>
            <th align="center" style="font-weight:bold;">Metode Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $val)
            <tr>
                <td>{{ optional($val->tanggal ? Carbon\Carbon::parse($val->tanggal) : null)->translatedFormat('l, d F Y') ?? '-' }}
                </td>
                <td align="center">{{ ucfirst($val->jenis) }}</td>
                <td>{{ $val->keterangan }}</td>
                <td align="right">Rp{{ number_format($val->nominal, 0, ',', '.') }}</td>
                <td align="center">{{ ucfirst($val->metode_pembayaran) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" class="right">Pengeluaran:</td>
            <td class="right">Rp{{ number_format($pengeluaran, 0, ',', '.') ?? '0' }}</td>
            <td></td>
        </tr>
        <!-- Baris Pemasukan -->
        <tr class="total-row">
            <td colspan="3" class="right">Pemasukan:</td>
            <td class="right">Rp{{ number_format($pemasukan, 0, ',', '.') ?? '0' }}</td>
            <td></td>
        </tr>
        <!-- Baris Total -->
        <tr class="total-row">
            <td colspan="3" class="right">TOTAL:</td>
            <td class="right">Rp{{ number_format($saldo, 0, ',', '.') ?? '0' }}</td>
            <td></td>
        </tr>

    </tbody>
</table>
