<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Data Admin</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <table class="table table-bordered" id="tabel-data">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Nama Admin</th>
                              <th>Username</th>
                              <th>Password</th>
                              <th><a href="admin_tambah.php"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true"></span>Tambah</button></a></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT * FROM data_admin");
                              while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                              <td><?= $no++ ?></td>
                              <td><?= $data['nama_admin'] ?></td>
                              <td><?= $data['username'] ?></td>
                              <td><?= $data['password'] ?></td>
                              <td>
                                <a href="admin_edit.php?id_admin=<?php echo $data['id_admin']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span aria-hidden="true"></span>Edit</button></a>
                                <?php if($data['id_admin'] == 1){}else{ ?>
                                <a href="admin_hapus.php?id_admin=<?php echo $data['id_admin']; ?>" onclick="return confirm('Yakin Ingin Mneghapus Data Ini?')" ><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true"></span>Hapus</button></a>
                                <?php } ?>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include 'src/footer.php'; ?>