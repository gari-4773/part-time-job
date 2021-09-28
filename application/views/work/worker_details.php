    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <h1 class="m-0 text-dark">求職者詳細</h1>
        </div><!-- /.row -->
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
                <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
                <h3 class="card-title">【<?= $worker_array['nickname'] ?>さん】</h3>
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
                      <p><strong>学年：</strong><?= $worker_array['school_year'] ?></p>
                      <p><strong>満年齢：</strong><?= date("Y") - $worker_array['birth'] ?>歳 </p>
                      <p><strong>住所：</strong><?= $worker_array['address'] ?></p>
                      <p><strong>最終学歴：</strong><?= $worker_array['schools'] ?></p>
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <p><strong>職務経歴：</strong><?= $worker_array['works'] ?></p>
                      <p><strong>希望職種：</strong><?= $worker_array['hope_work'] ?></p>
                      <p><strong>資格：</strong><?= $worker_array['skill'] ?></p>
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <button onclick="location.href='/matching/scout?id=<?= $worker_array['id'] ?>'" id="button2" type="submit" class="btn btn-primary btn-block mt-2">マッチング申し込み <i class="fas fa-envelope"></i></button>
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <button onclick="location.href='/chat/board?id=<?= $worker_array['id'] ?>'" id="button1" type="submit" class="btn btn-success btn-block mt-2">チャットする <i class="fas fa-envelope"></i></button>
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                  <div class="col-md-4">
                    <?php if (empty($favorite_array)) { ?>
                      <div class="form-group">
                        <button name="resister_favorite" data-id="<?= $worker_array['id'] ?>" data-name="<?= $worker_array['name'] ?>" type="submit" class="btn btn-primary btn-block mt-2">お気に入り登録 <i class="fas fa-heart"></i></button>
                      </div><!-- /.form-group -->
                    <?php } else { ?>
                      <div class="form-group">
                        <button name="release_favorite" data-id="<?= $worker_array['id'] ?>" data-name="<?= $worker_array['name'] ?>" type="submit" class="btn btn-danger btn-block mt-2">お気に入り解除 <i class="fas fa-heart"></i></button>
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