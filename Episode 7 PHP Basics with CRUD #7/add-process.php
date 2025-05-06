<?php
include 'koneksi.php';

$npm = $_POST['npm'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];
$kodemk = $_POST['kodemk'];
$namamk = $_POST['namamk'];
$sks = $_POST['sks'];

// Cek dan insert mahasiswa jika belum ada
$koneksi->query("INSERT IGNORE INTO mahasiswa (npm, nama, jurusan, alamat) VALUES ('$npm', '$nama', '$jurusan', '$alamat')");
// Cek dan insert matkul jika belum ada
$koneksi->query("INSERT IGNORE INTO matakuliah (kodemk, nama, jumlah_sks) VALUES ('$kodemk', '$namamk', '$sks')");
// Insert ke krs
$koneksi->query("INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')");

header("Location: index.php");
?>
