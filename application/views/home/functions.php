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
    <link rel="mask-icon" href="<?= base_url() ?>assets/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/images/favicons/eis1.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">

    <!-- <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">

    <!--  -->
    <!--    Stylesheets-->
    <!--    =============================================-->
    <!-- Default stylesheets-->
    <link href="<?= base_url() ?>assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="<?= base_url() ?>assets/lib/loaders.css/loaders.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/iconsmind/iconsmind.css" rel="stylesheet">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
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
    <script>
        window.onpageshow = function(){
        document.getElementById("myform").reset();
      };
    </script>
</head>

<body data-spy="scroll" data-target=".inner-link" data-offset="60">
    <main>
        <section style="padding:0;">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
                <img src="<?= base_url() ?>assets/images/eis2.png" alt="EIS">
                <a class="ml-2 mb-0 fs-1 d-inline color-white fw-700" href="<?= base_url() ?>main/index"></a>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav2" aria-controls="#navbarNav2" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger hamburger--emphatic">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </button>
            <div class="collapse navbar-collapse px-2" id="navbarNav2">
                <ul class="navbar-nav">
                    <li class="nav-item pt-lg-4 pt-2">
                        <a class="nav-link" href="#team" style="color:#2C819E;">掲載中</a>
                    </li>
                    <li class="nav-item pt-lg-4 pt-2">
                        <a class="nav-link" href="#news" style="color:#2C819E;">最新情報</a>
                    </li>
                    <li class="nav-item pt-lg-4 pt-2">
                        <a class="nav-link" href="#EAS" style="color:#2C819E;">EASで出来ること<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item pt-lg-4 pt-2">
                        <a class="nav-link" href="#question" style="color:#2C819E;">よくある質問</a>
                    </li>
                    <li class="nav-item pt-lg-4 pt-2">
                        <a class="nav-link" href="#form" style="color:#2C819E;">お問い合わせ</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                        <li class="nav-item pt-lg-4 pt-5">
                            <a class="nav-link" href="<?= base_url() ?>form/office_signup">事業者登録はこちら</a>
                        </li>
                    <li class="nav-item pt-lg-4 pt-2">
                        <a class="nav-link" href="<?= base_url() ?>form/work_signup">求職者登録はこちら</a>
                    </li>
                    <li class="nav-item pt-lg-4 pt-2">
                        <a class="nav-link" href="<?= base_url() ?>main/login">ログイン</a>
                    </li>
                </ul>
            </div>
            <!-- </div> -->
        </nav>
        </section>
        <div class="flexslider flexslider-simple h-full loading mb-md-8">
            <ul class="slides">
                <li>
                <!-- <li data-zanim-timeline="{}"> -->
                    <section class="py-0 mb-5">
                        <div>
                            <div class="background-holder elixir-zanimm-scale women">
                            </div>
                            <!--/.background-holder-->
                            <div class="container" style="background">
                                <p class="fs-4 fs-md-5 pt-6 text-center mb-0 text-top" style="color:#6F6F6F;">EAS</h1>
                                <p class="fs-1 text-center mb-6 text-top" style="font-weight:600;">愛媛のアルバイト求人サイト</p>
                                <div class="form py-6 mb-6" style="background-color:rgba(255,255,255,0.4);  border: 1px solid #A7A7A5;">
                                    <p class="fs-1 text-center text-dark" style="font-weight:600;">気になる求人を探してみよう</p>
                                        <?php
                                        $attributes = array('id' => 'myform');
                                        echo form_open("sort/top_sorts",$attributes); ?>
                                        <div class="input-group col-sm-8 mx-auto">
                                            <div class="input-group-append">
                                                <div class="input-group-text" style="background:white;">
                                                <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="search" style="background-color:white; border: 1px solid #B4AEB2;" class="form-control col-md-10 col-sm-12">
                                            <button class="btn btn-info col-md-2 col-sm-12 mt-2 mt-md-0">検索</button>
                                        </div>
                                        <div class="input-group col-sm-8 pt-4 pt-md-0 mx-auto" style="justify-content: space-between;">
                                            <div id="openModal1" class="col-md-3 col-sm-12 btn btn-white mt-md-6 mt-4" style="border: 1px solid #B4AEB2; padding: 0.8rem 1.5rem; cursor:pointer;">エリア</div>
                                            <div id="openModal2" class="col-md-3 col-sm-12 btn btn-white mt-md-6 mt-4" style="border: 1px solid #B4AEB2; padding: 0.8rem 1.5rem; cursor:pointer;">職種</div>
                                            <div id="openModal3" class="col-md-3 col-sm-12 btn btn-white mt-md-6 mt-4" style="border: 1px solid #B4AEB2; padding: 0.8rem 1.5rem; cursor:pointer;">こだわり</div>
                                        </div>
                                        <section id="modalArea1" class="modalArea">
                                            <div id="modalBg" class="modalBg" style="background-color:rbg(255,255,255,0.7);"></div>
                                                <div class="modalWrapper" style="border-radius:2%; padding: 20px 40px;">
                                                    <div class="modalContents">
                                                        <h3 class="text-center pb-2 mb-4 text-body" style="border-bottom:1px solid #d8d8d8;">エリアから探す</h3>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;" for="matsuyama"><input type="checkbox" class="form-check-input" name="area[]" value="松山市" id="matsuyama">松山市</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;" for="iyo"><input type="checkbox" class="form-check-input" name="area[]" value="伊予市" id="iyo">伊予市</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;" for="masaki"><input type="checkbox" class="form-check-input" name="area[]" value="松前町" id="masaki">松前町</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;" for="toon"><input type="checkbox" class="form-check-input" name="area[]" value="東温市" id="toon">東温市</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;" for="others"><input type="checkbox" class="form-check-input" name="area[]" value="その他" id="others">その他</label>
                                                            <div style="width:100%; text-align:center;"><input type="submit" class="btn mt-3 btnss" value="この求人で探す"></div>
                                                    </div>
                                                    <div id="closeModal" class="closeModal">
                                                    ×
                                                    </div>
                                            </div>
                                        </section>
                                        <section id="modalArea2" class="modalArea">
                                            <div id="modalBg1" class="modalBg" style="background-color:rbg(255,255,255,0.7); overflow-y:auto; max-height:90%;"></div>
                                                <div class="modalWrapper" style="border-radius:2%; padding: 20px 40px;">
                                                    <div class="modalContents">
                                                        <h3 class="text-center pb-2 mb-4 text-body" style="border-bottom:1px solid #d8d8d8;">職種から探す</h3>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="飲食・フード">飲食・フード</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="販売・接客・サービス">販売・接客・サービス</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="アパレル・ファッション関連">アパレル・ファッション関連</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="レジャー・アミューズメント">レジャー・アミューズメント</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="クリエイティブ・編集">クリエイティブ・編集</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="イベント・キャンペーン">イベント・キャンペーン</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="教育">教育</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="配送・引越し・ドライバー">配送・引越し・ドライバー</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="軽作業">軽作業</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="工場・倉庫・建築・土木">工場・倉庫・建築・土木</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="警備・清掃・ビル管理">警備・清掃・ビル管理</label>
                                                            <label class="labels lead" style="border-bottom: 1px solid #B4AEB2;"><input type="checkbox" name="jobs[]" value="その他">その他</label>
                                                            <div style="width:100%; text-align:center;"><input type="submit" class="btn mt-3 btnss" value="この求人で探す"></div>
                                                    </div>
                                                    <div id="closeModal1" class="closeModal">
                                                    ×
                                                    </div>
                                            </div>
                                        </section>
                                        <section id="modalArea3" class="modalArea">
                                            <div id="modalBg2" class="modalBg" style="background-color:rbg(255,255,255,0.7);"></div>
                                                <div class="modalWrapper" style="border-radius:2%; padding: 20px 40px; overflow-y:auto; max-height:90%;">
                                                    <div class="modalContents">
                                                        <h3 class="text-center pb-2 mb-4 text-body" style="border-bottom:1px solid #d8d8d8;">こだわりから探す</h3>
                                                        <div class="col-12">
                                                            <h4 class="mt-4">待遇</h4>
                                                            <div class="form-check form-check-inline ">
                                                                <input type="checkbox" class="form-check-input" name="treatment[]" value="交通費支給" id="transportation">
                                                                <label class="search" for="transportation">交通費支給</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="treatment[]" value="まかない" id="meal">
                                                                <label class="search" for="meal">まかない・食事補助あり</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="treatment[]" value="送迎" id="transfer">
                                                                <label class="search" for="transfer">送迎あり</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="treatment[]" value="昇給" id="salary-increase">
                                                                <label class="search" for="salary-increase">昇給あり</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="treatment[]" value="制服" id="uniform">
                                                                <label class="search" for="uniform">制服貸出</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="treatment[]" value="研修" id="training-system">
                                                                <label class="search" for="training-system">研修制度あり</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="treatment[]" value="社員" id="employee">
                                                                <label class="search" for="employee">社員登用あり</label>
                                                            </div>

                                                            <h4 class="pt-4" style="border-top: 1px solid #d8d8d8;">環境</h4>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="emvironment[]" value="駅チカ" id="station">
                                                                <label class="search" for="station">駅から5分以内</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="emvironment[]" value="車通勤" id="car">
                                                                <label class="search" for="car">車通勤可</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="emvironment[]" value="バイク" id="bike">
                                                                <label class="search" for="bike">バイク・自転車通勤可</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="emvironment[]" value="語学" id="language">
                                                                <label class="search" for="language">英語力・語学力が身に付く</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="emvironment[]" value="PC" id="pc">
                                                                <label class="search" for="pc">PCスキルが身に付く</label>
                                                            </div>

                                                            <h4  class="pt-4" style="border-top: 1px solid #d8d8d8;">～な人歓迎</h4>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="welcome[]" value="未経験" id="inexperienced">
                                                                <label class="search" for="inexperienced">未経験者歓迎</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="welcome[]" value="高校生" id="high-school">
                                                                <label class="search" for="high-school">高校生歓迎</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="welcome[]" value="大学生" id="college">
                                                                <label class="search" for="college">大学生歓迎</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="welcome[]" value="フリーター" id="freeter">
                                                                <label class="search" for="freeter">フリーター歓迎</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="welcome[]" value="副業" id="side-business">
                                                                <label class="search" for="side-business">副業・Wワーク歓迎</label>
                                                            </div>

                                                            <h4 class="pt-4" style="border-top: 1px solid #d8d8d8;">自分らしい格好</h4>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="form[]" value="髪型" id="hairstyle">
                                                                <label class="search" for="hairstyle">髪型・髪色自由</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="form[]" value="服装" id="clothes">
                                                                <label class="search" for="clothes">服装自由</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="form[]" value="髭" id="beard">
                                                                <label class="search" for="beard">髭・ネイル・ピアスOK</label>
                                                            </div>
                                                        </div>
                                                            <div style="width:100%; text-align:center;"><input type="submit" class="btn mt-3 btnss" value="この求人で探す"></div>
                                                    </div>
                                                    <div id="closeModal2" class="closeModal">
                                                    ×
                                                    </div>
                                            </div>
                                        </section>
                                        <!-- <input type="text" > -->
                                    <?= form_close();?>
                                </div>
                                <div class="announce">
                                    <div class="mx-auto d-lg-flex d-none" style="justify-content: space-between;">
                                        <div class="sizes" style="background-color:rgba(255,255,255,0.4); border: 1px solid #A7A7A5;"><p class="pt-5 pb-5 px-2 fs-1 mb-0 text-center text-dark" style="font-weight:600;">「希望条件で働きたい」が叶う</p></div>
                                        <div class="sizes" style="background-color:rgba(255,255,255,0.4); border: 1px solid #A7A7A5;"><p class="pt-4 pb-2 px-2 fs-1 text-center text-dark" style="font-weight:600;">アルバイトマッチングシステム<br>アルバイトを探す事業者✖️仕事がしたい</p></div>
                                        <div class="sizes" style="background-color:rgba(255,255,255,0.4); border: 1px solid #A7A7A5;"><p class="pt-5 pb-5 px-2 fs-1 mb-0 text-center text-dark" style="font-weight:600;">チャット機能で日程決めラクラク</p></div>
                                    </div>
                                </div>

                            </div>
                            <!--/.row-->
                        </div>
                        <!--/.container-->
                    </section>
                </li>
            </ul>
        </div>

        <!-- <h2 class="fs-2">掲載中</h3> -->
        <section id="team" class="text-center mt-md-0 mt-6 mb-4 mb-sm-6 pt-2">

        <h3>登録求人数：<?= $jobs_sum;?>件</h3>
            <h2 class="fs-2 text-secondary text-center">掲載中<br><span class="letter">wanted</span></h2>
            <div class="container">
                <div class="row justify-content-between">
                    <?php
                        $count = 0;
                        shuffle($office_array);
                        foreach ($office_array as $value) {
                        if ($value['withdrawal'] === "0") {
                            if ($count < 3) { ?>
                            <div class="col-lg-4 p-4 mt-3">
                                <img class="mb-4 radius-tr-secondary radius-tl-secondary" src="<?= base_url() ?>/assets/images/resize_office/<?= $value['img'] ?>" alt="Profile Picture" />
                                <div class="overflow-hidden">
                                    <h5>事業所：<?= $value['office'] ?></h5>
                                </div>
                                <div class="overflow-hidden">
                                    <h6 class="fw-400 color-7">担当：<?= $value['name'] ?></h6>
                                </div>
                                    <p class="py-3 mb-1 font-weight-bold text-top">求人名 :
                                        <?= $value['jobname'] ?></p>
                                    <p class="py-3 mb-1 font-weight-bold text-top">職種 :
                                        <?= $value['job'] ?></p>
                                    <p class="py-3 mb-1 font-weight-bold text-top">仕事内容 :
                                        <?= $value['work'] ?></p>
                                    <p class="py-3 mb-1  font-weight-bold text-top"><?= $value['salarys']; ?> :
                                        <?= $value['money'] ?>円</p>
                                    <p class="py-3 mb-1  font-weight-bold text-top">労働時間 :
                                        <?= $value['time'] ?>時間</p>
                                    <p class="py-3 mb-1  font-weight-bold text-top">シフト :
                                    週<?= $value['shift'] ?>日以上</p>
                            </div>
                            <?php $count++ ;?>
                        <?php  } ?>
                        <?php  } ?>
                    <?php  } ?>
                </div>
            </div>
            <!--/.container-->
        </section>
        <section id="news" class="text-center mb-4 mb-sm-8 pt-0">
            <h2 class="fs-2 text-secondary text-center">最新情報<br><span class="letter">new</span></h2>
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="row">
                    <div class="col-8 col-offset-1" style="margin:0 auto">
                        <ul class="text-left" style="border-top: 1px solid #c9c9c9; padding:0;">
                                <?php foreach ($news_array as $notice) {
                                    if ($notice['delete_message'] === "0") { ?>
                                        <?php
                                            $trim = " ";
                                            $insert_time = strstr($notice['insert_time'], $trim, true);
                                        ?>
                                        <li class="hello" style="list-style:none; border-bottom: 1px solid #c9c9c9; padding:0;">
                                            <a href="/news/newsdetail?id=<?= $notice['id'] ?>" class="a_hover d-block d-sm-flex align-items-center" style="position:relative; display: -webkit-flex;">
                                                <p class="text-dark pt-3 font-weight-normal hello1"><?= $insert_time ?></p>
                                                <p class="font-weight-bold pt-sm-3 text-body"><?= $notice['title'] ?></p>
                                            </a>
                                        </li>
                                    <?php  } ?>
                                <?php  } ?>
                        </ul>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

        <section id="EAS" class="text-center mb-4 mb-sm-8 coffee">
        <h2 class="fs-2 text-secondary text-center">EASで出来ること</h2>
            <div class="container py-md-7">
                <div class="section">
                    <h3 class="color-100">1 .マッチングによる求人検索が簡単</h3>
                    <p class="colors-100">労働日数・希望時間・給与・職種ごとに検索出来るので、ご希望の仕事をすぐに見つけることが可能です。</p>
                    <h3 class="color-100">2 . 愛媛県内の求人情報を一括管理</h3>
                    <p class="colors-100">求人情報を詳細なところまでしっかり抽出し管理しています。随時更新も行っておりますので、最新情報をご確認いただけます。</p>
                    <h3 class="color-100">3 . 面接前の事前確認や相談も可能</h3>
                    <p class="colors-100">チャット機能により、事業者様と連絡を取り合うことが出来ます。事前に確認事項を把握できるので、安心して面接に臨むことが可能です。</p>
                </div>
            </div>
        </section>

        <section id="question" class="background-white  text-center mb-sm-2" style="position: relative; padding-top:0px;">
            <h2 class="fs-2 text-secondary text-center" style="padding-bottom:0px;">よくある質問<br><span class="letter">Q&A</span></h2>
            <div class="section">
                <div class="oneArea px-md-6">
                        <table class="table tableresponsive" style="border:2px solid #2A819D">
                            <tr>
                                <td class="question" style="background-color:#DFF0F6; border-bottom:2px solid #2A819D;">
                                    <p class="fs-1 fs-md-3 font-weight-bold" styles="color:#777777">Q.マッチング検索はどういう流れで行われますか？</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="question">
                                    <p class="fs-1 fs-md-3" styles="color:#777777">求人一覧から選んで面接を申し込む形になります。<br>また絞り込み検索やチャットによる連絡も可能ですので、ぜひご活用下さい。</p>
                                </td>
                            </tr>
                        </table>
                        <table class="table tableresponsive" style="border:2px solid #2A819D">
                            <tr>
                                <td class="question" style="background-color:#DFF0F6; border-bottom:2px solid #2A819D;">
                                    <p class="fs-1 fs-md-3 font-weight-bold" styles="color:#777777">Q.求人情報を外部に非公開にできますか？</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="question">
                                    <p class="fs-1 fs-md-3" styles="color:#777777">可能です。公開・非公開設定を選択できます。非公開設定にするとトップ画面には掲載しませんので安心してご利用頂けます。</p>
                                </td>
                            </tr>
                        </table>
                        <table class="table tableresponsive" style="border:2px solid #2A819D">
                            <tr>
                                <td class="question" style="background-color:#DFF0F6; border-bottom:2px solid #2A819D;">
                                    <p class="fs-1 fs-md-3 font-weight-bold" styles="color:#777777">Q.求人情報は充実してますか？</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="question">
                                    <p class="fs-1 fs-md-3" styles="color:#777777">はい。愛媛県内の最新の求人情報に随時更新しております。また、登録は無料となっておりますので、数多くの事業者様に支持されております。</p>
                                </td>
                            </tr>
                        </table>
                        <table class="table tableresponsive" style="border:2px solid #2A819D">
                            <tr>
                                <td class="question" style="background-color:#DFF0F6; border-bottom:2px solid #2A819D;">
                                    <p class="fs-1 fs-md-3 font-weight-bold" styles="color:#777777">Q.スマホからでも操作可能ですか？</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="question">
                                    <p class="fs-1 fs-md-3" styles="color:#777777">はい。PC・スマホどちらにも対応しており操作可能です。</p>
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </section>

        <section id="form" class="background-11 py-5 mb-8" style="border-top:1px solid #f3f0f0; border-bottom:1px solid #f3f0f0;">
        <h2 class="fs-2 text-secondary text-center">お問い合わせ<br><span class="letter">contact</span></h2>
            <div class="container">
                <div class="text-center">
                    <div class="row mb-5">
                        <div class="col-3">
                            <p class="text-secondary font-weight-bold">お名前<span class="text-danger">(必須)</span></p>
                        </div>
                        <div class="col-9">
                            <div class="error">
                                <strong><span id="name_error" class="text-danger"></span></strong>
                            </div>
                            <div class="form-group">
                                <input type="text" id="name" class="form-control bg-white" placeholder="氏名">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-3">
                            <p class="text-secondary font-weight-bold">メールアドレス<span class="text-danger">(必須)</span></p>
                        </div>
                        <div class="col-9">
                            <div class="error">
                                <strong><span id="mail_error" class="text-danger"></span></strong>
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" class="form-control bg-white" placeholder="メールアドレス">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-3">
                            <p class="text-secondary font-weight-bold">お問い合わせ内容<span class="text-danger">(必須)</span></p>
                        </div>
                        <div class="col-9">
                            <div class="error">
                                <strong><span id="message_error" class="text-danger"></span></strong>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control bg-white" rows="4" placeholder="お問い合わせ内容"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="contact" class="btn btn-info">送信</button>
                </div>
            </div>
        </section>
        <div id="page_top"><a href="#"></a></div>
    </main>
    <!--  -->
    <!--    JavaScripts-->
    <!--    =============================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/gsap/src/minified/TweenMax.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>

    <script src="<?= base_url() ?>assets/lib/CustomEase.min.js"></script>
    <script src="<?= base_url() ?>assets/js/config.js"></script>
    <script src="<?= base_url() ?>assets/js/zanimation.js"></script>
    <script src="<?= base_url() ?>assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/remodal/dist/remodal.js"></script>
    <script src="<?= base_url() ?>assets/lib/lightbox2/dist/js/lightbox.js"></script>
    <script src="<?= base_url() ?>assets/lib/flexslider/jquery.flexslider-min.js"></script>
    <script src="<?= base_url() ?>assets/js/core.js"></script>
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.4.2/gsap.min.js"></script> -->
    <script>
        var mySwiper = new Swiper('.swiper-container', {
            autoplay: {
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
                reverseDirection: false
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
            }
        });
        $(function() {
            $("#contact").on('click', function(event) {
                event.preventDefault();
                $(this).prop('disabled', true);
                var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
                var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得
                var postdata = {
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'message': $('#message').val()
                };
                postdata[csrf_name] = csrf_hash;
                $.ajax({
                    type: "POST",
                    url: "/support/contact",
                    data: postdata,
                    crossDomain: false,
                    dataType: "json",
                    scriptCharset: 'utf-8',
                    success: function(data) {
                        if (data.error) {
                            if (data.name_error != '') {
                                $('#name_error').html(data.name_error);
                            } else {
                                $('#name_error').html('');
                            }
                            if (data.mail_error != '') {
                                $('#mail_error').html(data.mail_error);
                            } else {
                                $('#mail_error').html('');
                            }
                            if (data.message_error != '') {
                                $('#message_error').html(data.message_error);
                            } else {
                                $('#message_error').html('');
                            }
                            Swal.fire({
                                icon: 'error',
                                title: '問い合わせ出来ませんでした。',
                                text: '入力内容をご確認下さい。',
                            }).then((result) => {
                                $("#contact").prop('disabled', false);
                            });
                        }
                        if (data.success) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: '問い合わせありがとうございます。',
                                text: '返信までしばらくお待ち下さい。',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                window.location.href = "/main/index";
                            });
                        }
                    }
                });
                return false;
            });
        });
        $(function () {
            $('#openModal1').click(function(){
                $('#modalArea1').fadeIn();
                $('body').css('overflow-y', 'hidden')
            });
            $('#closeModal , #modalBg').click(function(){
                $('#modalArea1').fadeOut();
                $('body').css('overflow-y','auto');
            });
        });
        $(function () {
            $('#openModal2').click(function(){
                $('#modalArea2').fadeIn();
                $('body').css('overflow-y', 'hidden')
            });
            $('#closeModal1 , #modalBg1').click(function(){
                $('#modalArea2').fadeOut();
                $('body').css('overflow-y','auto');
            });
        });
        $(function () {
            $('#openModal3').click(function(){
                $('#modalArea3').fadeIn();
                $('body').css('overflow-y', 'hidden')
            });
            $('#closeModal2 , #modalBg2').click(function(){
                $('#modalArea3').fadeOut();
                $('body').css('overflow-y','auto');
            });
        });
    </script>
</body>

</html>