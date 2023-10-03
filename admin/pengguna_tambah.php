<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $nama   = $_POST['nama_pengguna'];
  $user   = $_POST['username'];
  $pass   = ($_POST['password']);
  $level  = $_POST['level'];

  $QueryCek = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username = '$user'");
  $DataCek  = mysqli_num_rows($QueryCek);

  if($DataCek > 0){
    echo "<script>alert('Username Sudah Ada');window.location='admin_tambah.php'</script>";
  }else{
    $simpan = mysqli_query($koneksi, "INSERT INTO pengguna VALUES('','$nama','$user','$pass','$level')");
    echo "<script>alert('Data Berhasil Di Simpan');window.location='data_pengguna.php'</script>";
  }

  

}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Tambah Data Pengguna</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                           <div class="form-group">
                             <label class="form-control-label" for="nama_pengguna">Nama Pengguna</label>
                             <input type="text" class="form-control" name="nama_pengguna" autocomplete="off" placeholder="Input Nama Pengguna" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="username">Username</label>
                             <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Input Username" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="password">Password</label>
                             <input type="text" class="form-control" id="password" name="password" autocomplete="off" placeholder="Input Password" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="level">Level</label>
                             <select class="form-control" name="level">
                               <option value="Admin Gudang">Admin Gudang</option>
                               <option value="Staff Gudang">Staff Gudang</option>
                               <option value="Kepala Gudang">Kepala Gudang</option>
                             </select>
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