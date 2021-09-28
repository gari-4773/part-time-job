  <?php $this->load->view('common/header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <h1 class="m-0 text-dark">チャット</h1>
          </div><!-- /.col -->
          <a href="<?= base_url() ?>chat/worker_list" class="nav-link pt-4 pl-1"><i class="fas fa-chevron-left"></i> チャット一覧</a>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="card card-info direct-chat direct-chat-primary">
          <div class="card-header">
            <input type="hidden" id="token" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>" />
            <h3 class="card-title">【<i class="fas fa-user"></i> <?= $you_array['nickname'] ?>】</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" id="chat_message">
              <?php $array_reverse = array_reverse($chats_array);
                  foreach ($array_reverse as $value) {
                if ($value['delete_chat'] === "0") { ?>
                  <!-- Message. Default to the left -->
                  <?php if ($value['myoffice_id'] === $my_array['id'] && $value['youworker_id'] === $you_array['id']) { ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">
                          <?php if(isset($my_array['nickname'])){
                              echo $my_array['nickname'];
                            }else{
                              echo $my_array['office'];
                            } ?>
                        </span>
                        <span class="direct-chat-timestamp float-right"><?= $value['insert_time'] ?></span>
                      </div><!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?= base_url() ?>assets/images/<?= $my_array['img'] ?>" alt="team1"> <!-- /.direct-chat-img -->
                      <div class="direct-chat-text float-left">
                        <?= $value['message'] ?>
                      </div><!-- /.direct-chat-text -->
                    </div><!-- /.direct-chat-msg -->
                  <?php  } ?>
                  <?php if ($value['myworker_id'] === $you_array['id'] && $value['youoffice_id'] === $my_array['id']) { ?>
                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">
                          <?php if(isset($you_array['nickname'])){
                              echo $you_array['nickname'];
                            }else{
                              echo $you_array['office'];
                            } ?>
                        </span>
                        <span class="direct-chat-timestamp float-left"><?= $value['insert_time'] ?></span>
                      </div><!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?= base_url() ?>assets/images/resize_work/<?= $you_array['img'] ?>" alt="team2"> <!-- /.direct-chat-img -->
                      <div class="direct-chat-text float-right">
                        <?= $value['message'] ?>
                      </div><!-- /.direct-chat-text -->
                    </div>
                  <?php  } ?>
                  <!-- /.direct-chat-msg -->
                <?php  } ?>
              <?php  } ?>
            </div>
            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
              <ul class="contacts-list">
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="/docs/3.0/assets/img/user1-128x128.jpg">
                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Count Dracula
                        <small class="contacts-list-date float-right">2/28/2015</small>
                      </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                    </div><!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="/docs/3.0/assets/img/user7-128x128.jpg">
                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Sarah Doe
                        <small class="contacts-list-date float-right">2/23/2015</small>
                      </span>
                      <span class="contacts-list-msg">I will be waiting for...</span>
                    </div><!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="/docs/3.0/assets/img/user3-128x128.jpg">
                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Nadia Jolie
                        <small class="contacts-list-date float-right">2/20/2015</small>
                      </span>
                      <span class="contacts-list-msg">I'll call you back at...</span>
                    </div><!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="/docs/3.0/assets/img/user5-128x128.jpg">
                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Nora S. Vans
                        <small class="contacts-list-date float-right">2/10/2015</small>
                      </span>
                      <span class="contacts-list-msg">Where is your new...</span>
                    </div><!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="/docs/3.0/assets/img/user6-128x128.jpg">
                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        John K.
                        <small class="contacts-list-date float-right">1/27/2015</small>
                      </span>
                      <span class="contacts-list-msg">Can I take a look at...</span>
                    </div><!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="/docs/3.0/assets/img/user8-128x128.jpg">
                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Kenneth M.
                        <small class="contacts-list-date float-right">1/4/2015</small>
                      </span>
                      <span class="contacts-list-msg">Never mind I found...</span>
                    </div><!-- /.contacts-list-info -->
                  </a>
                </li><!-- /End Contact Item -->
              </ul><!-- /.contacts-list -->
            </div><!-- /.direct-chat-pane -->
          </div><!-- /.card-body -->
          <div class="card-footer">
            <div class="error">
              <strong><span id="message_error" class="text-danger"></span></strong>
            </div>
            <div class="input-group">
              <input type="hidden" class="form-control" name="myoffice_id" value="<?= $my_array['id'] ?>">
              <input type="hidden" class="form-control" name="youworker_id" value="<?= $you_array['id'] ?>">
              <input type="hidden" class="form-control" name="office" value="<?= $my_array['office'] ?>">
              <input type="hidden" class="form-control" name="name" value="<?= $my_array['name'] ?>">
              <input type="hidden" class="form-control" name="mail" value="<?= $you_array['mail'] ?>">
              <input type="text" name="message" placeholder="メッセージを入力して下さい。" class="form-control">
              <span class="input-group-append">
                <button id="chat" type="submit" class="btn btn-primary btn-block" style="width: 100px;">送信</button>
              </span>
            </div>
          </div><!-- /.card-footer-->
          <!--/.direct-chat -->
        </div><!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php $this->load->view('common/footer'); ?>