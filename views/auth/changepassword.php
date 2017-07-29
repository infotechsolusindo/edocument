<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Ubah Password</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <form action="?url=auth/profile/changePasswordSimpan" method="post" class="form-horizontal style-form">
            <div class="panel">
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password Lama</label>
                  <div class="col-sm-10">
                    <input name="oldpassword" type="password" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password Baru</label>
                  <div class="col-sm-10">
                    <input name="newpassword" type="password" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Konfirmasi Password</label>
                  <div class="col-sm-10">
                    <input name="confpassword" type="password" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <center>
                    <a href="<?=SITE_ROOT . '/';?>" class="btn btn-default">Batal</a>
                    <button class="btn btn-theme" type="submit">Simpan</button>
                  </center>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /content-panel -->
      </div>
      <!-- /col-md-12 -->
    </div>
    <!-- /row -->
  </section>
</section>
<!--main content end-->
