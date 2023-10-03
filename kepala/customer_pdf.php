<?php
session_start();
  if($_SESSION['login'] == ""){
    echo "<script>alert('Anda Harus Login Terlebih Dahulu');window.location='index.php'</script>";
}
include '../koneksi.php';

$id     = $_SESSION['id'];
$ambil  = mysqli_query($koneksi, "SELECT * FROM data_admin WHERE id_admin = '$_SESSION[id]'");
$dt     = mysqli_fetch_array($ambil);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/style.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    <link rel="stylesheet" href="../assets/css/colors.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-select.css" />
    <link rel="stylesheet" href="../assets/css/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
    <style type="text/css">
      #kiri {
      float:left;
      width:250px;
      padding:10px;
      text-align: center;
      }

      #kanan {
          float:right;
          width:250px;
          padding:10px;
          text-align: center;
      }
    </style>
    <style type="text/css">
      body { font-family: arial; background-color: #ccc  }
      .rangkasurat { width: 900px; margin: 0 auto; background-color: #fff; padding: 20px; }
      table { border-bottom: 5px solid #000; padding: 2px; }
      .tengah { width: 900px; text-align: center;line-height: 5px; }
    </style>
</head>
<body>  
  <div class="modal-view">
    <div class="rangkasurat">
      <table width="100%">
        <tr>
          <td><img src="../logo.png" width="140px"></td>
          <td class="tengah">
            <h3>LAPORAN DATA CUSTOMER</h3>
          </td>
          <td><img src="../assets/space.png" width="140px"></td>
        </tr>
      </table>
      <br>
      <hr>
      <table class="table table-bordered" id="tabel-data">
      <thead>
        <tr bgcolor="yellow">
          <th>Kode</th>
          <th>Nama Cutomer</th>
          <th>Alamat</th>
          <th>No HP</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query1 = mysqli_query($koneksi, "SELECT * FROM data_customer");
        while($data = mysqli_fetch_array($query1)){

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
    <hr>

  <div id="kanan">
    <br/>
    <br/>
    <br/>    
    <b>Yang Membuat Laporan</b>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <u><?= $dt['nama_admin'] ?></u>
  </div>
    </div>

    
  </div>

</body>
<script type="text/javascript">
  window.print();
</script>
</html>