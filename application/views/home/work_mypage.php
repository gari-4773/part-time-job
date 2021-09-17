<?php $this->load->view('common/work_header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-6">
          <h1 class="m-0 text-dark">マイページ</h1>
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-user"></i>【<?= $_SESSION['name'] ?>　プロフィール】</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <p><strong>氏名：</strong><?= $worker_array['name'] ?></p>
                <p><strong>ニックネーム：</strong><?= $worker_array['nickname'] ?></p>
                <p><strong>電話番号：</strong><?= $worker_array['tel'] ?></p>
                <p><strong>メールアドレス：</strong><?= $worker_array['mail'] ?></p>
                <p><strong>年齢：</strong><?= date("Y") - $worker_array['birth'] ?>歳</p>
                <p><strong>性別：</strong><?= $worker_array['sex'] ?></p>
                <p><strong>学年：</strong><?= $worker_array['school_year'] ?></p>
                <p><strong>住所：</strong><?= $worker_array['address'] ?></p>
                <p><strong>最終学歴：</strong><?= $worker_array['schools'] ?></p>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <p><strong>希望職種：</strong><?= $worker_array['hope_work'] ?></p>
                <p><strong>資格：</strong><?= $worker_array['skill'] ?></p>
                <p><strong>画像：</strong></p><img class="mb-4 radius-tr-secondary radius-tl-secondary d-block mx-auto" src="<?= base_url() ?>/assets/images/resize_work/<?= $worker_array['img'] ?>" alt="Profile Picture" />
              </div><!-- /.form-group -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <button type="submit" onclick="location.href='/form/work_profile?id=<?= $_SESSION['id'] ?>'" class="btn btn-success btn-block mt-2">プロフィール編集　<i class="fas fa-pencil-alt"></i></button>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <button type="submit" onclick="location.href='/upload/worker_update?id=<?= $_SESSION['id'] ?>'" class="btn btn-primary btn-block mt-2">画像変更　<i class="fas fa-file-image"></i></button>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <button type="submit" onclick="location.href='/mail/work_mail?id=<?= $_SESSION['id'] ?>'" class="btn btn-info btn-block mt-2">メールアドレス変更　<i class="fas fa-envelope"></i></button>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.card-footer -->
      </div><!-- /.card -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('common/footer'); ?>