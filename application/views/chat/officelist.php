  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">チャット</h1>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">【メッセージ 一覧】</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>/.input-group-append
                  </div>/.input-group input-group-sm -->
                </div><!-- /.card-tools -->
              </div><!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>事業所</th>
                      <!-- <th>担当者</th> -->
                      <th>メッセージ</th>
                      <!-- <th>仕事内容</th> -->
                      <th colspan="3">申し込み</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($office_array as $values) {
                      if ($values['withdrawal'] == "0") { ?>
                        <tr>
                          <td><img src="<?= base_url().'assets/images/resize_office/'.$values['img'];?>" style="width:60px; height:auto;"></td>
                          <td style="vertical-align: middle;"><?= $values['office'] ?></td>
                          <!-- <td style="vertical-align: middle;"><?= $values['name'] ?></td> -->
                          <td style="vertical-align: middle;"><?= $values['message'] ?></td>
                          <!-- <td style="vertical-align: middle;"><?= $values['job'] ?></td> -->
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/matching/interview?id=<?= $values['id'] ?>'" id="button1" type="submit" class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                          </td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/chat/work_board?id=<?= $values['id'] ?>'" id="button2" type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                          </td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/office/job_lists?id=<?= $values['id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
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
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->