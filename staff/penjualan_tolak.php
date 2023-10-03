<?php
include "../koneksi.php";

$id_penjualan = $_GET['id_penjualan'];
$querykeluar  = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'");
$datakeluar   = mysqli_fetch_array($querykeluar);

$id_barang       = $datakeluar['id_barang'];
$id_customer     = $datakeluar['nama_customer'];
$tanggal_keluar  = $datakeluar['tanggal_penjualan'];
$barang_keluar   = $datakeluar['jumlah_penjualan'];
$id_pengguna     = $datakeluar['id_pengguna'];
$bulan_masuk     = date("m",strtotime($tanggal_keluar));
$tahun_keluar    = date("Y",strtotime($tanggal_keluar));
$status_stok     = "Stok Tidak Tersedia";

$update1      = mysqli_query($koneksi, "UPDATE penjualan SET status_stok = '$status_stok' WHERE id_penjualan = '$id_penjualan'");

echo "<script>alert('Stok Tidak Tersedia');window.location='penjualan.php'</script>";

?>