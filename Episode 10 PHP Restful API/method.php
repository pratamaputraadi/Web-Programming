<?php
include 'koneksi.php';

$action = $_GET['action'] ?? '';

if ($action == 'create') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $koneksi->query("INSERT INTO mahasiswa (nama, nim, jurusan, alamat, status) VALUES ('$nama', '$nim', '$jurusan', '$alamat', '$status')");
    header("Location: menu.php");
}
elseif ($action == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $koneksi->query("UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan', alamat='$alamat', status='$status' WHERE id=$id");
    header("Location: menu.php");
}
elseif ($action == 'delete') {
    $id = $_GET['id'];
    $koneksi->query("DELETE FROM mahasiswa WHERE id=$id");
    header("Location: menu.php");
}
?>
