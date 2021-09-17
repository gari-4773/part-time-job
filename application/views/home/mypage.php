<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <h1 class="m-0 text-dark">マイページ</h1>
      <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-users"></i>【<?= $_SESSION['office'] ?>　プロフィール】</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <p><strong>事業所名：</strong><?= $office_array['office'] ?></p>
                <p><strong>担当者名：</strong><?= $office_array['name'] ?></p>
                <p><strong>電話番号：</strong><?= $office_array['tel'] ?></p>
                <p><strong>メールアドレス：</strong><?= $office_array['mail'] ?></p>
                <p><strong>職種：</strong><?= $office_array['job'] ?></p>
                <?php if($office_array['advertising'] === "0"){?>
                  <p><strong>広告申請：</strong>未申請</p>
                <?php }elseif($office_array['advertising'] === "1") { ?>
                  <p><strong>広告申請：</strong>申請中</p>

                <?php }elseif($office_array['advertising'] === "3") {?>
                  <p><strong>広告掲載期限：</strong><?= $office_array['published_time'] ?></p>
                <?php } elseif ($office_array['advertising'] === "2") {?>
                <p><strong>広告申請：</strong>支払い待ち</p>
                <?= form_open('advertising/settlement');
                $config = parse_ini_file('config.ini', true);
                ?>
                  <!-- 本番用 stripe 公開可能キー -->
                  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button btn-block mt-2"
                  data-key= "<?= $config['stripe']['public_key'];?>"
                  data-amount="20000"
                  data-name="マッチングする"
                  data-description="広告表示のための決済"
                  data-locale="auto"
                  data-allow-remember-me="false"
                  data-panelLabel="決済する"
                  data-label="決済する"
                  data-currency="jpy">
                  </script>
                  <!-- </form> -->
                  <?= form_close();
                  }
                  ?>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <img class="mb-4 radius-tr-secondary radius-tl-secondary d-block mx-auto" src="<?= base_url() ?>/assets/images/resize_office/<?= $office_array['img'] ?>" alt="Profile Picture" />
              </div><!-- /.form-group -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
            <?php if ($office_array['advertising'] === "0") { ?>
              <div class="col-md-6">
                <div class="form-group">
                  <button name="advertising" data-id="<?= $_SESSION['id'] ?>" type="submit" class="btn btn-primary btn-block mt-2">広告登録　<i class="fas fa-flag"></i></button>
                </div><!-- /.form-group -->
              </div><!-- /.col -->
              <?php } ?>
            <div class="col-md-6">
              <div class="form-group">
                <button type="submit" onclick="location.href='/form/profile?id=<?= $_SESSION['id'] ?>'" class="btn btn-success btn-block mt-2">プロフィール編集　<i class="fas fa-pencil-alt"></i></button>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <button type="submit" onclick="location.href='/upload/office_update?id=<?= $_SESSION['id'] ?>'" class="btn btn-info btn-block mt-2">画像変更　<i class="fas fa-file-image"></i></button>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <button type="submit" onclick="location.href='/mail/update_mail?id=<?= $_SESSION['id'] ?>'" class="btn btn-info btn-block mt-2">メールアドレス変更　<i class="fas fa-envelope"></i></button>
              </div><!-- /.form-group -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.card-footer -->
      </div><!-- /.card -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->