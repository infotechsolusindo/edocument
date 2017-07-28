<?php
$ds = "";
$exp = 0;
?>
<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<style type="text/css">
  .warning1 {
    background: orange !important;
  }
  .warning2 {
    background: red !important;
  }
</style>
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Surat Masuk :: Terkirim</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <div style="overflow: scroll;max-height: 450px;">
            <table class="table table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th width="10"></th>
                  <th> Tanggal Masuk</th>
                  <th> Jam Masuk</th>
                  <th> ID</th>
                  <th> No. Dokumen</th>
                  <th> Kategori</th>
                  <th> Judul</th>
                  <th> Perihal</th>
                  <th> Pengirim</th>
                  <th> Penerima</th>
                  <th> Status</th>
                  <th> Waktu Kirim</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['list'] as $list) {
    ?>
                  <tr>
                    <td class="<?=$list->expstatus;?>">
                      <input type="checkbox" />
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->tgl; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->jam; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->iddoc; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <a href="<?php echo '?url=tu/suratmasuk/view/' . $list->iddoc; ?>">
                        <?php echo $list->nodoc; ?>
                      </a>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->kategori; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->judul; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->perihal; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->pengirim; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $list->penerima; ?>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php switch ($list->status) {
    case '1':
        echo "Terkirim";
        break;
    case '2':
        echo "Diterima";
        break;
    case 'x':
        echo "Ditolak";
        break;
    default:
        echo "Belum diproses";
        break;
    }$list->status;?>
                    </td>
                    <td>
                      <?php echo $list->tglkirim . ' ' . $list->jamkirim; ?>
                    </td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
          </div>

          <footer class="site-footer">
            <dir class="col-md-3 hidden-sm hidden-xs"></dir>
            <div class="col-md-6 col-xs-12 text-center">
              <a href="?url=tu/suratmasuk" class="btn btn-sm btn-danger" ><i class="fa fa-file"></i> Belum Diproses</a>
              <a href="?url=tu/suratmasuk/daftarTerkirim" class="btn btn-sm btn-warning" ><i class="fa fa-file"></i> Terkirim</a>
              <a href="?url=tu/suratmasuk/daftarDiterima" class="btn btn-sm btn-success" ><i class="fa fa-file"></i> Diterima</a>
              <a href="?url=tu/suratmasuk/daftarDitolak" class="btn btn-sm btn-danger" ><i class="fa fa-file"></i> Ditolak</a>
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