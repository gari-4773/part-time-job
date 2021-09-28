<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Newmail extends CI_Controller
{
  //事業者仮登録
  public function signup_validation()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "mail",
        "label" => "メールアドレス",
        "rules" => "trim|required|valid_email",
        "errors" => [
          "required" => "メールアドレスは入力必須です。",
          "valid_email" => "メールアドレスが不正です。"
        ]
      ]
    ];
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run()) {
      //ランダムキーを生成する
      $key = md5(uniqid());
      $to = $_POST['mail'];
      $subject = "仮登録完了しました。";
      $body = "ご登録ありがとうございます。\n仮登録が完了しました。\n";
      $body .= "-------------------------------------------------------------------\n【事業者用】\n";
      $body .= "<'" . base_url() . "index.php/office/check_signup_office/$key'>\n引き続きこちらをクリックして、本登録を完了してください。ただし、こちらのURLは1時間過ぎると無効になりますのでご注意下さい。\n\n";
      $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
      $this->load->model("model_temporary");
      if ($this->model_temporary->add_team($key)) {
        $this->load->library('mailclass');
        $this->mailclass->php_mailer($to, NULL, $subject, $body);
        $array = ['success' => true];
      } else {
        echo "仮登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'mail_error' => form_error('mail')
      ];
    }
    exit(json_encode($array));
  }
  //求職者仮登録
  public function worksignup_validation()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "mail",
        "label" => "メールアドレス",
        "rules" => "trim|required|valid_email",
        "errors" => [
          "required" => "メールアドレスは入力必須です。",
          "valid_email" => "メールアドレスが不正です。"
        ]
      ]
    ];
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run()) {
      //ランダムキーを生成する
      $key = md5(uniqid());
      $to = $_POST['mail'];
      $subject = "仮登録完了しました。";
      $body = "ご登録ありがとうございます。\n仮登録が完了しました。\n";
      $body .= "-------------------------------------------------------------------\n【求職者用】\n";
      $body .= "<'" . base_url() . "index.php/jobwork/check_signup_worker/$key'>\n引き続きこちらをクリックして、本登録を完了してください。ただし、こちらのURLは1時間過ぎると無効になりますのでご注意下さい。\n";
      $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
      $this->load->model("model_temporary");
      if ($this->model_temporary->add_team($key)) {
        $this->load->library('mailclass');
        $this->mailclass->php_mailer($to, NULL, $subject, $body);
        $array = ['success' => true];
      } else {
        echo "仮登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'mail_error' => form_error('mail')
      ];
    }
    exit(json_encode($array));
  }
}
