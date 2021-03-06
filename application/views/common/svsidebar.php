<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header sticky-top navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url() ?>manager/teams" class="nav-link text-primary">ホーム<i class="fas fa-home"></i></a>
        <li class="nav-item d-none d-sm-inline-block">
          <a id="logout" href="<?= base_url() ?>main/logout" class="nav-link text-danger">ログアウト<i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <div class="form-inline">
        <img src="<?= base_url() ?>assets/images/eis1.png" alt="EIS">
        <div class="d-block d-lg-none">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </div>
      </div>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
            <li class="nav-header">management</li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url() ?>manager/administrator" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>登録者一覧</p>
                <i class="right fas fa-angle-right"></i>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url() ?>dust/stop_teams" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>利用停止一覧</p>
                <i class="right fas fa-angle-right"></i>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url() ?>manager/match_list" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>マッチング一覧</p>
                <i class="right fas fa-angle-right"></i>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url() ?>advertising/entry" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>広告登録一覧</p>
                <i class="right fas fa-angle-right"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url() ?>manager/contacts" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>問い合わせ一覧</p>
                <i class="right fas fa-angle-right"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url() ?>news/notice" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>ユーザーお知らせ</p>
                <i class="right fas fa-angle-right"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url() ?>news/newstopix" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>お知らせ一覧</p>
                <i class="right fas fa-angle-right"></i>
              </a>
            </li>
          </ul>
        </nav><!-- /.sidebar-menu -->
      </div><!-- /.sidebar -->
    </aside>