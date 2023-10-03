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
$status_stok     = "Stok Tersedia";

include 'src/kondisi_bulan.php';

$simpankeluar = mysqli_query($koneksi, "INSERT INTO barang_keluar VALUES('','$id_barang','$id_customer','$tanggal_keluar','$barang_keluar','$id_pengguna')");
$update1      = mysqli_query($koneksi, "UPDATE penjualan SET status_stok = '$status_stok' WHERE id_penjualan = '$id_penjualan'");

$QueryCek = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");
$DataCek  = mysqli_num_rows($QueryCek);

if($DataCek > 0){
    $QueryPersediaan = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");
    $DataPersediaan  = mysqli_fetch_array($QueryPersediaan);
    $ABarangkeluar   = $DataPersediaan['barang_keluar'] + $barang_keluar;

    $update          = mysqli_query($koneksi, "UPDATE persediaan SET barang_keluar = '$ABarangkeluar' WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");

    echo "<script>alert('Data Berhasil Diapprove');window.location='penjualan.php'</script>";

  }else{
  	$querybarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
    $databarang  = mysqli_fetch_array($querybarang);

    $simpan = mysqli_query($koneksi, "INSERT INTO persediaan VALUES('','$id_barang','$bulanGanti','$tahun_keluar','$databarang[stok_barang]','','$barang_keluar')");
    echo "<script>alert('Data Berhasil Diapprove');window.location='penjualan.php'</script>";
  
  }
?>