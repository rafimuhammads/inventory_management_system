<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $id_barang       = $_POST['id_barang'];
  $tanggal_keluar  = $_POST['tanggal_keluar'];
  $barang_keluar   = ($_POST['barang_keluar']);

  $QueryAmbil     = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE id_barang_keluar = '$_GET[id_barang_keluar]'");
  $DataAmbil      = mysqli_fetch_array($QueryAmbil);
  $bulan_masuk    = date("m",strtotime($DataAmbil['tanggal_keluar']));
  $tahun_keluar   = date("Y",strtotime($DataAmbil['tanggal_keluar']));
  include 'src/kondisi_bulan.php';

  $QueryCek   = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");
  $DataCek    = mysqli_num_rows($QueryCek);
  $DataAmbil1 = mysqli_fetch_array($QueryCek);
  $keluarLama  = $DataAmbil1['barang_keluar'] - $DataAmbil['barang_keluar'];
  $keluarBaru  = $keluarLama + $barang_keluar;

  $update          = mysqli_query($koneksi, "UPDATE persediaan SET barang_keluar = '$keluarBaru' WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");

  $update2         = mysqli_query($koneksi, "UPDATE barang_keluar SET barang_keluar = '$barang_keluar' WHERE id_barang_keluar = '$_GET[id_barang_keluar]'");

  echo "<script>alert('Data Berhasil Perbaruhi');window.location='data_barang_keluar.php'</script>";

}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Edit Data Barang Keluar</h2>
            </div>
         </div>
         <?php
         $id_barang_keluar = $_GET['id_barang_keluar'];
         $query           = mysqli_query($koneksi, "SELECT barang.*, barang_keluar.* FROM barang, barang_keluar WHERE barang_keluar.id_barang = barang.id_barang AND barang_keluar.id_barang_keluar = '$id_barang_keluar'");
         $data            = mysqli_fetch_array($query);
         ?>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                             <label class="form-control-label" for="tanggal_keluar">Tanggal Keluar</label>
                             <input type="text" class="form-control" name="tanggal_keluar" value="<?= $data['tanggal_keluar'] ?>" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="nama_barang">Nama Barang</label>
                             <input type="hidden" name="id_barang" value="<?= $data['id_barang'] ?>">
                             <input type="text" class="form-control" name="nama_barang" value="<?= $data['nama_barang'] ?>" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="nama_barang">Ukuran Barang</label>
                             <input type="hidden" name="id_barang" value="<?= $data['id_barang'] ?>">
                             <input type="text" class="form-control" name="nama_barang" value="<?= $data['ukuran_barang'] ?>" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="nama_customer">Nama Customer</label>
                             <input type="text" class="form-control" placeholder="Nama Customer" value="<?= $data['nama_customer'] ?>" name="nama_customer" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="barang_keluar">Jumlah Barang Keluar</label>
                             <input type="number" class="form-control" name="barang_keluar" value="<?= $data['barang_keluar'] ?>" autocomplete="off" placeholder="Input Jumlah Barang Keluar" required>
                           </div>
                           <div class="form-group">
                             <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Simpan</button>
                           </div>
                         </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
    

<?php include 'src/footer.php'; ?>