<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Chat extends CI_Controller
{
  //事業者チャット
  public function board()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $opponent = $this->input->get('id');
    $this->load->model("model_offices");
    $chat['my_array'] = $this->model_offices->getoffice($id);
    $this->load->model("model_workers");
    $chat['you_array'] = $this->model_workers->get_worker($opponent);
    $this->load->model("model_chats");
    $chat['chats_array'] = $this->model_chats->getchats($id, $opponent);
    $clean_chat = html_escape($chat);
    $clean_chat['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('chat/chat', $clean_chat);
  }
  //求職者チャット
  public function work_board()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $id = $this->input->get('id');
    $opponent = $_SESSION['id'];
    $this->load->model("model_offices");
    $chat['you_array'] = $this->model_offices->getoffice($id);
    $this->load->model("model_workers");
    $chat['my_array'] = $this->model_workers->get_worker($opponent);
    $this->load->model("model_chats");
    $chat['chats_array'] = $this->model_chats->getchats($id, $opponent);
    $clean_chat = html_escape($chat);
    $clean_chat['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('chat/work_chat', $clean_chat);
  }
  //事業者チャット送信処理
  public function chat_validation()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "message",
        "label" => "チャット内容",
        "rules" => 'trim|required',
        "errors" => ["required" => "メッセージは入力必須です。"]
      ]
    ];
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run()) {
      $to = $_POST['mail'];
      $subject = "チャットのお知らせ";
      $body = $_POST['office'] . "の" . $_POST['name'] . "様からチャットがありました。\n";
      $body .= "<'" . base_url() . "index.php/worker/login/'>\nこちらからログインして、返信してください。\n\n";
      $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
      $this->load->library('mailclass');
      $this->mailclass->php_mailer($to, NULL, $subject, $body);
      $day = date("Y-m-d H:i:s");
      $this->load->model("model_chats");
      if ($this->model_chats->add_chats($day)) {
        $array = ['success' => true];
      } else {
        echo "選手登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'message_error' => form_error('message')
      ];
    }
    exit(json_encode($array));
  }
  //求職者チャット送信処理
  public function workchat_validation()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "message",
        "label" => "チャット内容",
        "rules" => 'trim|required',
        "errors" => ["required" => "メッセージは入力必須です。"]
      ]
    ];
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run()) {
      $to = $_POST['mail'];
      $subject = "チャットのお知らせ";
      $body = $_POST['name'] . "様からチャットがありました。\n";
      $body .= "<'" . base_url() . "index.php/main/login/'>\nこちらからログインして、返信してください。\n\n";
      $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
      $this->load->library('mailclass');
      $this->mailclass->php_mailer($to, NULL, $subject, $body);
      $day = date("Y-m-d H:i:s");
      $this->load->model("model_chats");
      if ($this->model_chats->add_workchats($day)) {
        //$this->output->set_status_header(200);
        $array = ['success' => true];
      } else {
        echo "選手登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'message_error' => form_error('message')
      ];
    }
    exit(json_encode($array));
  }
  //事業者チャット相手一覧
  public function worker_list()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_chats");
    $max_ids['max_id'] = $this->model_chats->getworker_maxid($id);
    $max_id1['max_id'] = $this->model_chats->getworkers_maxid($id);

    foreach ($max_ids as $maxids) {
      if (!empty($maxids)) {
        foreach ($maxids as $max_id) {
          $maxid[] = $max_id['chat_id'];
        }
      } else {
        $maxid = [];
        $maxid[0] = 0;
      }
    }

    foreach ($max_id1 as $maxid2) {
      if (!empty($maxid2)) {
        foreach ($maxid2 as $max_id) {
          $maxid3[] = $max_id['chat_id'];
        }
      } else {
        $maxid3 = [];
        $maxid3[0] = 0;
      }
    }
    $chat['worker_array'] = $this->model_chats->getworker($maxid);
    $chat['worker_array'] = array_merge($chat['worker_array'],$this->model_chats->getworkers($maxid3));

    array_multisort( array_map( "strtotime", array_column( $chat['worker_array'], "insert_time" ) ), SORT_DESC, $chat['worker_array'] );
    $unique = [];
    $tmp = [];
    // var_dump($chat);
    foreach($chat as $worker){
        foreach($worker as $value){
          if(!in_array($value['name'],$tmp)){
            $tmp[] = $value['name'];
            $unique[] = $value;
          }
        }
      }


      for($i=0;$i<count($unique);$i++){
        $chats['worker_array'][$i] = $unique[$i];
      }
    $clean_chat = html_escape($chats);
    $clean_chat['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('common/header');
    $this->load->view('chat/workerlist', $clean_chat);
    $this->load->view('common/footer');
  }
  //求職者チャット相手一覧
  public function office_list()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');

    $this->load->model("model_chats");
    $max_ids['max_id'] = $this->model_chats->getoffice_maxid($id);
    $max_id1['maxs_id'] = $this->model_chats->getoffices_maxid($id);
    foreach ($max_ids as $maxids) {
      if (!empty($maxids)) {
        foreach ($maxids as $max_id) {
          $maxid[] = $max_id['chat_id'];
        }
      } else {
        $maxid = [];
        $maxid[0] = 0;
      }
    }
    foreach ($max_id1 as $maxid2) {
      if (!empty($maxid2)) {
        foreach ($maxid2 as $max_id) {
          $maxid3[] = $max_id['chat_id'];
        }
      } else {
        $maxid3 = [];
        $maxid3[0] = 0;
      }
    }
    $chat['office_array'] = $this->model_chats->getoffice($maxid);
    $chat['office_array'] = array_merge($chat['office_array'],$this->model_chats->getoffices($maxid3));

    array_multisort( array_map( "strtotime", array_column( $chat['office_array'], "insert_time" ) ), SORT_DESC, $chat['office_array'] );
    $unique = [];
    $tmp = [];
    foreach($chat as $office){
        foreach($office as $value){
          if(!in_array($value['office'],$tmp)){
            $tmp[] = $value['office'];
            $unique[] = $value;
          }
        }
      }
    for($i=0;$i<count($unique);$i++){
      $chats['office_array'][$i] = $unique[$i];
    }
    $clean_chat = html_escape($chats);
    $clean_chat['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('common/work_header');
    $this->load->view('chat/officelist', $clean_chat);
    $this->load->view('common/footer');
  }
}
