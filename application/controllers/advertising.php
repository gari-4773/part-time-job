<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Advertising extends CI_Controller
{
  public function signup()
  {
    header("Content-type: application/json; charset=UTF-8");
    $to = $_SESSION['mail'];
    $subject = "広告申請完了のお知らせ";
    $body = "いつもご利用ありがとうございます。\n" . $_SESSION['office'] . "様の広告申請を承りました。";
    $body .= "運営の方で広告掲載の審査を致しますので、今しばらくお待ちください。\n\n";
    $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
    $this->load->model("model_office");
    if ($this->model_office->add_advertising()) {
      $this->load->library('mailclass');
      $this->mailclass->php_mailer($to, NULL, $subject, $body);
      $array = ['success' => true];
    } else {
      $array = ['error' => true];
    }
    exit(json_encode($array));
  }
  public function entry()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_offices");
    $team['office_array'] = $this->model_offices->get_application_offices();
    $clean_team = html_escape($team);
    $clean_team['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/advertising", $clean_team);
  }
  public function published()
  {
    header("Content-type: application/json; charset=UTF-8");
    $name = $this->input->post("name");
    $to = $this->input->post("mail");
    $subject = "広告掲載のお知らせ";
    $body = "いつもご利用ありがとうございます。\n" . $name . "様の広告掲載が決定しました。";
    $body .= "<'" . base_url() . "index.php/office/mypage'>つきましては、このurlより決済を行って下さい。\n\n";
    $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
    $this->load->model("model_office");
    if ($this->model_office->published_advertising()) {
      $this->load->library('mailclass');
      $this->mailclass->php_mailer($to, NULL, $subject, $body);
      $array = ['success' => true];
    } else {
      $array = ['error' => true];
    }
    exit(json_encode($array));
  }
  public function settlement()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    // $this->load->model("model_worker");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
        redirect("main/login");
        return;
    }
    $this->output->set_header('X-Frame-Options: DENY', false);
    $config = parse_ini_file('config.ini', true);
    // ダウンロードしたStripeのPHPライブラリのinit.phpを読み込む
    require_once('application/third_party/stripe-php/init.php');
    $sercret_key = $config['stripe']['secret_key'];
    // APIのシークレットキー
    \Stripe\Stripe::setApiKey($sercret_key);

    $chargeId = null;

    try {
        // (1) オーソリ（与信枠の確保）
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create(array(
            'amount' => 20000,
            'currency' => 'jpy',
            'description' => 'test',
            'source' => $token,
            'capture' => false,
        ));
        $chargeId = $charge['id'];

        // (2) 注文データベースの更新などStripeとは関係ない処理
        // :
        // :
        // :

        // (3) 売上の確定
        $charge->capture();

        $this->load->model("model_office");
        $this->model_office->update_advertising();
        $to = $_SESSION['mail'];
        $subject = "広告決済完了のお知らせ";
        $body = "いつもご利用いただきありがとうございます。\n広告決済が完了しました。\n掲載期間は本日より30日間となっており、求職者のトップページ上部に掲載します。\n";
        $body .= "引き続きEISバイトマッチングサービスをよろしくお願いします\n\n";
        $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
        $this->load->library('mailclass');
        $this->mailclass->php_mailer($to,NULL,$subject,$body);

        $this->load->view('common/header');
        $this->load->view('thanks');
        $this->load->view('common/footer');
        // exit;
    } catch(Exception $e) {
        if ($chargeId !== null) {
            // 例外が発生すればオーソリを取り消す
            \Stripe\Refund::create(array(
                'charge' => $chargeId,
            ));
        }

        // エラー画面にリダイレクト
        $this->load->view('common/header');
        $this->load->view('error');
        $this->load->view('common/footer');
        // header("Location: /error.html");
        // exit;
    }
  }
  public function release()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->model("model_office");
    if ($this->model_office->release_advertising()) {
      $array = ['success' => true];
    } else {
      $array = ['error' => true];
    }
    exit(json_encode($array));
  }
}
