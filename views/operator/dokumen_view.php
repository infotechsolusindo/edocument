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
            <?php $dok = $data['dokumen'];?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="">
                  <h2>No Dokumen : <?=$dok->nodoc;?></h2>
                  <div class="pull-right">
                    <a href="?url=operator/dokumen/masuk" class="btn btn-success btn-sm">Kembali</a>
                  </div>
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
                  <tr><td>Status</td><td>: <?=$dok->status;?> (0 = Belum Terkirim, 1=Terkirim, 2=DiTerima, 3=Ditolak)</td></tr>
                  <tr><td>Tgl Kirim</td><td>: <?=$dok->tglkirim;?></td></tr>
                  <tr><td>Jam Kirim</td><td>: <?=$dok->jamkirim;?></td></tr>
                  <tr><td>Tgl Terima</td><td>: <?=$dok->tglterima;?></td></tr>
                  <tr><td>Jam Terima</td><td>: <?=$dok->jamterima;?></td></tr>
                  <tr><td>File Dokumen</td><td>: <a href="?url=operator/dokumen/download/<?=$dok->iddoc;?>" class="btn btn-success">Lihat Dokumen</a></td></tr>
                </table>
                <center>
                  <a href="?url=operator/dokumen/masuk" class="btn btn-success btn-sm">Kembali</a>
                  <!-- <a href="?url=operator/dokumen/disposisi/<?=$dok->iddoc;?>" class="btn btn-success btn-sm">Buat Disposisi</a> -->
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
<!-- modal -->
<a href="#buatDisposisi" id="addDisposition" data-toggle="modal">click</a>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="buatDisposisi" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="?url=operator/dokumen/disposisiSimpan" method="post" class="form-horizontal style-form" enctype="multipart/form-data">
      <input name="tgl" type="hidden" class="form-control" value="<?=isset($data['tgl']) ? $data['tgl'] : date('Y-m-d');?>">
      <input name="jam" type="hidden" class="form-control" value="<?=isset($data['jam']) ? $data['jam'] : date('H:m:s');?>">
      <input name="tipe" type="hidden" class="form-control" value="<?=isset($data['tipe']) ? $data['tipe'] : 3;?>">
      <input name="dokumeninduk" type="hidden" class="form-control" value="<?=isset($data['dokumeninduk']) ? $data['dokumeninduk'] : '';?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Buat Disposisi</h4>
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
          <div class="input-group">
            <input name="penerima[1]" type="text" placeholder="Penerima Disposisi 1" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
            <span class="input-group-addon" style="padding: 0px">
              <select name="departemenpenerima[]" id="" class="">
              <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
              <?php }}?>
              </select>
            </span>
          </div>
          <div class="input-group">
            <input name="penerima[2]" type="text" placeholder="Penerima Disposisi 2 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
            <span class="input-group-addon" style="padding: 0px">
              <select name="departemenpenerima[]" id="" class="">
              <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
              <?php }}?>
              </select>
            </span>
          </div>
          <div class="input-group">
            <input name="penerima[3]" type="text" placeholder="Penerima Disposisi 3 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
            <span class="input-group-addon" style="padding: 0px">
              <select name="departemenpenerima[]" id="" class="">
              <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
              <?php }}?>
              </select>
            </span>
          </div>
          <div class="input-group">
            <input name="penerima[4]" type="text" placeholder="Penerima Disposisi 4 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
            <span class="input-group-addon" style="padding: 0px">
              <select name="departemenpenerima[]" id="" class="">
              <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
              <?php }}?>
              </select>
            </span>
          </div>
          <div class="input-group">
            <input name="penerima[5]" type="text" placeholder="Penerima Disposisi 5 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
            <span class="input-group-addon" style="padding: 0px">
              <select name="departemenpenerima[]" id="" class="">
              <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
              <?php }}?>
              </select>
            </span>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Memo</label>
            <div class="col-sm-10">
              <textarea name="memo" id="" cols="30" rows="10" class="form-control"></textarea>
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
<!-- modal end -->
<?php echo $data['footer']; ?>
<?php if (isset($data['buatDisposisi'])) {?>
<script>
  $(document).ready(function(){
    $('#addDisposition').click();
  })
</script>
<?php }?>