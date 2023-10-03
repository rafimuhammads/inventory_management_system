<?php
include '../koneksi.php';

$delete = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang = '$_GET[id_barang]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_barang.php'</script>";

?>