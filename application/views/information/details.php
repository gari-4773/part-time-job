
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  -->
    <!--    Document Title-->
    <!-- =============================================-->
    <title>【EIS】愛媛上陸!アルバイトマッチングシステム</title>
    <meta name="description" content="愛媛のアルバイト求人情報を一括管理。事業者様と労働者様とのマッチングや面接までのやり取りをサポートします。">
    <!--  -->
    <!--    Favicons-->
    <!--    =============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/images/favicons/eis1.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/images/favicons/eis32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/favicons/eis16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicons/eis1.ico">
    <link rel="manifest" href="<?= base_url() ?>assets/images/favicons/manifest.json">
    <link rel="mask-icon" href="<?= base_url() ?>assets/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/images/favicons/eis1.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">

    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">

    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!--  -->
    <!--    Stylesheets-->
    <!--    =============================================-->
    <!-- Default stylesheets-->
    <link href="<?= base_url() ?>assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="<?= base_url() ?>assets/lib/loaders.css/loaders.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/iconsmind/iconsmind.css" rel="stylesheet">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/hamburgers/dist/hamburgers.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/remodal/dist/remodal.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/remodal/dist/remodal-default-theme.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/lightbox2/dist/css/lightbox.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>

<div class="content-wrapper" style="margin-left:0px; background:white;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <h1 class="m-0 text-dark">お知らせ内容</h1> -->
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content">
          <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">
              <div class="col-lg-6 col-md-8 p-4" style="margin:0 auto">
                <h3 class="text-center">お知らせ詳細</h3>
                <?php
                    $trim = " ";
                    $insert_time = strstr($news_array[0]['insert_time'], $trim, true);
                ?>
                <!-- <p class="all-news">全体</p> -->
                <p style="color:black;"><span class="font-weight-bold">日時：</span><?= $insert_time;?></p>
                <h5><?= $news_array[0]['title'];?></h5>
                <div style="margin:0 auto;">
                  <p class="p-4 m-4 text-body" style="border:1px solid #A7A7A5"><?= $news_array[0]['message'];?></p>
                </div>
                <div class="text-center pt-4 pb-2">
                    <?php if($if === 1){ ?>
                        <button onclick=location.href="../main/players" class="btn btn-info col-8">トップページへ戻る</button>
                    <?php }elseif($if === 2){?>
                        <button onclick=location.href="../worker/workers" class="btn btn-info col-8">トップページへ戻る</button>
                    <?php } ?>
                </div>
                <!-- <button type="submit" id="contact" class="btn btn-info">送信</button> -->

              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section><!-- /.content -->
  <!-- Content Header (Page header) -->
  </div>



  <footer class="main-footer" style="margin:0;">
  <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io" class="admin_btns" style="color:#007bff;">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.0.3-pre
  </div>
</footer>
</body>
</html>