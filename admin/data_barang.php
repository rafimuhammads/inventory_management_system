<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Data Barang</h2>
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
                              <th>Kode</th>
                              <th>Nama Barang</th>
                              <th>Stok</th>
                              <th>Ukuran</th>
                              <th>Harga</th>
                              <th>Satuan</th>
                              <th>Foto</th>
                              <th><a href="barang_tambah.php"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true" class="fa fa-plus"></span></button></a></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT * FROM barang");
                              while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr align="center">
                              <th><?= $data['kode_barang'] ?></th>
                              <td><?= $data['nama_barang'] ?></td>
                              <td><?= $data['stok_barang'] ?></td>
                              <td><?= $data['ukuran_barang'] ?></td>
                              <td><?= $data['harga_barang'] ?></td>
                              <td>PCS</td>
                              <td><img src="../foto/<?= $data['id_barang'] ?>/<?= $data['foto_barang'] ?>" width="90px"></td>
                              <td>
                                <a href="barang_edit.php?id_barang=<?php echo $data['id_barang']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span aria-hidden="true" class="fa fa-pencil"></span></button></a>
                                <a href="barang_hapus.php?id_barang=<?php echo $data['id_barang']; ?>" onclick="return confirm('Yakin Ingin Mneghapus Data Ini?')" ><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true" class="fa fa-trash"></span></button></a>
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