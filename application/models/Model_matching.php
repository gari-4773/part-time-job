<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_matching extends CI_Model
{
  public function get_matchingcount($worker_id, $office_id, $job_id)
  {
    $array = ['office_id' => $office_id, 'worker_id' => $worker_id, 'job_id' => $job_id];
    $this->db->where($array);
    $count = $this->db->count_all_results('matching');
    return $count;  //重複数
  }
  public function office_application($office_id, $worker_id,$job_id)
  {
    $data = [
      "office_id" => $office_id,
      "worker_id" => $worker_id,
      'job_id' => $job_id,
      "from_office" => 1,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    $query = $this->db->insert("matching", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function worker_application($office_id, $worker_id,$job_id)
  {
    $data = [
      "office_id" => $office_id,
      "worker_id" => $worker_id,
      "job_id" => $job_id,
      "from_worker" => 1,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    $query = $this->db->insert("matching", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function add_matching($office_id, $worker_id)
  {
    $data = [
      "partner_flag" => 1,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    $array = ['office_id' => $office_id, 'worker_id' => $worker_id];
    return $this->db->where($array)
      ->update('matching', $data);
  }
  public function signup_matching($office_id, $worker_id)
  {
    $data = [
      "partner_flag" => 2,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    $array = ['office_id' => $office_id, 'worker_id' => $worker_id];
    return $this->db->where($array)
      ->update('matching', $data);
  }
  public function release_matching($office_id, $worker_id)
  {
    $data = [
      "partner_flag" => 3,
      "update_time" => date("Y-m-d H:i:s")
    ];
    $array = ['office_id' => $office_id, 'worker_id' => $worker_id];
    return $this->db->where($array)
      ->update('matching', $data);
  }
  public function getoffice_matching($id)
  {
    $this->db->select('*');
    $this->db->from('worker');
    $this->db->join('matching', 'matching.worker_id = worker.id');
    $this->db->where('office_id', $id);
    $matching = $this->db->get();
    return $matching->result_array(); //事業者とマッチングしている求職者
  }
  public function getworker_matching($id)
  {
    $this->db->select('*');
    $this->db->from('office');
    $this->db->join('matching', 'matching.office_id = office.id');
    $this->db->where('worker_id', $id);
    $matching = $this->db->get();
    return $matching->result_array(); //求職者とマッチングしている事業者
  }
  public function getall_matching()
  {
    $this->db->select('mid,office_id,worker_id,partner_flag,office,office.name AS office_name,worker.name AS worker_name');
    $this->db->from('matching');
    $this->db->join('office', 'office.id = matching.office_id');
    $this->db->join('worker', 'worker.id = matching.worker_id');
    $matching = $this->db->get();
    return $matching->result_array(); //求職者がお気に入り登録している事業者
  }

  public function rematching($id)
  {
    $data = [
      "partner_flag" => 1,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    $array = ['office_id' => $id, 'worker_id' => $this->input->post("worker_id")];
    $this->db->where($array);
    return $this->db->update('matching',$data);
  }

  public function get_matching_job($id,$worker_id){
    $this->db->select('job_id');
    $array = ['office_id' => $id, 'worker_id' => $worker_id];
    $this->db->where($array);
    $matching = $this->db->get('matching');
    return $matching->result_array();
  }
}