<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Menu Management</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
            <!-- <div style="overflow:scroll;height:600px"> -->
            <div>
            <form id="groupform" action="?url=admin/menugroup/index&cmd=refresh" method="post">
            <select name="group" id="group" class="form-control">
              <option value="">-- Tampilkan Menu dari Semua Group  --</option>
              <?php foreach ($data['usergroup'] as $ug) {?>
              <option value="<?php echo $ug->idgroup; ?>"><?php echo $ug->gname; ?></option>
              <?php }?>
            </select>
            </form>
            </div>
              <table class="table table-striped table-advance table-hover">
                <hr>
                <thead>
                  <tr>
                    <th> Group User</th>
                    <th> Nama Menu</th>
                    <th> Url</th>
                    <th> Icon</th>
                    <th> Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($data['menugroup'])) {foreach ($data['menugroup'] as $list) {?>
                    <tr>
                      <td>
                        <?php echo $list->gname; ?>
                      </td>
                      <td>
                        <?php echo $list->mname; ?>
                      </td>
                      <td>
                        <?php echo $list->url; ?>
                      </td>
                      <td>
                        <?php echo $list->icon; ?>
                      </td>
                      <td>
                        <?php echo $list->status; ?>
                      </td>
                      <td>
                        <a href="?url=admin/menugroup/ubah/<?php echo $list->idgroup; ?>/<?php echo $list->idmenu; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="?url=admin/menugroup/hapus/<?php echo $list->idgroup; ?>/<?php echo $list->idmenu; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                      </td>
                    </tr>
                  <?php }}?>
                </tbody>
              </table>
            <!-- </div> -->
            <footer class="site-footer">
              <dir class="col-md-3 hidden-sm hidden-xs"></dir>
              <div class="col-md-6 col-xs-12 text-center">
                <a id="addBtn" href="/#tambahForm" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</a>
              </div>
              <div class="col-md-3"></div>
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
    <form action="?url=admin/menugroup/tambahSimpan" method="post" class="form-horizontal style-form">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Menu</h4>
        </div>
      <?php if ($data['successMessage']) {?>
      <!-- Message OK -->
      <div id="successMessage" class="alert alert-success">
        <p><strong>Your data was uploaded succesfully!</strong>
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
          <div class="form-panel">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Group User</label>
              <div class="col-sm-10">
                <select name="idgroup" id="group" class="form-control">
                  <?php foreach ($data['usergroup'] as $ug) {?>
                  <option value="<?php echo $ug->idgroup; ?>" <?=isset($data['idgroup']) && ($data['idgroup'] == $ug->idgroup) ? 'selected' : '';?>><?php echo $ug->gname; ?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Menu</label>
              <div class="col-sm-10">
                <select name="idmenu" id="menu">
                <?php foreach ($data['menu'] as $list) {?>
                  <option value="<?=$list->id;?>" <?=isset($data['idmenu']) && ($data['idmenu'] == $list->id) ? 'selected' : '';?>>
                    <?=($list->mparent > 1) ? "-- $list->mname" : $list->mname;?>
                  </option>
                <?php }?>
                </select>
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
<a href="/#ubahForm" id="editbtn" data-toggle="modal"></a>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ubahForm" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="?url=admin/menu/ubahSimpan" method="post" class="form-horizontal style-form">
      <input name="id" type="hidden" class="form-control" value="<?php echo $data['id']; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Ubah Menu</h4>
        </div>
        <div class="modal-body">
          <div class="form-panel">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Group User</label>
              <div class="col-sm-10">
                <select name="idgroup" id="group" class="form-control">
                  <?php foreach ($data['usergroup'] as $ug) {?>
                  <option value="<?php echo $ug->idgroup; ?>" <?=isset($data['idgroup']) && ($data['idgroup'] == $ug->idgroup) ? 'selected' : '';?>><?php echo $ug->gname; ?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Menu</label>
              <div class="col-sm-10">
                <select name="idmenu" id="parent">
                <?php foreach ($data['menu'] as $list) {?>
                  <option value="<?=$list->id;?>" <?=isset($data['idmenu']) && ($data['idmenu'] == $list->id) ? 'selected' : '';?>>
                    <?=($list->mparent > 1) ? "-- $list->mname" : $list->mname;?>
                  </option>
                <?php }?>
                </select>
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
