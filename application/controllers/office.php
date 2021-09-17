<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Office extends CI_Controller
{
    //事業者本登録
    public function register_office()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "office",
                "label" => "事業者名",
                "rules" => "trim|required|max_length[100]",
                "errors" => [
                    "required" => "事業所名は入力必須です。",
                    "max_length" => "事業所名は100文字以内で入力してください。"
                ]
            ],
            [
                "field" => "name",
                "label" => "担当者名",
                "rules" => "trim|required|max_length[30]",
                "errors" => [
                    "required" => "担当者名は入力必須です。",
                    "max_length" => "担当者名は30文字以内で入力してください。"
                ]
            ],
            [
                "field" => "tel",
                "label" => "電話番号",
                "rules" => "trim|required|regex_match[/^[0-9]+$/]|min_length[10]|max_length[11]",
                "errors" => [
                    "required" => "電話番号は入力必須です。",
                    "regex_match" => "電話番号が不正です。",
                    "min_length" => "電話番号は10~11桁で入力してください。",
                    "max_length" => "電話番号は10~11桁で入力してください。"
                ]
            ],
            [
                "field" => "mail",
                "label" => "メールアドレス",
                "rules" => "trim|required|valid_email|is_unique[office.mail]",
                "errors" => [
                    "required" => "メールアドレスは入力必須です。",
                    "valid_email" => "メールアドレスが不正です。",
                    "is_unique" => "既に登録されているメールアドレスです。"
                ]
            ],
            [
                "field" => "job",
                "label" => "職種",
                "rules" => "required",
                "errors" => [
                    "required" => "職種は入力必須です。"
                ]
            ],
            [
                "field" => "pass",
                "label" => "パスワード",
                "rules" => "trim|required|min_length[6]|alpha_numeric",
                "errors" => [
                    "required" => "パスワードは入力必須です。",
                    "min_length" => "パスワードは最低6文字以上にしてください。",
                    "alpha_numeric" => "パスワードは半角英数字のみにしてください。"
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
        if ($this->form_validation->run()) {
            $to = $this->input->post("mail");
            $subject = "本登録完了しました。";
            $body = "ご登録ありがとうございます。\n登録が完了しましたことをお知らせ致します。\n";
            $body .= "-------------------------------------------------------------------\nログイン時に必要な情報について\n ・メールアドレス：このメールアドレス\n ・パスワード：本登録時に入力したパスワード\n";
            $body .= "<'" . base_url() . "index.php/main/login'>\nこちらからログインして、本サービスをご利用ください。\n";
            $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
            $this->load->model("model_offices");
            if ($this->model_offices->add_offices($to)) {
                $this->load->library('mailclass');
                $this->mailclass->php_mailer($to, NULL, $subject, $body);
                $this->load->model("model_office");
                $office['id'] = $this->model_office->get_id($to);
                $array = [
                    'success' => true,
                    'id' => $office['id']
                ];
            } else {
                echo "本登録できませんでした。";
            }
        } else {
            $array = [
                'error' => true,
                'office_error' => form_error('office'),
                'name_error' => form_error('name'),
                'tel_error' => form_error('tel'),
                'job_error' => form_error('job'),
                'mail_error' => form_error('mail'),
                'pass_error' => form_error('pass'),
                'chkpass_error' => form_error('chkpass')
            ];
        }
        exit(json_encode($array));
    }
    //事業者本登録
    public function check_signup_office($key)
    {
        $this->output->set_header('X-Frame-Options: DENY', false);
        $this->load->model("model_temporary");
        if ($this->model_temporary->is_valid_key($key)) {    //キーが正しい場合は、以下を実行
            $data["row_array"] = $this->model_temporary->is_valid_key($key);
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view("signup/master", $data);
        } else {
            echo "URLが間違っているか、アクセス期限が過ぎています。";
        }
    }
    //事業者詳細
    public function mypage()
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
        $clean_player = html_escape($player);
        $clean_player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('common/header');
        $this->load->view("home/mypage", $clean_player);
        $this->load->view('common/footer');
    }
    //登録求人一覧
    public function job_lists()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("worker/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $id = $this->input->get('id');
        $this->load->model("model_offices");
        $team['office_array'] = $this->model_offices->getoffice($id);
        $this->load->model("model_jobs");
        $team['jobs_array'] = $this->model_jobs->getjoblist($id);
        $this->load->model("model_favorite");
        $office_id['id'] = $this->model_favorite->get_id($id);
        $team['favorite_array'] = $this->model_favorite->getoffice($office_id);
        $clean_team = html_escape($team);
        $clean_team['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('common/work_header');
        $this->load->view("job/job_lists", $clean_team);
        $this->load->view('common/footer');
    }
}
