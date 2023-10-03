<?php
session_start();
  if($_SESSION['login'] == ""){
    echo "<script>alert('Anda Harus Login Terlebih Dahulu');window.location='index.php'</script>";
}
include '../koneksi.php';

$id     = $_SESSION['id'];
$ambil  = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE id_pengguna = '$_SESSION[id]'");
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
<?php
if(isset($_GET['id_barang'])){
  $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$_GET[id_barang]'");
  $DataBarang  = mysqli_fetch_array($QueryBarang);
}
?>
<body>  
  <div class="modal-view">
    <div class="rangkasurat">
      <table width="100%">
        <tr>
          <td><img src="../logo.png" width="140px"></td>
          <td class="tengah">
            <?php if(isset($_GET['id_barang'])){ ?>
            <h3>LAPORAN DATA HASIL PREDIKSI <?= $DataBarang['nama_barang'] ?></h3>
            <h3>UKURAN <?= $DataBarang['ukuran_barang'] ?> PADA TAHUN <?= $_GET['tahun'] ?></h3>
            <?php }else{ ?>
            <h3>LAPORAN DATA HASIL PREDIKSI BARANG</h3>
            <?php } ?>
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
          <th>Nama Vendor</th>
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

          $query = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.id_barang = barang.id_barang AND peramalan.id_barang = '$id_barang' AND peramalan.tahun_peramalan = '$tahun'");
        }else{
          $query = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.id_barang = barang.id_barang");
        }
        while($data = mysqli_fetch_array($query)){

        ?>
        <tr>
          <th><?= $data['kode_barang'] ?></th>
          <th><?= $data['suplier'] ?></th>
          <td><?= $data['nama_barang'] ?></td>
          <td><?= $data['bulan_peramalan'] ?></td>
          <td><?= $data['tahun_peramalan'] ?></td>
          <td><?= round($data['peramalan_keluar'],2) ?></td>
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
    <u><?= $dt['nama_pengguna'] ?></u>
  </div>
    </div>

    
  </div>

</body>
<script type="text/javascript">
  window.print();
</script>
</html>