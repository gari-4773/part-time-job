<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_manager extends CI_Model
{
  public function stop_office($day)
  {
    //事業者フラグを立てて事業者利用停止
    $data = [
      "withdrawal" => 1,
      "update_time" => $day
    ];
    return $this->db->where('id', $this->input->post("stop_id"))
      ->update('office', $data);
  }
  public function return_office($day)
  {
    //フラグを立てて事業者利用再開
    $date = [
      "withdrawal" => 0,
      "update_time" => $day
    ];
    return $this->db->where('id', $this->input->post("return_id"))
      ->update('office', $date);
  }
  public function delete_office()
  {
    //事業者削除
    return $this->db->where('id', $this->input->post("delete_id"))
      ->delete('office');
  }
  public function stop_worker($day)
  {
    //フラグを立てて求職者利用停止
    $data = [
      "withdrawal" => 1,
      "update_time" => $day
    ];
    return $this->db->where('id', $this->input->post("stop_id"))
      ->update('worker', $data);
  }
  public function return_worker($day)
  {
    //フラグを立てて求職者利用再開
    $date = [
      "withdrawal" => 0,
      "update_time" => $day
    ];
    return $this->db->where('id', $this->input->post("return_id"))
      ->update('worker', $date);
  }
  public function delete_worker()
  {
    //求職者削除
    return $this->db->where('id', $this->input->post("delete_id"))
      ->delete('worker');
  }
  public function get_officemail()
  {
    $this->db->select('mail');
    $mail = $this->db->get('office');
    return $mail->result_array();  //事業者メールアドレス全部   
  }
  public function get_workermail()
  {
    $this->db->select('mail');
    $mail = $this->db->get('worker');
    return $mail->result_array();  //求職者メールアドレス全部   
  }
}