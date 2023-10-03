<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>Detail Penjualan</h2>
            </div>
         </div>
         <?php
         $query = mysqli_query($koneksi, "SELECT penjualan.*, barang.* FROM penjualan, barang WHERE penjualan.id_barang = barang.id_barang AND penjualan.id_penjualan = '$_GET[id_penjualan]'");
         $data  = mysqli_fetch_array($query);
         ?>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="penjualan.php" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                             <label class="form-control-label" for="tanggal_penjualan">Tanggal Penjualan</label>
                             <input type="text" class="form-control" name="tanggal_penjualan" value="<?= $data['tanggal_penjualan'] ?>" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="nama_barang">Nama Barang</label>
                             <input type="text" class="form-control" value="<?= $data['nama_barang'] ?>" name="nama_barang" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="ukuran_barang">Ukuran Barang</label>
                             <input type="text" class="form-control" value="<?= $data['ukuran_barang'] ?>" name="ukuran_barang" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="satuan_barang">Satuan Barang</label>
                             <input type="text" class="form-control" value="PCS" name="satuan_barang" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="nama_customer">Nama Customer</label>
                             <input type="text" class="form-control" placeholder="Nama Customer" value="<?= $data['nama_customer'] ?>" name="nama_customer" readonly>
                           </div>
                           <div class="form-group">
                             <label class="form-control-label" for="jumlah_penjualan">Jumlah Penjualan</label>
                             <input type="number" class="form-control" name="jumlah_penjualan" value="<?= $data['jumlah_penjualan'] ?>" autocomplete="off" placeholder="Input Penjualan" readonly>
                           </div>
                           <div class="form-group">
                             <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Kembali</button>
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
    

<?php include 'src/footer.php'; ?>