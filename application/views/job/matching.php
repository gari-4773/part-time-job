  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <?= form_open("sort/job_sort"); ?>
        <div class="row mb-2">
          <div class="col-6">
            <h1 class="m-0 text-dark">求人一覧</h1>
            <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          </div>
          <div class="col-4">
            <select name="jobs" class="form-control" style="width: 100%;">
              <option disabled selected value>全て</option>
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
          <div class="col-2">
            <button id="sort" type="submit" class="btn-primary form-control">表示 </button>
          </div>
        </div><!-- /.row -->
        <?= form_close(); ?>
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <!-- Main content -->
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
                      <th>事業所名</th>
                      <th>仕事内容</th>
                      <th>シフト</th>
                      <th>時間帯</th>
                      <th>時給</th>
                      <th>勤務地</th>
                      <th colspan="3">申し込み</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($job_array as $values) {
                      if ($values['withdrawal'] == "0") { ?>
                        <tr>
                          <td><?= $values['office'] ?></td>
                          <td><?= $values['work'] ?></td>
                          <td><?= $values['shift'] ?></td>
                          <td><?= $values['time'] ?></td>
                          <td><?= $values['money'] ?></td>
                          <td><?= $values['address'] ?></td>
                          <td>
                            <button onclick="location.href='/matching/interview?id=<?= $values['job_id'] ?>'" id="button1" type="submit" class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                          </td>
                          <td>
                            <button onclick="location.href='/chat/work_board?id=<?= $values['id'] ?>'" id="button2" type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                          </td>
                          <td>
                            <button onclick="location.href='/matching/job_details?id=<?= $values['job_id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
                          </td>
                        </tr>
                      <?php  } ?>
                    <?php  } ?>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->