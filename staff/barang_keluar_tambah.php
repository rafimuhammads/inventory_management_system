<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $id_barang       = $_POST['id_barang'];
  $id_customer     = $_POST['nama_customer'];
  $tanggal_keluar  = $_POST['tanggal_keluar'];
  $barang_keluar   = ($_POST['barang_keluar']);
  $id_pengguna     = $_SESSION['id'];
  $bulan_masuk     = date("m",strtotime($tanggal_keluar));
  $tahun_keluar    = date("Y",strtotime($tanggal_keluar));

  include 'src/kondisi_bulan.php';

  $simpankeluar = mysqli_query($koneksi, "INSERT INTO barang_keluar VALUES('','$id_barang','$id_customer','$tanggal_keluar','$barang_keluar','$id_pengguna')");

  $QueryCek = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");
  $DataCek  = mysqli_num_rows($QueryCek);

  if($DataCek > 0){
    $QueryPersediaan = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");
    $DataPersediaan  = mysqli_fetch_array($QueryPersediaan);
    $ABarangkeluar   = $DataPersediaan['barang_keluar'] + $barang_keluar;

    $update          = mysqli_query($koneksi, "UPDATE persediaan SET barang_keluar = '$ABarangkeluar' WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");

    echo "<script>alert('Data Berhasil Disimpan');window.location='data_barang_keluar.php'</script>";

  }else{
    $querybarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
    $databarang  = mysqli_fetch_array($querybarang);

    $simpan = mysqli_query($koneksi, "INSERT INTO persediaan VALUES('','$id_barang','$bulanGanti','$tahun_keluar','$databarang[stok_barang]','','$barang_keluar')");
    echo "<script>alert('Data Berhasil Di Simpan');window.location='data_barang_keluar.php'</script>";
  
  }
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Tambah Data Barang Keluar</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                             <label class="form-control-label" for="tanggal_keluar">Tanggal keluar</label>
                             <input type="text" class="form-control" name="tanggal_keluar" value="<?= date('Y-m-d') ?>" readonly>
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
                             <label class="form-control-label" for="barang_keluar">Jumlah Barang Keluar</label>
                             <input type="number" class="form-control" name="barang_keluar" autocomplete="off" placeholder="Input Jumlah Barang Keluar" required>
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