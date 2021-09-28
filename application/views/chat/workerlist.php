  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">チャット</h1>
        <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
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
                <h3 class="card-title"><i class="fas fa-users"></i>【メッセージ 一覧】</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                  <thead>
                    <th></th>
                    <th>ニックネーム</th>
                    <th>学年</th>
                    <th>メッセージ</th>
                    <th colspan="3">各種フォーム</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($worker_array as $values) {
                      if ($values['withdrawal'] === "0") { ?>
                        <tr>
                          <td><img src="<?= base_url().'assets/images/resize_work/'.$values['img'];?>" style="width:60px; height:auto;"></td>
                          <td style="vertical-align: middle;"><?= $values['nickname'] ?></td>
                          <!-- <td style="vertical-align: middle;"><?= date("Y") - $values['birth'] ?></td> -->
                          <td style="vertical-align: middle;"><?= $values['school_year'] ?></td>
                          <!-- <td style="vertical-align: middle;"><?= $values['sex'] ?></td> -->
                          <td style="vertical-align: middle;"><?= $values['message'] ?></td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/matching/scout?id=<?= $values['id'] ?>'" type="submit" class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                          </td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/chat/board?id=<?= $values['id'] ?>'" id="button2" type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                          </td>
                          <td style="vertical-align: middle;">
                            <button onclick="location.href='/matching/worker_details?id=<?= $values['id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
                          </td>
                          <!-- <td>
                            <button name="resister_favorite" data-id="<?= $values['id'] ?>" data-name="<?= $values['name'] ?>" type="submit" class="btn-danger">お気に入り登録 <i class="fas fa-heart"></i></button>
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