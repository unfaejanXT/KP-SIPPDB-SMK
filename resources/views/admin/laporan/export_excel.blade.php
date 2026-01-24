<table>
    <thead>
        <tr>
            <th colspan="15" style="font-weight: bold; font-size: 14px; text-align: center;">LAPORAN DATA PPDB SMK SBI</th>
        </tr>
        <tr>
            <th colspan="15" style="text-align: center;">Tanggal Export: {{ now()->format('d F Y H:i') }}</th>
        </tr>
        <tr></tr>
        <tr>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">No</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">No. Pendaftaran</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">NISN</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Nama Lengkap</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">JK</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Tempat Lahir</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Tanggal Lahir</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Agama</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Alamat</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">No. HP</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Asal Sekolah</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Jurusan</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Gelombang</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Orang Tua (Ayah)</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #cccccc;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendaftaranData as $index => $siswa)
        <tr>
            <td style="border: 1px solid #000000;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->no_pendaftaran }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->nisn }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->nama_lengkap }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->jenis_kelamin }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->tempat_lahir }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '-' }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->agama }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->alamat_rumah }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->nomor_hp }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->asal_sekolah }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->gelombang->nama_gelombang ?? '-' }}</td>
            <td style="border: 1px solid #000000;">{{ $siswa->orangTua->nama_ayah ?? '-' }}</td>
            <td style="border: 1px solid #000000;">
                @if($siswa->status == 'terverifikasi')
                    Terverifikasi
                @elseif($siswa->status == 'submitted')
                    Menunggu Verifikasi
                @else
                    Draft
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
