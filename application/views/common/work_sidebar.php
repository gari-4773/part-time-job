<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Navbar -->
  <nav class="main-header sticky-top navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url() ?>main/login" class="nav-link text-primary">ホーム<i class="fas fa-home"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-block">
        <p class="nav-link">ようこそ<span class="text-primary"><?= $_SESSION['name'] ?></span>さん</p>
      </li>
      <li class="nav-item">
        <a id="logout" href="<?= base_url() ?>main/logout" class="nav-link text-danger">ログアウト<i
            class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <!-- Brand Logo -->
        <div class="form-inline">
          <img src="<?= base_url() ?>assets/images/eis1.png" alt="EIS">
          <div class="d-block d-lg-none">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </div>
        </div>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-header"></li>
          <li class="nav-header">works</li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>main/job_search" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>求人検索</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>favorite/worker_favorite" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>お気に入り</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>chat/office_list" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>チャット</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>partner/worker_matching" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>マッチング</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
          <li class="nav-header">admin</li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>worker/workers" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>求職管理</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>worker/mypage" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>マイページ</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
          <li class="nav-header">information</li>
          <li class="nav-item">
            <a href="<?= base_url() ?>worker/supports" class="nav-link">
              <i class="nav-icon far fa-circle text-success"></i>
              <p>お問い合わせ</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>worker/notices" class="nav-link">
              <i class="nav-icon far fa-circle text-success"></i>
              <p>お知らせ一覧</p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
        </ul>
      </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
  </aside>
  </div>