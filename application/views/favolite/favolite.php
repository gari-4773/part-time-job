  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-6">
            <h1 class="m-0 text-dark">お気に入り一覧</h1>
            <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline card-outline-tabs">
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="tab-menu01" data-toggle="pill" href="#panel-menu01" role="tab"
                  aria-controls="panel-menu01" aria-selected="true">フォロー</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab-menu02" data-toggle="pill" href="#panel-menu02" role="tab"
                  aria-controls="panel-menu02" aria-selected="false">フォロワー</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
              <div class="tab-pane fade show active" id="panel-menu01" role="tabpanel" aria-labelledby="tab-menu01">
                <div class="row">
                  <div class="col-12">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users"></i>【お気に入りフォロー一覧】</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                              class="fas fa-minus"></i></button>
                        </div>
                      </div><!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                          <thead>
                            <th>ニックネーム</th>
                            <th>年齢</th>
                            <th>学年</th>
                            <th>性別</th>
                            <th>希望職種</th>
                            <th colspan="3">各種フォーム</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($follow_array as $value) {
                      if ($value['withdrawal'] === "0") { ?>
                            <tr>
                              <td><?= $value['nickname'] ?></td>
                              <td><?= date("Y") - $value['birth'] ?></td>
                              <td><?= $value['school_year'] ?></td>
                              <td><?= $value['sex'] ?></td>
                              <td><?= $value['hope_work'] ?></td>
                              <td>
                                <button onclick="location.href='/matching/scout?id=<?= $value['id'] ?>'" type="submit"
                                  class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                              </td>
                              <td>
                                <button onclick="location.href='/chat/board?id=<?= $value['id'] ?>'" id="button2"
                                  type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                              </td>
                              <td>
                                <button onclick="location.href='/matching/worker_details?id=<?= $value['id'] ?>'"
                                  id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
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
              </div>
              <div class="tab-pane fade" id="panel-menu02" role="tabpanel" aria-labelledby="tab-menu02">
                <div class="row">
                  <div class="col-12">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users"></i>【お気に入りフォロワー一覧】</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                              class="fas fa-minus"></i></button>
                        </div>
                      </div><!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                          <thead>
                            <th>ニックネーム</th>
                            <th>年齢</th>
                            <th>学年</th>
                            <th>性別</th>
                            <th>希望職種</th>
                            <th colspan="3">各種フォーム</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($follower_array as $values) {
                      if ($values['withdrawal'] === "0") { ?>
                            <tr>
                              <td><?= $values['nickname'] ?></td>
                              <td><?= date("Y") - $values['birth'] ?></td>
                              <td><?= $values['school_year'] ?></td>
                              <td><?= $values['sex'] ?></td>
                              <td><?= $values['hope_work'] ?></td>
                              <td>
                                <button onclick="location.href='/matching/scout?id=<?= $values['id'] ?>'" type="submit"
                                  class="btn-primary">マッチング申し込み <i class="fas fa-envelope"></i></button>
                              </td>
                              <td>
                                <button onclick="location.href='/chat/board?id=<?= $values['id'] ?>'" id="button2"
                                  type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                              </td>
                              <td>
                                <button onclick="location.href='/matching/worker_details?id=<?= $values['id'] ?>'"
                                  id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
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
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->