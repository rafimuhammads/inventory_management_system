<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Data Pengguna</h2>
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
                              <th>Nama Pengguna</th>
                              <th>Username</th>
                              <th>Password</th>
                              <th>Level</th>
                              <th><a href="pengguna_tambah.php"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true" class="fa fa-plus"></span></button></a></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT * FROM pengguna");
                              while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                              <td><?= $no++ ?></td>
                              <td><?= $data['nama_pengguna'] ?></td>
                              <td><?= $data['username'] ?></td>
                              <td><?= $data['password'] ?></td>
                              <td><?= $data['level'] ?></td>
                              <td>
                                <a href="pengguna_edit.php?id_pengguna=<?php echo $data['id_pengguna']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span aria-hidden="true" class="fa fa-pencil"></span></button></a>
                                <?php if($data['id_pengguna'] == 1){}else{ ?>
                                <a href="pengguna_hapus.php?id_pengguna=<?php echo $data['id_pengguna']; ?>" onclick="return confirm('Yakin Ingin Mneghapus Data Ini?')" ><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true" class="fa fa-trash"></span></button></a>
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