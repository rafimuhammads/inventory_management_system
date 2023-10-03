<?php 
   error_reporting(0);
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-barang-masuk.xls");
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
    <h3 style="text-align: center;">LAPORAN DATA BARANG MASUK UNTUK <?= $DataBarang['nama_barang'] ?> DARI <?= $_GET['suplier'] ?></h3>
    <h3 style="text-align: center;">UKURAN <?= $DataBarang['ukuran_barang'] ?> PADA TAHUN <?= $_GET['tahun'] ?></h3>
    <?php }else{ ?>
    <h3 style="text-align: center;">LAPORAN DATA BARANG MASUK</h3>
    <?php } ?>
    <table border="1" width="100%" cellpadding="3" cellspacing="4">
      <thead>
        <tr bgcolor="yellow">
          <th>Kode Barang</th>
          <th>Vendor</th>
          <th>Tanggal</th>
          <th>Nama Barang</th>
          <th>Harga Satuan</th>
          <th>Barang Masuk</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $total_harga = 0;
        $total_barang = 0;
        if(isset($_GET['id_barang'])){
          $suplier   = $_GET['suplier'];
          $id_barang = $_GET['id_barang'];
          $tahun     = $_GET['tahun'];

          $query = mysqli_query($koneksi, "SELECT barang.*, barang_masuk.* FROM barang, barang_masuk WHERE barang_masuk.id_barang = barang.id_barang AND barang_masuk.suplier = '$suplier' AND barang_masuk.id_barang = '$id_barang' AND YEAR(barang_masuk.tanggal_masuk) = '$tahun'");
        }else{
          $query = mysqli_query($koneksi, "SELECT barang.*, barang_masuk.* FROM barang, barang_masuk WHERE barang_masuk.id_barang = barang.id_barang");
        }

        while($data = mysqli_fetch_array($query)){
          $total_harga += $data['barang_masuk'] * $data['harga_barang'];
          $total_barang  += $data['barang_masuk'];

        ?>
        <tr>
          <th><?= $data['kode_barang'] ?></th>
          <th><?= $data['suplier'] ?></th>
          <td><?= $data['tanggal_masuk'] ?></td>
          <td><?= $data['nama_barang'] ?></td>
          <td>Rp. <?= number_format($data['harga_barang'])  ?></td>
          <td><?= $data['barang_masuk'] ?></td>
          <td>Rp. <?= number_format($data['barang_masuk'] * $data['harga_barang'])  ?></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="5">Total</td>
          <td><?= ($total_barang) ?></td>
          <td>Rp. <?= number_format($total_harga) ?></td>
        </tr>    
      </tbody>
    </table>
  </div>
</body>
</html>