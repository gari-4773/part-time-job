  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <?= form_open("sort/worker_detail_sort");
        $sorts = $_SESSION;
        ?>
        <div class="row mb-2">
          <div class="col-6">
            <h1 class="m-0 text-dark">求職者一覧</h1>
            <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          </div><!-- /.col -->
          <div class="col-4">
            <select name="jobs" class="form-control" style="width: 100%;">
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("飲食・フード", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>飲食・フード</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("販売・接客・サービス", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>販売・接客・サービス</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("アパレル・ファッション関連", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>アパレル・ファッション関連</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("レジャー・アミューズメント", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>レジャー・アミューズメント</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("クリエイティブ・編集", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>クリエイティブ・編集</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("イベント・キャンペーン", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>イベント・キャンペーン</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("教育", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>教育</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("配送・引越・ドライバー", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>配送・引越・ドライバー</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("軽作業", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>軽作業</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("工場・倉庫・建築・土木", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>工場・倉庫・建築・土木</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("警備・清掃・ビル管理", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>警備・清掃・ビル管理</option>
              <option <?php if (!empty($sorts['jobs'])) {
                        if (in_array("その他", (array) $sorts['jobs'])) {
                          echo "selected";
                        }
                      } ?>>その他</option>
            </select>
          </div>
          <div class="col-2">
            <button id="sort" type="submit" class="btn-primary form-control">表示 </button>
          </div>
        </div><!-- /.row -->
        <?= form_close(); ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users"></i>【登録一覧表】</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                  <thead>
                    <th></th>
                    <th>ニックネーム</th>
                    <th>年齢</th>
                    <th>学年</th>
                    <th>性別</th>
                    <th>希望職種</th>
                    <th colspan="3">各種フォーム</th>
                    <th>最終ログイン</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($worker_array as $values) {
                      if ($values['withdrawal'] === "0") { ?>
                        <tr>
                          <td><img src="<?= base_url().'assets/images/resize_work/'.$values['img'];?>" style="width:60px; height:auto;"></td>
                          <td style="vertical-align: middle;"><?= $values['nickname'] ?></td>
                          <td style="vertical-align: middle;"><?= date("Y") - $values['birth'] . "歳" ?></td>
                          <td style="vertical-align: middle;"><?= $values['school_year'] ?></td>
                          <td style="vertical-align: middle;"><?= $values['sex'] ?></td>
                          <td style="vertical-align: middle;"><?= $values['hope_work'] ?></td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/matching/scout?id=<?= $values['id'] ?>'" type="submit" class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                          </td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/chat/board?id=<?= $values['id'] ?>'" id="button2" type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                          </td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/matching/worker_details?id=<?= $values['id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
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
                  <?php if (isset($worker_pagination)) {
                    echo $worker_pagination;
                  }
                  if (isset($sort_pagination)) {
                    echo $sort_pagination;
                  } ?>
                </div>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->