<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Password extends CI_Controller
{
  //事業者パスワード変更
  public function update_password()
  {
    $this->output->set_header('X-Frame-Options: DENY', false);
    $team['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/password", $team);
  }
  //事業者パスワード変更フォーム
  public function check_office_pass($key)
  {
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_temporary");
    if ($this->model_temporary->is_valid_key($key)) {    //キーが正しい場合は、以下を実行
      $data["row_array"] = $this->model_temporary->is_valid_key($key);
      $data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $this->load->view("update/pass_update", $data);
    } else {
      echo "URLが間違っているか、アクセス期限が過ぎています。";
    }
  }
  //事業者パスワード変更処理
  public function password_update()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "pass",
        "label" => "パスワード",
        "rules" => "trim|required|min_length[8]|max_length[256]|regex_match[/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]+\z/i]",
        "errors" => [
          "required" => "パスワードは入力必須です。",
          "min_length" => "パスワードは最低8文字以上で入力してください。",
          "max_length" => "パスワードは256文字以内で入力してください。",
          "regex_match" => "パスワードは半角英字(大文字・小文字)・数字を各1種類以上含めてください。"
        ]
      ],
      [
        "field" => "chkpass",
        "label" => "パスワード確認",
        "rules" => "trim|required|matches[pass]",
        "errors" => [
          "required" => "確認パスワードは入力必須です。",
          "matches" => "上記と同じパスワードを入力してください。"
        ]
      ]
    ];
    $this->form_validation->set_rules($config);
    $days = date("Y-m-d H:i:s");
    if ($this->form_validation->run()) {
      $this->load->model("model_office");
      if ($this->model_office->update_password($days)) {
        $array = ['success' => true];
      } else {
        echo "チーム登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'pass_error' => form_error('pass'),
        'chkpass_error' => form_error('chkpass')
      ];
    }
    exit(json_encode($array));
  }
  //求職者パスワード変更
  public function worker_password()
  {
    $this->output->set_header('X-Frame-Options: DENY', false);
    $team['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/work_password", $team);
  }
  //求職者パスワード変更フォーム
  public function check_worker_pass($key)
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
      $this->load->view("update/work_pass_update", $data);
    } else {
      echo "URLが間違っているか、アクセス期限が過ぎています。";
    }
  }
  //求職者パスワード変更処理
  public function worker_password_update()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "pass",
        "label" => "パスワード",
        "rules" => "trim|required|min_length[8]|max_length[256]|regex_match[/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]+\z/i]",
        "errors" => [
          "required" => "パスワードは入力必須です。",
          "min_length" => "パスワードは最低8文字以上で入力してください。",
          "max_length" => "パスワードは256文字以内で入力してください。",
          "regex_match" => "パスワードは半角英字(大文字・小文字)・数字を各1種類以上含めてください。"
        ]
      ],
      [
        "field" => "chkpass",
        "label" => "パスワード確認",
        "rules" => "trim|required|matches[pass]",
        "errors" => [
          "required" => "確認パスワードは入力必須です。",
          "matches" => "上記と同じパスワードを入力してください。"
        ]
      ]
    ];
    $this->form_validation->set_rules($config);
    $days = date("Y-m-d H:i:s");
    if ($this->form_validation->run()) {
      $this->load->model("model_worker");
      if ($this->model_worker->update_password($days)) {
        $array = ['success' => true];
      } else {
        echo "チーム登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'pass_error' => form_error('pass'),
        'chkpass_error' => form_error('chkpass')
      ];
    }
    exit(json_encode($array));
  }
}
