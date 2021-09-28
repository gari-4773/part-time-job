<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Partner extends CI_Controller
{
  //事業者マッチング一覧
  public function office_matching()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_matching");
    $matching['matching_array'] = $this->model_matching->getoffice_matching($id);
    $clean_matching = html_escape($matching);
    $clean_matching['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('common/header');
    $this->load->view("matching/office_match", $clean_matching);
    $this->load->view('common/footer');
  }
  //求職者マッチング一覧
  public function worker_matching()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_matching");
    $matching['matching_array'] = $this->model_matching->getworker_matching($id);
    $clean_matching = html_escape($matching);
    $clean_matching['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('common/work_header');
    $this->load->view("matching/worker_match", $clean_matching);
    $this->load->view('common/footer');
  }
  //事業者マッチング承認
  public function office_matching_approval()
  {
    header("Content-type: application/json; charset=UTF-8");
    $office_id = $_SESSION["id"];
    $worker_id = $this->input->post("id");
    $to = $_SESSION["mail"];
    $subject = "マッチング成立しました。";
    $body = "いつもご利用ありがとうございます。\n" . $_POST['name'] . "様とのマッチングが成立しましたことをお知らせ致します。\n";
    $body .= "-------------------------------------------------------------------\n
    <'" . base_url() . "index.php/partner/office_matching/'>\nつきましては、マッチング一覧画面から決済を行って下さい？\n\n";
    $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
    $this->load->model("model_matching");
    if ($this->model_matching->add_matching($office_id, $worker_id)) {
      $this->load->library('mailclass');
      $this->mailclass->php_mailer($to, NULL,$subject, $body);
      $to = $_POST["mail"];
      $subject = "マッチング成立しました。";
      $body = "いつもご利用ありがとうございます。\n" . $_SESSION['name'] . "様とのマッチングが成立しましたことをお知らせ致します。\n";
      $body .= "-------------------------------------------------------------------\nつきましては、" . $_POST['name'] . "様が決済完了するまでしばらくお待ち下さい。\n\n ";
      $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
      $this->mailclass->php_mailer($to, NUll,$subject, $body);
      $array = ['success' => true];
    } else {
      echo "送信できませんでした。";
    }
    exit(json_encode($array));
  }
  //求職者マッチング承認
  public function worker_matching_approval()
  {
    header("Content-type: application/json; charset=UTF-8");
    $worker_id = $_SESSION["id"];
    $office_id = $this->input->post("id");
    $to = $this->input->post("mail");
    // $to = $_POST['mail'];
    $subject = "マッチング成立しました。";
    $body = "いつもご利用ありがとうございます。\n" . $_SESSION['name'] . "様とのマッチングが成立しましたことをお知らせ致します。\n";
    $body .= "-------------------------------------------------------------------\nつきましては、マッチング一覧画面から決済を行って下さい？\n ";
    $this->load->model("model_matching");
    if ($this->model_matching->add_matching($office_id, $worker_id)) {
      $this->load->library('mailclass');
      $this->mailclass->php_mailer($to,NULL,$subject, $body);
      $to = $_SESSION["mail"];
      $subject = "マッチング成立しました。";
      $body = "いつもご利用ありがとうございます。\n" . $_POST['name'] . "様とのマッチングが成立しましたことをお知らせ致します。\n";
      $body .= "-------------------------------------------------------------------\nつきましては、" . $_POST['name'] . "様が決済完了するまでしばらくお待ち下さい。\n\n ";
      $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
      $this->mailclass->php_mailer($to,NULL,$subject, $body);
      $array = ['success' => true];
    } else {
      echo "送信できませんでした。";
    }
    exit(json_encode($array));
  }
  //事業者決済
  public function matching_settlement()
  {
    header("Content-type: application/json; charset=UTF-8");
    $office_id = $_SESSION["id"];
    $worker_id = $this->input->post("id");
    $to = $_POST['mail'];
    $bcc = $_SESSION["mail"];
    $subject = "マッチング登録しました。";
    $body = "いつもご利用ありがとうございます。\n" . $_POST['name'] . "様とのマッチング登録が完了しましたことをお知らせ致します。\n";
    $body .= "-------------------------------------------------------------------\nつきましては、連絡先情報をお知らせ致します。\n ・" . $_SESSION['office'] . "様：" . $_SESSION["mail"] . "\n ・" . $_POST['name'] . "様：" . $_POST['mail'] . "\n\n";
    $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
    $this->load->model("model_matching");
    if ($this->model_matching->signup_matching($office_id, $worker_id)) {
      $this->load->library('mailclass');
      $this->mailclass->php_mailer($to, $bcc, $subject, $body);
      $array = ['success' => true];
    } else {
      echo "送信できませんでした。";
    }
    exit(json_encode($array));
  }
  //事業者マッチング拒否
  public function release_worker()
  {
    header("Content-type: application/json; charset=UTF-8");
    $office_id = $_SESSION['id'];
    $worker_id = $this->input->post("id");
    $this->load->model("model_matching");
    if ($this->model_matching->release_matching($office_id, $worker_id)) {
      exit(json_encode(['favorite' => '解除完了']));
    } else {
      echo "マッチング拒否できませんでした。";
    }
  }
  //求職者マッチング拒否
  public function release_office()
  {
    header("Content-type: application/json; charset=UTF-8");
    $worker_id = $_SESSION['id'];
    $office_id = $this->input->post("id");
    $this->load->model("model_matching");
    if ($this->model_matching->release_matching($office_id, $worker_id)) {
      exit(json_encode(['favorite' => '解除完了']));
    } else {
      echo "マッチング拒否できませんでした。";
    }
  }
  public function office_rematching()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_matching");
    if($this->model_matching->rematching($id)){
      $result = ['success' => true];
    }else{
      echo "送信できませんでした。";
    }
    exit(json_encode($result));
  }
}
