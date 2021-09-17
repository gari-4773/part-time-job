<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>求人情報変更</title>
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
        var treatment1=[];
        $("[name='treatment[]']:checked").each(function(){
          treatment1.push(this.value);
        });
        var emvironment1=[];
        $("[name='emvironment[]']:checked").each(function(){
          emvironment1.push(this.value);
        });
        var welcome1=[];
        $("[name='welcome[]']:checked").each(function(){
          welcome1.push(this.value);
        });
        var form1=[];
        $("[name='form[]']:checked").each(function(){
          form1.push(this.value);
        });
        var treatment=treatment1.join();
        var emvironment=emvironment1.join();
        var welcome=welcome1.join();
        var form=form1.join();
        var postdata = {
          'treatment': treatment,
          'emvironment': emvironment,
          'welcome': welcome,
          'form': form,
          'job_id': $('[name="id"]').val(),
          'work': $('[name="work"]').val(),
          'time': $('[name="time"]').val(),
          'money': $('[name="money"]').val(),
          'branch': $('[name="branch"]').val(),
          'access': $('[name="access"]').val(),
          'skill': $('[name="skill"]').val(),
          'remarks': $('[name="remarks"]').val(),
          'shift': $('[name="shift"]').val(),
          'address': $('[name="address"]').val(),
          'employment': $('[name="employment"]').val(),
          'school': $('[name="school"]').val(),
          'category': $('[name="category"]').val(),
          'salary': $('[name="salary"]').val(),
          'salarys': $('[name="salarys"]').val()
        };
        postdata[csrf_name] = csrf_hash;
        $.ajax({
          type: "POST",
          url: "/change/update_ams",
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
                title: '更新出来ませんでした。',
                text: '入力内容をご確認下さい。',
              }).then((result) => {
                $("#update").prop('disabled', false);
              });
            }
            if (data.success) {
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '更新しました。',
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

<body class="hold-transition register-page sidebar-collapse h-auto">
  <div class="col-md-8 col-sm-10">
    <div class="register-logo">
      <h1>求人情報変更</h1>
    </div>
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">入力してください</p>
        <div class="input-group mb-3">
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          <input type="hidden" class="form-control" name="id" value="<?= $row_array['job_id'] ?>">
        </div>
        <div class="error">
          <strong><span id="work_error" class="text-danger"></span></strong>
        </div>
        <label>仕事内容(必須)</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="work" placeholder="例)居酒屋ホール業務" value="<?= $row_array['work'] ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="error">
          <strong><span id="money_error" class="text-danger"></span></strong>
        </div>
        <label>単価(必須/金額のみ)</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="money" placeholder="例)1000" value="<?= $row_array['money'] ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-yen-sign"></span>
            </div>
          </div>
        </div>
        <div class="error">
          <strong><span id="branch_error" class="text-danger"></span></strong>
        </div>
        <label>支店名</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="branch" placeholder="例)松山支店" value="<?= $row_array['branch'] ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="error">
          <strong><span id="access_error" class="text-danger"></span></strong>
        </div>
        <label>アクセス</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="access" placeholder="例)大街道から徒歩2分" value="<?= $row_array['access'] ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-car"></span>
            </div>
          </div>
        </div>
        <div class="error">
          <strong><span id="skill_error" class="text-danger"></span></strong>
        </div>
        <label>資格</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="skill" placeholder="例)日商簿記2級" value="<?= $row_array['skill'] ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-book"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="error">
            <strong><span id="shift_error" class="text-danger"></span></strong>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="shift">シフト(必須)</label>
              <select name="shift" class="form-control" style="width: 100%;">
                <option value="<?=$row_array['shift']?>">週<?= $row_array['shift'] ?>日以上</option>
                <?php for ($i = 1; $i < 8; $i++) { ?>
                  <option value="<?= $i?>">週<?= $i; ?>日以上</option>
                <?php } ?>
              </select>
            </div><!-- /.form-group -->
          </div>
          <div class="error">
            <strong><span id="time_error" class="text-danger"></span></strong>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="time">労働時間(必須)</label>
              <select name="time" class="form-control" style="width: 100%;">
                <option value="<?= $row_array['time'] ?>"><?= $row_array['time'] ?>時間以上</option>
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                  <option value="<?= $i?>"><?= $i; ?>時間以上</option>
                <?php } ?>
              </select>
            </div><!-- /.form-group -->
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="category">業種</label>
              <select name="category" class="form-control" style="width: 100%;">
                <option><?= $row_array['category'] ?></option>
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
          <div class="col-6">
            <div class="form-group">
              <label for="address">勤務地</label>
              <select name="address" class="form-control" style="width: 100%;">
                <option><?= $row_array['address'] ?></option>
                <option>松山市</option>
                <option>伊予市</option>
                <option>松前町</option>
                <option>東温市</option>
                <option>その他</option>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="employment">雇用形態</label>
              <select name="employment" class="form-control" style="width: 100%;">
                <option><?= $row_array['employment'] ?></option>
                <option>長期バイト</option>
                <option>短期バイト</option>
                <option>インターン</option>
                <option>ボランティア</option>
              </select>
            </div><!-- /.form-group -->
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="salarys">給与区分</label>
                <select name="salarys" class="form-control" style="width: 100%;">
                  <option><?= $row_array['salarys'] ?></option>
                  <option>時給</option>
                  <option>日給</option>
                  <option>月給</option>
                </select>
            </div><!-- /.form-group -->
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="school">学歴</label>
              <select name="school" class="form-control" style="width: 100%;">
                <option><?= $row_array['school'] ?></option>
                <option>高校卒</option>
                <option>大学卒見込み</option>
                <option>大学卒</option>
                <option>大学院卒見込み</option>
                <option>大学院卒</option>
              </select>
            </div><!-- /.form-group -->
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="salary">給与支払</label>
              <select name="salary" class="form-control" style="width: 100%;">
                <option><?= $row_array['salary'] ?></option>
                <?php for ($i = 1; $i < 32; $i++) { ?>
                  <option><?= $i; ?>日</option>
                <?php } ?>
              </select>
            </div><!-- /.form-group -->
          </div>
          <div class="col-12">
              <h5 class="mt-4 text-dark font-weight-bold">待遇</h5>
              <div class="form-check form-check-inline ">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="交通費支給" id="transportation"
                   <?php if(preg_grep("/交通費支給/",$treatment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="transportation">交通費支給</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="まかない・食事補助あり" id="meal"
                  <?php if(preg_grep("/まかない・食事補助あり/",$treatment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="meal">まかない・食事補助あり</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="送迎あり" id="transfer"
                  <?php if(preg_grep("/送迎あり/",$treatment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="transfer">送迎あり</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="昇給あり" id="salary-increase"
                  <?php if(preg_grep("/昇給あり/",$treatment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="salary-increase">昇給あり</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="制服貸出" id="uniform"
                  <?php if(preg_grep("/制服貸出/",$treatment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="uniform">制服貸出</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="研修制度あり" id="training-system"
                  <?php if(preg_grep("/研修制度あり/",$treatment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="training-system">研修制度あり</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="社員登用あり" id="employee"
                  <?php if(preg_grep("/社員登用あり/",$treatment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="employee">社員登用あり</label>
              </div>

              <h5 class="mt-4 text-dark font-weight-bold">環境</h5>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="駅から5分以内" id="station"
                  <?php if(preg_grep("/駅から5分以内/",$emvironment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="station">駅から5分以内</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="車通勤可" id="car"
                  <?php if(preg_grep("/車通勤可/",$emvironment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="car">車通勤可</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="バイク・自転車通勤可" id="bike"
                  <?php if(preg_grep("/バイク・自転車通勤可/",$emvironment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="bike">バイク・自転車通勤可</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="英語力・語学力が身に付く" id="language"
                  <?php if(preg_grep("/英語力・語学力が身に付く/",$emvironment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="language">英語力・語学力が身に付く</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="PCスキルが身に付く" id="pc"
                  <?php if(preg_grep("/PCスキルが身に付く/",$emvironment)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="pc">PCスキルが身に付く</label>
              </div>

              <h5 class="mt-4 text-dark font-weight-bold">～な人歓迎</h5>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="未経験者歓迎" id="inexperienced"
                  <?php if(preg_grep("/未経験者歓迎/",$welcome)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="inexperienced">未経験者歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="高校生歓迎" id="high-school"
                  <?php if(preg_grep("/高校生歓迎/",$welcome)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="high-school">高校生歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="大学生歓迎" id="college"
                  <?php if(preg_grep("/大学生歓迎/",$welcome)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="college">大学生歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="フリーター歓迎" id="freeter"
                  <?php if(preg_grep("/フリーター歓迎/",$welcome)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="freeter">フリーター歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="副業・Wワーク歓迎" id="side-business"
                  <?php if(preg_grep("/副業・Wワーク歓迎/",$welcome)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="side-business">副業・Wワーク歓迎</label>
              </div>

              <h5 class="mt-4 text-dark font-weight-bold">自分らしい格好</h5>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="form[]" value="髪型・髪色自由" id="hairstyle"
                  <?php if(preg_grep("/髪型・髪色自由/",$form)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="hairstyle">髪型・髪色自由</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="form[]" value="服装自由" id="clothes"
                  <?php if(preg_grep("/服装自由/",$form)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="clothes">服装自由</label>
              </div>
              <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="form[]" value="髭・ネイル・ピアスOK" id="beard"
                  <?php if(preg_grep("/髭・ネイル・ピアスOK/",$form)==true){?> checked <?php }?>>
                  <label class="form-check-label" for="beard">髭・ネイル・ピアスOK</label>
              </div>
              <div class="error">
                  <strong><span id="remarks_error" class="text-danger"></span></strong>
              </div>
              <div class="form-group mb-3 mt-3">
                <textarea name="remarks" id="remarks" cols="40" rows="5" class="col-12" placeholder="※その他(例：交通費支給・福利厚生有り、など)"><?= $row_array['remarks'] ?></textarea>
              </div>
            </div>
        <div class="container">
          <div class="row">
            <button id="update" type="submit" class="btn btn-primary btn-block">変更</button>
          </div>
          <br>
          <p><?= anchor('main/players', '一覧に戻る　>>'); ?></p>
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