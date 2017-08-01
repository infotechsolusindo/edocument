<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Surat Tugas</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <form action="?url=operator/surattugas/simpan" method="post" class="form-horizontal style-form">
            <input name="tgl" type="hidden" class="form-control" value="<?=isset($data['tgl']) ? $data['tgl'] : date('Y-m-d');?>">
            <input name="jam" type="hidden" class="form-control" value="<?=isset($data['jam']) ? $data['jam'] : date('H:m:s');?>">
            <div class="panel">
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No.Surat</label>
                  <div class="col-sm-10">
                    <input name="nodoc" type="text" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Pengirim</label>
                  <div class="col-sm-10">
                    <input name="pengirim" type="text" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tujuan</label>
                  <div class="col-sm-10">
                    <input name="penerima" type="text" class="form-control" value="">
                    <select name="departemen" id="" class="form-control">
                      <option value=""> -- Departemen -- </option>
                    <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                      <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
                    <?php }}?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Perihal</label>
                  <div class="col-sm-10">
                    <input name="perihal" type="text" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Salinan</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input name="penerimas[1]" type="text" placeholder="Penerima Salinan 1" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
                      <span class="input-group-addon" style="padding: 0px">
                        <select name="departemenpenerima[1]" id="" class="">
                          <option value=""> -- Departemen -- </option>
                        <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                          <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
                        <?php }}?>
                        </select>
                      </span>
                    </div>
                    <div class="input-group">
                      <input name="penerimas[2]" type="text" placeholder="Penerima Salinan 2 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
                      <span class="input-group-addon" style="padding: 0px">
                        <select name="departemenpenerima[2]" id="" class="">
                          <option value=""> -- Departemen -- </option>
                        <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                          <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
                        <?php }}?>
                        </select>
                      </span>
                    </div>
                    <div class="input-group">
                      <input name="penerimas[3]" type="text" placeholder="Penerima Salinan 3 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
                      <span class="input-group-addon" style="padding: 0px">
                        <select name="departemenpenerima[3]" id="" class="">
                          <option value=""> -- Departemen -- </option>
                        <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                          <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
                        <?php }}?>
                        </select>
                      </span>
                    </div>
                    <div class="input-group">
                      <input name="penerimas[4]" type="text" placeholder="Penerima Salinan 4 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
                      <span class="input-group-addon" style="padding: 0px">
                        <select name="departemenpenerima[4]" id="" class="">
                          <option value=""> -- Departemen -- </option>
                        <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                          <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
                        <?php }}?>
                        </select>
                      </span>
                    </div>
                    <div class="input-group">
                      <input name="penerimas[5]" type="text" placeholder="Penerima Salinan 5 (Opsi)" class="form-control" value="<?=isset($data['penerima']) ? $data['penerima'] : '';?>">
                      <span class="input-group-addon" style="padding: 0px">
                        <select name="departemenpenerima[5]" id="" class="">
                          <option value=""> -- Departemen -- </option>
                        <?php if (!empty($data['listdepartemen'])) {foreach ($data['listdepartemen'] as $dept) {?>
                          <option value="<?=$dept->iddepartemen;?>"><?=$dept->name;?></option>
                        <?php }}?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">File Dokumen</label>
                  <div class="col-sm-10">
                    <input name="filedokumen" type="file" class="">
                  </div>
                </div>
                <div class="form-group">
                  <center>
                    <a href="<?=SITE_ROOT . '/?url=operator/dokumen/keluar';?>" class="btn btn-default">Batal</a>
                    <button class="btn btn-theme" type="submit">Simpan</button>
                  </center>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</section>
<?php echo $data['footer']; ?>