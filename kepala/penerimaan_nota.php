<?php
session_start();
  if($_SESSION['login'] == ""){
    echo "<script>alert('Anda Harus Login Terlebih Dahulu');window.location='../index.php'</script>";
}
include "../koneksi.php";
$datadmin = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE id_pengguna = '3'");
$admin    = mysqli_fetch_array($datadmin);
$query = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.id_barang = barang.id_barang AND peramalan.status = 'Ya' AND peramalan.id_peramalan = '$_GET[id_peramalan]'");
$data  = mysqli_fetch_array($query);
?>
<html>
<head>
<title>NOTA PENGIRIMAN</title>
<style type="text/css">
      #kiri {
      float:left;
      width:250px;
      padding:10px;
      text-align: center;
      }

      #kanan {
          float:right;
          width:800px;
          padding:10px;
          text-align: center;
      }
    </style>
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
<center>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<span style='font-size:12pt'><b>PT. GEOFF MAKSIMAL JAYA</b></span></br>
Komplek Bank Duta, Jl. Waas No.B22, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40267</br>
Telp : 0227543349</br>
Nama Vendor : <?= $data['suplier'] ?></br>
</td>
<td style='vertical-align:top' width='30%' align='left'>
<b><span style='font-size:12pt'>NOTA PENGIRIMAN</span></b></br>
Kode. : <?= $data['kode_barang'] ?></br>
Tanggal : <?= date("d/m/Y") ?></br>
</td>
</table>
<br>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
</table>
<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
 
<tr align='center'>
<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='13%'>Ukuran</td>
<td width='13%'>Satuan</td>
<td width='13%'>Harga</td>
<td width='4%'>Jumlah</td>
<td width='13%'>Total Harga</td>
</tr>
<?php
$querydetail = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.id_barang = barang.id_barang AND peramalan.status = 'Ya' AND peramalan.id_peramalan = '$_GET[id_peramalan]'");
while($datadetail = mysqli_fetch_array($querydetail)){
	$totalsub = $datadetail['peramalan_keluar'] * $datadetail['harga_barang'];
?>
<tr>
<td><?= $datadetail['kode_barang'] ?></td>
<td><?= $datadetail['nama_barang'] ?></td>
<td><?= $datadetail['ukuran_barang'] ?></td>
<td>Pcs</td>
<td>Rp. <?= number_format($datadetail['harga_barang']) ?></td>
<td><?= round($datadetail['peramalan_keluar']) ?></td>
<td style='text-align:right'>Rp. <?= number_format($datadetail['peramalan_keluar'] * $datadetail['harga_barang']) ?></td>
</tr>
<?php } ?>

<tr>
<td colspan = '6'><div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div></td>
<td style='text-align:right'>Rp. <?= number_format($totalsub) ?></td>
</tr>
</table>

<br>
<br/>
<div id="kanan">
    <br/>
    <br/>
    <br/>    
    <b>TTD</b>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <u><?= $admin['nama_pengguna'] ?></u>
  </div>
</center>
<script type="text/javascript">window.print();</script>
</body>
</html>
