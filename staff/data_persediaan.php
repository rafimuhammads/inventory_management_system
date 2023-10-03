<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Data Persediaan Barang</h2>
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
                              <th>Ukuran</th>
                              <th>Bulan</th>
                              <th>Tahun</th>
                              <th>Stok Awal</th>
                              <th>Masuk</th>
                              <th>Keluar</th>
                              <th>Total</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no = 1;
                              $query = mysqli_query($koneksi, "SELECT barang.*, persediaan.* FROM barang, persediaan WHERE persediaan.id_barang = barang.id_barang");
                              while($data = mysqli_fetch_array($query)){
                                $persediaan = ($data['stok_awal'] + $data['barang_masuk'])  - $data['barang_keluar'];

                                if($persediaan > 300){
                                  $status = '<button class="btn btn-danger">Tidak Aman</button>';
                                }else{
                                  $status = '<button class="btn btn-success">Aman</button>';
                                }
                            ?>
                            <tr align="center">
                              <th><?= $data['kode_barang'] ?></th>
                              <td><?= $data['nama_barang'] ?></td>
                              <td><?= $data['ukuran_barang'] ?></td>
                              <td><?= $data['bulan_persediaan'] ?></td>
                              <td><?= $data['tahun_persediaan'] ?></td>
                              <td><?= $data['stok_awal'] ?></td>
                              <td><?= $data['barang_masuk'] ?></td>
                              <td><?= $data['barang_keluar'] ?></td>
                              <td><?= $persediaan ?></td>
                              <td><?= $status ?></td>
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