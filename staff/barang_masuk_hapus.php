<?php
include '../koneksi.php';

$QueryAmbil     = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE id_barang_masuk = '$_GET[id_barang_masuk]'");
$DataAmbil      = mysqli_fetch_array($QueryAmbil);
$bulan_masuk    = date("m",strtotime($DataAmbil['tanggal_masuk']));
$tahun_masuk    = date("Y",strtotime($DataAmbil['tanggal_masuk']));
include 'src/kondisi_bulan.php';

$QueryCek   = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$DataAmbil[id_barang]' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_masuk'");
$DataCek    = mysqli_num_rows($QueryCek);
$DataAmbil1 = mysqli_fetch_array($QueryCek);
$MasukLama  = $DataAmbil1['barang_masuk'] - $DataAmbil['barang_masuk'];

$update     = mysqli_query($koneksi, "UPDATE persediaan SET barang_masuk = '$MasukLama' WHERE id_barang = '$DataAmbil[id_barang]' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_masuk'");

$delete = mysqli_query($koneksi, "DELETE FROM barang_masuk WHERE id_barang_masuk = '$_GET[id_barang_masuk]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_barang_masuk.php'</script>";

?>