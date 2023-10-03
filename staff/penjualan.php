<?php include 'src/header.php'; error_reporting(0); ?>

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
                              <th>Stok Akhir</th>
                              <th>Jumlah</th>
                              <th>Status Stok</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT barang.*, penjualan.* FROM barang, penjualan WHERE penjualan.id_barang = barang.id_barang");
                              while($data = mysqli_fetch_array($query)){
                                $bulan_masuk    = date("m",strtotime($data['tanggal_penjualan']));
                                $tahun_keluar   = date("Y",strtotime($data['tanggal_penjualan']));

                                include 'src/kondisi_bulan.php';
                                $QueryPersediaan = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$data[id_barang]' AND bulan_persediaan = '$bulanGanti' AND tahun_persediaan = '$tahun_keluar'");
                                $DataPersediaan  = mysqli_fetch_array($QueryPersediaan);
                                $persediaan = ($DataPersediaan['stok_awal'] + $DataPersediaan['barang_masuk'])  - $DataPersediaan['barang_keluar'];
                            ?>
                            <tr align="center">
                              <th><?= $no++ ?></th>
                              <td><?= $data['tanggal_penjualan'] ?></td>
                              <td><?= $data['nama_customer'] ?></td>
                              <td><?= $data['nama_barang'] ?></td>
                              <td><?= $data['ukuran_barang'] ?></td>
                              <td><?= $persediaan ?></td>
                              <td><?= $data['jumlah_penjualan'] ?></td>
                              <td><?= $data['status_stok'] ?></td>
                              <td>
                                <a href="penjualan_detail.php?id_penjualan=<?php echo $data['id_penjualan']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span aria-hidden="true" class="fa fa-eye"></span></button></a>
                                <?php if($data['status_stok'] == "Menunggu Konfirmasi"){ ?>
                                <a href="penjualan_approve.php?id_penjualan=<?php echo $data['id_penjualan']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true" class="fa fa-check"></span></button></a>
                                <a href="penjualan_tolak.php?id_penjualan=<?php echo $data['id_penjualan']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true" class="fa fa-close"></span></button></a>
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