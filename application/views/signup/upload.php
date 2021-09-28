<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>画像登録</title>
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
      $("#upload").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        var postdata = new FormData($('#form').get(0));
        var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
        var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
        postdata[csrf_name] = csrf_hash;
        $.ajax({
          type: "POST",
          url: "/upload/office_imgupload",
          data: postdata,
          crossDomain: false,
          //data:に指定したオブジェクトをGETメソッドのクエリ文字への変換有無を指定する
          processData: false,
          //データ送信時のcontent-typeヘッダの値になるが、formDataオブジェクトの場合は適切なcontent-typeが設定されるため、falseを設定する。
          contentType: false,
          dataType: "json",
          scriptCharset: 'utf-8',
          success: function(data) {
            if (data.error) {
              if (data.img_error != '') {
                $('#img_error').html(data.img_error);
              } else {
                $('#img_error').html('');
              }
              Swal.fire({
                icon: 'error',
                title: '画像登録出来ませんでした。',
                text: 'エラー内容をご確認下さい。',
              }).then((result) => {
                $("#upload").prop('disabled', false);
              });
            }
            if (data.success) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '画像登録出来ました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/main/players";
              });
            }
          }
        });
        return false;
      });
    });
  </script>
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <h1>プロフィール画像登録</h1>
    </div>
    <div class="card">
      <?= form_open_multipart('upload/office_imgupload', array('id' => 'form')); ?>
      <div class="card-body register-card-body">
        <p class="login-box-msg">下記から選択後、登録してください。</p>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        <input type="hidden" class="form-control" name="id" value="<?= $id ?>">
        <div class="error">
          <strong><span id="img_error" class="text-danger"></span></strong>
        </div>
        <div class="input-group mb-3">
          <input type="file" name="img" class="form-control" placeholder="画像をアップロードする">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="far fa-file-image" aria-hidden="true"></span>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <button id="upload" type="submit" class="btn btn-primary btn-block">登録</button>
          </div>
          <br>
          <p><?= anchor('office/mypage', '後で登録する　>>'); ?></p>
        </div>
      </div>
      <!-- /.form-box -->
      <?= form_close() ?>
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