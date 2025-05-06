<?php
include 'koneksi.php';

$query = "
    SELECT krs.id, m.npm, m.nama AS nama_mhs, m.jurusan, m.alamat,
           mk.kodemk, mk.nama AS namamk, mk.jumlah_sks AS sks
    FROM krs
    JOIN mahasiswa m ON krs.mahasiswa_npm = m.npm
    JOIN matakuliah mk ON krs.matakuliah_kodemk = mk.kodemk
";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kartu Rencana Studi</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #212529;
            text-align: center;
            margin: 40px 0 20px;
        }

        form {
            max-width: 700px;
            background-color: #ffffff;
            padding: 30px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        fieldset {
            border: none;
            margin-bottom: 20px;
        }

        legend {
            font-size: 18px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #495057;
            font-weight: 500;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 15px;
            background-color: #fff;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #0d6efd;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #0b5ed7;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
            color: #212529;
        }

        th {
            background-color: #0d6efd;
            color: white;
        }

        tr:hover {
            background-color: #f1f3f5;
        }

        td a {
            text-decoration: none;
            color: #0d6efd;
            font-weight: 500;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>FORM KRS MAHASISWA</h2>
    <form action="add-process.php" method="POST">
        <fieldset>
            <legend>Data Mahasiswa</legend>
            <label for="npm">NPM:</label>
            <input type="text" name="npm" required>
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required>
            <label for="jurusan">Jurusan:</label>
            <select name="jurusan" required>
                <option value="Informatika">Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
            </select>
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" rows="3" required></textarea>
        </fieldset>
        <fieldset>
            <legend>Data Mata Kuliah</legend>
            <label for="kodemk">Kode:</label>
            <input type="text" name="kodemk" required>
            <label for="namamk">Nama Matkul:</label>
            <input type="text" name="namamk" required>
            <label for="sks">SKS:</label>
            <input type="number" name="sks" required>
        </fieldset>
        <button type="submit">Simpan</button>
    </form>

    <h2>DATA KRS MAHASISWA</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Mata Kuliah</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>$no</td>
                <td>{$row['nama_mhs']}</td>
                <td>{$row['namamk']}</td>
                <td>{$row['nama_mhs']} Mengambil Mata Kuliah {$row['namamk']} ({$row['sks']} SKS)</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> 
                    <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                </td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>
