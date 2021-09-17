<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_worker extends CI_Model
{
  public function login()
  {
    $this->db->where("mail", $this->input->post("mail", true));
    $query = $this->db->get('worker');
    if ($query->num_rows() == 1) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  public function get_id($to)
  {
    $this->db->select('id');
    $this->db->where("mail", $to);
    $teamid = $this->db->get('worker');
    return $teamid->first_row()->id;  //特定チームid
  }
  public function get_flag($id)
  {
    $this->db->select('withdrawal');
    $this->db->where("id", $id);
    $flag = $this->db->get('worker');
    return $flag->first_row()->withdrawal;  //特定チームフラグ
  }
  public function get_name($id)
  {
    $this->db->select('name');
    $this->db->where("id", $id);
    $flag = $this->db->get('worker');
    return $flag->first_row()->team;  //特定チーム名
  }
  public function get_email($id)
  {
    // $this->db->select('name');
    $this->db->select('mail, name');
    $this->db->where('id',$id);
    $mail = $this->db->get('worker');
    return $mail->result_array();
  }
  public function mail_update($id)
  {
    //add_teamsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "mail" => $this->input->post("mail"),
      "update_time" => date("Y-m-d H:i:s")
    ];
    return $this->db->where('id', $id)
      ->update('worker', $data);
  }
  public function update_password($days)
  {
    //add_teamsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "password" => password_hash($this->input->post("pass"), PASSWORD_DEFAULT),
      "update_time" => $days
    ];
    return $this->db->where('id', $this->input->post("id"))
      ->update('worker', $data);
  }
}