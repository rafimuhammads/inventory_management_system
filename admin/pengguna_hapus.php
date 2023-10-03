<?php
include '../koneksi.php';

$delete = mysqli_query($koneksi, "DELETE FROM pengguna WHERE id_pengguna = '$_GET[id_pengguna]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_pengguna.php'</script>";

?>