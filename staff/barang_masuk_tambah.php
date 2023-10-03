<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $id_barang      = $_POST['id_barang'];
  $tanggal_masuk  = $_POST['tanggal_masuk'];
  $waktu_tunggu   = $_POST['waktu_tunggu'];
  $suplier        = $_POST['suplier'];
  $barang_masuk   = ($_POST['barang_masuk']);
  $id_pengguna     = $_SESSION['id'];
  $bulan_masuk    = date("m",strtotime($tanggal_masuk));
  $tahun_masuk    = date("Y",strtotime($tanggal_masuk));

  include 'src/kondisi_bulan.php';

  $simpanMasuk = mysqli_query($koneksi, "INSERT INTO barang_masuk VALUES('','$id_barang','$tanggal_masuk','$waktu_tunggu','$suplier','$barang_masuk','$id_pengguna')");

  $QueryCek = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_masuk'");
  $DataCek  = mysqli_num_rows($QueryCek);

  if($DataCek > 0){
    $QueryPersediaan = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_masuk'");
    $DataPersediaan  = mysqli_fetch_array($QueryPersediaan);
    $ABarangMasuk    = $DataPersediaan['barang_masuk'] + $barang_masuk;

    $update          = mysqli_query($koneksi, "UPDATE persediaan SET barang_masuk = '$ABarangMasuk' WHERE id_barang = '$id_barang' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_masuk'");

    echo "<script>alert('Data Berhasil Disimpan');window.location='data_barang_masuk.php'</script>";

  }else{
    $querybarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
    $databarang  = mysqli_fetch_array($querybarang);

    $simpan = mysqli_query($koneksi, "INSERT INTO persediaan VALUES('','$id_barang','$bulanGanti','$tahun_masuk','$databarang[stok_barang]','$barang_masuk','')");
    echo "<script>alert('Data Berhasil Di Simpan');window.location='data_barang_masuk.php'</script>";
  
  }
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Tambah Data Barang Masuk</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                             <label class="form-control-label" for="tanggal_masuk">Tanggal Masuk</label>
                             <input type="text" class="form-control" name="tanggal_masuk" value="<?= date('Y-m-d') ?>" readonly>
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
                             <label class="form-control-label" for="waktu_tunggu">Waktu Tunggu</label>
                             <input type="number" class="form-control" name="waktu_tunggu" autocomplete="off" placeholder="Input Waktu Tunggu" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="suplier">Nama Vendor</label>
                             <input type="text" class="form-control" name="suplier" autocomplete="off" placeholder="Input Nama Vendor" required>
                           </div>
                           
                           <div class="form-group">
                             <label class="form-control-label" for="barang_masuk">Jumlah Barang Masuk</label>
                             <input type="number" class="form-control" name="barang_masuk" autocomplete="off" placeholder="Input Jumlah Barang Masuk" required>
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