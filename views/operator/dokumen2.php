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
    background: lightblue !important;
  }
</style>
<section id="main-content">
  <section class="wrapper">
  <h3><i class="fa fa-angle-right"></i> Daftar Dokumen</h3>
    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <!-- <h4><i class="fa fa-angle-right"></i> Daftar Dokumen</h4> -->
                    <hr>
                    <thead>
                    <tr>
                      <th width="10"></th>
                      <th> Tanggal Pembuatan</th>
                      <th> Jam Pembuatan</th>
                      <th> ID</th>
                      <th> No. Dokumen</th>
                      <th> Kategori</th>
                      <th> Judul</th>
                      <th> Perihal</th>
                      <th> Pengirim</th>
                      <th> Penerima</th>
                      <!-- <th> Status</th> -->
                      <th></th>
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
                        <a href="<?php echo '?url=operator/dokumen/view/' . $list->iddoc; ?>">
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
<!--                       <td class="<?=$list->expstatus;?>">
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
                      </td> -->
                      <td>
                        <a href="?url=operator/dokumen/view/<?php echo $list->iddoc; ?>" class="btn btn-success btn-xs"><i class="fa fa-expand"></i> Lihat</a>
                         <a href="?url=operator/dokumen/arsip/<?php echo $list->iddoc; ?>" class="btn btn-success btn-xs"><i class="fa fa-file"></i> Arsip</a>
                         <a href="?url=operator/dokumen/tolak/<?php echo $list->iddoc; ?>" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Tolak</a>
                      </td>
                    </tr>
                    <?php }?>


                    </tbody>
                </table>

                <footer class="site-footer">
                    <dir class="col-md-3 hidden-sm hidden-xs"></dir>
                    <div class="col-md-6 col-xs-12 text-center">
                      <!-- <a href="?url=dokumen/otorisasi" class="btn btn-sm btn-danger "><i class="fa fa-check-circle-o"></i> Otorisasi</a> -->
                      <!-- <a href="?url=dokumen/tolak" class="btn btn-sm btn-danger "><i class="fa fa-times-circle-o"></i> Tolak</a> -->
                      <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</a> -->
                      <a href="?url=operator/dokumen/keluar" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus"></i> Daftar Dokumen Keluar</a>
                      <!-- <a href="?url=operator/dokumen/keluar_arsip" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus"></i> Daftar Arsip</a> -->
                      <!-- <button id="btntambah" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</button> -->
                      <!-- <a href="?url=dokumen/ubah" class="btn btn-sm btn-success "><i class="fa fa-pencil"></i> Ubah</a> -->
                      <!-- <a href="?url=dokumen/hapus" class="btn btn-sm btn-success "><i class="fa fa-eraser"></i> Hapus</a> -->
                    </div>
                    <div class="col-md-3"></div>
                </footer>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->
  </section>
</section>
<!--main content end-->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog modal-lg">
                <form action="" class="form-horizontal style-form">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Tambah Dokumen</h4>
          </div>
          <div class="modal-body">
            <div class="form-panel">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Judul</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Atas Nama</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Kategori Dokumen</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>
          <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
              <button class="btn btn-theme" type="button">Submit</button>
          </div>
      </div>
                </form>
  </div>
</div>
<!-- modal -->
<?php echo $data['footer']; ?>