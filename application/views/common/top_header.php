<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AMSホーム</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!--    Favicons-->
  <!--    =============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/images/favicons/eis1.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/images/favicons/eis32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/favicons/eis16.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicons/eis1.ico">
  <link rel="manifest" href="<?= base_url() ?>assets/images/favicons/manifest.json">
  <link rel="mask-icon" href="<?= base_url() ?>assets/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/images/favicons/eis1.png">
  <meta name="theme-color" content="#ffffff">
  <!--  -->
  <link href="<?= base_url() ?>assets/lib/iconsmind/iconsmind.css" rel="stylesheet">
  <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/lib/hamburgers/dist/hamburgers.min.css" rel="stylesheet">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/user_header.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script>
    $(function() {
      $("#chat").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
        var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
        var postdata = {
          'myworker_id': $('[name="myworker_id"]').val(),
          'youoffice_id': $('[name="youoffice_id"]').val(),
          'name': $('[name="name"]').val(),
          'mail': $('[name="mail"]').val(),
          'message': $('[name="message"]').val()
        };
        postdata[csrf_name] = csrf_hash;
        $.ajax({
          type: "POST",
          url: "/chat/workchat_validation",
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
              Swal.fire({
                icon: 'error',
                title: 'メッセージ登録出来ませんでした。',
                text: '入力内容をご確認下さい。',
              }).then((result) => {
                $("#chat").prop('disabled', false);
              });
            }
            if (data.success) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'メッセージ登録しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/chat/office_list";
              });
            }
          }
        });
        return false;
      });
    });
    $(function() {
      $('#logout').click(function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当にログアウトしてもいいですか?',
          text: 'トップページに戻ります',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はいの場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'id': 'id'
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/main/logout",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'ログアウトOK',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/main/index";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'ログアウト出来ませんでした',
              }).then((result) => {
                $('#logout').prop('disabled', false);
              });
            });
          } else {
            $('#logout').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="resister_favorite"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: 'お気に入り登録してもいいですか?',
          text: '事業者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はいの場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'favorite': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/favorite/register_office",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'お気に入り登録しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/favorite/worker_favorite";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'お気に入り登録出来ませんでした。',
              }).then((result) => {
                $('[name="resister_favolite"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="resister_favolite"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="release_favorite"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: 'お気に入り解除してもいいですか?',
          text: '事業者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はいの場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'favorite': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/favorite/release_office",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'お気に入り解除しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/favorite/worker_favorite";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'お気に入り解除出来ませんでした。',
              }).then((result) => {
                $('[name="release_favorite"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="release_favorite"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    var salarys = {
      "時給": [
        750, 800, 850, 900, 950, 1000, 1050, 1100, 1150, 1200, 1250, 1300, 1350, 1400, 1450, 1500
      ],
      "日給": [
        6000, 7000, 8000, 9000, 10000, 11000, 12000, 13000, 14000, 15000
      ],
      "月給": [
        "15万", "16万", "17万", "18万", "19万", "20万", "21万", "22万", "23万", "24万", "25万"
      ],
    };
    var novalue = $('#salarys').html();
    $(function() {
      $('#salary').on('change', function() {
        var sala = $(this).val();
        if (sala) {
          var item = salarys[sala];
          $('#salarys').html('');
          var options;
          for (var i = 0; i < item.length; i++) {
            options = '<option value="' + item[i] + '">' + item[i] + "円以上" + '</option>';
            $('#salarys').append(options);
          }
        } else {
          $('#salarys').html(novalue);
        }
      });
    });
    $(function() {
      $('[name="approval"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: 'マッチングしてもいいですか?',
          text: '事業者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はいの場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'id': $(this).data('id'),
              'name': $(this).data('name'),
              'mail': $(this).data('mail')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/partner/worker_matching_approval",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'マッチング登録しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/partner/worker_matching";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'マッチング登録出来ませんでした。',
              }).then((result) => {
                $('[name="approval"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="approval"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="block"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: 'マッチング拒否してもいいですか?',
          text: '事業者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はいの場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/partner/release_office",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'マッチング拒否しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/partner/worker_matching";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'マッチング拒否出来ませんでした。',
              }).then((result) => {
                $('[name="block"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="block"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
  </script>
  <style>
    .hamburger-inner,.hamburger-inner::after,.hamburger-inner::before{
      width:30px;
      height:2px;
    }
    .hamburger-inner::before {
      top: -7px;
    }

    .hamburger--emphatic .hamburger-inner::after {
      top: 7px;
    }
    .hamburger{
      padding:2px;
    }
    button:focus{
      outline:none;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hello" aria-controls="#hello" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger hamburger--emphatic">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
      </button>
      <!-- <nav class="main-header sticky-top navbar navbar-expand navbar-white navbar-light" id="hello" style="margin-left:0px;"> -->

      <!-- Left navbar links -->
      <div class="collapse navbar-collapse px-2" id="hello">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a  href="<?= base_url() ?>main/index" class="nav-link font-weight-bold" style="color:#2A3855;">ホーム<i class="fas fa-home"></i></a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>form/office_signup" class="nav-link font-weight-bold" style="color:#2A3855;">事業者登録はこちら<i class="far fa-building"></i></a>
          </li>
          <li class="nav-item">
            <a  href="<?= base_url() ?>form/work_signup" class="nav-link font-weight-bold" style="color:#2A3855;">求職者登録はこちら<i class="far fa-user"></i></a>
          </li>
        </ul>
      <!-- </nav> -->
      </div>
  </nav>