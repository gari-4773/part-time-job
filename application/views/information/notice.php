  <?php $this->load->view('common/header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background:white;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <h1 class="m-0 text-dark">お知らせ内容</h1> -->
          <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <!-- Main content -->

    <section id="news" class="text-center mb-4 mb-sm-8 pt-0">
            <h2 class="fs-2 text-center mb-4">【お知らせ一覧】</h2>
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
                                            <a href="/news/newsdetails?id=<?= $notice['id'] ?>" class="a_hover d-block d-sm-flex align-items-center" style="position:relative; display: -webkit-flex;">
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
  </div><!-- /.content-wrapper -->
  <?php $this->load->view('common/footer'); ?>