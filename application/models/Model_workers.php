<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_workers extends CI_Model
{
  public function add_workers($to)
  {
    //add_workersのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "name" => $this->input->post("name"),
      "nickname" => $this->input->post("nickname"),
      "tel" => $this->input->post("tel"),
      "sex" => $this->input->post("sex"),
      "birth" => $this->input->post("birth"),
      "mail" => $to,
      "school_year" => $this->input->post("school_year"),
      "hope_work" => $this->input->post("hope_work"),
      "skill" => $this->input->post("skill"),
      "address" => $this->input->post("address"),
      "schools" => $this->input->post("schools"),
      "password" => password_hash($this->input->post("pass"), PASSWORD_DEFAULT),
      "img" => "noimg.png",
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のworkerに挿入後に、$queryと紐づける
    $query = $this->db->insert("worker", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function getworkers()
  {
    $this->db->select('*');
    $this->db->from('worker');
    $this->db->order_by('login_time', 'DESC');
    $players = $this->db->get();
    return $players->result_array();  //求職者全て表示
  }
  public function getworker($id)
  {
    $this->db->where('id', $id);
    $team = $this->db->get('worker');
    return $team->row_array();  //特定求職者を表示
  }
  public function get_worker($opponent)
  {
    $this->db->where('id', $opponent);
    $team = $this->db->get('worker');
    return $team->row_array();  //特定チームを表示
  }
  public function login_time($id)
  {
      $data = [
        "login_time" => date("Y-m-d H:i:s")
      ];
    //$dateをDB内の特定workerに挿入(更新)する
    return $this->db->where('id', $id)
      ->update('worker', $data);
  }
  public function update_worker()
  {
    //update_workerのモデルの実行時、以下のデータを取得して、$dateと紐づける
    $date = [
      "name" => $this->input->post("name"),
      "nickname" => $this->input->post("nickname"),
      "tel" => $this->input->post("tel"),
      "sex" => $this->input->post("sex"),
      "birth" => $this->input->post("birth"),
      "school_year" => $this->input->post("school_year"),
      "hope_work" => $this->input->post("hope_work"),
      "skill" => $this->input->post("skill"),
      "address" => $this->input->post("address"),
      "schools" => $this->input->post("schools"),
      "update_time" => date("Y-m-d H:i:s")
    ];
    //$dateをDB内の特定workerに挿入(更新)する
    return $this->db->where('id', $this->input->post("id"))
      ->update('worker', $date);
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
    ->update('worker', $data);
  }
  public function getcountworkers()
  {
    $this->db->where('withdrawal', 0);
    $count = $this->db->count_all_results('worker');
    return $count;
  }
  public function getallworkerslist($limit,$offset)
  {
    $this->db->select('*');
    $this->db->from('worker');
    $this->db->where('withdrawal', 0);
    $this->db->limit($limit,$offset);
    $this->db->order_by('login_time','DESC');
    $job = $this->db->get();
    return $job->result_array();
  }
}
