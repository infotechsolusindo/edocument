<?php echo $data['header']; ?>
<?php echo $data['sidebarleft']; ?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Daftar Departemen</h3>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <table class="table table-striped table-advance table-hover">
            <hr>
            <thead>
              <tr>
                <th width="10"></th>
                <th> ID.User</th>
                <th> Nama User</th>
                <th> Wewenang</th>
                <th> Email</th>
                <th> Status</th>
                <th> Created</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
foreach ($data['list'] as $list) {
    ?>
                <tr>
                  <td>
                    <input type="checkbox" />
                  </td>
                  <td>
                    <?php echo $list->userid; ?>
                  </td>
                  <td>
                    <?php echo $list->name; ?>
                  </td>
                  <td>
                    <?php echo $list->wewenang; ?>
                  </td>
                  <td>
                    <?php echo $list->email; ?>
                  </td>
                  <td>
                    <?php echo $list->status; ?>
                  </td>
                  <td>
                    <?php echo $list->tgl; ?>
                  </td>
                  <td>
                    <a href="?url=admin/user/ubah/<?php echo $list->userid; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <a href="?url=admin/user/hapus/<?php echo $list->userid; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                  </td>
                </tr>
                <?php }?>
            </tbody>
          </table>
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
    <form action="?url=admin/user/tambahSimpan" method="post" class="form-horizontal style-form">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah User</h4>
        </div>
        <div class="modal-body">
          <div class="form-panel">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Login User</label>
              <div class="col-sm-10">
                <input name="id" type="text" class="form-control" value="<?=isset($data['name']) ? $data['name'] : '';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <input name="name" type="text" class="form-control" value="<?=isset($data['name']) ? $data['name'] : '';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Wewenang</label>
              <div class="col-sm-10">
                <select name="wewenang" class="form-control">
                <?php foreach($data['wewenang'] as $w) { ?>
                <option value="<?=$w->idgroup?>"><?=$w->gname?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input name="email" type="text" class="form-control" value="<?=isset($data['email']) ? $data['email'] : '';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <input name="status" type="radio" class="" value="<?=isset($data['name']) ? $data['status'] : '';?>" checked="checked"> Aktif
                <input name="status" type="radio" class="" value="<?=isset($data['name']) ? $data['status'] : '';?>"> Non Aktif
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
<a href="/#ubahForm" id="editBtn" data-toggle="modal"></a>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ubahForm" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="?url=admin/user/ubahSimpan" method="post" class="form-horizontal style-form">
      <input type="hidden" name="id" value="<?=isset($data['userid']) ? $data['userid'] : '';?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Ubah User</h4>
        </div>
        <div class="modal-body">
          <div class="form-panel">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <input name="name" type="text" class="form-control" value="<?=isset($data['name']) ? $data['name'] : '';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Wewenang</label>
              <div class="col-sm-10">
                <select name="wewenang" class="form-control">
                  <option value="1">Admin</option>
                  <option value="2">Operator</option>
                  <option value="3">Umum</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input name="email" type="text" class="form-control" value="<?=isset($data['email']) ? $data['email'] : '';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <input name="status" type="radio" class="" value="<?=isset($data['name']) ? $data['status'] : '';?>" checked="checked"> Aktif
                <input name="status" type="radio" class="" value="<?=isset($data['name']) ? $data['status'] : '';?>"> Non Aktif

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
    $('#editBtn').click();
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
