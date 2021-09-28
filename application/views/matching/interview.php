<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>マッチング申し込み</title>
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
      $("#interview").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
        var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
        var postdata = {
          'destination': $('[name="destination"]').val(),
          'id': $('[name="office_id"]').val(),
          'name': $('[name="name"]').val(),
          'job_id': $('[name="job_id"]').val(),
          'mail': $('[name="mail"]').val(),
          'message': $('[name="message"]').val()
        };
        postdata[csrf_name] = csrf_hash;
        $.ajax({
          type: "POST",
          url: "/matching/worker_matching",
          data: postdata,
          crossDomain: false,
          dataType: "json",
          scriptCharset: 'utf-8',
          success: function(data) {
            if (data.error) {
              if (data.message_error != '') {
                $('#message_error').html(data.message_error);
              } else {
                $('#message_error').html('');
              }
              if (data.count_error != '') {
                $('#count_error').html(data.count_error);
              } else {
                $('#count_error').html('');
              }
              Swal.fire({
                icon: 'error',
                title: 'メール送信出来ませんでした。',
                text: '入力内容をご確認下さい。',
              }).then((result) => {
                $("#interview").prop('disabled', false);
              });
            }
            if (data.success) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'メール送信しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/main/job_search";
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
      <h1>マッチング申し込み</h1>
    </div>
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">入力内容を確認し、申し込んでください。</p>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        <input type="hidden" class="form-control" name="office_id" value="<?= $row_array['id'] ?>">
        <input type="hidden" name="job_id" value="<?= $_GET['job_id'] ?>">
        <p class="text-group mb-3">事業所名 <span class="fas fa-users"></span> : <strong><?= $row_array['office'] ?></strong></p>
        <p class="text-group mb-3">担当者 <span class="fas fa-user"></span> : <strong><?= $row_array['name'] ?></strong></p>
        <div class="error">
          <strong><span id="count_error" class="text-danger"></span></strong>
        </div>
        <div class="error">
          <?php if(isset($error)){?>
            <b class="text-danger"><?= $error; ?></b>
          <?php } ?>
        </div>
        <div class="input-group mb-3">
          <input type="hidden" class="form-control" name="destination" placeholder="メールアドレス" value="<?= $row_array['mail'] ?>">
        </div>
        <div class="input-group">
          <input type="hidden" class="form-control" name="name" placeholder="氏名" value="<?= $_SESSION['name'] ?>">
        </div>
        <div class="input-group">
          <input type="hidden" class="form-control" name="mail" placeholder="メールアドレス" value="<?= $_SESSION['mail'] ?>">
        </div>
        <div class="error">
          <strong><span id="message_error" class="text-danger"></span></strong>
        </div>
        <div class="form-group mb-3">
          <textarea name="message" id="message" cols="40" rows="15">いつもご利用ありがとうございます。

<?= $_SESSION['name'] ?>様よりマッチングの申し込みがありました。
サイトにログインしていただき返信をお願いします。

求人名：<?= $_GET['jobname'];?>


※こちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。
          </textarea>
        </div>
        <?php if(!isset($error)){?>
            <div class="row">
              <button id="interview" type="submit" class="btn btn-primary btn-block">申し込む</button>
            </div>
            <?php } ?>
        <br>
        <p><?= anchor('main/job_search', '一覧に戻る　>>'); ?></p>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </div><!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
</body>

</html>