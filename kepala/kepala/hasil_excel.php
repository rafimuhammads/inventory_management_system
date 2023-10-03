<?php 
   error_reporting(0);
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-hasil.xls");
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
  $QueryBarang = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang = '$_GET[id_barang]'");
  $DataBarang  = mysqli_fetch_array($QueryBarang);
}
?>

  <div class="modal-view">
    <?php if(isset($_GET['id_barang'])){ ?>
    <h3 style="text-align: center;">LAPORAN HASIL PREDIKSI BARANG <?= $DataBarang['nama_barang'] ?></h3>
    <h3 style="text-align: center;">PADA TAHUN <?= $_GET['tahun'] ?></h3>
    <?php }else{ ?>
    <h3 style="text-align: center;">LAPORAN HASIL PREDIKSI BARANG</h3>
    <?php } ?>
    <table border="1" width="100%" cellpadding="3" cellspacing="4">
      <thead>
        <tr bgcolor="yellow">
          <th>No</th>
          <th>Kode</th>
          <th>Nama Barang</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Hasil Prediksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        if(isset($_GET['id_barang'])){
          $id_barang = $_GET['id_barang'];
          $tahun     = $_GET['tahun'];

          $query = mysqli_query($koneksi, "SELECT data_barang.*, data_hasil.* FROM data_barang, data_hasil WHERE data_hasil.id_barang = data_barang.id_barang AND data_hasil.id_barang = '$id_barang' AND data_hasil.tahun_persediaan = '$tahun'");
        }else{
          $query = mysqli_query($koneksi, "SELECT data_barang.*, data_hasil.* FROM data_barang, data_hasil WHERE data_hasil.id_barang = data_barang.id_barang");
                              }
        while($data = mysqli_fetch_array($query)){

        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $data['kode_barang'] ?></td>
          <td><?= $data['nama_barang'] ?></td>
          <td><?= $data['bulan_hasil'] ?></td>
          <td><?= $data['tahun_hasil'] ?></td>
          <td><?= round($data['prediksi_keluar']) ?></td>
        </tr>
        <?php } ?>            
      </tbody>
    </table>
  </div>
</body>
</html>