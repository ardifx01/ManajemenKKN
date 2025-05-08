<table>
    <thead>
        <tr>
            <th bgcolor="red" style="font-size: 20px">Name</th>
            <th bgcolor="yellow">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $val)
            <tr>
                <td style="font-size: 12px">{{ $val->nama_user }}</td>
                <td style="color: white">{{ $val->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
