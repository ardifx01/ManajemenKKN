<table>
    <thead>
        <tr>
            <th bgcolor="yellow" style="font-size: 12px">Nama Anggota</th>
            <th bgcolor="yellow" style="font-size: 12px">Email</th>
            <th bgcolor="yellow" style="font-size: 12px">Jabatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $val)
            <tr>
                <td style="font-size: 12px">{{ $val->name }}</td>
                <td style="font-size: 12px">{{ $val->email }}</td>
                <td style="font-size: 12px">{{ $val->jabatan->nama_jabatan ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
