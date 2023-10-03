<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $nama      = $_POST['nama_barang'];
  $stok      = $_POST['stok_barang'];
  $ukur      = $_POST['ukuran_barang'];
  $harga     = ($_POST['harga_barang']);
  $foto      = $_FILES['foto_barang']['name'];

  $QueryCek = mysqli_query($koneksi, "SELECT * FROM barang WHERE nama_barang = '$nama' AND ukuran_barang = '$ukur'");
  $DataCek  = mysqli_num_rows($QueryCek);

  $query    = mysqli_query($koneksi, "SELECT max(id_barang) as noMax FROM barang");
  $data     = mysqli_fetch_array($query);
  $nomax    = $data['noMax'] + 1;
  $kode     = "SPT".$nomax;

  $tempdir = "../foto/$nomax/"; 

  if($DataCek > 0){
    echo "<script>alert('barang Sudah Ada');window.location='barang_tambah.php'</script>";

  }elseif (!file_exists($tempdir)){
    mkdir($tempdir,0755); 
    $target_path1 = $tempdir . basename($_FILES['foto_barang']['name']);
    move_uploaded_file($_FILES['foto_barang']['tmp_name'], $target_path1);

    $simpan = mysqli_query($koneksi, "INSERT INTO barang VALUES('$nomax','$kode','$nama','$stok','$ukur','$harga','$foto')");
    echo "<script>alert('Data Berhasil Di Simpan');window.location='data_barang.php'</script>";
  
  }else{
    $target_path1 = $tempdir . basename($_FILES['foto_barang']['name']);
    move_uploaded_file($_FILES['foto_barang']['tmp_name'], $target_path1);

    $simpan = mysqli_query($koneksi, "INSERT INTO barang VALUES('$nomax','$kode','$nama','$stok','$ukur','$harga','$foto')");
    echo "<script>alert('Data Berhasil Di Simpan');window.location='data_barang.php'</script>";
  }
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Tambah Data Barang</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                             <label class="form-control-label" for="nama_barang">Nama Barang</label>
                             <input type="text" class="form-control" name="nama_barang" autocomplete="off" placeholder="Input Nama Barang" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="ukuran_barang">Ukuran Barang</label>
                             <input type="text" class="form-control" name="ukuran_barang" autocomplete="off" placeholder="Input Ukuran Barang" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="stok_barang">Stok Barang</label>
                             <input type="number" class="form-control" name="stok_barang" autocomplete="off" placeholder="Input Stok Barang" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="harga_barang">Harga Barang</label>
                             <input type="text" class="form-control" name="harga_barang" autocomplete="off" placeholder="Input Harga Barang" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="foto_barang">Foto Barang</label>
                             <input type="file" class="form-control" name="foto_barang" autocomplete="off" required>
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