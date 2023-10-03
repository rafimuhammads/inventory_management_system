<?php include 'src/header.php'; error_reporting(0); ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Perencanaan Persediaan Barang Masuk</h2>
            </div>
         </div>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                          <div class="form-group">
                             <label class="form-control-label" for="suplier">Nama Vendor</label>
                             <select class="form-control" name="suplier">
                                <?php
                                $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang_masuk GROUP BY suplier");
                                while($DataBarang = mysqli_fetch_array($QueryBarang)){
                                ?>
                                <option value="<?= $DataBarang['suplier'] ?>"><?= $DataBarang['suplier'] ?></option>
                                <?php } ?>
                              </select>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="id_barang">Nama Barang</label>
                             <select class="form-control" name="id_barang">
                                <?php
                                $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY ukuran_barang");
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
                            <label class="form-control-label" for="jumlah">Jumlah Permintaan</label>
                            <input type="number" class="form-control" placeholder="Jumlah Permintaan" name="jumlah" required>
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

<?php
$id_barang1 = $_POST['id_barang'];
$bulan1     = $_POST['bulan'];
$tahun1     = $_POST['tahun'];

//CEK BARANG KELUAR PADA BULAN DAN TAHUN SEBELUMNYA
$bulankurang = $bulan1 - 1;

if($bulankurang < 0){
  $bulan = 11;
  $tahun = $tahun - 1;
}else{
  $bulan = $bulankurang;
  $thn   = $tahun1;
}

include "src/kondisi/kondisi_bulan.php";
include "src/kondisi/kondisi_thn.php";

$querycek = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang1' AND bulan_persediaan = '$tampil' AND tahun_persediaan = '$ganti'");
$datacek  = mysqli_num_rows($querycek);
$dataj    = mysqli_fetch_array($querycek);

