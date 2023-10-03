<?php
include '../koneksi.php';

$QueryAmbil     = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE id_barang_keluar = '$_GET[id_barang_keluar]'");
$DataAmbil      = mysqli_fetch_array($QueryAmbil);
$bulan_masuk    = date("m",strtotime($DataAmbil['tanggal_keluar']));
$tahun_keluar   = date("Y",strtotime($DataAmbil['tanggal_keluar']));
include 'src/kondisi_bulan.php';

$QueryCek   = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$DataAmbil[id_barang]' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");
$DataCek    = mysqli_num_rows($QueryCek);
$DataAmbil1 = mysqli_fetch_array($QueryCek);
$keluarLama  = $DataAmbil1['barang_keluar'] - $DataAmbil['barang_keluar'];

$update     = mysqli_query($koneksi, "UPDATE persediaan SET barang_keluar = '$keluarLama' WHERE id_barang = '$DataAmbil[id_barang]' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");

$delete = mysqli_query($koneksi, "DELETE FROM barang_keluar WHERE id_barang_keluar = '$_GET[id_barang_keluar]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_barang_keluar.php'</script>";

?>