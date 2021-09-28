<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dust extends CI_Controller
{
    //非表示求人一覧
    public function deletes()
    {
        $this->output->set_header('X-Frame-Options: DENY', false);
        $id = $this->input->get('id');
        $this->load->model("model_jobs");
        $player['job_array'] = html_escape($this->model_jobs->getjobs($id));
        $player['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view("home/delete_job", $player);
    }
    //利用停止ユーザー一覧
    public function stop_teams()
    {
        if (!$this->session->userdata("is_logged_in")) {
            redirect("main/login");
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
        $this->load->view("supervisor/delete_team", $clean_team);
    }
    //求人非表示処理
    public function delete_job()
    {
        header("Content-type: application/json; charset=UTF-8");
        $day = date("Y-m-d H:i:s");
        $this->load->model("model_jobs");
        if($this->model_jobs->job_delete($day)){
            exit(json_encode(['job' => '削除完了']));
        }else{
            echo "選手削除できませんでした。";   
        }     
    }
    //求人再開
    public function job_return()
    {
        header("Content-type: application/json; charset=UTF-8");
        $day = date("Y-m-d H:i:s");
        $this->load->model("model_jobs");
        if($this->model_jobs->return_job($day)){
            exit(json_encode(['job' => '復帰完了']));
        }else{
            echo "復帰できませんでした。";
        }  
    }
    //求人をデータから削除処理
    public function delete_real()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->model("model_jobs");
        if($this->model_jobs->real_delete()){
            exit(json_encode(['job' => '削除完了']));
        }else{
            echo "選手削除できませんでした。"; 
        } 
    }
    //事業者利用停止
    public function stop_office()
    {
        header("Content-type: application/json; charset=UTF-8");
        $day = date("Y-m-d H:i:s");
        $this->load->model("model_manager");
        if($this->model_manager->stop_office($day)){
            exit(json_encode(['team' => '削除完了']));
        }else{
            echo "チーム削除できませんでした。"; 
        }    
    }
    //事業者利用再開
    public function office_return()
    {
        header("Content-type: application/json; charset=UTF-8");
        $day = date("Y-m-d H:i:s");
        $this->load->model("model_manager");
        if($this->model_manager->return_office($day)){
            exit(json_encode(['team' => '復帰完了']));
        }else{
            echo "チーム復帰できませんでした。";
        } 
    }
    //事業者データ削除処理
    public function delete_office()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->model("model_manager");
        if($this->model_manager->delete_office()){
            exit(json_encode(['team' => '削除完了']));
        }else{
            echo "チーム削除できませんでした。";
        } 
    }
    //求職者利用停止
    public function stop_worker()
    {
        header("Content-type: application/json; charset=UTF-8");
        $day = date("Y-m-d H:i:s");
        $this->load->model("model_manager");
        if($this->model_manager->stop_worker($day)){
            exit(json_encode(['team' => '削除完了']));
        }else{
            echo "チーム削除できませんでした。"; 
        }    
    }
    //求職者利用再開
    public function worker_return()
    {
        header("Content-type: application/json; charset=UTF-8");
        $day = date("Y-m-d H:i:s");
        $this->load->model("model_manager");
        if($this->model_manager->return_worker($day)){
            exit(json_encode(['team' => '復帰完了']));
        }else{
            echo "チーム復帰できませんでした。";
        } 
    }
    //求職者データ削除処理
    public function delete_worker()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->model("model_manager");
        if($this->model_manager->delete_worker()){
            exit(json_encode(['team' => '削除完了']));
        }else{
            echo "チーム削除できませんでした。";
        } 
    }
    //問い合わせ対応済処理
    public function end_message()
    {
        header("Content-type: application/json; charset=UTF-8");
        $day = date("Y-m-d H:i:s");
        $this->load->model("model_supports");
        if($this->model_supports->end_message($day)){
            exit(json_encode(['messasge' => '削除完了']));
        }else{
            echo "問い合わせを削除できませんでした。";
        }  
    }
    //問い合わせ内容データ削除処理
    public function delete_message()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->model("model_supports");
        if($this->model_supports->delete_message()){
            exit(json_encode(['messasge' => '削除完了']));
        }else{
            echo "問い合わせを削除できませんでした。";
        }
    }
}