//JIKA TIDA ADA MAKA AKAN MUNCUL NOTIFIKASI
if($datacek < 1){
  echo "<script>alert('Persediaan Pada Bulan $tampil Tahun $ganti Tidak Ada');window.location='peramalan.php'</script>";
}else{ //JIKA ADA MAKA AKAN MENGHITUNG PERAMALAN
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Barang Keluar 1 Tahun Terakhir</h2>
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
                            <th align="center">No</th>
                            <th align="center">Periode</th>
                            <th align="center">Bulan</th>
                            <th align="center">Tahun</th>
                            <th align="center">Barang Keluar</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                          $id_barang  = $_POST['id_barang'];
                          $periode    = $bulan + $thn;
                          //MENGAMBIL DATA 1 TAHUN TERAKHIR SEBELUM BULAN DAN TAHUN YANG DIPILIH
                          if($periode < 12){
                            $ambil = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' ORDER BY id_persediaan LIMIT 12");
                          }else{
                            $ambil = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND id_persediaan <= '$dataj[id_persediaan]' ORDER BY id_persediaan DESC LIMIT 12");
                          }
                          if (mysqli_num_rows($ambil) > 0) {
                              
                              $datamasuk = array();
                              while ($data = mysqli_fetch_array($ambil)) {
                                array_push($datamasuk, $data['id_persediaan']); //MEMASUKKAN DATA KE DALAM ARRAY
                              } 
                              //MENGHITUNG JUMLAH Y, JUMLAH X, DLL
                              sort($datamasuk);
                              $no = 1;
                              $x1 = 0;

                              foreach($datamasuk as $datamasuk):
                                $queryambil = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_persediaan = '$datamasuk'"); //MEMANGGIL DATA BERDASARKAN ID PERSEDIAAN
                                $dataambil  = mysqli_fetch_array($queryambil);
                              
                              ?>
                              <tr>
                                  <td align="center"><?= $no++; ?></td>
                                  <td align="center"><?= $x1++; ?></td>
                                  <td align="center"><?= $dataambil['bulan_persediaan']; ?></td>
                                  <td align="center"><?= $dataambil['tahun_persediaan']; ?></td>
                                  <td align="center"><?= $dataambil['barang_keluar']; ?></td>
                              </tr>
                              <?php endforeach; } ?>
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
                          $periode    = $bulan + $thn;
                          //MENGAMBIL DATA 1 TAHUN TERAKHIR SEBELUM BULAN DAN TAHUN YANG DIPILIH
                          if($periode < 12){
                            $ambil = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' ORDER BY id_persediaan LIMIT 12");
                          }else{
                            $ambil = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_barang = '$id_barang' AND id_persediaan <= '$dataj[id_persediaan]' ORDER BY id_persediaan DESC LIMIT 12");
                          }
                          if (mysqli_num_rows($ambil) > 0) {
                              
                              $datamasuk = array();
                              while ($data = mysqli_fetch_array($ambil)) {
                                array_push($datamasuk, $data['id_persediaan']); //MEMASUKKAN DATA KE DALAM ARRAY
                              } 
                              //MENGHITUNG JUMLAH Y, JUMLAH X, DLL
                              sort($datamasuk);
                              $x = 0;
                              $jumlah_x = 0;
                              $jumlah_y = 0;
                              $jumlah_xx = 0;
                              $jumlah_xy = 0;

                              foreach($datamasuk as $datamasuk):
                                $queryambil = mysqli_query($koneksi, "SELECT * FROM persediaan WHERE id_persediaan = '$datamasuk'"); //MEMANGGIL DATA BERDASARKAN ID PERSEDIAAN
                                $dataambil  = mysqli_fetch_array($queryambil);
                                $jumlah_x += $x;
                                $jumlah_y += $dataambil['barang_keluar'];
                                $jumlah_xy += ($x * $dataambil['barang_keluar']);
                                $jumlah_xx += ($x * $x);
      
                                $x++;
                              endforeach;

                              //MENCARI RATA - RATA
                              $rata2_x = $jumlah_x / 12;
                              $rata2_y = $jumlah_y / 12;
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
                              <th align="center">Vendor</th>
                              <th align="center">Nama Barang</th>
                              <th align="center">Bulan</th>
                              <th align="center">Tahun</th>
                              <th align="center">Periode</th>
                              <th align="center">Peramalan</th>
                              <th align="center">MAD</th>
                          </tr>
                          <?php
                          //Menghitung nilai B
                          $Angka1 = (12 * $jumlah_xy);
                          $angka1a = ($jumlah_x * $jumlah_y);
                          $hasil1 = $Angka1 - $angka1a;
                          $hasil2 = (12 * $jumlah_xx) - ($jumlah_x * $jumlah_x);
                          $NilaiB = $hasil1 / $hasil2;
                          //Menghitung nilai A
                          $NilaiA = ($jumlah_y - ($NilaiB * $jumlah_x)) / 12;

                          //mengambil periode
                          $id_barang  = $_POST['id_barang'];
                          $bulan      = $_POST['bulan'];
                          $thn        = $_POST['tahun'];

                          //MENGAMBIL KONDISI BULAN DAN TAHUN
                          include "src/kondisi/kondisi_bulan.php";
                          include "src/kondisi/kondisi_thn.php";

                          //Prediksi Penjualan
                          $periode  = $bulan + $thn; //PERIODE (X) YANG AKAN DI PREDIKSI
                          $hasil    = ($NilaiA) + ($NilaiB * $x); //RUMUS TREND MOMENT

                          //Menghitung Error MSE dan MAD
                          $ambil2 = mysqli_query($koneksi, "SELECT barang.*, persediaan.* FROM barang, persediaan WHERE persediaan.id_barang = barang.id_barang AND persediaan.id_barang = '$id_barang' AND persediaan.bulan_persediaan = '$tampil' AND persediaan.tahun_persediaan = '$ganti'"); //MENGAMBIL DATA BARANG KELUAR BERDASARKAN ID BARANG, BULAN, DAN TAHUN
                          $error = mysqli_fetch_array($ambil2);
                          $cek = mysqli_num_rows($ambil2);

                          if ($cek > 0) { //JIKA DATA ADA MAKA AKAN MENGAMBIL DATA BARANG KELUAR
                            $MAD = (abs($hasil - $error['barang_keluar']) / 12);
                          } else { //JIKA DATA TIDAK ADA MAKA NILAINYA 0
                            $MAD = (abs($hasil - 0) / 12);
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

                          //MENYIMPAN HASIL PREDIKSI KE DALAM TABEL PERAMALAN
                          $simpan = mysqli_query($koneksi, "INSERT INTO peramalan VALUES ('','$id_barang','$_POST[suplier]','$tampil','$ganti','$_POST[jumlah]','$hasil','$safety_stock','$MAD','$_SESSION[id]','')");

                          $QueryBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
                          $DataBarang  = mysqli_fetch_array($QueryBarang);

                          ?>
                          <tbody>
                              <tr>
                                  <td align="center"><?= $DataBarang['kode_barang'] ?></td>
                                  <td align="center"><?= $_POST['suplier'] ?></td>
                                  <td align="center"><?= $DataBarang['nama_barang'] ?></td>
                                  <td align="center"><?= $tampil ?></td>
                                  <td align="center"><?= $ganti ?></td>
                                  <td align="center"><?= $x ?></td>
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

<?php } } ?>

<?php include 'src/footer.php'; ?>