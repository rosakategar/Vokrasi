<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PDF</title>
</head>

<body>
    Tanggal Cetak : <?= date('d F Y'); ?>
    <table width="100%" style="border: 0.1mm solid #000000;" cellpaddin="8">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Angkatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($semuamahasiswa as $mahasiswa) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $mahasiswa['nim']; ?></td>
                    <td><?= $mahasiswa['nama']; ?></td>
                    <td><?= $mahasiswa['angkatan']; ?></td>
                </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
</body>

</html>