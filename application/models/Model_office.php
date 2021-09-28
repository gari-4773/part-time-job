<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_office extends CI_Model
{
  public function login()
  {
    $this->db->where("mail", $this->input->post("mail", true));
    $query = $this->db->get('office');
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
    $teamid = $this->db->get('office');
    return $teamid->first_row()->id;  //特定チームid
  }
  public function get_flag($id)
  {
    $this->db->select('withdrawal');
    $this->db->where("id", $id);
    $flag = $this->db->get('office');
    return $flag->first_row()->withdrawal;  //特定チームフラグ
  }
  public function get_name($id)
  {
    $this->db->select('office');
    $this->db->where("id", $id);
    $flag = $this->db->get('office');
    return $flag->first_row()->team;  //特定チーム名
  }
  public function mail_update($id)
  {
    //add_teamsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "mail" => $this->input->post("mail"),
      "update_time" => date("Y-m-d H:i:s")
    ];
    return $this->db->where('id', $id)
      ->update('office', $data);
  }
  public function update_password($days)
  {
    //add_teamsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "password" => password_hash($this->input->post("pass"), PASSWORD_DEFAULT),
      "update_time" => $days
    ];
    return $this->db->where('id', $this->input->post("id"))
      ->update('office', $data);
  }
  //広告申請
  public function add_advertising()
  {
    $data = [
      "advertising" => 1,
      "published_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内の特定playerに挿入(更新)する
    return $this->db->where('id', $this->input->post("id"))
      ->update('office', $data);
  }
  //広告決済
  public function published_advertising()
  {
    $data = [
      "advertising" => 2,
      "published_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内の特定playerに挿入(更新)する
    return $this->db->where('id', $this->input->post("id"))
      ->update('office', $data);
  }
  //広告掲載
  public function update_advertising()
  {
    $config = parse_ini_file('config.ini', true);
    $day = date("Y-m-d H:i:s",strtotime("+".$config['expire']['days']." day"));
    $data = [
      "advertising" => 3,
      "published_time" => $day
    ];
    //$dataをDB内の特定playerに挿入(更新)する
    return $this->db->where('id', $_SESSION['id'])
      ->update('office', $data);
  }
  //広告掲載解除
  public function release_advertising($office_id)
  {
    $data = [
      "advertising" => 0,
      "published_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内の特定playerに挿入(更新)する
    return $this->db->where_in('id', $office_id)
      ->update('office', $data);
  }
}
