<?php
include 'koneksi.php';

$id = $_POST['id'];
$npm = $_POST['npm'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];
$kodemk = $_POST['kodemk'];
$namamk = $_POST['namamk'];
$sks = $_POST['sks'];

$koneksi->query("UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan', alamat='$alamat' WHERE npm='$npm'");
$koneksi->query("UPDATE matakuliah SET nama='$namamk', jumlah_sks='$sks' WHERE kodemk='$kodemk'");
$koneksi->query("UPDATE krs SET matakuliah_kodemk='$kodemk' WHERE id=$id");

header("Location: index.php");
?>
