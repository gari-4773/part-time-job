  <?php $this->load->view('common/svheader'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">利用停止ユーザー一覧</h1>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="nav nav-tabs" id="tab-menu1" role="tablist">
          <!-- タブ01 -->
          <a class="nav-item nav-link active" id="tab-menu01" data-toggle="tab" href="#panel-menu01" role="tab" aria-controls="panel-menu01" aria-selected="true">事業者</a>
          <!-- タブ02 -->
          <a class="nav-item nav-link" id="tab-menu02" data-toggle="tab" href="#panel-menu02" role="tab" aria-controls="panel-menu02" aria-selected="false">求職者</a>
        </div>
        <div class="tab-content" id="panel-menu1">
          <div class="tab-pane fade show active border border-top-0" id="panel-menu01" role="tabpanel" aria-labelledby="tab-menu01">
            <div class="row">
              <div class="col-12">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【事業者】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>事業所</th>
                        <th>担当者</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>職種</th>
                        <th colspan="3">更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($office_array as $office) {
                          if ($office['withdrawal'] === "1") { ?>
                            <tr>
                              <td><?= $office['office'] ?></td>
                              <td><?= $office['name'] ?></td>
                              <td><?= $office['tel'] ?></td>
                              <td><?= $office['mail'] ?></td>
                              <td><?= $office['job'] ?></td>
                              <td>
                                <button onclick="location.href='/manager/jobs_detail?id=<?= $office['id'] ?>'" id="button3" type="submit" class="btn-success">登録求人 <i class="fas fa-pencil-alt"></i></button>
                              </td>
                              <td>
                                <button name="return_office" data-id="<?= $office['id'] ?>" data-name="<?= $office['office'] ?>" type="submit" class="btn-primary">利用再開 <i class="fas fa-user"></i></button>
                              </td>
                              <td>
                                <button name="delete_office" data-id="<?= $office['id'] ?>" data-name="<?= $office['office'] ?>" type="submit" class="btn-danger">データ削除 <i class="far fa-trash-alt"></i></button>
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
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【求職者】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>氏名</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>満年齢</th>
                        <th>希望職種</th>
                        <th colspan="3">更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($worker_array as $worker) {
                          if ($worker['withdrawal'] === "1") { ?>
                            <tr>
                              <td><?= $worker['name'] ?></td>
                              <td><?= $worker['tel'] ?></td>
                              <td><?= $worker['mail'] ?></td>
                              <td><?= date("Y") - $worker['birth'] ?>歳</td>
                              <td><?= $worker['hope_work'] ?></td>
                              <td>
                                <button onclick="location.href='/matching/job_details?id=<?= $worker['id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
                              </td>
                              <td>
                                <button name="return_worker" data-id="<?= $worker['id'] ?>" data-name="<?= $worker['name'] ?>" type="submit" class="btn-primary">利用再開 <i class="far fa-trash-alt"></i></button>
                              </td>
                              <td>
                                <button name="delete_worker" data-id="<?= $worker['id'] ?>" data-name="<?= $worker['name'] ?>" type="submit" class="btn-danger">データ削除 <i class="far fa-trash-alt"></i></button>
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