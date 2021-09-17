<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_favorite extends CI_Model
{
  //求職者をお気に入り登録
  public function add_worker($id)
  {
    //add_workerのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "myoffice_id" => $id,
      "youworker_id" => $this->input->post("favorite"),
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のfavoritesに挿入後に、$queryと紐づける
    $query = $this->db->insert("favorites", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  //事業者をお気に入り登録
  public function add_office($id)
  {
    //add_officeのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "myworker_id" => $id,
      "youoffice_id" => $this->input->post("favorite"),
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のfavoritesに挿入後に、$queryと紐づける
    $query = $this->db->insert("favorites", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  //お気に入り求職者
  public function getworker($id)
  {
    $this->db->where('myoffice_id', $_SESSION['id']);
    $this->db->where('youworker_id', $id);
    $this->db->where('delete_favorite', 0);
    $favorite = $this->db->get('favorites');
    return $favorite->row_array();
  }
  //お気に入り事業者
  public function getoffice($office_id)
  {
    $this->db->where('myworker_id', $_SESSION['id']);
    $this->db->where('youoffice_id', $office_id['id']);
    $this->db->where('delete_favorite', 0);
    $favorite = $this->db->get('favorites');
    return $favorite->row_array();
  }
  //事業者id
  public function get_id($id)
  {
    $this->db->select('id');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');
    $this->db->where("job_id", $id);
    $teamid = $this->db->get();
    return $teamid->first_row()->id;
  }
  //求職者をお気に入り解除
  public function worker_delete($id)
  {
    $array = array('myoffice_id' => $id, 'youworker_id' => $this->input->post("favorite"));
    return $this->db->where($array)
      ->delete('favorites');
  }
  //事業者をお気に入り解除
  public function office_delete($id)
  {
    $array = array('myworker_id' => $id, 'youoffice_id' => $this->input->post("favorite"));
    return $this->db->where($array)
      ->delete('favorites');
  }
  //事業者がお気に入り登録した求職者
  public function getoffice_follow($id)
  {
    $this->db->select('*');
    $this->db->from('worker');
    $this->db->join('favorites', 'favorites.youworker_id = worker.id');
    $this->db->where('myoffice_id', $id);
    $favorite = $this->db->get();
    return $favorite->result_array();
  }
  //事業者がお気に入り登録された求職者
  public function getoffice_follower($id)
  {
    $this->db->select('*');
    $this->db->from('worker');
    $this->db->join('favorites', 'favorites.myworker_id = worker.id');
    $this->db->where('youoffice_id', $id);
    $favorite = $this->db->get();
    return $favorite->result_array();
  }
  //求職者がお気に入り登録した事業者
  public function getworker_follow($id)
  {
    $this->db->select('*');
    $this->db->from('office');
    $this->db->join('favorites', 'favorites.youoffice_id = office.id');
    $this->db->where('myworker_id', $id);
    $favorite = $this->db->get();
    return $favorite->result_array();
  }
  //求職者がお気に入り登録された事業者
  public function getworker_follower($id)
  {
    $this->db->select('*');
    $this->db->from('office');
    $this->db->join('favorites', 'favorites.myoffice_id = office.id');
    $this->db->where('youworker_id', $id);
    $favorite = $this->db->get();
    return $favorite->result_array();
  }
}
