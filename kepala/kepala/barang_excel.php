<?php 
   error_reporting(0);
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-barang.xls");
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

  <div class="modal-view">
    <h3 style="text-align:center;"> 
      LAPORAN DATA BARANG
    </h3>
    <table border="1" width="100%" cellpadding="3" cellspacing="4">
      <thead>
        <tr bgcolor="yellow">
          <th>No</th>
          <th>Kode</th>
          <th>Nama Barang</th>
          <th>Ukuran</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM barang");
        while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $data['kode_barang'] ?></td>
          <td><?= $data['nama_barang'] ?></td>
          <td><?= $data['ukuran_barang'] ?></td>
          <td><?= $data['harga_barang'] ?></td>
        </tr>
        <?php } ?>            
      </tbody>
    </table>
  </div>
</body>
</html>