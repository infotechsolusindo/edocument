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
  .unread {
    background: pink !important;
  }
</style>
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Disposisi Keluar</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <div style="overflow: scroll;height: 400px;">
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
                  <th> Waktu Kirim</th>
                  <th> Status</th>
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
                      <a href="<?php echo '?url=operator/dokumen/disposisi_view/' . $list->iddoc; ?>">
                        <?php echo $list->nodoc; ?>
                      </a>
                    </td>
                    <td class="<?=$list->expstatus;?>">
                      <?php echo $data['listkategori'][$list->kategori]; ?>
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
                    <td>
                      <?php echo $list->tglkirim . ' ' . $list->jamkirim; ?>
                    </td>
                    <td>
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
                      <a href="?url=operator/dokumen/disposisi_view/<?php echo $list->iddoc; ?>" class="btn btn-success btn-xs"><i class="fa fa-expand"></i> Lihat</a>
                    </td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
          </div>

          <footer class="site-footer">
            <dir class="col-md-3 hidden-sm hidden-xs"></dir>
            <div class="col-md-6 col-xs-12 text-center">
              <a href="?url=operator/dokumen/masuk" class="btn btn-sm btn-success" ><i class="fa fa-file"></i> Kembali ke Dokumen Masuk</a>
              <a href="?url=operator/dokumen/disposisi" class="btn btn-sm btn-danger" ><i class="fa fa-file"></i> Disposisi Masuk</a>
              <a href="?url=operator/dokumen/disposisi_keluar" class="btn btn-sm btn-danger" ><i class="fa fa-file"></i> Disposisi Keluar</a>
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