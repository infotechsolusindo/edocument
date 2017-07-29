<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Dokumen Masuk</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <div class="">
            <?php $disposisi = $data['disposisi'];?>
            <?php $lampiran = $data['lampiran'];?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="">
                  <h2>No Dokumen : <?=$disposisi->nodoc;?></h2>
                  <div class="pull-right">
                    <a href="#" onclick="window.history.back();" class="btn btn-success btn-sm">Kembali</a>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table">
                  <tr><td>Tgl</td><td>: <?=$disposisi->tgl;?></td></tr>
                  <tr><td>Jam</td><td>: <?=$disposisi->jam;?></td></tr>
                  <tr><td>Kategori</td><td>: <?=$disposisi->nmkategori;?></td></tr>
                  <tr><td>Perihal</td><td>: <?=$disposisi->perihal;?></td></tr>
                  <tr><td>Pengirim Disposisi</td><td>: <?=$disposisi->pengirim;?></td></tr>
                  <tr><td>Penerima Disposisi</td><td>: <?=$disposisi->penerima;?> <span class="badge badge-primary">Departemen: <?=$disposisi->departemen;?></span></td></tr>
                  <tr>
                    <td>Memo</td>
                    <td>: <?=$disposisi->data3;?></td>
                  </tr>
                  <tr><td colspan="2"  style="background-color:#f89999">
                    <h4>Lampiran</h4>
                    <table class="table">
                      <tr><td>Waktu Kirim</td><td>: <?=$lampiran->tgl;?> <?=$lampiran->jam;?></td></tr>
                      <tr><td>Pengirim Dokumen</td><td>: <?=$lampiran->pengirim;?></td></tr>
                      <tr><td>File Dokumen</td><td>: <a href="?url=operator/dokumen/download/<?=$disposisi->data2;?>" class="btn btn-success" <?=($lampiran->data2 == '') ? 'disabled' : '';?>>Lihat Dokumen</a> <b><?=$lampiran->data3;?></b></td></tr>
                    </table>
                  </td></tr>
                </table>
                <center>
                  <a href="?url=operator/dokumen/disposisi" class="btn btn-success btn-sm">Kembali</a>
                </center>
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