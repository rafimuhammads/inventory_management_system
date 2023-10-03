<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Data Barang Masuk</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <table class="table table-bordered" id="tabel-data">
                          <thead>
                            <tr align="center">
                              <th>Kode Barang</th>
                              <th>Tanggal</th>
                              <th>Nama Barang</th>
                              <th>Ukuran</th>
                              <th>Barang Masuk</th>
                              <th><a href="barang_masuk_tambah.php"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true" class="fa fa-plus"></span></button></a></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT barang.*, barang_masuk.* FROM barang, barang_masuk WHERE barang_masuk.id_barang = barang.id_barang");
                              while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr align="center">
                              <th><?= $data['kode_barang'] ?></th>
                              <td><?= $data['tanggal_masuk'] ?></td>
                              <td><?= $data['nama_barang'] ?></td>
                              <td><?= $data['ukuran_barang'] ?></td>
                              <td><?= $data['barang_masuk'] ?></td>
                              <td>
                                <a style="color: red" href="#" data-toggle="modal" data-target="#myModal<?php echo $data['id_barang_masuk']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden="true" class="fa fa-search"></span></button></a>
                                <a href="barang_masuk_edit.php?id_barang_masuk=<?php echo $data['id_barang_masuk']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span aria-hidden="true" class="fa fa-pencil"></span></button></a>
                                <a href="barang_masuk_hapus.php?id_barang_masuk=<?php echo $data['id_barang_masuk']; ?>" onclick="return confirm('Yakin Ingin Mneghapus Data Ini?')" ><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true" class="fa fa-trash"></span></button></a>
                              </td>
                            </tr>
                            <div class="modal fade" id="myModal<?php echo $data['id_barang_masuk']; ?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <div id="only-on-print"> <h2>Detail Barang Masuk</h2> </div>
                                  <hr>
                                  <form method="post" action="">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Tanggal Barang Masuk</label>
                                          <div class="col-sm-15">
                                            <input type="text" name="tanggal_masuk" value="<?= $data['tanggal_masuk'] ?>" class="form-control" autocomplete="off" autofocus readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Kode Barang</label>
                                          <div class="col-sm-15">
                                            <input type="text" name="kode_barang" value="<?= $data['kode_barang'] ?>" class="form-control" autocomplete="off" readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Nama Barang</label>
                                          <div class="col-sm-15">
                                            <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" class="form-control" autocomplete="off" readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Waktu Tunggu</label>
                                          <div class="col-sm-15">
                                            <input type="text" name="waktu_tunggu" value="<?= $data['waktu_tunggu'].' Hari' ?>" class="form-control" autocomplete="off" readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Jumlah</label>
                                          <div class="col-sm-15">
                                            <input type="text" name="barang_masuk" value="<?= $data['barang_masuk'] ?>" class="form-control" autocomplete="off" readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Nama Vendor</label>
                                          <div class="col-sm-15">
                                            <input type="text" name="suplier" value="<?= $data['suplier'] ?>" class="form-control" autocomplete="off" readonly>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>            
                                  </form>             
                                </div>
                              </div>
                            </div>
                          </div>    
                          <!-- Large modal -->
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