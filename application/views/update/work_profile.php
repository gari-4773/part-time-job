<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>プロフィール変更</title>
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
      $("#update").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
        var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
        var postdata = {
          'id': $('[name="id"]').val(),
          'name': $('[name="name"]').val(),
          'nickname': $('[name="nickname"]').val(),
          'tel': $('[name="tel"]').val(),
          'sex': $('[name="sex"]').val(),
          'birth': $('[name="birth"]').val(),
          'school_year': $('[name="school_year"]').val(),
          'address': $('[name="address"]').val(),
          'schools': $('[name="schools"]').val(),
          'hope_work': $('[name="hope_work"]').val(),
          'skill': $('[name="skill"]').val()
        };
        postdata[csrf_name] = csrf_hash;
        $.ajax({
          type: "POST",
          url: "/change/update_worker_profile",
          data: postdata,
          crossDomain: false,
          dataType: "json",
          scriptCharset: 'utf-8',
          success: function(data) {
            if (data.error) {
              if (data.name_error != '') {
                $('#name_error').html(data.name_error);
              } else {
                $('#name_error').html('');
              }
              if (data.nickname_error != '') {
                $('#nickname_error').html(data.nickname_error);
              } else {
                $('#nickname_error').html('');
              }
              if (data.tel_error != '') {
                $('#tel_error').html(data.tel_error);
              } else {
                $('#tel_error').html('');
              }
              if (data.skill_error != '') {
                $('#skill_error').html(data.skill_error);
              } else {
                $('#skill_error').html('');
              }
              Swal.fire({
                icon: 'error',
                title: '編集NG',
                text: '入力内容をご確認下さい。',
              }).then((result) => {
                $("#update").prop('disabled', false);
              });
            }
            if (data.success) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '編集OK',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/worker/workers";
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
      <h1>登録情報変更</h1>
    </div>
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">変更箇所を入力してください</p>
        <div class="input-group mb-3">
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          <input type="hidden" class="form-control" name="id" value="<?= $row_array['id'] ?>">
        </div>
        <p class="mb-2 text-bold">◆氏名</p>
        <div class="error">
          <strong><span id="name_error" class="text-danger"></span></strong>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="※氏名" value="<?= $row_array['name'] ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <p class="mb-2 text-bold">◆ニックネーム</p>
        <div class="error">
          <strong><span id="nickname_error" class="text-danger"></span></strong>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nickname" placeholder="※ニックネーム" value="<?= $row_array['nickname'] ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-circle"></span>
            </div>
          </div>
        </div>
        <p class="mb-2 text-bold">◆電話番号</p>
        <div class="error">
          <strong><span id="tel_error" class="text-danger"></span></strong>
        </div>
        <div class="input-group mb-3">
          <input type="tel" class="form-control" name="tel" placeholder="※電話番号" value="<?= $row_array['tel'] ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group mb-2">
              <label for="sex">◆性別</label>
              <select name="sex" class="form-control" style="width: 100%;">
              <option><?= $row_array['sex'] ?></option>
                <option>男性</option>
                <option>女性</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group mb-2">
              <label for="birth">◆生年</label>
              <select name="birth" class="form-control" style="width: 100%;">
                <option><?= $row_array['birth'] ?>年</option>
                <?php for ($i = date("Y", strtotime("-30 year")); $i <= date("Y"); $i++) { ?>
                  <option><?= $i; ?>年</option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="school_year">◆学年</label>
              <select name="school_year" class="form-control" style="width: 100%;">
                <option><?= $row_array['school_year'] ?></option>
                <?php for ($i = 1; $i <= 4; $i++) { ?>
                  <option>大学<?= $i; ?>年</option>
                <?php } ?>
                <?php for ($i = 1; $i <= 2; $i++) { ?>
                  <option>大学院<?= $i; ?>年</option>
                <?php } ?>
                <?php for ($i = 1; $i <= 4; $i++) { ?>
                  <option>専門学校/短期大学<?= $i; ?>年</option>
                <?php } ?>
              </select>
            </div><!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="address">◆住所</label>
              <select name="address" class="form-control" style="width: 100%;">
                <option><?= $row_array['address'] ?></option>
                <option>松山市</option>
                <option>伊予市</option>
                <option>東温市</option>
                <option>松前町</option>
                <option>その他</option>
              </select>
            </div><!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="schools">◆最終学歴</label>
              <select name="schools" class="form-control" style="width: 100%;">
                <option><?= $row_array['schools'] ?></option>
                <option>大学卒業見込み</option>
                <option>大学院卒業見込み</option>
                <option>高校卒業</option>
              </select>
            </div><!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="hope_work">◆希望職種</label>
              <select name="hope_work" class="form-control" style="width: 100%;">
                <option><?= $row_array['hope_work'] ?></option>
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
                <option>その他</option>
              </select>
            </div><!-- /.form-group -->
          </div>
        </div>
        <p class="mb-2 text-bold">資格・スキル</p>
        <div class="error">
          <strong><span id="skill_error" class="text-danger"></span></strong>
        </div>
        <div class="input-group mb-3">
          <textarea class="form-control" name="skill" placeholder="※資格・スキル" value="<?= $row_array['skill'] ?>"></textarea>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-pen"></span>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <button id="update" type="submit" class="btn btn-primary btn-block">変更</button>
          </div>
          <br>
          <p><?= anchor('worker/mypage', 'マイページに戻る　>>'); ?></p>
        </div>
      </div><!-- /.form-box -->
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