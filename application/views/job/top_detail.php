  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <h1 class="m-0 text-dark">求人詳細</h1>
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
                <h3 class="card-title">【<?= $job_array['office'] ?>】</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> -->
                    <div class="input-group-append">
                      <!-- <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button> -->
                    </div><!-- /.input-group-append -->
                  </div><!-- /.input-group input-group-sm -->
                </div><!-- /.card-tools -->
              </div><!-- /.card-header -->
              <div class="card-body" style="filter:blur(5px); user-select:none;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <p><strong>仕事内容：</strong></p>
                      <p><strong>シフト：</strong></p>
                      <p><strong>時間：</strong>時間以上</p>
                      <p><strong>業種：</strong></p>
                      <p><strong>時給：</strong>円</p>
                      <p><strong>勤務地：</strong></p>
                      <p><strong>支店名：</strong></p>
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <p><strong>アクセス：</strong></p>
                      <p><strong>学歴：</strong></p>
                      <p><strong>資格：</strong></p>
                      <p><strong>雇用形態：</strong>ment</p>
                      <p><strong>給与支払：</strong></p>
                      <p><strong>備考：</strong>s</p>
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <p><strong>待遇面：</strong></p>
                      <p><strong>環境面：</strong></p>
                      <p><strong>～な人歓迎：</strong></p>
                      <p><strong>自分らしい格好：</strong></p>
                    </div>
                  </div>
                </div><!-- /.row -->
              </div><!-- /.card-body -->
              <div class="px-4" style="margin:0 auto;">
                <h5>※サイト登録を行うことで情報を見ることが出来ます。</h5>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <button onclick="location.href='/form/work_signup'" id="button1" type="submit" class="btn btn-primary btn-block mt-2">アルバイトをお探しの方 <i class="fas fa-envelope"></i></button>
                      <!-- <button onclick="location.href='/matching/interview?id=_id''" id="button1" type="submit" class="btn btn-primary btn-block mt-2">マッチング申し込み <i class="fas fa-envelope"></i></button> -->
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <button onclick="location.href='/form/office_signup'" id="button2" type="submit" class="btn btn-success btn-block mt-2">事業者様の方 <i class="fas fa-envelope"></i></button>
                      <!-- <button onclick="location.href='/chat/work_board?id=<?= $job_array['office_id'] ?>'" id="button2" type="submit" class="btn btn-success btn-block mt-2">チャットする <i class="fas fa-envelope"></i></button> -->
                    </div><!-- /.form-group -->
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.card-footer -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->