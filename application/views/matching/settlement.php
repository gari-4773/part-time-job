<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>マッチング決済</title>
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
    $("#transfer").on('click', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
      var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
      var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
      var postdata = {
        'id': $('[name="id"]').val()
      };
      postdata[csrf_name] = csrf_hash;
      $.ajax({
        type: "POST",
        url: "/email/transfer_mail",
        data: postdata,
        crossDomain: false,
        dataType: "json",
        scriptCharset: 'utf-8'
      }).done(function(data) {
        Swal.fire({
          position: 'top-center',
          icon: 'success',
          title: 'メール送信OK!',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location.href = "/partner/office_matching";
        });
      }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        Swal.fire({
          icon: 'error',
          title: 'メール送信NG!',
          text: 'お問い合わせからご連絡下さい。',
        }).then((result) => {
          $("#transfer").prop('disabled', false);
        });
      });
      return false;
    });
  });
  </script>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <h1>マッチング決済</h1>
    </div><!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">以下から選択後お支払いください</p>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        <div class="form-group">
          <label for="email">▼クレジット決済はこちら</label>
          <?= form_open('main/stripe');?>
          <!-- 河﨑テスト用のstripe 公開可能キー -->
          <!-- data-key="pk_test_51IWlZqGJrPJmUkIi84svzjFyepGRe8XWL12gFfU7fLvKYXv2uZVhlSfOYJjdpR1omVwE77rUfs66uDPnGGwgcUCv00NMkLTZBg" -->
          <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_51IqoyfBD2NQf5O0bXd2xZkbUOAzsCP0NIHG1e9eU52DovHw4g6rGmcyyI2i9UM9uGXG9bgszaeHnari78WLBnjBT00jSwIPvHl"
            data-amount="500" data-name="マッチングする" data-description="求職者様の情報を公開する" data-locale="auto"
            data-allow-remember-me="false" data-panelLabel="マッチングする" data-label="決済する" data-currency="jpy">
          </script>
          <script>
          // Hide default stripe button, be careful there if you
          // have more than 1 button of that class
          document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
          </script>
          <button type="submit" class="btn btn-primary btn-block">クレジット決済</button>
          <input type="hidden" name="id" value="<?= $row_array['id']?>">
          <!-- </form> -->
          <?= form_close(); ?>
        </div>
        <div class="form-group">
          <label for="email">▼銀行振込はこちら</label>
          <button id="transfer" type="submit" class="btn btn-primary btn-block">振込先送信
          </button>
        </div>
        <br>
        <p><?= anchor('partner/office_matching/', 'マッチング一覧に戻る　>>'); ?></p>
        <p><?= anchor('main/players/', 'ホームに戻る　>>'); ?></p>
      </div><!-- /.login-card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->
  <!-- jQuery -->
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>

</body>

</html>