<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = $koneksi->query("
    SELECT krs.id, m.npm, m.nama AS nama_mhs, m.jurusan, m.alamat,
           mk.kodemk, mk.nama AS namamk, mk.jumlah_sks AS sks
    FROM krs
    JOIN mahasiswa m ON krs.mahasiswa_npm = m.npm
    JOIN matakuliah mk ON krs.matakuliah_kodemk = mk.kodemk
    WHERE krs.id = $id
");

$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit KRS</title>
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
    </style>
</head>
<body>
    <h2>Edit Data KRS</h2>
    <form action="edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <fieldset>
            <legend>Data Mahasiswa</legend>
            <label>NPM:</label>
            <input type="text" name="npm" value="<?= $data['npm'] ?>" readonly>

            <label>Nama:</label>
            <input type="text" name="nama" value="<?= $data['nama_mhs'] ?>">

            <label>Jurusan:</label>
            <select name="jurusan">
                <option <?= $data['jurusan'] == 'Informatika' ? 'selected' : '' ?>>Informatika</option>
                <option <?= $data['jurusan'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
            </select>

            <label>Alamat:</label>
            <textarea name="alamat"><?= $data['alamat'] ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Data Mata Kuliah</legend>
            <label>Kode:</label>
            <input type="text" name="kodemk" value="<?= $data['kodemk'] ?>">

            <label>Nama Matkul:</label>
            <input type="text" name="namamk" value="<?= $data['namamk'] ?>">

            <label>SKS:</label>
            <input type="number" name="sks" value="<?= $data['sks'] ?>">
        </fieldset>

        <button type="submit">Update</button>
    </form>
</body>
</html>
