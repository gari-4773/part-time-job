<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main extends CI_Controller
{
    //トップ画面
    public function index()
    {
        $this->load->model("model_jobs");
        $data['office_array'] = $this->model_jobs->getalljobs();
        $data['jobs_sum'] = $this->model_jobs->getcountjobs();
        $this->load->model("model_news");
        $data['news_array'] = $this->model_news->get_news();
        $clean_data = html_escape($data);
        $clean_data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        // $this->load->view('signup/login', $clean_data);
        // $this->load->view('information/user_guide', $clean_data);
        $this->load->view('home/functions', $clean_data);
        // $this->load->view('home/function', $clean_data);
    }
    //ログイン
    public function login()
    {
        if ($this->session->userdata("is_logged_in") === 1) {
            $id = $_SESSION["id"];
            $this->load->model("model_office");
            $row = $this->model_office->get_flag($id);
            if ($row == 0) {
                redirect("main/players");
            } else {
                $this->session->sess_destroy();        //セッションデータの削除
                redirect("main/index");
            }
        } elseif ($this->session->userdata("is_logged_in") === 2) {
            $id = $_SESSION["id"];
            $this->load->model("model_worker");
            $row = $this->model_worker->get_flag($id);
            if ($row == 0) {
                redirect("worker/workers");
            } else {
                $this->session->sess_destroy();        //セッションデータの削除
                redirect("main/index");
            }
        } else {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('signup/login', $data);
        }
    }
    //ログアウト
    public function logout()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->session->sess_destroy();        //セッションデータの削除
        exit(json_encode(['team' => 'ログアウト完了']));
    }
    //事業者ログイン処理
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
            $this->load->model("model_office");
            $rows = $this->model_office->login();
            if ($rows[0]["withdrawal"] == 0) {
                if (password_verify($this->input->post("pass", true), $rows[0]["password"]) == true) {
                    $data = [
                        "id" => $rows[0]["id"],
                        "office" => $rows[0]["office"],
                        "name" => $rows[0]["name"],
                        "tel" => $rows[0]["tel"],
                        "mail" => $this->input->post("mail"),
                        "job" => $this->input->post("job"),
                        "img" => $this->input->post("img"),
                        "withdrawal" => $rows[0]["withdrawal"],
                        "is_logged_in" => 1
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
    //事業者管理画面
    public function players()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY');
        $this->load->model("model_offices");
        $player['office_array'] = $this->model_offices->getoffice($id);
        $this->model_offices->login_time($id);
        $this->load->model("model_jobs");
        $player['job_array'] = $this->model_jobs->getjobs($id);
        $clean_player = html_escape($player);
        $clean_player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('common/header');
        $this->load->view("home/admin", $clean_player);
        $this->load->view('common/footer');
    }
    //求職者一覧
    public function workers()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY');
        $this->load->model("model_workers");

        $worker_num = $this->model_workers->getcountworkers();
        $limit = 5;
        $offset = $this->input->get('per_page');
        unset($_SESSION['jobs']);
        $player['worker_array'] = $this->model_workers->getallworkerslist($limit,$offset);
        $clean_player = html_escape($player);
        $clean_player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $clean_player['worker_pagination'] = $this->setPages($limit,$worker_num);

        $this->load->view('common/header');
        $this->load->view("work/work_matching", $clean_player);
        $this->load->view('common/footer');
    }
    //事業者お知らせ一覧
    public function notices()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
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
        $this->load->view("information/notice", $clean_news);
    }
    //事業者問い合わせフォーム
    public function supports()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('information/support', $data);
    }
    //求人検索
    public function job_search()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $this->load->model("model_jobs");

        $jobs_num = $this->model_jobs->getcountjobs();
        $limit = 5;
        $offset = $this->input->get('per_page');
        unset($_SESSION['jobs']);
        unset($_SESSION['area']);
        unset($_SESSION['employment']);
        unset($_SESSION['shift']);
        unset($_SESSION['time']);
        unset($_SESSION['salary']);
        unset($_SESSION['salarys']);
        unset($_SESSION['treatment']);
        unset($_SESSION['emvironment']);
        unset($_SESSION['welcome']);
        unset($_SESSION['form']);
        $job['job_array'] = $this->model_jobs->getalljobslist($limit,$offset);

        $clean_job = html_escape($job);
        $clean_job['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $clean_job['jobs_pagination'] = $this->setPage($limit,$jobs_num);
        $this->load->view("sort/works_sort", $clean_job);
    }
    //ページネーション
    public function setPage($limit,$num)
    {
        $this->load->Library("pagination");
        $config['base_url']='http://yakyu.com/index.php/main/job_search/';
        $config['total_rows']=$num;
        $config['per_page'] = $limit;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
    public function setPages($limit,$num)
    {
        $this->load->Library("pagination");
        $config['base_url']='http://yakyu.com/index.php/main/workers/';
        $config['total_rows']=$num;
        $config['per_page'] = $limit;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function stripe()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $config = parse_ini_file('config.ini', true);
        $secret_key = $config['stripe']['secret_key'];
        // ダウンロードしたStripeのPHPライブラリのinit.phpを読み込む
        require_once('application/third_party/stripe-php/init.php');
        // APIのシークレットキー
        \Stripe\Stripe::setApiKey($secret_key);

        $chargeId = null;


        try {
            // (1) オーソリ（与信枠の確保）
            $token = $_POST['stripeToken'];
            $charge = \Stripe\Charge::create(array(
                'amount' => 500,
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

            $worker_id = (int)$_POST['worker_id'];
            $this->load->model('model_worker');
            $to = $this->model_worker->get_email($worker_id);
            $this->load->model('model_matching');
            $this->model_matching->signup_matching($id,$worker_id);

            $subject = "マッチングが完了しました";
            $body = "マッチングが完了しました。\n下記求職者様のメールアドレスより面接日程などの連絡を行ってください。\n";
            $body .= "氏名:".$to[0]['name']."\n";
            $body .= "メールアドレス:".$to[0]['mail']."\n";
            $body .= "この度はEISバイトマッチングサービスをご利用いただきありがとうございました。\n\n";
            $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
            $this->load->library('mailclass');
            $this->mailclass->php_mailer($to[0]['mail'],NULL,$subject,$body);

            $this->load->view('common/header');
            $this->load->view('complete');
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
    public function office_user_guide()
    {
        $this->load->view('information/user_guide');
    }
}
