<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Favorite extends CI_Controller
{
  //事業者お気に入り登録処理
  public function register_worker()
  {
    header("Content-type: application/json; charset=UTF-8");
    $id = $_SESSION['id'];
    $this->load->model("model_favorite");
    if ($this->model_favorite->add_worker($id)) {
      exit(json_encode(['favorite' => '登録完了']));
    } else {
      echo "お気に入り登録できませんでした。";
    }
  }
  //求職者お気に入り登録処理
  public function register_office()
  {
    header("Content-type: application/json; charset=UTF-8");
    $id = $_SESSION['id'];
    $this->load->model("model_favorite");
    if ($this->model_favorite->add_office($id)) {
      exit(json_encode(['favorite' => '登録完了']));
    } else {
      echo "お気に入り登録できませんでした。";
    }
  }
  //事業者お気に入り解除処理
  public function release_worker()
  {
    header("Content-type: application/json; charset=UTF-8");
    $id = $_SESSION['id'];
    $this->load->model("model_favorite");
    if ($this->model_favorite->worker_delete($id)) {
      exit(json_encode(['favorite' => '登録完了']));
    } else {
      echo "お気に入り登録できませんでした。";
    }
  }
  //求職者お気に入り解除処理
  public function release_office()
  {
    header("Content-type: application/json; charset=UTF-8");
    $id = $_SESSION['id'];
    $this->load->model("model_favorite");
    if ($this->model_favorite->office_delete($id)) {
      exit(json_encode(['favorite' => '削除完了']));
    } else {
      echo "お気に入り登録できませんでした。";
    }
  }
  //事業者お気に入り一覧
  public function office_favorite()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $this->load->model("model_favorite");
    $favolite['follow_array'] = $this->model_favorite->getoffice_follow($id);
    $favolite['follower_array'] = $this->model_favorite->getoffice_follower($id);
    $clean_favolite = html_escape($favolite);
    $clean_favolite['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('common/header');
    $this->load->view("favolite/favolite", $clean_favolite);
    $this->load->view('common/footer');
  }
  //求職者お気に入り一覧
  public function worker_favorite()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY', false);
    $this->load->model("model_favorite");
    $favolite['follow_array'] = $this->model_favorite->getworker_follow($id);
    $favolite['follower_array'] = $this->model_favorite->getworker_follower($id);
    $clean_favolite = html_escape($favolite);
    $clean_favolite['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view('common/work_header');
    $this->load->view("favolite/work_favolite", $clean_favolite);
    $this->load->view('common/footer');
  }
}
