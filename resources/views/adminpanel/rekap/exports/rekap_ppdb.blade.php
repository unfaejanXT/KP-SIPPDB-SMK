<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap PPDB</title>
</head>
<body>
    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th colspan="13" style="text-align: center; font-weight: bold">
                    REKAPITULASI PENERIMAAN PESERTA DIDIK BARU
                </th>
            </tr>
            <tr>
                <th colspan="13" style="text-align: center; font-weight: bold">
                    SMK SOLUSI BANGUN INDONESIA
                </th>
            </tr>
            <tr>
                <th colspan="13" style="text-align: center; font-weight: bold">
                    TAHUN PELAJARAN 2024-2025
                </th>
            </tr>
            <tr>
                <th colspan="13"></th>
            </tr>
            <tr>
                <th rowspan="2" style="text-align: center; border: 1px solid black;">Urut</th>
                <th colspan="2" style="text-align: center; border: 1px solid black;">Nomor</th>
                <th rowspan="2" style="text-align: center; border: 1px solid black;">NAMA CALON PESERTA DIDIK</th>
                <th rowspan="2" style="text-align: center; border: 1px solid black;">ASAL SEKOLAH</th>
                <th colspan="2" style="text-align: center; border: 1px solid black;">NAMA ORANGTUA</th>
                <th rowspan="2" style="text-align: center; border: 1px solid black;">TEMPAT LAHIR</th>
                <th rowspan="2" style="text-align: center; border: 1px solid black;">TANGGAL LAHIR</th>
                <th rowspan="2" style="text-align: center; border: 1px solid black;">ALAMAT</th>
                <th rowspan="2" style="text-align: center; border: 1px solid black;">NO HP</th>
                <th colspan="2" style="text-align: center; border: 1px solid black;">PENERIMA</th>
            </tr>
            <tr>
                <th style="text-align: center; border: 1px solid black;">PENDAFTARAN</th>
                <th style="text-align: center; border: 1px solid black;">NISN</th>
                <th style="text-align: center; border: 1px solid black;">AYAH</th>
                <th style="text-align: center; border: 1px solid black;">IBU</th>
                <th style="text-align: center; border: 1px solid black;">KIP</th>
                <th style="text-align: center; border: 1px solid black;">KIS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftaranData as $key => $data)
                <tr>
                    <td style="text-align: center; border: 1px solid black;">{{ $key + 1 }}</td>
                    <td style="text-align: center; border: 1px solid black;">{{ $data->no_pendaftaran }}</td>
                    <td style="text-align: center; border: 1px solid black;">{{ $data->nisn }}</td>
                    <td style="border: 1px solid black;">{{ $data->nama_lengkap }}</td>
                    <td style="border: 1px solid black;">{{ $data->asal_sekolah }}</td>
                    <td style="border: 1px solid black;">{{ $data->orangTuaSiswa->nama_ayah ?? '-' }}</td>
                    <td style="border: 1px solid black;">{{ $data->orangTuaSiswa->nama_ibu ?? '-' }}</td>
                    <td style="border: 1px solid black;">{{ $data->tempat_lahir }}</td>
                    <td style="border: 1px solid black;">{{ $data->tanggal_lahir }}</td>
                    <td style="border: 1px solid black;">{{ $data->alamat_rumah }}</td>
                    <td style="border: 1px solid black;">{{ $data->nomor_hp }}</td>
                    <td style="text-align: center; border: 1px solid black;">{{ $data->penerima_kip ? 'Ya' : 'Tidak' }}</td>
                    <td style="text-align: center; border: 1px solid black;">{{ $data->penerima_kis ? 'Ya' : 'Tidak' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
