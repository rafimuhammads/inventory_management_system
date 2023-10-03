<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Input Prediksi Trend Moment</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="tampil_prediksi.php" method="POST">
                           <div class="form-group">
                             <label class="form-control-label" for="id_barang">Nama Barang</label>
                             <select class="form-control" name="id_barang">
                                <?php
                                $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang");
                                while($DataBarang = mysqli_fetch_array($QueryBarang)){
                                ?>
                                <option value="<?= $DataBarang['id_barang'] ?>"><?= $DataBarang['nama_barang']." Ukuran ".$DataBarang['ukuran_barang'] ?></option>
                                <?php } ?>
                              </select>
                           </div>
                           <div class="form-group">
                            <label class="form-control-label" for="bulan">Bulan</label>
                            <select class="form-control" name="bulan" id="bulan">
                                <option value="0">Januari</option>
                                <option value="1">Februari</option>
                                <option value="2">Maret</option>
                                <option value="3">April</option>
                                <option value="4">Mei</option>
                                <option value="5">Juni</option>
                                <option value="6">Juli</option>
                                <option value="7">Agustus</option>
                                <option value="8">September</option>
                                <option value="9">Oktober</option>
                                <option value="10">November</option>
                                <option value="11">Desember</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="form-control-label" for="tahun">Tahun</label>
                            <select class="form-control" name="tahun" id="tahun">
                                <option value="0">2022</option>
                                <option value="11">2023</option>
                                <option value="22">2024</option>
                            </select>
                          </div>
                           <div class="form-group">
                             <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Hitung</button>
                           </div>
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
               <h2>Tampil Hasil Prediksi</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                          
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include 'src/footer.php'; ?>