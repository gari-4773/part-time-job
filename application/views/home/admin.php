<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-12">
          <h1 class="m-0 text-dark">求人管理</h1>
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
                aria-controls="panel-menu01" aria-selected="true">表示</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab-menu02" data-toggle="pill" href="#panel-menu02" role="tab"
                aria-controls="panel-menu02" aria-selected="false">非表示</a>
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
                      <h3 class="card-title"><i class="fas fa-users"></i>【登録求人一覧】</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                      </div>
                    </div><!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                      <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                        <thead>
                          <th>求人名</th>
                          <th>仕事内容</th>
                          <th>時間</th>
                          <th>給与</th>
                          <th>シフト</th>
                          <th>勤務地</th>
                          <th>雇用形態</th>
                          <th colspan="2">更新</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($job_array as $values) {
                    if ($values['delete_job'] === "0") { ?>
                          <tr>
                            <td><?= $values['jobname'] ?></td>
                            <td><?= $values['work'] ?></td>
                            <td><?= $values['time'] . "時間以上" ?></td>
                            <td><?= $values['salarys'] . $values['money'] . "円" ?></td>
                            <td><?= "週" . $values['shift'] . "日以上" ?></td>
                            <td><?= $values['address'] ?></td>
                            <td><?= $values['employment'] ?></td>
                            <td>
                              <button onclick="location.href='/form/update_job?id=<?= $values['job_id'] ?>'"
                                type="submit" class="btn-success">編集 <i class="fas fa-pencil-alt"></i></button>
                            </td>
                            <td>
                              <button name="delete_job" data-id="<?= $values['job_id'] ?>"
                                data-name="<?= $values['work'] ?>" type="submit" class="btn-danger">削除 <i
                                  class="far fa-trash-alt"></i></button>
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
                        <h3 class="card-title"><i class="fas fa-users"></i>【非表示求人】</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                              class="fas fa-minus"></i></button>
                        </div>
                      </div><!-- /.card-header -->
                      <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-bordered table-striped table-head-fixed text-nowrap">
                          <thead>
                            <th>時間</th>
                            <th>時給</th>
                            <th>シフト</th>
                            <th>雇用形態</th>
                            <th>指導方法</th>
                            <th colspan="2">更新</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($job_array as $values) {
                    if ($values['delete_job'] === "1") { ?>
                            <tr>
                              <td><?= $values['time'] . "時間以上" ?></td>
                              <td><?= $values['money'] . "円以上" ?></td>
                              <td><?= "週" . $values['shift'] . "日以上" ?></td>
                              <td><?= $values['employment'] ?></td>
                              <td><?= $values['schooling'] ?></td>
                              <td>
                                <button name="return" data-id="<?= $values['job_id'] ?>" type="submit"
                                  class="btn-primary">再登録 <i class="fas fa-pencil-alt"></i></button>
                              </td>
                              <td>
                                <button name="real_delete" data-id="<?= $values['job_id'] ?>" type="submit"
                                  class="btn-danger">データ削除 <i class="far fa-trash-alt"></i></button>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-save"></i>【新規求人登録】</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                  class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="error">
                  <strong><span id="time_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="time" class="col-3 col-form-label">労働時間<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="time" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
                      <?php for ($i = 1; $i <= 10; $i++) { ?>
                      <option value="<?= $i ?>"><?= $i; ?>時間以上</option>
                      <?php } ?>
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="error">
                  <strong><span id="shift_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="shift" class="col-3 col-form-label">シフト<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="shift" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
                      <?php for ($i = 1; $i < 8; $i++) { ?>
                      <option value="<?= $i ?>">週<?= $i; ?>日以上</option>
                      <?php } ?>
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="error">
                  <strong><span id="category_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="category" class="col-3 col-form-label">業種<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="category" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
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
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="error">
                  <strong><span id="address_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="address" class="col-3 col-form-label">勤務地<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="address" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
                      <option>松山市</option>
                      <option>伊予市</option>
                      <option>松前町</option>
                      <option>東温市</option>
                      <option>砥部町</option>
                      <option>北条</option>
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="error">
                  <strong><span id="employment_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="employment" class="col-3 col-form-label">雇用形態<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="employment" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
                      <option>アルバイト</option>
                      <option>派遣社員</option>
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="error">
                  <strong><span id="school_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="school" class="col-3 col-form-label">学歴<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="school" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
                      <option>学歴不問</option>
                      <option>高校卒</option>
                      <option>大学卒見込み</option>
                      <option>大学卒</option>
                      <option>大学院卒見込み</option>
                      <option>大学院卒</option>
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="error">
                  <strong><span id="salary_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="salary" class="col-3 col-form-label">給与日<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="salary" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
                      <?php for ($i = 1; $i < 32; $i++) { ?>
                      <option><?= $i; ?>日</option>
                      <?php } ?>
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="error">
                  <strong><span id="salarys_error" class="text-danger"></span></strong>
                </div>
                <div class="form-group row">
                  <label for="salarys" class="col-3 col-form-label">給与区分<span class="text-danger">*</span>：</label>
                  <div class="col-9">
                    <select name="salarys" class="form-control" style="width: 100%;">
                      <option disabled selected value>▼選択して下さい</option>
                      <option>時給</option>
                      <option>日給</option>
                      <option>月給</option>
                    </select>
                  </div>
                </div>
              </div><!-- /.col -->
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="error">
                    <strong><span id="money_error" class="text-danger"></span></strong>
                  </div>
                  <div class="input-group mb-3">
                  <label class="col-3 col-form-label">単価(金額のみ)<span class="text-danger">*</span>：</label>
                    <input type="text" class="form-control col-9" name="money" placeholder="※ 例)900" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-yen-sign"></span>
                      </div>
                    </div>
                  </div>
                  <div class="error">
                    <strong><span id="jobname_error" class="text-danger"></span></strong>
                  </div>
                  <div class="input-group mb-3">
                  <label class="col-3 col-form-label">求人名<span class="text-danger">*</span>：</label>
                    <input type="text" class="form-control col-9" name="jobname" placeholder="※ 例)ホールスタッフ 嬉しい「まかない」付き♪" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-briefcase"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group">
                    <input type="hidden" class="form-control" name="office_id" value="<?= $_SESSION['id'] ?>">
                  </div>
                  <div class="error">
                    <strong><span id="work_error" class="text-danger"></span></strong>
                  </div>
                  <div class="input-group mb-3">
                    <label class="col-3 col-form-label">仕事内容<span class="text-danger">*</span>：</label>
                    <input type="text" class="form-control col-9" name="work" placeholder="※ 例)ホールスタッフ業務" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <div class="error">
                    <strong><span id="branch_error" class="text-danger"></span></strong>
                  </div>
                  <div class="input-group mb-3">
                  <label class="col-3 col-form-label">支店名：</label>
                    <input type="text" class="form-control col-9" name="branch" placeholder="※支店名" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <div class="error">
                    <strong><span id="access_error" class="text-danger"></span></strong>
                  </div>
                  <div class="input-group mb-3">
                  <label class="col-3 col-form-label">アクセス：</label>
                    <input type="text" class="form-control col-9" name="access" placeholder="※アクセス" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-car"></span>
                      </div>
                    </div>
                  </div>
                  <div class="error">
                    <strong><span id="skill_error" class="text-danger"></span></strong>
                  </div>
                  <div class="input-group mb-3">
                  <label class="col-3 col-form-label">資格：</label>
                    <input type="text" class="form-control col-9" name="skill" placeholder="※資格" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-book"></span>
                      </div>
                    </div>
                  </div>
                </div><!-- /.form-group -->
              </div><!-- /.col -->
              <div class="col-12">
                <h4 class="mt-4">待遇</h4>
                <div class="form-check form-check-inline ">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="交通費支給" id="transportation">
                  <label class="form-check-label" for="transportation">交通費支給</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="まかない・食事補助あり" id="meal">
                  <label class="form-check-label" for="meal">まかない・食事補助あり</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="送迎あり" id="transfer">
                  <label class="form-check-label" for="transfer">送迎あり</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="昇給あり" id="salary-increase">
                  <label class="form-check-label" for="salary-increase">昇給あり</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="制服貸出" id="uniform">
                  <label class="form-check-label" for="uniform">制服貸出</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="研修制度あり"
                    id="training-system">
                  <label class="form-check-label" for="training-system">研修制度あり</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="treatment[]" value="社員登用あり" id="employee">
                  <label class="form-check-label" for="employee">社員登用あり</label>
                </div>
                <h4 class="mt-4">環境</h4>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="駅から5分以内" id="station">
                  <label class="form-check-label" for="station">駅から5分以内</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="車通勤可" id="car">
                  <label class="form-check-label" for="car">車通勤可</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="バイク・自転車通勤可" id="bike">
                  <label class="form-check-label" for="bike">バイク・自転車通勤可</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="英語力・語学力が身に付く"
                    id="language">
                  <label class="form-check-label" for="language">英語力・語学力が身に付く</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="emvironment[]" value="PCスキルが身に付く" id="pc">
                  <label class="form-check-label" for="pc">PCスキルが身に付く</label>
                </div>
                <h4 class="mt-4">～な人歓迎</h4>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="未経験者歓迎" id="inexperienced">
                  <label class="form-check-label" for="inexperienced">未経験者歓迎</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="高校生歓迎" id="high-school">
                  <label class="form-check-label" for="high-school">高校生歓迎</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="大学生歓迎" id="college">
                  <label class="form-check-label" for="college">大学生歓迎</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="フリーター歓迎" id="freeter">
                  <label class="form-check-label" for="freeter">フリーター歓迎</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="welcome[]" value="副業・Wワーク歓迎" id="side-business">
                  <label class="form-check-label" for="side-business">副業・Wワーク歓迎</label>
                </div>
                <h4 class="mt-4">自分らしい格好</h4>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="form[]" value="髪型・髪色自由" id="hairstyle">
                  <label class="form-check-label" for="hairstyle">髪型・髪色自由</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="form[]" value="服装自由" id="clothes">
                  <label class="form-check-label" for="clothes">服装自由</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="form[]" value="髭・ネイル・ピアスOK" id="beard">
                  <label class="form-check-label" for="beard">髭・ネイル・ピアスOK</label>
                </div>
                <div class="error mt-3">
                  <strong><span id="remarks_error" class="text-danger"></span></strong>
                </div>
                <div class="input-group mb-3 mt-3">
                  <input type="text" class="form-control" name="remarks" placeholder="※その他備考(例：福利厚生有りなど)" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.card-body -->
          <div class="card-footer">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <button id="register" type="submit" class="btn btn-primary w-50 mt-2">登録　<i
                      class="fas fa-pencil-alt"></i></button>
                </div><!-- /.form-group -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.card-footer -->
        </div><!-- /.card -->
      </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->