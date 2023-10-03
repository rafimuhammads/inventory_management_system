<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Penjualan</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <a href="penjualan_tambah.php"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true" class="fa fa-plus"></span></button></a>
                  <hr>
                  <div class="content">
                     <div class="table-responsive-sm">
                        <table class="table table-bordered" id="tabel-data">
                          <thead>
                            <tr align="center">
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Customer</th>
                              <th>Nama Barang</th>
                              <th>Ukuran</th>
                              <th>Jumlah</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT barang.*, penjualan.* FROM barang, penjualan WHERE penjualan.id_barang = barang.id_barang");
                              while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr align="center">
                              <th><?= $no++ ?></th>
                              <td><?= $data['tanggal_penjualan'] ?></td>
                              <td><?= $data['nama_customer'] ?></td>
                              <td><?= $data['nama_barang'] ?></td>
                              <td><?= $data['ukuran_barang'] ?></td>
                              <td><?= $data['jumlah_penjualan'] ?></td>
                              <td>
                                <a href="penjualan_detail.php?id_penjualan=<?php echo $data['id_penjualan']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden="true" class="fa fa-eye"></span></button></a>
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