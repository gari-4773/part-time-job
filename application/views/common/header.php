<!DOCTYPE html>
<html lang="ja">

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
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script>

$(function() {
      $("#re-matching").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: 'マッチングを再開しますか?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ'
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              // 'office_id': $('[name="office_id"]').val(),
              'worker_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/partner/office_rematching",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'マッチング再開しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/partner/office_matching";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'マッチングを再開出来ませんでした。',
              }).then((result) => {
                $('#re-matching').prop('disabled', false);
              });
            });
          } else {
            $('#re-matching').prop('disabled', false);
          }
        });
        return false;
      });
    });

    $(function() {
      $("#register").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        var work = $('[name="work"]').val();
        var jobname = $('[name="jobname"]').val();
        var time = $('[name="time"]').val();
        var money = $('[name="money"]').val();
        var branch = $('[name="branch"]').val();
        var access = $('[name="access"]').val();
        var skill = $('[name="skill"]').val();
        var remarks = $('[name="remarks"]').val();
        var shift = $('[name="shift"]').val();
        var category = $('[name="category"]').val();
        var address = $('[name="address"]').val();
        var employment = $('[name="employment"]').val();
        var salarys = $('[name="salarys"]').val();
        var school = $('[name="school"]').val();
        var salary = $('[name="salary"]').val();
        var treatment1 = [];
        $("[name='treatment[]']:checked").each(function() {
          treatment1.push(this.value);
        });
        var emvironment1 = [];
        $("[name='emvironment[]']:checked").each(function() {
          emvironment1.push(this.value);
        });
        var welcome1 = [];
        $("[name='welcome[]']:checked").each(function() {
          welcome1.push(this.value);
        });
        var form1 = [];
        $("[name='form[]']:checked").each(function() {
          form1.push(this.value);
        });
        var treatment = treatment1.join();
        var emvironment = emvironment1.join();
        var welcome = welcome1.join();
        var form = form1.join();

        Swal.fire({
          title: '以下の内容で求人登録してもいいですか?',
          html: '<div class="row">' + '<div class="col-6">' +
            '<p><strong>求人名：</strong>' + jobname + '</p>' + '<p><strong>仕事内容：</strong>' + work + '</p>' + '<p><strong>時間：</strong>' + time + '時間以上' + '</p>' + '<p><strong>給与区分：</strong>' + salarys + '</p>' + '<p><strong>単価：</strong>' + money + '円' + '</p>' + '<p><strong>支店：</strong>' + branch + '</p>' + '<p><strong>アクセス：</strong>' + access + '</p>' + '<p><strong>資格：</strong>' + skill + '</p>' +
            '</div>' + '<div class="col-6">' +
            '<p><strong>シフト：</strong>' + '週' + shift + '日以上' + '</p>' + '<p><strong>業種：</strong>' + category + '</p>' + '<p><strong>勤務地：</strong>' + address + '</p>' + '<p><strong>雇用形態：</strong>' + employment + '</p>' +
            '<p><strong>学歴：</strong>' + school + '</p>' + '<p><strong>給与支払：</strong>' + salary + '</p>' +
            '</div>' + '<div class="col-12">' +
            '<p><strong>待遇面：</strong>' + remarks + '</p>' + '<p><strong>待遇面：</strong>' + treatment + '</p>' + '<p><strong>環境面：</strong>' + emvironment + '</p>' + '<p><strong>～な人歓迎：</strong>' + welcome + '</p>' + '<p><strong>自分らしい格好：</strong>' + form + '</p>' +
            '</div>' + '</div>',
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ'
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'office_id': $('[name="office_id"]').val(),
              'work': work,
              'jobname': jobname,
              'time': time,
              'salarys': salarys,
              'money': money,
              'branch': branch,
              'access': access,
              'skill': skill,
              'remarks': remarks,
              'shift': shift,
              'category': category,
              'address': address,
              'school': school,
              'employment': employment,
              'treatment': treatment,
              'emvironment': emvironment,
              'welcome': welcome,
              'form': form,
              'salary': salary
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/jobwork/register_validation",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8',
              success: function(data) {
                if (data.error) {
                  if (data.work_error != '') {
                    $('#work_error').html(data.work_error);
                  } else {
                    $('#work_error').html('');
                  }
                  if (data.jobname_error != '') {
                    $('#jobname_error').html(data.jobname_error);
                  } else {
                    $('#jobname_error').html('');
                  }
                  if (data.time_error != '') {
                    $('#time_error').html(data.time_error);
                  } else {
                    $('#time_error').html('');
                  }
                  if (data.money_error != '') {
                    $('#money_error').html(data.money_error);
                  } else {
                    $('#money_error').html('');
                  }
                  if (data.shift_error != '') {
                    $('#shift_error').html(data.shift_error);
                  } else {
                    $('#shift_error').html('');
                  }
                  if (data.category_error != '') {
                    $('#category_error').html(data.category_error);
                  } else {
                    $('#category_error').html('');
                  }
                  if (data.address_error != '') {
                    $('#address_error').html(data.address_error);
                  } else {
                    $('#address_error').html('');
                  }
                  if (data.employment_error != '') {
                    $('#employment_error').html(data.employment_error);
                  } else {
                    $('#employment_error').html('');
                  }
                  if (data.salarys_error != '') {
                    $('#salarys_error').html(data.salarys_error);
                  } else {
                    $('#salarys_error').html('');
                  }
                  if (data.school_error != '') {
                    $('#school_error').html(data.school_error);
                  } else {
                    $('#school_error').html('');
                  }
                  if (data.salary_error != '') {
                    $('#salary_error').html(data.salary_error);
                  } else {
                    $('#salary_error').html('');
                  }
                  if (data.branch_error != '') {
                    $('#branch_error').html(data.branch_error);
                  } else {
                    $('#branch_error').html('');
                  }
                  if (data.access_error != '') {
                    $('#access_error').html(data.access_error);
                  } else {
                    $('#access_error').html('');
                  }
                  if (data.skill_error != '') {
                    $('#skill_error').html(data.skill_error);
                  } else {
                    $('#skill_error').html('');
                  }
                  if (data.remarks_error != '') {
                    $('#remarks_error').html(data.remarks_error);
                  } else {
                    $('#remarks_error').html('');
                  }
                  Swal.fire({
                    icon: 'error',
                    title: '求人登録出来ませんでした。',
                    text: '入力内容をご確認下さい。',
                  }).then((result) => {
                    $("#register").prop('disabled', false);
                  });
                }
                if (data.success) {
                  Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: '求人登録しました。',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((result) => {
                    window.location.href = "/main/players";
                  });
                }
              }
            });
          } else {
            $('#register').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="delete_job"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に削除してもいいですか?',
          text: '削除求人：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ'
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'delete_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/delete_job",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '求人削除しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/main/players";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '求人削除出来ませんでした。',
              }).then((result) => {
                $('[name="delete_job"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="delete_job"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="return"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に再登録してもいいですか?',
          text: $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'return_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/job_return",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '求人再登録しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/dust/deletes";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '求人再登録出来ませんでした。',
              }).then((result) => {
                $('[name="return"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="return"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $('[name="real_delete"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '本当に求人データ削除してもいいですか?',
          text: $(this).data('name') + 'は再登録出来なくなります',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'delete_id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/dust/delete_real",
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
                window.location.href = "/main/delete";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '削除出来ませんでした。',
              }).then((result) => {
                $('[name="real_delete"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="real_delete"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
    $(function() {
      $("#chat").on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
        var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
        var postdata = {
          'myoffice_id': $('[name="myoffice_id"]').val(),
          'youworker_id': $('[name="youworker_id"]').val(),
          'office': $('[name="office"]').val(),
          'name': $('[name="name"]').val(),
          'mail': $('[name="mail"]').val(),
          'message': $('[name="message"]').val()
        };
        postdata[csrf_name] = csrf_hash;
        $.ajax({
          type: "POST",
          url: "/chat/chat_validation",
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
                window.location.href = "/chat/worker_list";
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
          text: 'トップページに戻ります。',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
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
                title: 'ログアウト出来ませんでした。',
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
          text: '求職者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'favorite': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/favorite/register_worker",
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
                window.location.href = "/favorite/office_favorite";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: 'お気に入り登録出来ませんでした。',
              }).then((result) => {
                $('[name="resister_favorite"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="resister_favorite"]').prop('disabled', false);
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
          text: '求職者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'favorite': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/favorite/release_worker",
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
                window.location.href = "/favorite/office_favorite";
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
    $(function() {
      $('[name="approval"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: 'マッチングしてもいいですか?',
          text: '求職者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
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
              url: "/partner/office_matching_approval",
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
                window.location.href = "/partner/office_matching";
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
          text: '求職者：' + $(this).data('name'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/partner/release_worker",
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
                window.location.href = "/partner/office_matching";
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
    $(function() {
      $('[name="advertising"]').on('click', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
        Swal.fire({
          title: '広告掲載に登録してもいいですか?',
          text: '広告掲載は有料です。',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'はい',
          cancelButtonText: 'いいえ',
        }).then((result) => {
          if (result.value) { //はい！の場合
            var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
            var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
            var postdata = {
              'id': $(this).data('id')
            };
            postdata[csrf_name] = csrf_hash;
            $.ajax({
              type: "POST",
              url: "/advertising/signup",
              data: postdata,
              crossDomain: false,
              dataType: "json",
              scriptCharset: 'utf-8'
            }).done(function(data) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '広告掲載に登録しました。',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location.href = "/office/mypage";
              });
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
              Swal.fire({
                icon: 'error',
                title: '広告掲載に登録出来ませんでした。',
              }).then((result) => {
                $('[name="advertising"]').prop('disabled', false);
              });
            });
          } else {
            $('[name="advertising"]').prop('disabled', false);
          }
        });
        return false;
      });
    });
  </script>
  <style>
  @media screen and (min-width: 576px) {
    .hello1{
      width:30%;
      }
  }

  .a_hover:hover{
  text-decoration: none;
  opacity: 0.5; filter: brightness(110%);
  }
  </style>
</head>
<?php $this->load->view('common/sidebar'); ?>