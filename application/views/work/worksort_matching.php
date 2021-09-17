  <?php $this->load->view('common/header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <?= form_open("sort/hopejob_sort"); ?>
        <div class="row mb-2">
          <div class="col-6">
            <h1 class="m-0 text-dark">求職者一覧</h1>
            <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          </div><!-- /.col -->
          <div class="col-4">
            <select name="jobs" class="form-control" style="width: 100%;">
              <?php if (!empty($job_array[0]['hope_work'])) { ?>
                <option><?= $job_array[0]['hope_work'] ?></option>
              <?php } else { ?>
                <option></option>
              <?php } ?>
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
                    <th>氏名</th>
                    <th>年齢</th>
                    <th>学年</th>
                    <th>性別</th>
                    <th>希望職種</th>
                    <th colspan="3">各種フォーム</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($job_array as $values) {
                      if ($values['withdrawal'] === "0") { ?>
                        <tr>
                          <td><?= $values['name'] ?></td>
                          <td><?= date("Y") - $values['birth'] ?></td>
                          <td><?= $values['school_year'] ?></td>
                          <td><?= $values['sex'] ?></td>
                          <td><?= $values['hope_work'] ?></td>
                          <td>
                            <button onclick="location.href='/matching/scout?id=<?= $values['id'] ?>'" type="submit" class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                          </td>
                          <td>
                            <button onclick="location.href='/chat/board?id=<?= $values['id'] ?>'" id="button2" type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                          </td>
                          <td>
                            <button onclick="location.href='/matching/worker_details?id=<?= $values['id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
                          </td>
                          <!-- <td>
                            <button name="delete_job" data-id="<?= $values['id'] ?>" data-name="<?= $values['name'] ?>" type="submit" class="btn-danger">お気に入り <i class="fas fa-heart"></i></button>
                          </td> -->
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
  <?php $this->load->view('common/footer'); ?>