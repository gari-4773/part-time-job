<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ユーザーガイド</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="<?= base_url() ?>assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">
  <!-- header style -->
  <link href="<?= base_url() ?>dist/css/user_header.css" rel="stylesheet" >
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
    <!-- headerボタン -->
    <div class="header_userguide">
      <div class="button_userguide">
        <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url() ?>main/index" class="nav-link text-primary">ホーム<i class="fas fa-home"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url() ?>form/work_signup" class="nav-link text-success" target="_blank">新規登録<i class="fas fa-sign-out-alt"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a id="logout" href="<?= base_url() ?>main/login" class="nav-link text-secondary" target="_blank">ログイン<i class="fas fa-check"></i></a>
        </li>
      </div>
      <h2>ユーザーガイド一覧(求職者)</h2>
    </div>
        <section class="content">
        <div class="container-fluid">
                <!-- タブ型ナビゲーション -->
            <div class="nav nav-tabs" id="tab-menu1" role="tablist">
              <!-- タブ01 -->
              <a class="nav-item nav-link active" id="tab-menu01" data-toggle="tab" href="#panel-menu01" role="tab" aria-controls="panel-menu01" aria-selected="true">登録までの流れ</a>
              <!-- タブ02 -->
              <a class="nav-item nav-link" id="tab-menu02" data-toggle="tab" href="#panel-menu02" role="tab" aria-controls="panel-menu02" aria-selected="false">求人検索</a>
              <!-- タブ03 -->
              <a class="nav-item nav-link" id="tab-menu03" data-toggle="tab" href="#panel-menu03" role="tab" aria-controls="panel-menu03" aria-selected="false">お気に入り</a>
              <!-- タブ04 -->
              <a class="nav-item nav-link" id="tab-menu04" data-toggle="tab" href="#panel-menu04" role="tab" aria-controls="panel-menu04" aria-selected="false">チャット</a>
              <!-- タブ05 -->
              <a class="nav-item nav-link" id="tab-menu05" data-toggle="tab" href="#panel-menu05" role="tab" aria-controls="panel-menu05" aria-selected="false">マッチング</a>
              <!-- タブ06 -->
              <a class="nav-item nav-link" id="tab-menu06" data-toggle="tab" href="#panel-menu06" role="tab" aria-controls="panel-menu06" aria-selected="false">ホーム画面</a>
              <!-- タブ07 -->
              <a class="nav-item nav-link" id="tab-menu07" data-toggle="tab" href="#panel-menu07" role="tab" aria-controls="panel-menu07" aria-selected="false">マイページ</a>
              <!-- タブ08 -->
              <a class="nav-item nav-link" id="tab-menu08" data-toggle="tab" href="#panel-menu08" role="tab" aria-controls="panel-menu08" aria-selected="false">お問い合わせ</a>
              <!-- タブ09 -->
              <a class="nav-item nav-link" id="tab-menu09" data-toggle="tab" href="#panel-menu09" role="tab" aria-controls="panel-menu09" aria-selected="false">お知らせ一覧</a>
              <!-- タブ10 -->
              <a class="nav-item nav-link" id="tab-menu10" data-toggle="tab" href="#panel-menu10" role="tab" aria-controls="panel-menu10" aria-selected="false">パスワード変更</a>
            </div>
        <!-- /タブ型ナビゲーション -->
        <!-- パネル -->
        <div class="tab-content" id="panel-menu1">
            <!-- パネル01 -->
          <div class="tab-pane fade show active border border-top-0" id="panel-menu01" role="tabpanel" aria-labelledby="tab-menu01">
            <div class="row p-3">
                <h3>【求職者ユーザー/登録までの流れ】</h3>
                <div class="col-md-8 order-md-2">
                </div><!-- /.col -->
                  <div class="col-md-12">
                    <img src="<?= base_url() ?>assets/images/user_guide/work_temporary.png" alt="求職者仮登録" class="img-fluid">
                    <div class="w-100"></div>
                    <br>
                    <img src="<?= base_url() ?>assets/images/user_guide/work_resister.png" alt="求職者本登録" class="img-fluid">
                    <div class="w-100"></div>
                    <br>
                    <img src="<?= base_url() ?>assets/images/user_guide/プロフィール画像アップロード画面.png" alt="画像登録" class="img-fluid">
                    <div class="w-100"></div>
                    <br>
                    <img src="<?= base_url() ?>assets/images/user_guide/ログイン画面.png" alt="ログイン画面" class="img-fluid">
                    <div class="w-100"></div>
                    <br>
                  </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.tab-pane fade show active border border-top-0 -->
          <!-- パネル02 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu02" role="tabpanel" aria-labelledby="tab-menu02">
              <div class="row p-3">
                <h3>【求人検索について】</h3>
                <div class="col-md-8 order-md-2">
                </div><!-- /.col -->
                    <div class="col-md-12">
                        <img src="<?= base_url() ?>assets/images/user_guide/job_search.png" alt="ホームページ画面" class="img-fluid">
                        <div class="w-100"></div>
                        <br>
                        <img src="<?= base_url() ?>assets/images/user_guide/job_detail.png" alt="ホームページ画面" class="img-fluid">
                        <div class="w-100"></div>
                        <br>
                    </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.tab-pane fade show active border border-top-0 -->
          <!-- パネル03 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu03" role="tabpanel" aria-labelledby="tab-menu03">
              <div class="row p-3">
                <h3>【お気に入りについて】</h3>
              <div class="col-md-8 order-md-2">
                </div><!-- /.col -->
              <div class="col-md-12">
                <img src="<?= base_url() ?>assets/images/user_guide/favorite.png" alt="ホームページ画面" class="img-fluid">
                <div class="w-100"></div>
                <br>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.tab-pane fade show active border border-top-0 -->
          <!-- パネル04 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu04" role="tabpanel" aria-labelledby="tab-menu04">
              <div class="row p-3">
                <h3>【チャットについて】</h3>
                <div class="col-md-8 order-md-2">
                    </div><!-- /.row -->
                    <div class="col-md-12">
                        <img src="<?= base_url() ?>assets/images/user_guide/chat1.png" alt="チャット受信一覧画面" class="img-fluid">
                        <div class="w-100"></div>
                        <br>
                        <img src="<?= base_url() ?>assets/images/user_guide/chat2.png" alt="チャット一覧画面" class="img-fluid">
                        <div class="w-100"></div>
                        <br>
                    </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.tab-pane fade show active border border-top-0 -->
          <!-- パネル05 -->
          <div class="tab-pane fade border border-top-0" id="panel-menu05" role="tabpanel" aria-labelledby="tab-menu05">
              <div class="row p-3">
                  <h3>【マッチングについて】</h3>
              <div class="col-md-8 order-md-2">
                  </div><!-- /.col -->
                  <img src="<?= base_url() ?>assets/images/user_guide/matching2.png" alt="マッチング申し込み" class="img-fluid">
                  <div class="w-100"></div>
                  <br>
                  <img src="<?= base_url() ?>assets/images/user_guide/matching1.png" alt="マッチング状況一覧" class="img-fluid">
                  <div class="w-100"></div>
                  <br>
              </div><!-- /.col -->
            </div><!-- /.row -->

          <div class="tab-pane fade border border-top-0" id="panel-menu06" role="tabpanel" aria-labelledby="tab-menu06">
              <div class="row p-3">
                <h3>【ホーム画面について】</h3>
                <div class="col-md-8 order-md-2">
              </div><!-- /.col -->
              <div class="col-md-12">
                <img src="<?= base_url() ?>assets/images/user_guide/work_admin.png" alt="ホームページ画面" class="img-fluid">
                <div class="w-100"></div>
                <br>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
          <div class="tab-pane fade border border-top-0" id="panel-menu07" role="tabpanel" aria-labelledby="tab-menu07">
              <div class="row p-3">
                <h3>【マイページについて】</h3>
                <div class="col-md-8 order-md-2">
                </div><!-- /.col -->
                <div class="col-md-12">
                <img src="<?= base_url() ?>assets/images/user_guide/work_mypage.png" alt="マイページ" class="img-fluid">
                <div class="w-100"></div>
                <br>
                <img src="<?= base_url() ?>assets/images/user_guide/work_profile.png" alt="プロフィール編集" class="img-fluid">
                <div class="w-100"></div>
                <br>
                <img src="<?= base_url() ?>assets/images/user_guide/プロフィール画像アップロード画面.png" alt="画像変更" class="img-fluid">
                <div class="w-100"></div>
                <br>
                <img src="<?= base_url() ?>assets/images/user_guide/work_mail.png" alt="メールアドレス変更" class="img-fluid">
                <div class="w-100"></div>
                <br>
              </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.tab-pane fade show active border border-top-0 -->
        <div class="tab-pane fade border border-top-0" id="panel-menu08" role="tabpanel" aria-labelledby="tab-menu08">
              <div class="row p-3">
                <h3>【お問い合わせについて】</h3>
                <div class="col-md-8 order-md-2">
                </div><!-- /.col -->
                <div class="col-md-12">
                <img src="<?= base_url() ?>assets/images/user_guide/お問い合わせ画面.png" alt="お問い合わせ" class="img-fluid">
                <div class="w-100"></div>
                <br>
              </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <div class="tab-pane fade border border-top-0" id="panel-menu09" role="tabpanel" aria-labelledby="tab-menu09">
              <div class="row p-3">
                <h3>【お知らせ一覧について】</h3>
                <div class="col-md-8 order-md-2">
                </div><!-- /.col -->
                <div class="col-md-12">
                <img src="<?= base_url() ?>assets/images/user_guide/work_notice.png" alt="お知らせ" class="img-fluid">
                <div class="w-100"></div>
                <br>
              </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <div class="tab-pane fade border border-top-0" id="panel-menu10" role="tabpanel" aria-labelledby="tab-menu10">
              <div class="row p-3">
                <h3>【パスワード変更について】</h3>
                <div class="col-md-8 order-md-2">
                </div><!-- /.col -->
                <div class="col-md-12">
                <img src="<?= base_url() ?>assets/images/user_guide/password1.png" alt="パスワード変更1" class="img-fluid">
                <div class="w-100"></div>
                <br>
                <img src="<?= base_url() ?>assets/images/user_guide/password2.png" alt="パスワード変更2" class="img-fluid">
                <div class="w-100"></div>
                <br>
              </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div><!-- /.tab-content -->
</div><!-- /.container-fluid -->
</div>
</section><!-- /.content -->
</body>
<?php $this->load->view('common/footer'); ?>
  <!-- jQuery -->
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>

</body>

</html>