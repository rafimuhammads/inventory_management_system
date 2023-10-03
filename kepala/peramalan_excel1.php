<?php 
   error_reporting(0);
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-peramalan.xls");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 

    require '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if(isset($_GET['id_barang'])){
  $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$_GET[id_barang]'");
  $DataBarang  = mysqli_fetch_array($QueryBarang);
}
?>

  <div class="modal-view">
    <?php if(isset($_GET['id_barang'])){ ?>
    <h3 style="text-align: center;">LAPORAN PENERIMAAN BARANG MASUK VENDOR <?= $DataBarang['nama_barang'] ?></h3>
    <h3 style="text-align: center;">UKURAN <?= $DataBarang['ukuran_barang'] ?> PADA TAHUN <?= $_GET['tahun'] ?></h3>
    <?php }else{ ?>
    <h3 style="text-align: center;">LAPORAN PENERIMAAN BARANG MASUK VENDOR</h3>
    <?php } ?>
    <table border="1" width="100%" cellpadding="3" cellspacing="4">
      <thead>
        <tr bgcolor="yellow">
          <th>Kode</th>
          <th>Nama Barang</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Peramalan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        if(isset($_GET['id_barang'])){
          $id_barang = $_GET['id_barang'];
          $tahun     = $_GET['tahun'];

          $query = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.id_barang = barang.id_barang AND peramalan.id_barang = '$id_barang' AND peramalan.tahun_peramalan = '$tahun' AND peramalan.status = 'Ya'");
        }else{
          $query = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.id_barang = barang.id_barang AND peramalan.status = 'Ya'");
        }
        while($data = mysqli_fetch_array($query)){

        ?>
        <tr>
          <th><?= $data['kode_barang'] ?></th>
          <td><?= $data['nama_barang'] ?></td>
          <td><?= $data['bulan_peramalan'] ?></td>
          <td><?= $data['tahun_peramalan'] ?></td>
          <td><?= round($data['peramalan_keluar'],2) ?></td>
        </tr>
        <?php } ?>            
      </tbody>
    </table>
  </div>
</body>
</html>