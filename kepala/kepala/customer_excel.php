<?php 
   error_reporting(0);
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-customer.xls");
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
      LAPORAN DATA CUSTOMER
    </h3>
    <table border="1" width="100%" cellpadding="3" cellspacing="4">
      <thead>
        <tr bgcolor="yellow">
          <th>No</th>
          <th>Kode</th>
          <th>Nama Customer</th>
          <th>Alamat</th>
          <th>No HP</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM data_customer");
        while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $data['kode_customer'] ?></td>
          <td><?= $data['nama_customer'] ?></td>
          <td><?= $data['alamat_customer'] ?></td>
          <td><?= $data['hp_customer'] ?></td>
        </tr>
        <?php } ?>            
      </tbody>
    </table>
  </div>
</body>
</html>