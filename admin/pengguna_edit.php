<?php 
include 'src/header.php'; 

if(isset($_POST['simpan'])){
  $nama   = $_POST['nama_pengguna'];
  $user   = $_POST['username'];
  $pass   = ($_POST['password']);
  $level  = $_POST['level'];

  $simpan = mysqli_query($koneksi, "UPDATE pengguna SET nama_pengguna = '$nama', username = '$user', password = '$pass', level = '$level' WHERE id_pengguna = '$_GET[id_pengguna]'");
  echo "<script>alert('Data Berhasil Di Perbaruhi');window.location='data_pengguna.php'</script>";
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Edit Data Pengguna</h2>
            </div>
         </div>
         <?php
         $id_pengguna = $_GET['id_pengguna'];
         $query    = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE id_pengguna = '$id_pengguna'");
         $data     = mysqli_fetch_array($query);
         ?>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                           <div class="form-group">
                             <label class="form-control-label" for="nama_pengguna">Nama Pengguna</label>
                             <input type="text" class="form-control" name="nama_pengguna" value="<?= $data['nama_pengguna'] ?>" autocomplete="off" placeholder="Input Nama Pengguna" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="username">Username</label>
                             <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>" autocomplete="off" placeholder="Input Username" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="password">Password</label>
                             <input type="text" class="form-control" id="password" name="password" value="<?= $data['password'] ?>" autocomplete="off" placeholder="Input Password" required>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="level">Level</label>
                             <select class="form-control" name="level">
                               <option value="Admin Gudang" <?php if($data['level'] == "Admin Gudang"){ echo "selected"; } ?> >Admin Gudang</option>
                               <option value="Staff Gudang" <?php if($data['level'] == "Staff Gudang"){ echo "selected"; } ?> >Staff Gudang</option>
                               <option value="Kepala Gudang" <?php if($data['level'] == "Kepala Gudang"){ echo "selected"; } ?> >Kepala Gudang</option>
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