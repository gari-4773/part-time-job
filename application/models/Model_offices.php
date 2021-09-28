<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_offices extends CI_Model
{
  public function add_offices($to)
  {
    //add_teamsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "office" => $this->input->post("office"),
      "name" => $this->input->post("name"),
      "tel" => $this->input->post("tel"),
      "mail" => $to,
      "password" => password_hash($this->input->post("pass"), PASSWORD_DEFAULT),
      "job" => $this->input->post("job"),
      "img" => "noimg.png",
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のteamに挿入後に、$queryと紐づける
    $query = $this->db->insert("office", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function getoffices()
  {
    $this->db->select('*');
    $this->db->from('office');
    $office = $this->db->get();
    return $office->result_array();  //登録チーム全て表示
  }
  public function getoffice($id)
  {
    $this->db->where('id', $id);
    $office = $this->db->get('office');
    return $office->row_array();  //特定チームを表示
  }
  public function get_application_offices()
  {
    $this->db->select('*');
    $this->db->from('office');
    $this->db->where('published_time !=', NULL);
    $this->db->order_by('published_time', 'DESC');
    $office = $this->db->get();
    return $office->result_array();  //登録チーム全て表示
  }
  public function get_advertising_offices()
  {
    $this->db->select('*');
    $this->db->from('office');
    $this->db->where('published_time >', date("Y-m-d H:i:s"));
    $office = $this->db->get();
    return $office->result_array();  //登録チーム全て表示
  }
  public function getnot_advertising_offices()
  {
    $this->db->select('id');
    $this->db->from('office');
    $this->db->where('advertising', 3);
    $this->db->where('published_time <=', date("Y-m-d H:i:s"));
    $office = $this->db->get();
    return $office->result_array();  //登録チーム全て表示
  }
  public function login_time($id)
  {
    $data = [
      "login_time" => date("Y-m-d H:i:s")
    ];
    //$dateをDB内の特定playerに挿入(更新)する
    return $this->db->where('id', $id)
      ->update('office', $data);
  }
  public function update_office()
  {
    //update_playerのモデルの実行時、以下のデータを取得して、$dateと紐づける
    $data = [
      "office" => $this->input->post("office"),
      "name" => $this->input->post("name"),
      "tel" => $this->input->post("tel"),
      "job" => $this->input->post("job"),
      "update_time" => date("Y-m-d H:i:s")
    ];
    //$dateをDB内の特定playerに挿入(更新)する
    return $this->db->where('id', $this->input->post("id"))
      ->update('office', $data);
  }
  public function add_img($upload_data)
  {
    foreach ($upload_data as $key) {
      $data = [
        "img" => $key['file_name'],
        "update_time" => date("Y-m-d H:i:s")
      ];
    }
    return $this->db->where('id', $this->input->post("id"))
      ->update('office', $data);
  }
}
