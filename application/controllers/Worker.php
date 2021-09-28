<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Worker extends CI_Controller
{
    //求職者ログイン処理
    public function login_validation()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "mail",
                "label" => "メールアドレス",
                "rules" => "trim|required",
                "errors" => ["required" => "メールアドレスは入力必須です。"]
            ],
            [
                "field" => "pass",
                "label" => "パスワード",
                "rules" => "trim|required",
                "errors" => ["required" => "パスワードは入力必須です。",]
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $this->load->model("model_worker");
            $rows = $this->model_worker->login();
            if ($rows[0]["withdrawal"] == 0) {
                if (password_verify($this->input->post("pass", true), $rows[0]["password"]) == true) {
                    $data = [
                        "id" => $rows[0]["id"],
                        "name" => $rows[0]["name"],
                        "mail" => $rows[0]["mail"],
                        "birth" => $rows[0]["birth"],
                        "tel" => $rows[0]["tel"],
                        "school_year" => $rows[0]["school_year"],
                        "hope_work" => $rows[0]["hope_work"],
                        "skill" => $rows[0]["skill"],
                        "schools" => $rows[0]["schools"],
                        "address" => $rows[0]["address"],
                        "img" => $rows[0]["img"],
                        "withdrawal" => $rows[0]["withdrawal"],
                        "is_logged_in" => 2
                    ];
                    $this->session->set_userdata($data);
                    exit(json_encode($data));
                } else {
                    $data["error"] = "メールアドレスかパスワードが不正です。";
                    $this->load->view("login", $data);
                }
            }
        }
        $this->load->view("login");
    }
    //求職者管理画面
    public function workers()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY');
        $this->load->model("model_workers");
        $this->model_workers->login_time($id);
        $this->load->model("model_offices");
        $player['office_array'] = $this->model_offices->get_advertising_offices();
        $advertising['id'] = $this->model_offices->getnot_advertising_offices();
        foreach ($advertising as $officeids) {
            foreach ($officeids as $officeid) {
                $office_id[] = $officeid['id'];
            }
        }
        if(!empty($office_id)){
            $this->load->model("model_office");
            $this->model_office->release_advertising($office_id);
        }
        $hope = $_SESSION['hope_work'];
        $this->load->model("model_jobs");
        $player['hope_array'] = $this->model_jobs->gethopejobs($hope);
        $clean_player = html_escape($player);
        $clean_player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('common/work_header');
        $this->load->view("home/work_admin", $clean_player);
        $this->load->view('common/footer');
    }
    //求職者お知らせ一覧
    public function notices()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
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
        // $this->load->view("information/work_notice", $clean_news);
        $this->load->view("information/notices", $clean_news);
    }
    //求職者問い合わせ
    public function supports()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("worker/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('information/work_support', $data);
    }
    //求職者詳細
    public function mypage()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("worker/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY');
        $this->load->model("model_workers");
        $player['worker_array'] = $this->model_workers->getworker($id);
        $clean_player = html_escape($player);
        $clean_player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("home/work_mypage", $clean_player);
    }
    public function worker_user_guide()
    {
        $this->load->view('information/user_guide2');
    }
}
