<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_jobs extends CI_Model
{
  public function add_jobs($day)
  {
    //add_jobsのモデルの実行時に、以下のデータを取得して、$dataと紐づける
    $data = [
      "office_id" => $this->input->post("office_id"),
      "work" => $this->input->post("work"),
      "jobname" => $this->input->post("jobname"),
      "time" => $this->input->post("time"),
      "money" => $this->input->post("money"),
      "branch" => $this->input->post("branch"),
      "access" => $this->input->post("access"),
      "skill" => $this->input->post("skill"),
      "remarks" => $this->input->post("remarks"),
      "shift" => $this->input->post("shift"),
      "category" => $this->input->post("category"),
      "address" => $this->input->post("address"),
      "employment" => $this->input->post("employment"),
      "salarys" => $this->input->post("salarys"),
      "treatment" => $this->input->post("treatment"),
      "emvironment" => $this->input->post("emvironment"),
      "welcome" => $this->input->post("welcome"),
      "form" => $this->input->post("form"),
      "school" => $this->input->post("school"),
      "salary" => $this->input->post("salary"),
      "insert_time" => $day
    ];
    //$dataをDB内のjobsに挿入後に、$queryと紐づける
    $query = $this->db->insert("jobs", $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  public function getjobs($id)
  {
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->where('office_id', $id);
    $jobs = $this->db->get();
    return $jobs->result_array();
  }
  public function gethopejobs($hope)
  {
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');
    $this->db->where('job', $hope);
    $this->db->where('delete_job', 0);
    $job = $this->db->get();
    return $job->result_array();
  }
  public function getalljobs()
  {
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');
    $this->db->where('delete_job', 0);
    $this->db->order_by('login_time', 'DESC');
    $job = $this->db->get();
    return $job->result_array();
  }
  public function getofficejob($id)
  {
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');
    $this->db->where('job_id', $id);
    $job = $this->db->get();
    return $job->row_array();
  }
  public function getjoblist($id)
  {
    $this->db->where('office_id', $id);
    $job = $this->db->get('jobs');
    return $job->result_array();
  }
  public function get_job($id)
  {
    $this->db->where('job_id', $id);
    $player = $this->db->get('jobs');
    return $player->row_array();  //特定選手を表示
  }
  public function update_job($day)
  {
    //update_playerのモデルの実行時、以下のデータを取得して、$dateと紐づける
    $data = [
      "work" => $this->input->post("work"),
      "time" => $this->input->post("time"),
      "money" => $this->input->post("money"),
      "branch" => $this->input->post("branch"),
      "access" => $this->input->post("access"),
      "skill" => $this->input->post("skill"),
      "remarks" => $this->input->post("remarks"),
      "shift" => $this->input->post("shift"),
      "address" => $this->input->post("address"),
      "employment" => $this->input->post("employment"),
      "school" => $this->input->post("school"),
      "category" => $this->input->post("category"),
      "salary" => $this->input->post("salary"),
      "salarys" => $this->input->post("salarys"),
      "treatment" => $this->input->post("treatment"),
      "emvironment" => $this->input->post("emvironment"),
      "welcome" => $this->input->post("welcome"),
      "form" => $this->input->post("form"),
      "update_time" => $day
    ];
    //$dateをDB内の特定jobsに挿入(更新)する
    return $this->db->where('job_id', $this->input->post("job_id"))
      ->update('jobs', $data);
  }
  public function job_delete($day)
  {
    //フラグを立てて画面非表示にする
    $date = [
      "delete_job" => 1,
      "update_time" => $day
    ];
    return $this->db->where('job_id', $this->input->post("delete_id"))
      ->update('jobs', $date);
  }
  public function return_job($day)
  {
    //フラグを立てて画面表示にする
    $date = [
      "delete_job" => 0,
      "update_time" => $day
    ];
    return $this->db->where('job_id', $this->input->post("return_id"))
      ->update('jobs', $date);
  }
  public function real_delete()
  {
    return $this->db->where('job_id', $this->input->post("delete_id"))
      ->delete('jobs');
  }

  public function getalljobslist($limit,$offset)
  {
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');
    $this->db->where('delete_job', 0);
    $this->db->limit($limit,$offset);
    $job = $this->db->get();
    return $job->result_array();
  }

  public function getcountjobs()
  {
    $this->db->where('delete_job', 0);
    $count = $this->db->count_all_results('jobs');
    return $count;
  }


  public function get_not_matching_jobs($id, $worker_id){
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('matching', 'matching.office_id = jobs.office_id');
    $this->db->where('office_id', $id);
    $this->db->where('partner_flag', 0);
    $this->db->where('worker_id', $worker_id);
    $jobs = $this->db->get();
    return $jobs->result_array();
  }

  public function getjobs_id($job_id,$id)
  {
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->where('office_id',$id);
    $this->db->where_not_in('job_id',$job_id);
    $jobs = $this->db->get();
    return $jobs->result_array();
  }

  public function get_job_name($job_name){
    $this->db->select('job_id');
    $this->db->from('jobs');
    $this->db->where('jobname',$job_name);
    $jobs = $this->db->get();
    return $jobs->result_array();
  }
}
