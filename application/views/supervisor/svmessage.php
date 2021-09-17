  <?php $this->load->view('common/svheader'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">問い合わせ一覧</h1>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="nav nav-tabs" id="tab-menu1" role="tablist">
          <!-- タブ01 -->
          <a class="nav-item nav-link active" id="tab-menu01" data-toggle="tab" href="#panel-menu01" role="tab" aria-controls="panel-menu01" aria-selected="true">事業者</a>
          <!-- タブ02 -->
          <a class="nav-item nav-link" id="tab-menu02" data-toggle="tab" href="#panel-menu02" role="tab" aria-controls="panel-menu02" aria-selected="false">求職者</a>
        </div>
        <div class="tab-content" id="panel-menu1">
          <!-- パネル01 -->
          <div class="tab-pane fade show active border border-top-0" id="panel-menu01" role="tabpanel" aria-labelledby="tab-menu01">
            <div class="row">
              <div class="col-12">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【未対応】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>事業所</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>項目</th>
                        <th>内容</th>
                        <th>更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($office_array as $value) {
                          if ($value['delete_message'] === "0") { ?>
                            <tr>
                              <td><?= $value['office'] ?></td>
                              <td><?= $value['name'] ?></td>
                              <td><?= $value['mail'] ?></td>
                              <td><?= $value['title'] ?></td>
                              <td><?= $value['message'] ?></td>
                              <td>
                                <button onclick="location.href='/manager/sv_mail?id=<?= $value['id'] ?>'" type="submit" class="btn-primary">返信 <i class="fas fa-envelope"></i></button>
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
            <!-- contacts -->
            <div class="row">
              <div class="col-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【対応中】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>事業所</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>項目</th>
                        <th>内容</th>
                        <th colspan="2">更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($office_array as $value) {
                          if ($value['delete_message'] === "1") { ?>
                            <tr>
                              <td><?= $value['office'] ?></td>
                              <td><?= $value['name'] ?></td>
                              <td><?= $value['mail'] ?></td>
                              <td><?= $value['title'] ?></td>
                              <td><?= $value['message'] ?></td>
                              <td>
                                <button onclick="location.href='/manager/sv_remail?id=<?= $value['id'] ?>'" type="submit" class="btn-primary">返信 <i class="fas fa-envelope"></i></button>
                              </td>
                              <td>
                                <button name="end_message" data-id="<?= $value['id'] ?>" type="submit" class="btn-danger">削除 <i class="far fa-trash-alt"></i></button>
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
            <!-- contacts -->
            <div class="row">
              <div class="col-12">
                <div class="card card-danger collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【対応済】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>事業所</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>項目</th>
                        <th>内容</th>
                        <th>更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($office_array as $value) {
                          if ($value['delete_message'] === "2") { ?>
                            <tr>
                              <td><?= $value['office'] ?></td>
                              <td><?= $value['name'] ?></td>
                              <td><?= $value['mail'] ?></td>
                              <td><?= $value['title'] ?></td>
                              <td><?= $value['message'] ?></td>
                              <td>
                                <button name="delete_message" data-id="<?= $value['id'] ?>" type="submit" class="btn-danger">削除 <i class="far fa-trash-alt"></i></button>
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
          </div><!-- /.tab-pane fade show active border border-top-0 -->
          <!-- パネル02 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu02" role="tabpanel" aria-labelledby="tab-menu02">
            <div class="row">
              <div class="col-12">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【未対応】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>項目</th>
                        <th>内容</th>
                        <th>更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($worker_array as $values) {
                          if ($values['delete_message'] === "0") { ?>
                            <tr>
                              <td><?= $values['name'] ?></td>
                              <td><?= $values['mail'] ?></td>
                              <td><?= $values['title'] ?></td>
                              <td><?= $values['message'] ?></td>
                              <td>
                                <button onclick="location.href='/manager/sv_mail?id=<?= $values['id'] ?>'" type="submit" class="btn-primary">返信 <i class="fas fa-envelope"></i></button>
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
            <!-- contacts -->
            <div class="row">
              <div class="col-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【対応中】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>項目</th>
                        <th>内容</th>
                        <th colspan="2">更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($worker_array as $values) {
                          if ($values['delete_message'] === "1") { ?>
                            <tr>
                              <td><?= $values['name'] ?></td>
                              <td><?= $values['mail'] ?></td>
                              <td><?= $values['title'] ?></td>
                              <td><?= $values['message'] ?></td>
                              <td>
                                <button onclick="location.href='/manager/sv_remail?id=<?= $values['id'] ?>'" type="submit" class="btn-primary">返信 <i class="fas fa-envelope"></i></button>
                              </td>
                              <td>
                                <button name="end_message" data-id="<?= $values['id'] ?>" type="submit" class="btn-danger">削除 <i class="far fa-trash-alt"></i></button>
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
            <!-- contacts -->
            <div class="row">
              <div class="col-12">
                <div class="card card-danger collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i>【対応済】</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                      <thead>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>項目</th>
                        <th>内容</th>
                        <th>更新</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($worker_array as $values) {
                          if ($values['delete_message'] === "2") { ?>
                            <tr>
                              <td><?= $values['name'] ?></td>
                              <td><?= $values['mail'] ?></td>
                              <td><?= $values['title'] ?></td>
                              <td><?= $values['message'] ?></td>
                              <td>
                                <button name="delete_message" data-id="<?= $values['id'] ?>" type="submit" class="btn-danger">削除 <i class="far fa-trash-alt"></i></button>
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
          </div><!-- /.tab-pane fade show active border border-top-0 -->
        </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php $this->load->view('common/footer'); ?>