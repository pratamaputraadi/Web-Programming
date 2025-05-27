<?php
include 'koneksi.php';

$data = $koneksi->query("SELECT * FROM mahasiswa");

$edit = false;
$mahasiswa = [
    'id' => '',
    'nama' => '',
    'nim' => '',
    'jurusan' => '',
    'alamat' => '',
    'status' => ''
];

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $koneksi->query("SELECT * FROM mahasiswa WHERE id=$id");
    $mahasiswa = $result->fetch_assoc();
    $edit = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa - University</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        form { margin-bottom: 20px; }
        input, select, textarea { padding: 8px; margin: 5px 0; width: 100%; }
        .btn { padding: 8px 12px; margin-top: 10px; }
    </style>
</head>
<body>
    <h2><?= $edit ? "Edit Mahasiswa" : "Tambah Mahasiswa" ?></h2>
    <form method="post" action="method.php?action=<?= $edit ? "update" : "create" ?>">
        <?php if ($edit): ?>
            <input type="hidden" name="id" value="<?= $mahasiswa['id'] ?>">
        <?php endif; ?>
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= $mahasiswa['nama'] ?>" required>

        <label>NIM:</label>
        <input type="text" name="nim" value="<?= $mahasiswa['nim'] ?>" required>

        <label>Jurusan:</label>
        <input type="text" name="jurusan" value="<?= $mahasiswa['jurusan'] ?>" required>

        <label>Alamat:</label>
        <textarea name="alamat" required><?= $mahasiswa['alamat'] ?></textarea>

        <label>Status:</label>
        <select name="status" required>
            <option value="aktif" <?= $mahasiswa['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="non-aktif" <?= $mahasiswa['status'] == 'non-aktif' ? 'selected' : '' ?>>Non-Aktif</option>
        </select>

        <button class="btn" type="submit"><?= $edit ? "Update" : "Simpan" ?></button>
    </form>

    <h2>Data Mahasiswa</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['jurusan'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="menu.php?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="method.php?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
