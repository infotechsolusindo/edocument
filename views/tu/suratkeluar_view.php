<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Surat Keluar</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <div class="">
            <?php //var_dump($data['dokumen']);;;;;;;;;;;;;;;;;;;;;;;;;;;;;;?>
            <?php $dok = $data['dokumen'];?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="">
                  <h2>No Dokumen : <?=$dok->nodoc;?></h2>
                  <div class="pull-right">
                    <a href="?url=tu/suratkeluar" class="btn btn-success btn-sm">Kembali</a>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table">
                  <tr><td>Tgl</td><td>: <?=$dok->tgl;?></td></tr>
                  <tr><td>Jam</td><td>: <?=$dok->jam;?></td></tr>
                  <tr><td>Tipe</td><td>: <?=$dok->tipe;?></td></tr>
                  <tr><td>Kategori</td><td>: <?=$dok->kategori;?></td></tr>
                  <tr><td>Judul</td><td>: <?=$dok->judul;?></td></tr>
                  <tr><td>Perihal</td><td>: <?=$dok->perihal;?></td></tr>
                  <tr><td>Pengirim</td><td>: <?=$dok->pengirim;?></td></tr>
                  <tr><td>Penerima</td><td>: <?=$dok->penerima;?></td></tr>
                  <tr><td>Status</td><td>: <?=$dok->status;?> (0 = Belum Terkirim, 1=Terkirim, 2=DiTerima, 3=Ditolak)</td></tr>
                  <tr><td>Tgl Kirim</td><td>: <?=$dok->tglkirim;?></td></tr>
                  <tr><td>Jam Kirim</td><td>: <?=$dok->jamkirim;?></td></tr>
                  <tr><td>Tgl Terima</td><td>: <?=$dok->tglterima;?></td></tr>
                  <tr><td>Jam Terima</td><td>: <?=$dok->jamterima;?></td></tr>
                  <tr><td>File Dokumen</td><td>: <a href="<?=$dok->data2;?>" class="btn btn-success">Lihat</a></td></tr>
                </table>
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