<?php $this->load->view('common/svheader'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <h1 class="m-0 text-dark">マッチング一覧</h1>
      <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="nav nav-tabs" id="tab-menu1" role="tablist">
        <!-- タブ01 -->
        <a class="nav-item nav-link active" id="tab-menu01" data-toggle="tab" href="#panel-menu01" role="tab" aria-controls="panel-menu01" aria-selected="true">未回答・保留</a>
        <!-- タブ02 -->
        <a class="nav-item nav-link" id="tab-menu02" data-toggle="tab" href="#panel-menu02" role="tab" aria-controls="panel-menu02" aria-selected="false">成立中</a>
        <!-- タブ03 -->
        <a class="nav-item nav-link" id="tab-menu03" data-toggle="tab" href="#panel-menu03" role="tab" aria-controls="panel-menu03" aria-selected="false">ブロック中</a>
      </div>
      <div class="tab-content" id="panel-menu1">
        <div class="tab-pane fade show active border border-top-0" id="panel-menu01" role="tabpanel" aria-labelledby="tab-menu01">
          <div class="row">
            <div class="col-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-users"></i>【未回答・保留中】</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                    <thead>
                      <th>事業所</th>
                      <th>氏名</th>
                      <th>詳細</th>
                      <th>求職者</th>
                      <th>詳細</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($matching_array as $holds) {
                        if ($holds['partner_flag'] === "0") { ?>
                          <tr>
                            <td><?= $holds['office'] ?></td>
                            <td><?= $holds['office_name'] ?></td>
                            <td>
                              <button onclick="location.href='/manager/jobs_detail?id=<?= $holds['office_id'] ?>'" id="button3" type="submit" class="btn-success">登録求人 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                            <td><?= $holds['worker_name'] ?></td>
                            <td>
                              <button onclick="location.href='/manager/worker_detail?id=<?= $holds['worker_id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                          </tr>
                        <?php  } ?>
                      <?php  } ?>
                    </tbody>
                  </table>
                </div><!-- /.card-body -->
              </div><!-- /.card -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
        <div class="tab-pane fade border border-top-0" id="panel-menu02" role="tabpanel" aria-labelledby="tab-menu02">
          <div class="row">
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-users"></i>【マッチング成立中】</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                    <thead>
                      <th>事業所</th>
                      <th>氏名</th>
                      <th>詳細</th>
                      <th>求職者</th>
                      <th>詳細</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($matching_array as $values) {
                        if ($values['partner_flag'] === "1") { ?>
                          <tr>
                            <td><?= $values['office'] ?></td>
                            <td><?= $values['office_name'] ?></td>
                            <td>
                              <button onclick="location.href='/manager/jobs_detail?id=<?= $values['office_id'] ?>'" id="button3" type="submit" class="btn-success">登録求人 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                            <td><?= $values['worker_name'] ?></td>
                            <td>
                              <button onclick="location.href='/manager/worker_detail?id=<?= $values['worker_id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                          </tr>
                        <?php  } ?>
                      <?php  } ?>
                    </tbody>
                  </table>
                </div><!-- /.card-body -->
              </div><!-- /.card -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
        <div class="tab-pane fade border border-top-0" id="panel-menu03" role="tabpanel" aria-labelledby="tab-menu03">
          <div class="row">
            <div class="col-12">
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-users"></i>【マッチングブロック中】</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                    <thead>
                      <th>事業所</th>
                      <th>氏名</th>
                      <th>詳細</th>
                      <th>求職者</th>
                      <th>詳細</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($matching_array as $blocks) {
                        if ($blocks['partner_flag'] === "2") { ?>
                          <tr>
                            <td><?= $blocks['office'] ?></td>
                            <td><?= $blocks['office_name'] ?></td>
                            <td>
                              <button onclick="location.href='/manager/jobs_detail?id=<?= $blocks['office_id'] ?>'" id="button3" type="submit" class="btn-success">登録求人 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                            <td><?= $blocks['worker_name'] ?></td>
                            <td>
                              <button onclick="location.href='/manager/worker_detail?id=<?= $blocks['worker_id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                          </tr>
                        <?php  } ?>
                      <?php  } ?>
                    </tbody>
                  </table>
                </div><!-- /.card-body -->
              </div><!-- /.card -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('common/footer'); ?>