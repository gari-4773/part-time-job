<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Manager extends CI_Controller
{
  public function login()
  {
    if ($this->session->userdata("is_logged_in")) {
      redirect("manager/administrator");
    } else {
      $data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $this->load->view('supervisor/svlogin', $data);
    }
    $this->session->sess_destroy();
  }
  //管理者ログイン処理
  public function login_validation()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "pass",
        "label" => "パスワード",
        "rules" => "trim|required",
        "errors" => ["required" => "パスワードは入力必須です。",]
      ]
    ];
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run()) {
      //管理者パスワードの設定読込
      $config = parse_ini_file('config.ini', true);
      if ($this->input->post("pass") == $config['login']['password']) {
        $data = ["is_logged_in" => 100];
        $this->session->set_userdata($data);
        exit(json_encode($data));
      } else {
        $data["error"] = "メールアドレスかパスワードが不正です。";
        $this->load->view("login", $data);
      }
    } else {
      $this->load->view("login");
    }
  }
  //管理者管理画面
  public function administrator()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_offices");
    $team['office_array'] = $this->model_offices->getoffices();
    $this->load->model("model_workers");
    $team['worker_array'] = $this->model_workers->getworkers();
    $clean_team = html_escape($team);
    $clean_team['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/supervisor", $clean_team);
  }
  //事業者詳細
  public function jobs_detail()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY', false);
    $id = $this->input->get('id');
    $this->load->model("model_offices");
    $job['office_array'] = $this->model_offices->getoffice($id);
    $this->load->model("model_jobs");
    $job['job_array'] = $this->model_jobs->getjoblist($id);
    $clean_job = html_escape($job);
    $clean_job['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/svjobs", $clean_job);
  }
  //求職者詳細
  public function worker_detail()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY', false);
    $id = $this->input->get('id');
    $this->load->model("model_workers");
    $worker['worker_array'] = $this->model_workers->getworker($id);
    $clean_worker = html_escape($worker);
    $clean_worker['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/svworker", $clean_worker);
  }
  //マッチング一覧
  public function match_list()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_matching");
    $matching['matching_array'] = $this->model_matching->getall_matching();
    $clean_matching = html_escape($matching);
    $clean_matching['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/matchlist", $clean_matching);
  }
  //問い合わせ一覧
  public function contacts()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_supports");
    $contact['office_array'] = $this->model_supports->getoffice_messages();
    $contact['worker_array'] = $this->model_supports->getworker_messages();
    $clean_contact = html_escape($contact);
    $clean_contact['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/svmessage", $clean_contact);
  }
  //未対応問い合わせ返信
  public function sv_mail()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $id = $this->input->get('id');
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_supports");
    $message['row_array'] = html_escape($this->model_supports->getmessage($id));
    $message['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/svmail", $message);
  }
  //対応中問い合わせ返信
  public function sv_remail()
  {
    if (!$this->session->userdata("is_logged_in")) {
      redirect("manager/login");
      return;
    }
    $id = $this->input->get('id');
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_supports");
    $message['row_array'] = html_escape($this->model_supports->getmessage($id));
    $message['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("supervisor/svremail", $message);
  }
}
