<?php
defined('BASEPATH') or exit('No direct script access allowed');
class News extends CI_Controller
{
  //運営からお知らせ
  public function notice()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $data['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/svnotice", $data);
  }
  //お知らせ通知処理
  public function news_register()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $rule = [
      [
        "field" => "title",
        "label" => "問い合わせ内容",
        "rules" => 'trim|required|max_length[100]',
        "errors" => [
          "required" => "件名は入力必須です。",
          "max_length" => "件名は100文字以内で入力してください。"
        ]
      ],
      [
        "field" => "message",
        "label" => "問い合わせ内容",
        "rules" => 'trim|required|max_length[1000]',
        "errors" => [
          "required" => "問い合わせ内容は入力必須です。",
          "max_length" => "問い合わせ内容は1000文字以内で入力してください。"
        ]
      ]
    ];
    $this->form_validation->set_rules($rule);
    if ($this->form_validation->run()) {
      $config = parse_ini_file('config.ini', true);
      $to = $config['contact']['Username'];
      $bcc = [];
      $user = $this->input->post('user');
      $subject = $this->input->post("title");
      $body = $this->input->post("message");
      $this->load->model("model_manager");
      if (in_array('office', $user) === true) {
        $office_mails['mail'] = $this->model_manager->get_officemail();
        foreach ($office_mails as $office_mail) {
          foreach ($office_mail as $office) {
            $bcc[] = $office['mail'];
          }
        }
        $this->load->library('mailclass');
        $this->mailclass->php_mailers($to, $bcc, $subject, $body);
        $bcc = [];
      }
      if (in_array('worker', $user) === true) {
        $worker_mails['mail'] = $this->model_manager->get_workermail();
        foreach ($worker_mails as $worker_mail) {
          foreach ($worker_mail as $worker) {
            $bcc[] = $worker['mail'];
          }
        }
        $this->load->library('mailclass');
        $this->mailclass->php_mailers($to, $bcc, $subject, $body);
      }
      $this->load->model("model_news");
      $this->model_news->add_news($subject, $body);
      $array = ['success' => true];
    } else {
      $array = [
        'error' => true,
        'title_error' => form_error('title'),
        'message_error' => form_error('message')
      ];
    }
    exit(json_encode($array));
  }
  //お知らせ一覧
  public function newstopix()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_news");
    $news['news_array'] = $this->model_news->get_news();
    $clean_news = html_escape($news);
    $clean_news['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/svnews", $clean_news);
  }

  public function newsdetail()
  {
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_news");
    $id = $this->input->get('id');
    $detail_news['news_array'] = $this->model_news->get_detail_news($id);
    $this->load->view('information/detail',$detail_news);
  }

  //事業者側のnews
  public function newsdetails()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_news");
    $id = $this->input->get('id');
    $detail_news['news_array'] = $this->model_news->get_detail_news($id);
    $detail_news['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    if(isset($_SESSION['office'])){
      $detail_news['if'] = 1;
    }elseif(isset($_SESSION['school_year'])){
      $detail_news['if'] = 2;
    }else{

    }
    $this->load->view('information/details',$detail_news);
  }
}
