<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mail extends CI_Controller
{
  //事業者メルアド変更フォーム
  public function update_mail()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $id = $this->input->get('id');
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_offices");
    $team['team_array'] = html_escape($this->model_offices->getoffice($id));
    $team['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/mail_send", $team);
  }
  //事業者メルアド変更確認
  public function check_office_mail($key)
  {
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_temporary");
    if ($this->model_temporary->is_valid_key($key)) {    //キーが正しい場合は、以下を実行
      $data["row_array"] = $this->model_temporary->is_valid_key($key);
      $data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $this->load->view("update/mail_update", $data);
    } else {
      echo "URLが間違っているか、アクセス期限が過ぎています。";
    }
  }
  //事業者メルアド変更処理
  public function mail_update()
  {
    header("Content-type: application/json; charset=UTF-8");
    $id = $this->input->post('id');
    $this->load->model("model_office");
    if ($this->model_office->mail_update($id)) {
      $array = ['success' => true];
    } else {
      $array = ['error' => true];
    }
    exit(json_encode($array));
  }
  //求職者メルアド変更フォーム
  public function work_mail()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }
    $id = $this->input->get('id');
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_workers");
    $team['row_array'] = html_escape($this->model_workers->getworker($id));
    $team['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/work_mail_send", $team);
  }
  //求職者メルアド変更確認
  public function check_worker_mail($key)
  {
    $this->output->set_header('X-Frame-Options: DENY', false);
    //add_temp_usersモデルが書かれている、model_uses.phpをロードする
    $this->load->model("model_temporary");
    if ($this->model_temporary->is_valid_key($key)) {    //キーが正しい場合は、以下を実行
      $data["row_array"] = $this->model_temporary->is_valid_key($key);
      $data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $this->load->view("update/work_mail_update", $data);
    } else {
      echo "URLが間違っているか、アクセス期限が過ぎています。";
    }
  }
  //求職者メルアド変更処理
  public function work_mail_update()
  {
    header("Content-type: application/json; charset=UTF-8");
    $id = $this->input->post('id');
    $this->load->model("model_worker");
    if ($this->model_worker->mail_update($id)) {
      $array = ['success' => true];
    } else {
      $array = ['error' => true];
    }
    exit(json_encode($array));
  }
}
