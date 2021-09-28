<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_chats extends CI_Model
{
  public function add_chats($day)
  {
    //add_chatsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "myoffice_id" => $this->input->post("myoffice_id"),
      "youworker_id" => $this->input->post("youworker_id"),
      "message" => $this->input->post("message"),
      "insert_time" => $day
    ];
    //$dataをDB内のchatに挿入後に、$queryと紐づける
    $query = $this->db->insert("chat", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function add_workchats($day)
  {
    //add_chatsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "myworker_id" => $this->input->post("myworker_id"),
      "youoffice_id" => $this->input->post("youoffice_id"),
      "message" => $this->input->post("message"),
      "insert_time" => $day
    ];
    //$dataをDB内のchatに挿入後に、$queryと紐づける
    $query = $this->db->insert("chat", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  //チャット
  public function getchats($id, $opponent)
  {
    $this->db->or_where('myoffice_id', $id);
    $this->db->or_where('myworker_id', $opponent);
    $this->db->or_where('youoffice_id', $id);
    $this->db->or_where('youworker_id', $opponent);
    $this->db->order_by('chat_id', 'DESC');
    $chats = $this->db->get('chat');
    return $chats->result_array();
  }
  //事業者受信一覧
  public function getoffice_maxid($id)
  {
    $this->db->select_max('chat_id');
    $this->db->where('youworker_id', $id);
    $this->db->group_by("myoffice_id");
    $maxid = $this->db->get('chat');
    return $maxid->result_array();
  }
  public function getoffice($maxid)
  {
    $this->db->select('*');
    $this->db->from('office');
    $this->db->join('chat', 'office.id = chat.myoffice_id');
    $this->db->where_in('chat_id', $maxid);
    $this->db->order_by('chat_id', 'DESC');
    $chat = $this->db->get();
    return $chat->result_array();
  }
  //求職者受信一覧
  public function getworker_maxid($id)
  {
    $this->db->select_max('chat_id'); //chat_idの最大値を取っている
    $this->db->where('youoffice_id', $id); //自分のidを取っている
    $this->db->where_in('youoffice_id', $id);
    $this->db->group_by("myworker_id"); //相手のidを取っている
    $maxid = $this->db->get('chat');
    return $maxid->result_array();
  }
  public function getworker($maxid)
  {
    $this->db->select('*');
    $this->db->from('worker');
    $this->db->join('chat', 'worker.id = chat.myworker_id');
    $this->db->where_in('chat_id', $maxid);
    $this->db->order_by('chat_id', 'DESC');
    $chat = $this->db->get();
    return $chat->result_array();
  }

  public function getchatmessage($maxid)
  {
    $this->db->select('*');
    $this->db->from('chat');
    // $this->db->join('chat', 'office.id = chat.myoffice_id');
    $this->db->where_in('chat_id', $maxid);
    $this->db->order_by('chat_id', 'DESC');
    $chat = $this->db->get();
    return $chat->result_array();
  }

  //求職者から送信した方
  public function getoffices_maxid($id)
  {
    $this->db->select_max('chat_id');
    $this->db->where('myworker_id', $id);
    $this->db->group_by("youoffice_id");
    $maxid = $this->db->get('chat');
    return $maxid->result_array();
  }

  public function getoffices($maxid3)
  {
    $this->db->select('*');
    $this->db->from('office');
    $this->db->join('chat', 'office.id = chat.youoffice_id');
    $this->db->where_in('chat_id', $maxid3);
    $this->db->order_by('chat_id', 'DESC');
    $chat = $this->db->get();
    return $chat->result_array();
  }

  public function getworkers_maxid($id)
  {
    $this->db->select_max('chat_id'); //chat_idの最大値を取っている
    $this->db->where('myoffice_id', $id); //自分のidを取っている
    $this->db->group_by("youworker_id"); //相手のidを取っている
    $maxid = $this->db->get('chat');
    return $maxid->result_array();
  }

  public function getworkers($maxid3)
  {
    $this->db->select('*');
    $this->db->from('worker');
    $this->db->join('chat', 'worker.id = chat.youworker_id');
    $this->db->where_in('chat_id', $maxid3);
    $this->db->order_by('chat_id', 'DESC');
    $chat = $this->db->get();
    return $chat->result_array();
  }
}
