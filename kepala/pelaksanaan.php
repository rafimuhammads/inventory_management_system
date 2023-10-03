<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Bulan Dan Tahun</h2>
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
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                          </tr>
                          <tr>
                            <td>
                              <select class="form-control" name="bulan">
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                              </select>
                            </td>
                            <td>
                              <input type="number" name="tahun" value="2023" class="form-control" required>
                            </td>
                            <td>
                              <button name="cari" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fa fa-search"></i> Cari </button>
                              <a href="pelaksanaan.php" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"> <i class="fa fa-refresh"></i> Refresh</a>
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
               <h2>Pelaksanaan Barang Masuk</h2>
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
                              <th>Nama Barang</th>
                              <th>Ukuran</th>
                              <th>Satuan</th>
                              <?php if(isset($_POST['cari'])){ ?>
                              <th>Barang Masuk <?= $_POST['bulan']." ".$_POST['tahun'] ?></th>
                              <?php }else{ ?>
                              <th>Barang Masuk Januari 2023</th>
                              <?php } ?>
                              <th>Vendor</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $bulan_peramalan = "";
                              
                              if(isset($_POST['cari'])){
                                $bulan = $_POST['bulan'];
                                $tahun = $_POST['tahun'];

                                $query = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.id_barang = barang.id_barang AND peramalan.bulan_peramalan = '$_POST[bulan]' AND peramalan.tahun_peramalan = '$tahun' AND peramalan.status = 'Ya'");
                              }else{
                                $query = mysqli_query($koneksi, "SELECT barang.*, peramalan.* FROM barang, peramalan WHERE peramalan.bulan_peramalan = 'Januari' AND peramalan.tahun_peramalan = '2023' AND peramalan.id_barang = barang.id_barang AND peramalan.status = 'Ya'");
                              }
                              
                              while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr align="center">
                              <td bgcolor="#FFFFFF"> <?php echo $data['kode_barang']; ?></td>
                              <td bgcolor="#FFFFFF"> <?php echo $data['nama_barang']; ?></td>
                              <td bgcolor="#FFFFFF"><?php echo $data['ukuran_barang']; ?></td>
                              <td bgcolor="#FFFFFF">Pcs</td>
                              <td><?= round($data['peramalan_keluar']) ?></td>
                              <td bgcolor="#FFFFFF"> <?php echo $data['suplier']; ?></td>
                            </tr>
                            <?php $bulan_peramalan = $data['bulan_peramalan']; } ?>
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