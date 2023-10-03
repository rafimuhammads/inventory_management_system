<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $id_barang       = $_POST['id_barang'];
  $nama_customer   = $_POST['nama_customer'];
  $tanggal_keluar  = $_POST['tanggal_penjualan'];
  $barang_keluar   = ($_POST['jumlah_penjualan']);
  $status_stok     = "Menunggu Konfirmasi";
  $id_pengguna     = $_SESSION['id'];

  $simpankeluar = mysqli_query($koneksi, "INSERT INTO penjualan VALUES('','$id_barang','$nama_customer','$tanggal_keluar','$barang_keluar','$status_stok','$id_pengguna')");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='penjualan.php'</script>";
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Tambah Penjualan</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                             <label class="form-control-label" for="tanggal_penjualan">Tanggal Penjualan</label>
                             <input type="text" class="form-control" name="tanggal_penjualan" value="<?= date('Y-m-d') ?>" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="nama_barang">Nama Barang</label>
                             <select class="form-control" name="id_barang">
                               <?php
                               $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang");
                               while($DataBarang = mysqli_fetch_array($QueryBarang)){
                               ?>
                               <option value="<?= $DataBarang['id_barang'] ?>"><?= $DataBarang['kode_barang']." - ".$DataBarang['nama_barang']." Ukuran ".$DataBarang['ukuran_barang'] ?></option>
                               <?php } ?>
                             </select>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="nama_customer">Nama Customer</label>
                             <input type="text" class="form-control" placeholder="Nama Customer" name="nama_customer" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="jumlah_penjualan">Jumlah Penjualan</label>
                             <input type="number" class="form-control" name="jumlah_penjualan" autocomplete="off" placeholder="Input Penjualan" required>
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