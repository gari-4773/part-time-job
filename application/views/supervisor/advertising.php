<?php $this->load->view('common/svheader'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-6">
          <h1 class="m-0 text-dark">広告管理</h1>
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="nav nav-tabs" id="tab-menu1" role="tablist">
        <!-- タブ01 -->
        <a class="nav-item nav-link active" id="tab-menu01" data-toggle="tab" href="#panel-menu01" role="tab" aria-controls="panel-menu01" aria-selected="true">登録事業者</a>
        <!-- タブ02 -->
        <a class="nav-item nav-link" id="tab-menu02" data-toggle="tab" href="#panel-menu02" role="tab" aria-controls="panel-menu02" aria-selected="false">掲載予定事業者</a>
        <!-- タブ03 -->
        <a class="nav-item nav-link" id="tab-menu03" data-toggle="tab" href="#panel-menu03" role="tab" aria-controls="panel-menu03" aria-selected="false">掲載事業者</a>
      </div>
      <div class="tab-content" id="panel-menu1">
        <div class="tab-pane fade show active border border-top-0" id="panel-menu01" role="tabpanel" aria-labelledby="tab-menu01">
          <div class="row">
            <div class="col-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-users"></i>【登録事業者一覧】</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                    <thead>
                      <th>事業所</th>
                      <th>担当者</th>
                      <th>仕事内容</th>
                      <th>申請日時</th>
                      <th>更新</th>
                      <th>詳細</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($office_array as $values) {
                        if ($values['withdrawal'] === "0" && $values['advertising'] ==="1") { ?>
                          <tr>
                            <td><?= $values['office'] ?></td>
                            <td><?= $values['name'] ?></td>
                            <td><?= $values['job'] ?></td>
                            <td><?= $values['published_time'] ?></td>
                            <td>
                              <button name="advertising_published" data-id="<?= $values['id'] ?>" data-name="<?= $values['office'] ?>" data-mail="<?= $values['mail'] ?>" type="submit" class="btn-primary">広告掲載 <i class="far fa-flag"></i></button>
                            </td>
                            <td>
                              <button onclick="location.href='/manager/jobs_detail?id=<?= $values['id'] ?>'" id="button3" type="submit" class="btn-success">登録求人 <i class="fas fa-pencil-alt"></i></button>
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
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-users"></i>【掲載予定事業者一覧】</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                    <thead>
                      <th>事業所</th>
                      <th>担当者</th>
                      <th>仕事内容</th>
                      <th>掲載期限</th>
                      <th>更新</th>
                      <th>詳細</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($office_array as $values) {
                        if ($values['withdrawal'] === "0" && $values['advertising'] ==="2") { ?>
                          <tr>
                            <td><?= $values['office'] ?></td>
                            <td><?= $values['name'] ?></td>
                            <td><?= $values['job'] ?></td>
                            <td><?= $values['published_time'] ?></td>
                            <td>
                              <button name="advertising_published" data-id="<?= $values['id'] ?>" data-name="<?= $values['office'] ?>" data-mail="<?= $values['mail'] ?>" type="submit" class="btn-primary">再通知 <i class="far fa-flag"></i></button>
                            </td>
                            <td>
                              <button onclick="location.href='/manager/jobs_detail?id=<?= $values['id'] ?>'" id="button3" type="submit" class="btn-success">登録求人 <i class="fas fa-pencil-alt"></i></button>
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
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-users"></i>【掲載事業者一覧】</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                    <thead>
                      <th>事業所</th>
                      <th>担当者</th>
                      <th>仕事内容</th>
                      <th>掲載期限</th>
                      <th>更新</th>
                      <th>詳細</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($office_array as $values) {
                        if ($values['withdrawal'] === "0" && $values['advertising'] ==="3") { ?>
                          <tr>
                            <td><?= $values['office'] ?></td>
                            <td><?= $values['name'] ?></td>
                            <td><?= $values['job'] ?></td>
                            <td><?= $values['published_time'] ?></td>
                            <td>
                              <button name="advertising_release" data-id="<?= $values['id'] ?>" data-name="<?= $values['office'] ?>" type="submit" class="btn-danger">掲載解除 <i class="far fa-flag"></i></button>
                            </td>
                            <td>
                              <button onclick="location.href='/manager/jobs_detail?id=<?= $values['id'] ?>'" id="button3" type="submit" class="btn-success">登録求人 <i class="fas fa-pencil-alt"></i></button>
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
      </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('common/footer'); ?>