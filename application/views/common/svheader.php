<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EIS運営</title>
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
  <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/images/favicons/fabicon1.png">
  <meta name="theme-color" content="#ffffff">
  <!--  -->
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script>
    $(function() {
      $('[name="stop_office"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に利用停止してもいいですか?',
          text: '事業所：' + $(this).data('name'),
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
              'stop_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/stop_office",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '利用停止しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/manager/administrator";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '利用停止出来ませんでした。',
              }).then((result) => {
                $('[name="stop_office"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="stop_office"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="return_office"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に復帰してもいいですか?',
          text: $(this).data('name'),
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
              'return_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/office_return",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '利用再開しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/dust/stop_teams";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '利用再開出来ませんでした。',
              }).then((result) => {
                $('[name="return_office"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="return_office"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="delete_office"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当にデータから削除してもいいですか?',
          text: $(this).data('name') + 'は復帰出来なくなります。',
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
              'delete_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/delete_office",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'データ削除OK',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/dust/stop_teams";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'データ削除出来ませんでした。',
              }).then((result) => {
                $('[name="delete_office"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="delete_office"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="stop_worker"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に利用停止してもいいですか?',
          text: '求職者：' + $(this).data('name'),
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
              'stop_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/stop_worker",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '利用停止しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/manager/administrator";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '利用停止出来ませんでした。',
              }).then((result) => {
                $('[name="stop_worker"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="stop_worker"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="return_worker"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に復帰してもいいですか?',
          text: $(this).data('name'),
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
              'return_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/worker_return",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '利用再開しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/dust/stop_teams";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '利用再開出来ませんでした。',
              }).then((result) => {
                $('[name="return_worker"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="return_worker"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="delete_worker"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当にデータから削除してもいいですか?',
          text: $(this).data('name') + 'は復帰出来なくなります。',
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
              'delete_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/delete_worker",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'データ削除OK',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/dust/stop_teams";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'データ削除出来ませんでした',
              }).then((result) => {
                $('[name="delete_worker"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="delete_worker"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="end_message"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に対応済ですか?',
          text: '一度処理すると戻れません。',
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
              'end_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/end_message",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '対応済にしました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/manager/contacts";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '対応済に出来ませんでした。',
              }).then((result) => {
                $('[name="end_message"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="end_message"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="delete_message"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に削除してもいいですか?',
          text: 'データ消去するので処理すると二度と表示出来ません。',
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
              'delete_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/delete_message",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '削除しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/manager/contacts";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '削除出来ませんでした。',
              }).then((result) => {
                $('[name="end_message"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="end_message"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $("#news").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
        var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
        var user = [];
        $("[name='user[]']:checked").each(function() {
          user.push(this.value);
        });
        var postdata = {
          'user': user,
          'title': $('[name="title"]').val(),
          'message': $('[name="message"]').val()
        };
        postdata[csrf_name] = csrf_hash;
        $.ajax({
          type: "POST",
          url: "/news/news_register",
          data: postdata,
          crossDomain: false,
          dataType: "json",
          scriptCharset: 'utf-8',
          success: function(data) {
            if (data.error) {
              if (data.title_error != '') {
                $('#title_error').html(data.title_error);
              } else {
                $('#title_error').html('');
              }
              if (data.message_error != '') {
                $('#message_error').html(data.message_error);
              } else {
                $('#message_error').html('');
              }
              Swal.fire({
                icon: 'error',
                title: 'メール送信出来ませんでした。',
                text: '入力内容をご確認下さい。',
              }).then((result) => {
                $("#news").prop('disabled', false);
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
                window.location.href = "/news/newstopix";
              });
            }
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="advertising_published"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '広告掲載してもいいですか?',
          text: '事業所：' + $(this).data('name'),
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
              url: "/advertising/published",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '広告掲載完了しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/advertising/entry";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '広告掲載出来ませんでした。',
              }).then((result) => {
                $('[name="advertising_published"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="advertising_published"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="advertising_release"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '広告掲載を解除してもいいですか?',
          text: '事業所：' + $(this).data('name'),
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
              url: "/advertising/release",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '広告掲載を解除しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/advertising/entry";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '広告掲載を解除出来ませんでした。',
              }).then((result) => {
                $('[name="advertising_release"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="advertising_release"]').prop('disabled', false);
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
          text: 'トップページに戻ります。',
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
                window.location.href = "/manager/login";
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
  </script>
</head>
<?php $this->load->view('common/svsidebar'); ?>