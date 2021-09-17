<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_sort extends CI_Model
{
  public function get_job($job)
  {
    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');
    $this->db->where('job', $job);
    $job = $this->db->get();
    return $job->result_array();
  }
  public function get_hopejob($job)
  {
    if($job === "全て"){
      $this->db->where(1,1);
    }else{
      $this->db->where('hope_work', $job);
    }
    $job = $this->db->get('worker');
    return $job->result_array();  //特定チームを表示
  }

  public function detail_hopejob($limit,$offset)
  {
    $job=$this->session->userdata('jobs');
    $area=$this->session->userdata('area');
    $employment=$this->session->userdata('employment');
    $shift=(int)$this->session->userdata('shift');
    $time=(int)$this->session->userdata('time');
    $salary = $this->session->userdata('salary');
    $salarys = (int)$this->session->userdata('salarys');
    $treatment = $this->session->userdata("treatment");
    $emvironment = $this->session->userdata("emvironment");
    $welcome = $this->session->userdata("welcome");
    $form = $this->session->userdata("form");

    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');

    if($job!="全て" && !empty($job)){
      $this->db->where('category',$job);
    }

    if(!empty($treatment)){
      foreach($treatment as $value){
        $this->db->like('treatment',$value);
      }
    }
    if(!empty($emvironment)){
      foreach($emvironment as $value){
        $this->db->like('emvironment',$value);
      }
    }
    if(!empty($welcome)){
      foreach($welcome as $value){
        $this->db->like('welcome',$value);
      }
    }
    if(!empty($form)){
      foreach($form as $value){
        $this->db->like('form',$value);
      }
    }
    $areas=["松山市","松前町","伊予市","東温市"];
    if($area==="その他"){
      $this->db->where_not_in('address',$areas);
    }elseif(!empty($area)){
      $this->db->where_in('address',$area);
    }else{
      $this->db->where(1,1);
    }

    if(!empty($salary)){
      $this->db->where('salarys', $salary);
    }

    if(!empty($salarys)){
      $this->db->where('money >=', $salarys);
    }

    if(!empty($employment)){
      $this->db->where_in('employment', $employment);
    }

    if(!empty($shift)){
      $this->db->where('shift>=', $shift);
    }

    if(!empty($time)){
      $this->db->where('time>=', $time);
    }
    $this->db->limit($limit,$offset);
    $job = $this->db->get();
    return $job->result_array();
  }

  public function detail_hopejobs()
  {
    $job = $this->session->userdata('jobs');
    $area=$this->session->userdata('area');
    $employment=$this->session->userdata('employment');
    $shift=(int)$this->session->userdata('shift');
    $time=(int)$this->session->userdata('time');
    $salary = $this->session->userdata('salary');
    $salarys = (int)$this->session->userdata('salarys');
    $treatment = $this->session->userdata("treatment");
    $emvironment = $this->session->userdata("emvironment");
    $welcome = $this->session->userdata("welcome");
    $form = $this->session->userdata("form");

    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');
    if($job!="全て" && !empty($job)){
      $this->db->where('category', $job);
    }
    if(!empty($treatment)){
      foreach($treatment as $value){
        $this->db->like('treatment',$value);
      }
    }
    if(!empty($emvironment)){
      foreach($emvironment as $value){
        $this->db->like('emvironment',$value);
      }
    }
    if(!empty($welcome)){
      foreach($welcome as $value){
        $this->db->like('welcome',$value);
      }
    }
    if(!empty($form)){
      foreach($form as $value){
        $this->db->like('form',$value);
      }
    }
    $areas=["松山市","松前町","伊予市","東温市"];
    if($area==="その他"){
      $this->db->where_not_in('address',$areas);
    }elseif(!empty($area)){
      $this->db->where_in('address',$area);
    }else{
      $this->db->where(1,1);
    }

    if(!empty($salary)){
      $this->db->where('salarys', $salary);
    }

    if(!empty($salarys)){
      $this->db->where('money >=', $salarys);
    }

    if(!empty($employment)){
      $this->db->where_in('employment', $employment);
    }

    if(!empty($shift)){
      $this->db->where('shift>=', $shift);
    }

    if(!empty($time)){
      $this->db->where('time>=', $time);
    }

    return $this->db->count_all_results();
  }
  //事業者側の求職者検索機能
  public function detail_hopeworker($limit,$offset)
  {
    $job=$this->session->userdata('jobs');

    $this->db->select('*');
    $this->db->from('worker');
    if($job!="全て" && !empty($job)){
      $this->db->where('hope_work',$job);
    }
    $this->db->limit($limit,$offset);
    $worker = $this->db->get();
    return $worker->result_array();
  }
  //事業者側の求職者検索機能(検索件数)
  public function detail_hopeworkers()
  {
    $job = $this->session->userdata('jobs');

    $this->db->select('*');
    $this->db->from('worker');
    if($job!="全て" && !empty($job)){
      $this->db->where('hope_work', $job);
    }
    return $this->db->count_all_results();
  }
  public function top_detail_hopejob($limit,$offset)
  {
    $search=$this->session->userdata('search');
    $job=$this->session->userdata('jobs');
    $area=$this->session->userdata('area');
    $employment=$this->session->userdata('employment');
    $treatment = $this->session->userdata("treatment");
    $emvironment = $this->session->userdata("emvironment");
    $welcome = $this->session->userdata("welcome");
    $form = $this->session->userdata("form");

    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');

    if(!empty($search)){
        $this->db->like('treatment',$search);
        $this->db->or_like('emvironment',$search);
        $this->db->or_like('welcome',$search);
        $this->db->or_like('form',$search);
        $this->db->or_like('work',$search);
        $this->db->or_like('branch',$search);
        $this->db->or_like('office',$search);
      }

    if(!empty($job)){
      foreach($job as $value){
        $this->db->like('category',$value);
      }
    }


    if(!empty($treatment)){
      foreach($treatment as $value){
        $this->db->like('treatment',$value);
      }
    }
    if(!empty($emvironment)){
      foreach($emvironment as $value){
        $this->db->like('emvironment',$value);
      }
    }
    if(!empty($welcome)){
      foreach($welcome as $value){
        $this->db->like('welcome',$value);
      }
    }
    if(!empty($form)){
      foreach($form as $value){
        $this->db->like('form',$value);
      }
    }
    $areas=["松山市","松前町","伊予市","東温市"];
    if($area==="その他"){
      $this->db->where_not_in('address',$areas);
    }elseif(!empty($area)){
      $this->db->where_in('address',$area);
    }else{
      $this->db->where(1,1);
    }


    if(!empty($employment)){
      $this->db->where_in('employment', $employment);
    }


    $this->db->limit($limit,$offset);
    $job = $this->db->get();
    return $job->result_array();
  }

  public function top_detail_hopejobs()
  {
    $job = $this->session->userdata('jobs');
    $area=$this->session->userdata('area');
    $employment=$this->session->userdata('employment');
    $treatment = $this->session->userdata("treatment");
    $emvironment = $this->session->userdata("emvironment");
    $welcome = $this->session->userdata("welcome");
    $form = $this->session->userdata("form");

    $this->db->select('*');
    $this->db->from('jobs');
    $this->db->join('office', 'office.id = jobs.office_id');

    if(!empty($job)){
      foreach($job as $value){
        $this->db->like('category',$value);
      }
    }
    if(!empty($treatment)){
      foreach($treatment as $value){
        $this->db->like('treatment',$value);
      }
    }
    if(!empty($emvironment)){
      foreach($emvironment as $value){
        $this->db->like('emvironment',$value);
      }
    }
    if(!empty($welcome)){
      foreach($welcome as $value){
        $this->db->like('welcome',$value);
      }
    }
    if(!empty($form)){
      foreach($form as $value){
        $this->db->like('form',$value);
      }
    }
    $areas=["松山市","松前町","伊予市","東温市"];
    if($area==="その他"){
      $this->db->where_not_in('address',$areas);
    }elseif(!empty($area)){
      $this->db->where_in('address',$area);
    }else{
      $this->db->where(1,1);
    }

    if(!empty($employment)){
      $this->db->where_in('employment', $employment);
    }

    return $this->db->count_all_results();
  }
}