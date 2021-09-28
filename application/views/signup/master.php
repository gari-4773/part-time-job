<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>新規本登録</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
    $("#master_office").on('click', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
      var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
      var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
      var postdata = {
        'office': $('[name="office"]').val(),
        'name': $('[name="name"]').val(),
        'tel': $('[name="tel"]').val(),
        'mail': $('[name="mail"]').val(),
        'pass': $('[name="pass"]').val(),
        'chkpass': $('[name="chkpass"]').val(),
        'job': $('[name="job"]').val()
      };
      postdata[csrf_name] = csrf_hash;
      $.ajax({
        type: "POST",
        url: "/office/register_office",
        data: postdata,
        crossDomain: false,
        dataType: "json",
        scriptCharset: 'utf-8',
        success: function(data) {
          if (data.error) {
            if (data.office_error != '') {
              $('#office_error').html(data.office_error);
            } else {
              $('#office_error').html('');
            }
            if (data.name_error != '') {
              $('#name_error').html(data.name_error);
            } else {
              $('#name_error').html('');
            }
            if (data.tel_error != '') {
              $('#tel_error').html(data.tel_error);
            } else {
              $('#tel_error').html('');
            }
            if (data.mail_error != '') {
              $('#mail_error').html(data.mail_error);
            } else {
              $('#mail_error').html('');
            }
            if (data.job_error != '') {
              $('#job_error').html(data.job_error);
            } else {
              $('#job_error').html('');
            }
            if (data.pass_error != '') {
              $('#pass_error').html(data.pass_error);
            } else {
              $('#pass_error').html('');
            }
            if (data.chkpass_error != '') {
              $('#chkpass_error').html(data.chkpass_error);
            } else {
              $('#chkpass_error').html('');
            }
            Swal.fire({
              icon: 'error',
              title: '本登録出来ませんでした。',
              text: '入力内容をご確認下さい。',
            }).then((result) => {
              $("#master_office").prop('disabled', false);
            });
          }
          if (data.success) {
            Swal.fire({
              title: '本登録完了しました。\nプロフィール画像登録しますか？',
              text: '後からでも登録可能です。',
              icon: 'success',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#bbb',
              confirmButtonText: 'はい!',
              cancelButtonText: 'いいえ！'
            }).then((result) => {
              if (result.value) { //はい！の場合
                window.location.href = "/upload/office_upload?id=" + data.id;
              } else {
                window.location.href = "/main/login";
              }
            });
          }
        }
      });
      return false;
    });
  });
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
</head>

<body class="hold-transition register-page" style="height: 100%;">
  <div class="register-box">
    <div class="register-logo">
      <h1>事業者本登録</h1>
    </div>
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">下記に入力後、登録してください。</p>
        <div class="input-group mb-3">
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        </div>
        <form>
          <div class="error">
            <strong><span id="mail_error" class="text-danger"></span></strong>
          </div>
          <div class="email">
            <input type="hidden" class="form-control" name="mail" value="<?= $row_array['mail'] ?>">
            <p class="text-group mb-3">メールアドレス <span class="fas fa-envelope"></span> :
              <strong><?= $row_array['mail'] ?></strong></p>
          </div>
          <div class="error">
            <strong><span id="office_error" class="text-danger"></span></strong>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="office" placeholder="※事業所名" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-home"></span>
              </div>
            </div>
          </div>
          <div class="error">
            <strong><span id="name_error" class="text-danger"></span></strong>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="※担当者名" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="error">
            <strong><span id="tel_error" class="text-danger"></span></strong>
          </div>
          <div class="input-group mb-3">
            <input type="tel" class="form-control" name="tel" placeholder="※電話番号" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <div class="error">
            <strong><span id="job_error" class="text-danger"></span></strong>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="job">職種</label>
                <select name="job" class="form-control" style="width: 100%;">
                  <option disabled selected value>選択してください</option>
                  <option>飲食・フード</option>
                  <option>販売・接客・サービス</option>
                  <option>アパレル・ファッション関連</option>
                  <option>レジャー・アミューズメント</option>
                  <option>クリエイティブ・編集</option>
                  <option>イベント・キャンペーン</option>
                  <option>教育</option>
                  <option>配送・引越・ドライバー</option>
                  <option>軽作業</option>
                  <option>工場・倉庫・建築・土木</option>
                  <option>警備・清掃・ビル管理</option>
                </select>
              </div>
            </div>
          </div>
          <div class="error">
            <strong><span id="pass_error" class="text-danger"></span></strong>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" placeholder="※パスワード" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="error">
            <strong><span id="chkpass_error" class="text-danger"></span></strong>
          </div>
          <div class="input-group mb-4">
            <input type="password" class="form-control" name="chkpass" placeholder="※パスワード確認" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button id="master_office" type="submit" class="btn btn-primary btn-block">登録</button>
        </form>
        <br>
        <div class="container">
          <div class="row">
            <div class="col-6">
              <p class="float-left"><?= anchor('main/login/', 'ログインへ　>>'); ?></p>
            </div><!-- /.col -->
            <div class="col-6">
              <p class="float-right"><?= anchor('form/office_signup', '仮登録へ　>>'); ?></p>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
</body>

</html>