<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AMSログイン</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script>
  $(function() {
    $("#login").on('click', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
      var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
      var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
      var postdata = {
        'mail': $('[name="mail"]').val(),
        'pass': $('[name="pass"]').val()
      };
      postdata[csrf_name] = csrf_hash;
      $.ajax({
        type: "POST",
        url: "/main/login_validation",
        data: postdata,
        crossDomain: false,
        dataType: "json",
        scriptCharset: 'utf-8'
      }).done(function(data) {
        Swal.fire({
          position: 'top-center',
          icon: 'success',
          title: 'ログイン認証OK!',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location.href = "/main/players";
        });
      }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        Swal.fire({
          icon: 'error',
          title: 'ログイン認証NG!',
          text: '入力内容をご確認下さい。',
        }).then((result) => {
          $("#login").prop('disabled', false);
        });
      });
      return false;
    });
  });
  $(function() {
    $("#work_login").on('click', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
      var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
      var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
      var postdata = {
        'mail': $('[name="work_mail"]').val(),
        'pass': $('[name="work_pass"]').val()
      };
      postdata[csrf_name] = csrf_hash;
      $.ajax({
        type: "POST",
        url: "/worker/login_validation",
        data: postdata,
        crossDomain: false,
        dataType: "json",
        scriptCharset: 'utf-8'
      }).done(function(data) {
        Swal.fire({
          position: 'top-center',
          icon: 'success',
          title: 'ログイン認証OK!',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location.href = "/worker/workers";
        });
      }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        Swal.fire({
          icon: 'error',
          title: 'ログイン認証NG!',
          text: '入力内容をご確認下さい。',
        }).then((result) => {
          $("#work_login").prop('disabled', false);
        });
      });
      return false;
    });
  });
  //form内ではエンターで次の要素に移動(buttonやtextarea以外)
  $(function() {
    $('form').on('keydown', 'input, button, select', function(e) {
      if (e.keyCode == 13) {
        if ($(this).attr("type") == 'submit') return;

        var form = $(this).closest('form');
        var focusable = form.find('input, button[type="submit"], select, textarea')
          .not('[readonly]').filter(':visible');

        if (e.shiftKey) {
          focusable.eq(focusable.index(this) - 1).focus();
        } else {
          var next = focusable.eq(focusable.index(this) + 1);
          if (next.length) {
            next.focus();
          } else {
            focusable.eq(0).focus();
          }
        }
        e.preventDefault();
      }
    });
  });
  </script>
  <style>
    .hello{

      -ms-flex-align: center;
      align-items: center;
      background: #e9ecef;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-direction: column;
      flex-direction: column;
      height: 100vh;
      -ms-flex-pack: center;
      justify-content: center;
    }
  </style>
</head>

<body class="hold-transition hello mt-4">
<!-- <body class="hold-transition login-page"> -->
  <div class="login-box">
    <div class="login-logo">
      <h1>ログイン</h1>
    </div><!-- /.login-logo -->
  </div><!-- /.login-box -->
  <!-- <div class="tab-content">
    <div id="worker" class="tab-pane active">
      <p class="login-box-msg">【お仕事をお探しの方】ログインしてください</p>
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          <form>
            <div class="input-group mb-3">
              <input type="email" name="mail" class="form-control" placeholder="※メールアドレス" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="pass" class="form-control" placeholder="※パスワード" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <button id="login" type="submit" class="btn btn-primary btn-block">ログイン
            </button>
          </form>
    </div>
    <div id="office" class="tab-pane">
      <p class="login-box-msg">【事業者専用】ログインしてください</p>
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          <form>
            <div class="input-group mb-3">
              <input type="email" name="mail" class="form-control" placeholder="※メールアドレス" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="pass" class="form-control" placeholder="※パスワード" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <button id="login" type="submit" class="btn btn-primary btn-block">ログイン
            </button>
          </form>
    </div> -->
  <div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#worker">お仕事をお探しの方はこちらから</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#office">事業者様専用</a>
      </li>
    </ul>
  </div>
    <div class="tab-content" style="width:80%; margin:0 auto;">
      <div id="worker" class="tab-pane active mt-2">
      <p class="login-box-msg">【お仕事をお探しの方】<br>ログインしてください</p>
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
      <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          <form>
            <div class="input-group mb-3">
              <input type="email" name="work_mail" class="form-control" placeholder="※メールアドレス" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="work_pass" class="form-control" placeholder="※パスワード" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <button id="work_login" type="submit" class="btn btn-primary btn-block">ログイン
            </button>
          </form>
          <br>
        <p><?= anchor('form/work_signup/', '新規登録へ　>>'); ?></p>
        <p><?= anchor('password/worker_password/', 'パスワード忘れた方　>>'); ?></p>
      </div>
      <div id="office" class="tab-pane mt-2">
      <p class="login-box-msg">【事業者専用】<br>ログインしてください</p>
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          <form>
            <div class="input-group mb-3">
              <input type="email" name="mail" class="form-control" placeholder="※メールアドレス" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="pass" class="form-control" placeholder="※パスワード" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <button id="login" type="submit" class="btn btn-primary btn-block">ログイン
            </button>
          </form>
          <br>
        <p><?= anchor('form/office_signup/', '新規登録へ　>>'); ?></p>
        <p><?= anchor('password/update_password/', 'パスワード忘れた方　>>'); ?></p>

      </div>
    </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>

</body>

</html>