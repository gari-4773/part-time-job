<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Form extends CI_Controller
{
    //事業者仮登録
    public function office_signup()
    {
        $this->output->set_header('X-Frame-Options: DENY', false);
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("signup/signup", $data);
    }
    //求職者仮登録
    public function work_signup()
    {
        $this->output->set_header('X-Frame-Options: DENY', false);
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("signup/work_signup", $data);
    }
    //求人編集
    public function update_job()
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
        $this->load->model("model_jobs");
        $player['row_array'] = html_escape($this->model_jobs->get_job($id));
        $player['treatment']=explode(",",$player['row_array']['treatment']);
        $player['form']=explode(",",$player['row_array']['form']);
        $player['emvironment']=explode(",",$player['row_array']['emvironment']);
        $player['welcome']=explode(",",$player['row_array']['welcome']);
        $player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("update/update", $player);
    }
    //事業者プロフィール編集
    public function profile()
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
        $this->load->model("model_offices");
        $team['team_array'] = html_escape($this->model_offices->getoffice($id));
        $team['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('update/profile', $team);
    }
    //求職者プロフィール編集
    public function work_profile()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_worker");
        $row = $this->model_worker->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY', false);
        $id = $this->input->get('id');
        $this->load->model("model_workers");
        $team['row_array'] = html_escape($this->model_workers->getworker($id));
        $team['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('update/work_profile', $team);
    }
    //決済画面
    public function settlement()
    {
        $id = $_SESSION['id'];
        $this->load->model("model_office");
        $row = $this->model_office->get_flag($id);
        if (!$this->session->userdata("is_logged_in") || $row != 0) {
            redirect("main/login");
            return;
        }
        $this->output->set_header('X-Frame-Options: DENY');
        $id = $this->input->get('id');
        $this->load->model("model_workers");
        $teacher['row_array'] = html_escape($this->model_workers->getworker($id));
        $teacher['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('matching/settlement', $teacher);
    }
}
