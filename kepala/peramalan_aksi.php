<?php
include '../koneksi.php';

$delete = mysqli_query($koneksi, "UPDATE peramalan SET status = '$_GET[status]' WHERE id_peramalan = '$_GET[id_peramalan]'");

if($_GET['status'] == "Tidak"){
echo "<script>alert('Data Tidak Di Terima');window.location='data_peramalan.php'</script>";
}elseif($_GET['status'] == "Ya"){
echo "<script>alert('Data Di Terima');window.location='data_peramalan.php'</script>";
}

?>