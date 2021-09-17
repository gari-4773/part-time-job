<?php $this->load->view('common/top_header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="header">

<div class="content-wrapper" style="margin-left:0px;">
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">検索結果一覧</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>/.input-group-append
                  </div>/.input-group input-group-sm -->
                </div><!-- /.card-tools -->
              </div><!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>事業所名</th>
                      <th>仕事内容</th>
                      <th>シフト</th>
                      <th>時間帯</th>
                      <th>時給</th>
                      <th>勤務地</th>
                      <th>詳細</th>
                      <th>最終ログイン</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($job_array as $values) {
                      if ($values['withdrawal'] == "0") { ?>
                        <tr>
                          <td><img src="<?= base_url().'assets/images/resize_office/'.$values['img'];?>" style="width:60px; height:auto;"></td>
                          <td style="vertical-align: middle;"><?= $values['office'] ?></td>
                          <td style="vertical-align: middle;"><?= $values['work'] ?></td>
                          <td style="vertical-align: middle;"><?= "週" . $values['shift'] . "日以上" ?></td>
                          <td style="vertical-align: middle;"><?= $values['time'] . "時間以上" ?></td>
                          <td style="vertical-align: middle;"><?= $values['salarys'] . $values['money'] . "円"  ?></td>
                          <td style="vertical-align: middle;"><?= $values['address'] ?></td>
                          <!-- <td>
                            <button onclick="location.href='/matching/interview?id=<?= $values['office_id'] ?>'" id="button1" type="submit" class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                          </td>
                          <td>
                            <button onclick="location.href='/chat/work_board?id=<?= $values['office_id'] ?>'" id="button2" type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                          </td> -->
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/matching/top_details?id=<?= $values['job_id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
                            <!-- <button onclick="location.href='/matching/job_details?id=<?= $values['job_id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button> -->
                          </td>
                          <?php $day = date("Y-m-d H:i:s");
                              $login = strtotime($day) - strtotime($values['login_time']);
                              if ($login < 3600) { ?>
                            <td style="vertical-align: middle;"><?= floor($login / 60) ?>分前</td>
                          <?php } elseif ($login < 86400) { ?>
                            <td style="vertical-align: middle;"><?= floor($login / 3600) ?>時間前</td>
                          <?php  } elseif ($login < 2592000) { ?>
                            <td style="vertical-align: middle;"><?= floor($login / 86400) ?>日前</td>
                          <?php  } else { ?>
                            <td style="vertical-align: middle;">1ヶ月以上前</td>
                          <?php  } ?>
                        </tr>
                      <?php  } ?>
                    <?php  } ?>
                  </tbody>
                </table>
                <div id="pagination">
                  <?php if (isset($sort_pagination)) {
                    echo $sort_pagination;
                  } ?>
                  <?php if (isset($jobs_pagination)) {
                    echo $jobs_pagination;
                  } ?>
                </div>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <?= form_open("sort/top_detail_sort"); ?>
      <div class="accordion" id="collapse-accordion">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">【求人検索】</h3>
            <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#collapse-accordion-1" aria-expanded="true" aria-controls="collapse-accordion-1"><i class="fas fa-minus"></i></button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" aria-expanded="false"><i class="fas fa-minus"></i></button> -->
            </div>
          </div>
          <div id="collapse-accordion-1" class="collapse"aria-labelledby="headingOne" data-parent="#collapse-accordion">
          <div class="card-body">
            <div class="form-group">
              <h4>業種</h4>
              <select name="jobs" class="form-control col-12">
                <option selected>全て</option>
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
            </div>
            <h4 class="mt-4">エリア</h4>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="area[]" value="松山市" id="matsuyama">
              <label class="form-check-label" for="matsuyama">松山</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="area[]" value="伊予市" id="iyo">
              <label class="form-check-label" for="iyo">伊予</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="area[]" value="松前町" id="masaki">
              <label class="form-check-label" for="masaki">松前</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="area[]" value="東温市" id="toon">
              <label class="form-check-label" for="toon">東温</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="area[]" value="その他" id="others">
              <label class="form-check-label" for="tobe">その他</label>
            </div>
            <h4 class="mt-4">給与</h4>
            <div class="form-group col-12">
              <select class="form-control mb-1" name="salary" id="salary">
                <option disabled selected>給与区分を選択してください</option>
                <option>時給</option>
                <option>日給</option>
                <option>月給</option>
              </select>
              <select class="form-control" name="salarys" id="salarys">
                <option disable selected></option>
              </select>
            </div>
            <h4 class="mt-4">雇用形態</h4>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="employment" value="長期バイト" id="long-part">
              <label class="form-check-label" for="long-part">長期バイト</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="employment" value="短期バイト" id="short-part">
              <label class="form-check-label" for="short-part">短期バイト</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="employment" value="インターン" id="intern">
              <label class="form-check-label" for="intern">インターン</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" name="employment" value="ボランティア" id="volunteer">
              <label class="form-check-label" for="volunteer">ボランティア</label>
            </div>
            <h4 class="mt-4">シフト</h4>
            <div class="form-group mb-4">
              <select class="form-control col-12" name="shift" id="shift">
                <option disabled selected>日数を選択してください</option>
                <option value="1">週1からOK</option>
                <option value="2">週2からOK</option>
                <option value="3">週3からOK</option>
                <option value="4">週4からOK</option>
                <option value="5">週5以上OK</option>
              </select>
            </div>
            <h4 class="mt-4">勤務時間</h4>
            <div class="form-group mb-4">
              <select class="form-control col-12" name="time" id="time">
                <option disabled selected>勤務時間を選択してください</option>
                <?php for ($i = 1; $i <= 8; $i++) {
                  echo '<option value="' . $i . '">' . $i . '時間以上' . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-12">
              <h4 class="mt-4">待遇</h4>
              <div class="form-check form-check-inline ">
                <input type="checkbox" class="form-check-input" name="treatment[]" value="交通費支給" id="transportation">
                <label class="form-check-label" for="transportation">交通費支給</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="treatment[]" value="まかない" id="meal">
                <label class="form-check-label" for="meal">まかない・食事補助あり</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="treatment[]" value="送迎" id="transfer">
                <label class="form-check-label" for="transfer">送迎あり</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="treatment[]" value="昇給" id="salary-increase">
                <label class="form-check-label" for="salary-increase">昇給あり</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="treatment[]" value="制服" id="uniform">
                <label class="form-check-label" for="uniform">制服貸出</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="treatment[]" value="研修" id="training-system">
                <label class="form-check-label" for="training-system">研修制度あり</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="treatment[]" value="社員" id="employee">
                <label class="form-check-label" for="employee">社員登用あり</label>
              </div>

              <h4 class="mt-4">環境</h4>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="emvironment[]" value="駅チカ" id="station">
                <label class="form-check-label" for="station">駅から5分以内</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="emvironment[]" value="車通勤" id="car">
                <label class="form-check-label" for="car">車通勤可</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="emvironment[]" value="バイク" id="bike">
                <label class="form-check-label" for="bike">バイク・自転車通勤可</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="emvironment[]" value="語学" id="language">
                <label class="form-check-label" for="language">英語力・語学力が身に付く</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="emvironment[]" value="PC" id="pc">
                <label class="form-check-label" for="pc">PCスキルが身に付く</label>
              </div>

              <h4 class="mt-4">～な人歓迎</h4>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="welcome[]" value="未経験" id="inexperienced">
                <label class="form-check-label" for="inexperienced">未経験者歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="welcome[]" value="高校生" id="high-school">
                <label class="form-check-label" for="high-school">高校生歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="welcome[]" value="大学生" id="college">
                <label class="form-check-label" for="college">大学生歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="welcome[]" value="フリーター" id="freeter">
                <label class="form-check-label" for="freeter">フリーター歓迎</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="welcome[]" value="副業" id="side-business">
                <label class="form-check-label" for="side-business">副業・Wワーク歓迎</label>
              </div>

              <h4 class="mt-4">自分らしい格好</h4>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="form[]" value="髪型" id="hairstyle">
                <label class="form-check-label" for="hairstyle">髪型・髪色自由</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="form[]" value="服装" id="clothes">
                <label class="form-check-label" for="clothes">服装自由</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="form[]" value="髭" id="beard">
                <label class="form-check-label" for="beard">髭・ネイル・ピアスOK</label>
              </div>
              <div class="col-12 mt-5">
                <button id="search" type="submit" class="btn-primary form-control">検索する </button>
              </div>
            </div>
          </div>
          </div>
          </div>
        </div>
      <?= form_close(); ?>
    </div>

  </div><!-- /.content-wrapper -->
  <?php $this->load->view('common/top_footer'); ?>