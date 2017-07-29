<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Surat Masuk</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <div class="">
            <?php $dok = $data['dokumen'];?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="">
                  <h2>No Dokumen : <?=$dok->nodoc;?></h2>
                </div>
              </div>
              <div class="panel-body">
                <table class="table">
                  <tr><td>Tgl</td><td>: <?=$dok->tgl;?></td></tr>
                  <tr><td>Jam</td><td>: <?=$dok->jam;?></td></tr>
                  <tr><td>Kategori</td><td>: <?=$dok->nmkategori;?></td></tr>
                  <tr><td>Judul</td><td>: <?=$dok->judul;?></td></tr>
                  <tr><td>Perihal</td><td>: <?=$dok->perihal;?></td></tr>
                  <tr><td>Pengirim</td><td>: <?=$dok->pengirim;?></td></tr>
                  <tr><td>Penerima</td><td>: <?=$dok->penerima;?> <span class="badge badge-primary">Departemen: <?=$dok->departemen;?></span></td></tr>
                  <tr><td>Status</td><td>: &nbsp;<?=$dok->status;?> <i>(0 = Belum Terkirim, 1=Terkirim, 2=DiTerima, 3=DiKembalikan, x=Ditolak)</i></td></tr>
                  <tr><td>Tgl Kirim</td><td>: <?=$dok->tglkirim;?></td></tr>
                  <tr><td>Jam Kirim</td><td>: <?=$dok->jamkirim;?></td></tr>
                  <tr><td>Tgl Terima</td><td>: <?=$dok->tglterima;?></td></tr>
                  <tr><td>Jam Terima</td><td>: <?=$dok->jamterima;?></td></tr>
                  <?php if ($dok->status == '3' || $dok->status == 'x') {?>
                  <tr><td>Catatan</td><td>:
                    <textarea name="" id="" cols="30" rows="10" class="form-control" disabled><?=$dok->data5;?></textarea>
                  </td></tr>
                  <?php }?>
                  <tr><td>File Dokumen</td><td>: <a href="?url=tu/suratmasuk/download/<?=$dok->iddoc;?>" class="btn btn-success">Lihat Dokumen</a></td></tr>
                </table>
                <div class="centered">
                  <a href="#" onclick="window.history.back()" class="btn btn-success btn-sm">Kembali</a>
                </div>
              </div>
            </div>
          </div>
          <footer class="site-footer">

          </footer>
        </div>
        <!-- /content-panel -->
      </div>
      <!-- /col-md-12 -->
    </div>
    <!-- /row -->
  </section>
</section>
<!--main content end-->
<?php echo $data['footer']; ?>