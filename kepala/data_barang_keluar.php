<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Nama Barang Dan Tahun</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form method="POST" action="">
                        <table class="table table-striped">
                          <tr>
                            <th>Nama Barang</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                          </tr>
                          <tr>
                            <td>
                              <select class="form-control" name="id_barang">
                                <?php
                                $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang");
                                while($DataBarang = mysqli_fetch_array($QueryBarang)){
                                ?>
                                <option value="<?= $DataBarang['id_barang'] ?>"><?= $DataBarang['nama_barang']." Ukuran ".$DataBarang['ukuran_barang'] ?></option>
                                <?php } ?>
                              </select>
                            </td>
                            <td>
                              <input type="number" name="tahun" value="2023" class="form-control" required>
                            </td>
                            <td>
                              <button name="cari" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fa fa-search"></i> Cari </button>
                              <a href="barang_keluar.php" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"> <i class="fa fa-refresh"></i> Refresh</a>
                              <?php if(isset($_POST['cari'])){ ?>
                              <a href="barang_keluar_pdf.php?id_barang=<?= $_POST['id_barang'] ?>&tahun=<?= $_POST['tahun'] ?>" target="blank()" ><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true"></span><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button></a>
                              <a href="barang_keluar_excel.php?id_barang=<?= $_POST['id_barang'] ?>&tahun=<?= $_POST['tahun'] ?>" target="blank()" ><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true"></span><i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL</button></a>
                              <?php }else{ ?>
                              <a href="barang_keluar_pdf.php" target="blank()" ><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true"></span><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button></a>
                              <a href="barang_keluar_excel.php" target="blank()" ><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true"></span><i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL</button></a>
                              <?php } ?>
                            </td>
                          </tr>
                        </table>
                      </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Data Barang Keluar</h2>
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
                              <th>Customer</th>
                              <th>Nama Barang</th>
                              <th>Ukuran</th>
                              <th>Barang Keluar</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              if(isset($_POST['cari'])){
                                $id_barang = $_POST['id_barang'];
                                $tahun     = $_POST['tahun'];

                                $query = mysqli_query($koneksi, "SELECT barang.*, barang_keluar.* FROM barang, barang_keluar WHERE barang_keluar.id_barang = barang.id_barang AND barang_keluar.id_barang = '$id_barang' AND YEAR(barang_keluar.tanggal_keluar) = '$tahun'");
                              }else{
                                $query = mysqli_query($koneksi, "SELECT barang.*, barang_keluar.* FROM barang, barang_keluar WHERE barang_keluar.id_barang = barang.id_barang");
                              }
                              
                              while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr align="center">
                              <th><?= $data['kode_barang'] ?></th>
                              <td><?= $data['tanggal_keluar'] ?></td>
                              <td><?= $data['nama_customer'] ?></td>
                              <td><?= $data['nama_barang'] ?></td>
                              <td><?= $data['ukuran_barang'] ?></td>
                              <td><?= $data['barang_keluar'] ?></td>
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