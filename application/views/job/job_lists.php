<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <h1 class="m-0 text-dark">登録求人</h1>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="row">
        <div class="col-12">
          <?php foreach ($jobs_array as $values) {
            if ($values['delete_job'] == "0") { ?>
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">【<?= $office_array['office'] ?>】</h3>
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> -->
                      <div class="input-group-append">
                        <!-- <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button> -->
                      </div><!-- /.input-group-append -->
                    </div><!-- /.input-group input-group-sm -->
                  </div><!-- /.card-tools -->
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <p><strong>求人名：</strong><?= $values['jobname'] ?></p>
                        <p><strong>仕事内容：</strong><?= $values['work'] ?></p>
                        <p><strong>シフト：</strong><?= "週" . $values['shift'] . "日以上" ?></p>
                        <p><strong>時間：</strong><?= $values['time'] . "時間以上" ?></p>
                        <p><strong>業種：</strong><?= $values['category'] ?></p>
                        <p><strong>時給：</strong><?= $values['salarys'] . $values['money'] . "円" ?></p>
                        <p><strong>勤務地：</strong><?= $values['address'] ?></p>
                        <p><strong>支店名：</strong><?= $values['branch'] ?></p>
                      </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <p><strong>アクセス：</strong><?= $values['access'] ?></p>
                        <p><strong>学歴：</strong><?= $values['school'] ?></p>
                        <p><strong>資格：</strong><?= $values['skill'] ?></p>
                        <p><strong>雇用形態：</strong><?= $values['employment'] ?></p>
                        <p><strong>給与支払：</strong><?= $values['salary'] ?></p>
                        <p><strong>備考：</strong><?= $values['remarks'] ?></p>
                      </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-12">
                      <div class="form-group">
                        <p><strong>待遇面：</strong><?= $values['treatment'] ?></p>
                        <p><strong>環境面：</strong><?= $values['emvironment'] ?></p>
                        <p><strong>～な人歓迎：</strong><?= $values['welcome'] ?></p>
                        <p><strong>自分らしい格好：</strong><?= $values['form'] ?></p>
                      </div>
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.card-body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <button onclick="location.href='/matching/interview?id=<?= $values['office_id'] ?>'" id="button1" type="submit" class="btn btn-primary btn-block mt-2">マッチング申し込み <i class="fas fa-envelope"></i></button>
                      </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <button onclick="location.href='/chat/work_board?id=<?= $values['office_id'] ?>'" id="button2" type="submit" class="btn btn-success btn-block mt-2">チャットする <i class="fas fa-envelope"></i></button>
                      </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <?php if (empty($favorite_array)) { ?>
                        <div class="form-group">
                          <button name="resister_favorite" data-id="<?= $values['office_id'] ?>" data-name="<?= $office_array['office'] ?>" type="submit" class="btn btn-primary btn-block mt-2">お気に入り登録 <i class="fas fa-heart"></i></button>
                        </div><!-- /.form-group -->
                      <?php } else { ?>
                        <div class="form-group">
                          <button name="release_favorite" data-id="<?= $values['office_id'] ?>" data-name="<?= $office_array['office'] ?>" type="submit" class="btn btn-danger btn-block mt-2">お気に入り解除 <i class="fas fa-heart"></i></button>
                        </div><!-- /.form-group -->
                      <?php } ?>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.card-footer -->
              </div><!-- /.card -->
            <?php  } ?>
          <?php  } ?>
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-users"></i>【<?= $office_array['office'] ?>　プロフィール】</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <p><strong>事業所名：</strong><?= $office_array['office'] ?></p>
                    <p><strong>担当者名：</strong><?= $office_array['name'] ?></p>
                    <p><strong>職種：</strong><?= $office_array['job'] ?></p>
                    <p><strong>広告：</strong><?= $office_array['published_time'] ?></p>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <p><strong>画像：</strong></p><img class="mb-4 radius-tr-secondary radius-tl-secondary" src="<?= base_url() ?>/assets/images/resize_office/<?= $office_array['img'] ?>" alt="Profile Picture" />
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.card-body -->
            <div class="card-footer">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <button onclick="location.href='/matching/interview?id=<?= $office_array['id'] ?>'" id="button1" type="submit" class="btn btn-primary btn-block mt-2">マッチング申し込み <i class="fas fa-envelope"></i></button>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                    <button onclick="location.href='/chat/work_board?id=<?= $office_array['id'] ?>'" id="button2" type="submit" class="btn btn-success btn-block mt-2">チャットする <i class="fas fa-envelope"></i></button>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-4">
                  <?php if (empty($favorite_array)) { ?>
                    <div class="form-group">
                      <button name="resister_favorite" data-id="<?= $office_array['id'] ?>" data-name="<?= $office_array['office'] ?>" type="submit" class="btn btn-primary btn-block mt-2">お気に入り登録 <i class="fas fa-heart"></i></button>
                    </div><!-- /.form-group -->
                  <?php } else { ?>
                    <div class="form-group">
                      <button name="release_favorite" data-id="<?= $office_array['id'] ?>" data-name="<?= $office_array['office'] ?>" type="submit" class="btn btn-danger btn-block mt-2">お気に入り解除 <i class="fas fa-heart"></i></button>
                    </div><!-- /.form-group -->
                  <?php } ?>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.card-footer -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->