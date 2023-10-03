<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $id_barang      = $_POST['id_barang'];
  $tanggal_masuk  = $_POST['tanggal_masuk'];
  $barang_masuk   = ($_POST['barang_masuk']);
  $waktu_tunggu   = $_POST['waktu_tunggu'];
  $suplier        = $_POST['suplier'];

  $QueryAmbil     = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE id_barang_masuk = '$_GET[id_barang_masuk]'");
  $DataAmbil      = mysqli_fetch_array($QueryAmbil);
  $bulan_masuk    = date("m",strtotime($DataAmbil['tanggal_masuk']));
  $tahun_masuk    = date("Y",strtotime($DataAmbil['tanggal_masuk']));
  include 'src/kondisi_bulan.php';

  $QueryCek   = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_masuk'");
  $DataCek    = mysqli_num_rows($QueryCek);
  $DataAmbil1 = mysqli_fetch_array($QueryCek);
  $MasukLama  = $DataAmbil1['barang_masuk'] - $DataAmbil['barang_masuk'];
  $MasukBaru  = $MasukLama + $barang_masuk;

  $update          = mysqli_query($koneksi, "UPDATE persediaan SET barang_masuk = '$MasukBaru' WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_masuk'");

  $update2         = mysqli_query($koneksi, "UPDATE barang_masuk SET waktu_tunggu = '$waktu_tunggu', suplier = '$suplier', barang_masuk = '$barang_masuk' WHERE id_barang_masuk = '$_GET[id_barang_masuk]'");

  echo "<script>alert('Data Berhasil Disimpan');window.location='data_barang_masuk.php'</script>";

}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Edit Data Barang Masuk</h2>
            </div>
         </div>
         <?php
         $id_barang_masuk = $_GET['id_barang_masuk'];
         $query           = mysqli_query($koneksi, "SELECT barang.*, barang_masuk.* FROM barang, barang_masuk WHERE barang_masuk.id_barang = barang.id_barang AND barang_masuk.id_barang_masuk = '$id_barang_masuk'");
         $data            = mysqli_fetch_array($query);
         ?>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                             <label class="form-control-label" for="tanggal_masuk">Tanggal Masuk</label>
                             <input type="text" class="form-control" name="tanggal_masuk" value="<?= $data['tanggal_masuk'] ?>" readonly>
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
                             <label class="form-control-label" for="waktu_tunggu">Waktu Tunggu</label>
                             <input type="number" class="form-control" value="<?= $data['waktu_tunggu'] ?>" name="waktu_tunggu" autocomplete="off" placeholder="Input Waktu Tunggu" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="suplier">Nama Vendor</label>
                             <input type="text" class="form-control" value="<?= $data['suplier'] ?>" name="Vendor" autocomplete="off" placeholder="Input Nama Vendor" required>
                           </div>
                           
                           <div class="form-group">
                             <label class="form-control-label" for="barang_masuk">Jumlah Barang Masuk</label>
                             <input type="number" class="form-control" name="barang_masuk" value="<?= $data['barang_masuk'] ?>" autocomplete="off" placeholder="Input Jumlah Barang Masuk" required>
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