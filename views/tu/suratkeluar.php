<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Surat Keluar</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <div style="overflow: scroll;max-height: 450px;">
            <table class="table table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th width="10"></th>
                  <th> Tanggal Masuk</th>
                  <th> Jam Surat</th>
                  <th> ID</th>
                  <th> No. Dokumen</th>
                  <th> Judul</th>
                  <th> Perihal</th>
                  <th> Pengirim</th>
                  <th> Penerima</th>
                  <th> Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['list'] as $list) {
    ?>
                  <tr>
                    <td>
                      <input type="checkbox" />
                    </td>
                    <td>
                      <?php echo $list->tgl; ?>
                    </td>
                    <td>
                      <?php echo $list->jam; ?>
                    </td>
                    <td>
                      <?php echo $list->iddoc; ?>
                    </td>
                    <td>
                      <?php echo $list->nodoc; ?>
                    </td>
                    <td>
                      <?php echo $list->judul; ?>
                    </td>
                    <td>
                      <?php echo $list->perihal; ?>
                    </td>
                    <td>
                      <?php echo $list->pengirim; ?>
                    </td>
                    <td>
                      <?php echo $list->penerima; ?>
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
                      <a href="?url=tu/suratkeluar/ubah/<?php echo $list->iddoc; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                      <a href="?url=tu/suratkeluar/hapus/<?php echo $list->iddoc; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                    </td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
          </div>

          <footer class="site-footer">
            <dir class="col-md-3 hidden-sm hidden-xs"></dir>
            <div class="col-md-6 col-xs-12 text-center">
              <a id="addBtn" href="/#tambahForm" class="btn btn-sm btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</a>
              <a href="?url=tu/suratkeluar" class="btn btn-sm btn-danger" ><i class="fa fa-file"></i> Belum Diproses</a>
              <a href="?url=tu/suratkeluar/daftarTerkirim" class="btn btn-sm btn-warning" ><i class="fa fa-file"></i> Terkirim</a>
              <a href="?url=tu/suratkeluar/daftarDiterima" class="btn btn-sm btn-success" ><i class="fa fa-file"></i> Diterima</a>
              <a href="?url=tu/suratkeluar/daftarDitolak" class="btn btn-sm btn-danger" ><i class="fa fa-file"></i> Ditolak</a>
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
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambahForm" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="?url=tu/suratkeluar/tambahSimpan" method="post" class="form-horizontal style-form">
      <input name="tgl" type="hidden" class="form-control" value="<?=isset($data['tgl']) ? $data['tgl'] : date('Y-m-d');?>">
      <input name="jam" type="hidden" class="form-control" value="<?=isset($data['jam']) ? $data['jam'] : date('H:m:s');?>">
      <input name="kategori" type="hidden" class="form-control" value="<?=isset($data['kategori']) ? $data['kategori'] : 3;?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Surat Keluar</h4>
        </div>
      <?php if ($data['successMessage']) {?>
      <!-- Message OK -->
      <div id="successMessage" class="alert alert-success">
        <p><strong>Your file was uploaded succesifully!</strong>
        <a href="#" class="close"><i class="fa fa-times-circle-o"></i></a></p>
      </div>
      <!-- End Message OK -->
      <?php }?>
      <?php if ($data['errorMessage']) {?>
      <!-- Message Error -->
      <div id="errorMessage" class="alert alert-danger">
        <p><strong><?php echo $data['errorMessage']; ?></strong>
        <a href="#" class="close"><i class="fa fa-times-circle-o"></i></a></p> </div>
      <!-- End Message Error -->
      <?php }?>
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Waktu</label>
            <div class="col-sm-10">
              <?=isset($data['tgl']) ? $data['tgl'] : date('Y-m-d');?>
                <?=isset($data['jam']) ? $data['jam'] : date('H:m:s');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nomer Surat</label>
            <div class="col-sm-10">
              <input name="nodoc" type="text" class="form-control" value="<?=isset($data['nodoc']) ? $data['nodoc'] : '';?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input name="judul" type="text" class="form-control" value="<?=isset($data['judul']) ? $data['judul'] : '';?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Perihal</label>
            <div class="col-sm-10">
              <input name="perihal" type="text" class="form-control" value="<?=isset($data['perihal']) ? $data['perihal'] : '';?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-6">
              <label class="col-sm-2 col-sm-2 control-label">Pengirim</label>
              <div class="col-sm-10">
                <input name="pengirim" type="text" class="form-control" value="<?=isset($data['pengirim']) ? $data['pengirim'] : '';?>">
                <select name="departemenpengirim" id="" class="form-control">
                <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                  <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
                <?php }}?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <label class="col-sm-2 col-sm-2 control-label">Penerima</label>
              <div class="col-sm-10">
                <input name="penerima" type="text" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">File Dokumen</label>
            <div class="col-sm-10">
              <input name="filedokumen" type="file" class="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
          <button class="btn btn-theme" type="submit">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<a href="/#ubahForm" id="editbtn" data-toggle="modal"></a>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ubahForm" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="?url=tu/suratkeluar/ubahSimpan" method="post" class="form-horizontal style-form">
      <input name="iddoc" type="hidden" class="form-control" value="<?=isset($data['iddoc']) ? $data['iddoc'] : 2;?>">
      <input name="tgl" type="hidden" class="form-control" value="<?=isset($data['tgl']) ? $data['tgl'] : date('Y-m-d');?>">
      <input name="jam" type="hidden" class="form-control" value="<?=isset($data['jam']) ? $data['jam'] : date('H:m:s');?>">
      <input name="kategori" type="hidden" class="form-control" value="<?=isset($data['kategori']) ? $data['kategori'] : 2;?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Ubah Surat Keluar</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Waktu</label>
            <div class="col-sm-10">
              <?=isset($data['tgl']) ? $data['tgl'] : date('Y-m-d');?>
                <?=isset($data['jam']) ? $data['jam'] : date('H:m:s');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nomer Surat</label>
            <div class="col-sm-10">
              <input name="nodoc" type="text" class="form-control" value="<?=isset($data['nodoc']) ? $data['nodoc'] : '';?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input name="judul" type="text" class="form-control" value="<?=isset($data['judul']) ? $data['judul'] : '';?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Perihal</label>
            <div class="col-sm-10">
              <input name="perihal" type="text" class="form-control" value="<?=isset($data['perihal']) ? $data['perihal'] : '';?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-6">
              <label class="col-sm-2 col-sm-2 control-label">Pengirim</label>
              <div class="col-sm-10">
                <input name="pengirim" type="text" class="form-control" value="<?=isset($data['pengirim']) ? $data['pengirim'] : '';?>">
              </div>
            </div>
            <div class="col-sm-6">
              <label class="col-sm-2 col-sm-2 control-label">Penerima</label>
              <div class="col-sm-10">
                <input name="penerima" type="text" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
          <button class="btn btn-theme" type="submit">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- modal -->
<?php echo $data['footer']; ?>
<?php if (isset($data['ubahForm'])) {?>
<script>
  $(document).ready(function(){
    $('#editbtn').click();
  })
</script>
<?php }?>
<?php if (isset($data['tambahForm'])) {?>
<script>
  $(document).ready(function(){
    $('#addBtn').click();
  })
</script>
<?php }?>
<!-- <script>
    $('#btntambah').on('click',function(){
        $('#myModal').show();
    });
</script> -->
