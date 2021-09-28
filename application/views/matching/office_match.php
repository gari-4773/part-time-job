<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-6">
          <h1 class="m-0 text-dark">マッチング一覧</h1>
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
                aria-controls="panel-menu01" aria-selected="true">申請中</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab-menu02" data-toggle="pill" href="#panel-menu02" role="tab"
                aria-controls="panel-menu02" aria-selected="false">未決済</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab-menu03" data-toggle="pill" href="#panel-menu03" role="tab"
                aria-controls="panel-menu03" aria-selected="false">成立中</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab-menu04" data-toggle="pill" href="#panel-menu04" role="tab"
                aria-controls="panel-menu04" aria-selected="false">拒否中</a>
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
                      <h3 class="card-title"><i class="fas fa-users"></i>【申請一覧】</h3>
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
                          <?php foreach ($matching_array as $hold) {
                    if ($hold['from_worker'] === "1" && $hold['partner_flag'] === "0") {
                      if ($hold['withdrawal'] === "0") { ?>
                          <tr>
                            <td><?= $hold['name'] ?></td>
                            <td><?= date("Y") - $hold['birth'] ?></td>
                            <td><?= $hold['school_year'] ?></td>
                            <td><?= $hold['sex'] ?></td>
                            <td><?= $hold['hope_work'] ?></td>
                            <td>
                              <button name="approval" data-id="<?= $hold['id'] ?>" data-name="<?= $hold['name'] ?>"
                                data-mail="<?= $hold['mail'] ?>" type="submit" class="btn-primary">マッチング承認 <i
                                  class="fas fa-envelope"></i></button>
                            </td>
                            <td>
                              <button onclick="location.href='/chat/board?id=<?= $hold['id'] ?>'" id="button2"
                                type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                            </td>
                            <td>
                              <button name="block" data-id="<?= $hold['id'] ?>" data-name="<?= $hold['name'] ?>"
                                type="submit" class="btn-danger">マッチング拒否 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                          </tr>
                          <?php  } ?>
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
                      <h3 class="card-title"><i class="fas fa-users"></i>【未決済一覧】</h3>
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
                          <?php foreach ($matching_array as $holds) {
                    if ($holds['withdrawal'] === "0" && $holds['partner_flag'] === "1") { ?>
                          <tr>
                            <td><?= $holds['nickname'] ?></td>
                            <td><?= date("Y") - $holds['birth'] ?></td>
                            <td><?= $holds['school_year'] ?></td>
                            <td><?= $holds['sex'] ?></td>
                            <td><?= $holds['hope_work'] ?></td>
                            <td>
                              <button onclick="location.href='/form/settlement?id=<?= $holds['id'] ?>'" id="button1"
                                type="submit" class="btn-primary">決済はこちら <i class="fas fa-cash-register"></i></button>
                            </td>
                            <td>
                              <button onclick="location.href='/chat/board?id=<?= $holds['id'] ?>'" id="button2"
                                type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                            </td>
                            <td>
                              <button name="block" data-id="<?= $holds['id'] ?>" data-name="<?= $holds['name'] ?>"
                                type="submit" class="btn-danger">マッチング拒否 <i class="fas fa-pencil-alt"></i></button>
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
            <div class="tab-pane fade" id="panel-menu03" role="tabpanel" aria-labelledby="tab-menu03">
              <div class="row">
                <div class="col-12">
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-users"></i>【マッチング一覧】</h3>
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
                          <?php foreach ($matching_array as $value) {
                    if ($value['withdrawal'] === "0" && $value['partner_flag'] === "2") { ?>
                          <tr>
                            <td><?= $value['nickname'] ?></td>
                            <td><?= date("Y") - $value['birth'] ?></td>
                            <td><?= $value['school_year'] ?></td>
                            <td><?= $value['sex'] ?></td>
                            <td><?= $value['hope_work'] ?></td>
                            <td>
                              <button onclick="location.href='/chat/board?id=<?= $value['id'] ?>'" id="button2"
                                type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button>
                            </td>
                            <td>
                              <button onclick="location.href='/match/worker_details?id=<?= $value['id'] ?>'"
                                id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button>
                            </td>
                            <td>
                              <button name="block" data-id="<?= $value['id'] ?>" data-name="<?= $value['name'] ?>"
                                type="submit" class="btn-danger">マッチング拒否 <i class="fas fa-envelope"></i></button>
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
            <div class="tab-pane fade" id="panel-menu04" role="tabpanel" aria-labelledby="tab-menu04">
              <div class="row">
                <div class="col-12">
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-users"></i>【ブロック一覧】</h3>
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
                          <?php foreach ($matching_array as $block) {
                    if ($block['withdrawal'] === "0" && $block['partner_flag'] === "3") { ?>
                          <tr>
                            <td><?= $block['nickname'] ?></td>
                            <td><?= date("Y") - $block['birth'] ?></td>
                            <td><?= $block['school_year'] ?></td>
                            <td><?= $block['sex'] ?></td>
                            <td><?= $block['hope_work'] ?></td>
                            <td>
                              <!-- <button onclick="location.href='/match/scout?id=<?= $block['id'] ?>'" type="submit" class="btn-primary">マッチング再開申請 <i class="fas fa-envelope"></i></button> -->
                            </td>
                            <td>
                              <!-- <button onclick="location.href='/chat/board?id=<?= $block['id'] ?>'" id="button2" type="submit" class="btn-info">チャットする <i class="fas fa-envelope"></i></button> -->
                            </td>
                            <td>
                              <!-- <button onclick="location.href='/match/worker_details?id=<?= $block['id'] ?>'" id="button3" type="submit" class="btn-success">詳細 <i class="fas fa-list"></i></button> -->
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
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->