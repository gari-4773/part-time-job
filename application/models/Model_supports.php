<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_supports extends CI_Model
{
  public function add_contact($name, $mail, $message)
  {
    //add_playersのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "name" => $name,
      "mail" => $mail,
      "title" => "新規",
      "message" => $message,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のplayerに挿入後に、$queryと紐づける
    $query = $this->db->insert("support", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function add_officecontact($name, $mail, $title, $message)
  {
    //add_playersのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "office_id" => $this->input->post("office_id"),
      "name" => $name,
      "mail" => $mail,
      "title" => $title,
      "message" => $message,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のplayerに挿入後に、$queryと紐づける
    $query = $this->db->insert("support", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function add_workercontact($name, $mail, $title, $message)
  {
    //add_playersのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "worker_id" => $this->input->post("worker_id"),
      "name" => $name,
      "mail" => $mail,
      "title" => $title,
      "message" => $message,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のplayerに挿入後に、$queryと紐づける
    $query = $this->db->insert("support", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function getoffice_messages()
  {
    $this->db->select('*');
    $this->db->from('support');
    $this->db->join('office', 'office.id = support.office_id');
    $office = $this->db->get();
    return $office->result_array();  //事業者からの問い合わせ全て
  }
  public function getworker_messages()
  {
    $this->db->select('*');
    $this->db->from('support');
    $this->db->join('worker', 'worker.id = support.worker_id');
    $worker = $this->db->get();
    return $worker->result_array();  //求職者からの問い合わせ全て
  }
  public function getmessage($id)
  {
    $this->db->where('id', $id);
    $team = $this->db->get('support');
    return $team->row_array();  //特定の問い合わせ表示   
  }
  public function update_message($day)
  {
    $date = [
      "delete_message" => 1,
      "update_time" => $day
    ];
    return $this->db->where('id', $this->input->post("id"))
      ->update('support', $date);
  }
  public function end_message($day)
  {
    $date = [
      "delete_message" => 2,
      "update_time" => $day
    ];
    return $this->db->where('id', $this->input->post("end_id"))
      ->update('support', $date);
  }
  public function delete_message()
  {
    return $this->db->where('id', $this->input->post("delete_id"))
      ->delete('support');
  }
}
