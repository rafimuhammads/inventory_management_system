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
          <a href="barang_pdf.php" target="blank()" ><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true"></span><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button></a>
          <a href="barang_excel.php" target="blank()" ><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true"></span><i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL</button></a>
          <hr>
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <table class="table table-bordered" id="tabel-data">
                          <thead>
                            <tr align="center">
                              <th>Kode</th>
                              <th>Nama Barang</th>
                              <th>Ukuran</th>
                              <th>Harga</th>
                              <th>Foto</th>
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
                              <td><?= $data['ukuran_barang'] ?></td>
                              <td><?= $data['harga_barang'] ?></td>
                              <td><img src="../foto/<?= $data['id_barang'] ?>/<?= $data['foto_barang'] ?>" width="90px"></td>
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