<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Input Peramalan Trend Moment</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
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
                                <option value="12">2023</option>
                                <option value="24">2024</option>
                            </select>
                          </div>
                           <div class="form-group">
                             <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="hitung"><span aria-hidden="true"></span>Hitung</button>
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

<?php if(isset($_POST['hitung'])){ ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Mencari Nilai Prediksi</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <table class="table table-bordered" id="tabel-data">
                          <tr align="center">
                              <th align="center">Y</th>
                              <th align="center">X</th>
                              <th align="center">XY</th>
                              <th align="center">XX</th>
                              <th align="center">Rata" Y</th>
                              <th align="center">Rata" X</th>
                          </tr>
                          <?php
                          $id_barang  = $_POST['id_barang'];
                          $ambil = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang'");
                          if (mysqli_num_rows($ambil) > 0) {
                              $x = 0;
                              $jumlah_x = 0;
                              $jumlah_y = 0;
                              $jumlah_xx = 0;
                              $jumlah_xy = 0;
                              while ($data = mysqli_fetch_array($ambil)) {
                                  $jumlah_x += $x;
                                  $jumlah_y += $data['barang_keluar'];
                                  $jumlah_xy += ($x * $data['barang_keluar']);
                                  $jumlah_xx += ($x * $x);
                          ?>
                          <?php $x++;
                              } ?>
                          <!-- Mencari Rata - Rata -->
                          <?php
                              $jumlah_data = mysqli_query($koneksi, "SELECT COUNT(id_persediaan) as jumlahdata FROM persediaan WHERE id_barang = '$id_barang'");
                              $r = mysqli_fetch_array($jumlah_data);
                              $rata2_x = $jumlah_x / $r['jumlahdata'];
                              $rata2_y = $jumlah_y / $r['jumlahdata'];
                              ?>
                          <tbody>
                              <tr>
                                  <td align="center"><?= $jumlah_y; ?></td>
                                  <td align="center"><?= $jumlah_x; ?></td>
                                  <td align="center"><?= $jumlah_xy; ?></td>
                                  <td align="center"><?= $jumlah_xx; ?></td>
                                  <td align="center"><?= $rata2_y; ?></td>
                                  <td align="center"><?= $rata2_x; ?></td>
                              </tr>
                              <?php } ?>
                      </table>
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
               <h2>Tampil Hasil Peramalan</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <tr align="center">
                              <th align="center">Kode</th>
                              <th align="center">Nama Barang</th>
                              <th align="center">Bulan</th>
                              <th align="center">Tahun</th>
                              <th align="center">Periode</th>
                              <th align="center">Prediksi Persediaan</th>
                              <th align="center">MAD</th>
                          </tr>
                          <?php
                          //Menghitung nilai B
                          $Angka1 = ($r['jumlahdata'] * $jumlah_xy);
                          $angka1a = ($jumlah_x * $jumlah_y);
                          $hasil1 = $Angka1 - $angka1a;
                          $hasil2 = ($r['jumlahdata'] * $jumlah_xx) - ($jumlah_x * $jumlah_x);
                          $NilaiB = $hasil1 / $hasil2;
                          //Menghitung nilai A
                          $NilaiA = ($jumlah_y - ($NilaiB * $jumlah_x)) / $r['jumlahdata'];

                          //mengambil periode
                          $id_barang  = $_POST['id_barang'];
                          $bulan      = $_POST['bulan'];
                          $thn        = $_POST['tahun'];

                          //MENGAMBIL KONDISI BULAN DAN TAHUN
                          include "src/kondisi/kondisi_bulan.php";
                          include "src/kondisi/kondisi_thn.php";

                          //Prediksi Penjualan
                          $periode = $bulan + $thn;
                          $prediksi1 = ($NilaiB * $periode);
                          $hasil = ($NilaiA) + ($prediksi1);

                          $QueryId = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND bulan_persediaan = '$tampil' AND tahun_persediaan = '$ganti'");
                          $DataId  = mysqli_fetch_array($QueryId);

                          //Menghitung Error MSE dan MAD
                          $ambil2 = mysqli_query($koneksi, "SELECT barang.*, persediaan.* FROM barang, persediaan WHERE persediaan.id_barang = barang.id_barang AND persediaan.id_barang = '$id_barang' AND persediaan.bulan_persediaan = '$tampil' AND persediaan.tahun_persediaan = '$ganti'");
                          $error = mysqli_fetch_array($ambil2);
                          $cek = mysqli_num_rows($ambil2);

                          if ($cek > 0) {
                            $MAD = (abs($hasil - $error['barang_keluar']) / $r['jumlahdata']);
                          } else {
                            $MAD = (abs($hasil - 0) / $r['jumlahdata']);
                          }

                          //SAFTY STOK                    
                          $SL          = 1.28;
                          $HL          = 30;
                          $LT          = array(2,3,4,3,4,2,3,4,3,4,3,4);
                          $AVGLead     = array_sum($LT) / count($LT);
                          $AVGKeluar   = $rata2_y;
                          $stdLT       = 0;
                          $stdK        = 0;
                          foreach ($LT as $d) {
                            $stdLT += pow($d - $AVGLead, 2);
                          }

                          $datakeluar   = array();
                          $QueryKeluar  = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang'");
                          while($DataKeluar = mysqli_fetch_array($QueryKeluar)){
                            array_push($datakeluar, $DataKeluar['barang_keluar']);
                            $stdK       += pow($DataKeluar['barang_keluar'] - $AVGKeluar, 2);
                          }
                          $STDLead      = sqrt($stdLT / (count($LT)-1));
                          $STDKeluar    = sqrt($stdK / (count($datakeluar)-1));
                          $MAXKeluar    = max($datakeluar);

                          $safety_stock = sqrt(($AVGLead * ($STDKeluar * $STDKeluar)) + ($rata2_y * $rata2_y) * ($STDLead * $STDLead)) * $SL;

                          //Simpan ke Tabel tbl_forecastingSS

                          $QueryHasilCek = mysqli_query($koneksi, "SELECT * FROM peramalan WHERE id_barang = '$id_barang' AND bulan_peramalan = '$tampil' AND tahun_peramalan = '$ganti'");
                          $DataHAsilCek  = mysqli_num_rows($QueryHasilCek);

                          if($DataHAsilCek < 1){
                            $simpan = mysqli_query($koneksi, "INSERT INTO peramalan VALUES ('','$id_barang','$tampil','$ganti','$hasil','$safety_stock','$MAD','$_SESSION[id]')");
                          }else{
                            $update = mysqli_query($koneksi, "UPDATE peramalan SET peramalan_keluar = '$hasil', error1_keluar = '$MAD', safety_stok = '$safety_stock' WHERE id_barang = '$id_barang' AND bulan_peramalan = '$tampil' AND tahun_peramalan = '$ganti'");
                          }

                          $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
                          $DataBarang  = mysqli_fetch_array($QueryBarang);

                          ?>
                          <tbody>
                              <tr>
                                  <td align="center"><?= $DataBarang['kode_barang'] ?></td>
                                  <td align="center"><?= $DataBarang['nama_barang'] ?></td>
                                  <td align="center"><?= $tampil ?></td>
                                  <td align="center"><?= $ganti ?></td>
                                  <td align="center"><?= $periode ?></td>
                                  <td align="center"><?= round($hasil) ?></td>
                                  <td align="center"><?= round($MAD, 2) ?></td>
                              </tr>
                      </table>
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php } ?>

<?php include 'src/footer.php'; ?>