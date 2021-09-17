<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_news extends CI_Model
{
  public function add_news($subject,$body)
  {
    //add_playersのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "title" => $subject,
      "message" => $body,
      "insert_time" => date("Y-m-d H:i:s")
    ];
    //$dataをDB内のplayerに挿入後に、$queryと紐づける
    $query = $this->db->insert("news", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function get_news()
  {
    $news = $this->db->get('news');
    return $news->result_array();  //登録チーム全て表示
  }
  public function get_detail_news($id)
  {
    $this->db->select('*');
    $this->db->from('news');
    $this->db->where('id', $id);
    $news = $this->db->get();
    return $news->result_array();
  }
}