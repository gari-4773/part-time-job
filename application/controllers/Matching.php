<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Matching extends CI_Controller
{
    //求職者マッチングフォーム
    public function interview()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $office_id = $this->input->get('id');
        $job_id = $this->input->get('job_id');
        $this->load->model("model_offices");
        $player['row_array'] = html_escape($this->model_offices->getoffice($office_id));
        $this->load->model("model_matching");
        $count['match'] = $this->model_matching->get_matchingcount($id, $office_id,$job_id);
        if ($count['match'] !== 0) {
            $player['error'] = "既にマッチング申請をしています。";
        }
        $player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('matching/interview', $player);
    }
    //事業者マッチングフォーム
    public function scout()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $worker_id = $this->input->get('id');
        $this->load->model("model_workers");
        $player['row_array'] = html_escape($this->model_workers->getworker($worker_id));
        $this->load->model("model_matching");
        $job_id = $this->model_matching->get_matching_job($id,$worker_id);
        foreach($job_id as $value){
            foreach($value as $values){
                $job_ids[] = (int)$values;
            }
        }
        $this->load->model("model_jobs");
        $player['jobs_array'] = $this->model_jobs->getjobs_id($job_ids,$id);
        $player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('matching/scout', $player);
    }
    //事業者からマッチング申し込み
    public function office_matching()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "message",
                "label" => "メッセージ",
                "rules" => 'trim|required|max_length[1000]',
                "errors" => [
                    "required" => "メール本文は入力必須です。",
                    "max_length" => "メール本文は1000文字以内で入力してください。"
                ]
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $office_id = $_SESSION["id"];
            $worker_id = $this->input->post("id");
            $job_id = $this->input->post("id");
            $job_name = $this->input->post("jobs");
            $job_idss = $this->input->post("job_id");
            $this->load->model("model_jobs");
            $job_ids = $this->model_jobs->get_job_name($job_name);
            $to = $_POST['destination'];
            $bcc =    $_POST['mail'];
            $subject =    $_POST['name'] . "様からの申し込み";
            $body =    $_POST['message']."\n";
            $body .=    "求人名： " . $job_name . "\n";
            $body .= "<'" . base_url() . "/matching/job_details?id=".$job_idss."'>";
            // $body .= "<'" . base_url() . "index.php/worker/workers'>";
            $this->load->model("model_matching");
            $count['match'] = $this->model_matching->get_matchingcount($office_id, $worker_id, $job_id);
            if ($count['match'] === 0) {
                if ($this->model_matching->office_application($office_id, $worker_id, $job_id)) {
                    $this->load->library('mailclass');
                    $this->mailclass->php_mailer($to, $bcc, $subject, $body);
                    $array = ['success' => true];
                } else {
                    echo "送信できませんでした。";
                }
            } else {
                $array = [
                    'error' => true,
                    'count_error' => "既にマッチング申請されています"
                ];
            }
        } else {
            $array = [
                'error' => true,
                'message_error' => form_error('message')
            ];
        }
        exit(json_encode($array));
    }
    //求職者からマッチング申し込み
    public function worker_matching()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "message",
                "label" => "メッセージ",
                "rules" => 'trim|required|max_length[1000]',
                "errors" => [
                    "required" => "メール本文は入力必須です。",
                    "max_length" => "メール本文は1000文字以内で入力してください。"
                ]
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $worker_id = $_SESSION["id"];
            $office_id = $this->input->post("id");
            $job_id = $this->input->post("job_id");
            $to = $_POST['destination'];
            $bcc = $_POST['mail'];
            $subject = $_POST['name'] . "様からの申し込み";
            $body = $_POST['message'];
            $body .= "<'" . base_url() . "/matching/job_details?id=".$job_id."'>";
            // $body .= "<'" . base_url() . "index.php/main/players'>";
            $this->load->model("model_matching");
            $count['match'] = $this->model_matching->get_matchingcount($office_id, $worker_id,$job_id);
            if ($count['match'] === 0) {
                if ($this->model_matching->worker_application($office_id, $worker_id,$job_id)) {
                    $this->load->library('mailclass');
                    $this->mailclass->php_mailer($to, $bcc, $subject, $body);
                    $array = ['success' => true];
                } else {
                    echo "送信できませんでした。";
                }
            } else {
                $array = [
                    'error' => true,
                    'count_error' => "既にマッチング申請されています"
                ];
            }
        } else {
            $array = [
                'error' => true,
                'message_error' => form_error('message')
            ];
        }
        exit(json_encode($array));
    }
    //求人詳細
    public function job_details()
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
        $this->load->model("model_jobs");
        $team['job_array'] = $this->model_jobs->getofficejob($id);
        $this->load->model("model_favorite");
        $office_id['id'] = $this->model_favorite->get_id($id);
        $team['favorite_array'] = $this->model_favorite->getoffice($office_id);
        $clean_team = html_escape($team);
        $clean_team['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('common/work_header');
        $this->load->view("job/job_details", $clean_team);
        $this->load->view('common/footer');
    }
    //求職者詳細
    public function worker_details()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $id = $this->input->get('id');
        $this->load->model("model_workers");
        $team['worker_array'] = $this->model_workers->getworker($id);
        $this->load->model("model_favorite");
        $team['favorite_array'] = $this->model_favorite->getworker($id);
        $clean_team = html_escape($team);
        $clean_team['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('common/header');
        $this->load->view("work/worker_details", $clean_team);
        $this->load->view('common/footer');
    }
    public function rules()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_team");
        $row = $this->model_team->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY');
        $this->load->view('information/rules');
    }
    public function userguide()
    {
        $this->load->view('information/user_guide');
    }

    public function top_details()
    {
        $this->output->set_header('X-Frame-Options: DENY', false);
        $id = $this->input->get('id');
        $this->load->model("model_jobs");
        $team['job_array'] = $this->model_jobs->getofficejob($id);
        $clean_team = html_escape($team);
        $clean_team['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('common/top_header');
        $this->load->view("job/top_detail", $clean_team);
        $this->load->view('common/top_footer');
    }
}
