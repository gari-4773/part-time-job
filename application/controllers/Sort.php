<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sort extends CI_Controller
{
  public function hopejob_sort()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $job = $this->input->post('jobs');
    $this->load->model("model_sort");
    $player['job_array'] = $this->model_sort->get_hopejob($job);
    $clean_player = html_escape($player);
    $clean_player['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("work/worksort_matching", $clean_player);
  }
  public function job_sort()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }
    $this->output->set_header('X-Frame-Options: DENY');
    $job = $this->input->post('jobs');
    $this->load->model("model_sort");
    $player['job_array'] = $this->model_sort->get_job($job);
    $clean_player = html_escape($player);
    $clean_player['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("job/sort_matching", $clean_player);
  }
  public function job_detail_sort()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }

    if(empty($this->input->get('per_page'))){
      $newdata=[
        "jobs"=>$this->input->post('jobs'),
        "area"=>$this->input->post('area'),
        "employment"=>$this->input->post('employment'),
        "shift"=>(int)$this->input->post('shift'),
        "time"=>(int)$this->input->post('time'),
        "salary"=>$this->input->post('salary'),
        "salarys"=>(int)$this->input->post('salarys'),
        "treatment"=>$this->input->post('treatment'),
        "emvironment"=>$this->input->post('emvironment'),
        "welcome"=>$this->input->post('welcome'),
        "form"=>$this->input->post('form'),
      ];
      $this->session->set_userdata($newdata);
      }

    $this->output->set_header('X-Frame-Options: DENY');
    $limit = 5;
    if(!$this->input->get('per_page')){
      $offset=0;
    }else{
      $offset = (int)$this->input->get('per_page') ;
    }

    $this->load->model("model_sort");
    $player['job_array'] = $this->model_sort->detail_hopejob($limit,$offset,$newdata);
    $jobs_count = $this->model_sort->detail_hopejobs();

    $clean_player['sorts'] = html_escape($newdata);
    $clean_player = html_escape($player);
    $clean_player['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $clean_player['sort_pagination'] = $this->setPage($limit,$jobs_count);
    $this->load->view("sort/works_sort", $clean_player);
  }
  public function setPage($limit,$num)
    {
        $this->load->Library("pagination");
        $config['base_url']='http://yakyu.com/index.php/sort/job_detail_sorts/';
        $config['total_rows']=$num;
        $config['per_page'] = $limit;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function job_detail_sorts()
    {
      $id = $_SESSION['id'];
      $this->load->model("model_worker");
      $row = $this->model_worker->get_flag($id);
      if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }

    $this->output->set_header('X-Frame-Options: DENY');
    $limit = 5;
    if(!$this->input->get('per_page')){
      $offset=0;
    }else{
      $offset = (int)$this->input->get('per_page') ;
    }
    $newdata = $_SESSION;

    $this->load->model("model_sort");
    $player['job_array'] = $this->model_sort->detail_hopejob($limit,$offset);
    $jobs_count = $this->model_sort->detail_hopejobs($newdata);

    $clean_player = html_escape($player);
    $clean_player['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $clean_player['sort_pagination'] = $this->setPage($limit,$jobs_count);
    $this->load->view("sort/works_sort", $clean_player);
    }

    public function worker_detail_sort()
    {
      $id = $_SESSION['id'];
      $this->load->model("model_worker");
      $row = $this->model_worker->get_flag($id);
      if (!$this->session->userdata("is_logged_in") || $row != 0) {
        redirect("worker/login");
        return;
      }

      if(empty($this->input->get('per_page'))){
        $sortwork=[
          "jobs"=>$this->input->post('jobs')
        ];
        $this->session->set_userdata($sortwork);
      }

      $this->output->set_header('X-Frame-Options: DENY');
      $limit = 5;
      if(!$this->input->get('per_page')){
        $offset=0;
      }else{
        $offset = (int)$this->input->get('per_page') ;
      }

      $this->load->model("model_sort");
      $player['worker_array'] = $this->model_sort->detail_hopeworker($limit,$offset);
      $workers_count = $this->model_sort->detail_hopeworkers();
      $clean_player = html_escape($sortwork);
      $clean_player = html_escape($player);
      $clean_player['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $clean_player['sort_pagination'] = $this->setPages($limit,$workers_count);
      $this->load->view('common/header');
      $this->load->view("work/work_matching", $clean_player);
      $this->load->view('common/footer');
    }
    public function setPages($limit,$num)
    {
        $this->load->Library("pagination");
        $config['base_url']='http://yakyu.com/index.php/sort/worker_detail_sorts/';
        $config['total_rows']=$num;
        $config['per_page'] = $limit;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function worker_detail_sorts()
    {
      $id = $_SESSION['id'];
      $this->load->model("model_worker");
      $row = $this->model_worker->get_flag($id);
      if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }

    $this->output->set_header('X-Frame-Options: DENY');
    $limit = 5;
    if(!$this->input->get('per_page')){
      $offset=0;
    }else{
      $offset = (int)$this->input->get('per_page') ;
    }
    $sortwork = $_SESSION;

    $this->load->model("model_sort");
    $player['worker_array'] = $this->model_sort->detail_hopeworker($limit,$offset);
    $workers_count = $this->model_sort->detail_hopeworkers($sortwork);

    $clean_player = html_escape($player);
    $clean_player['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $clean_player['sort_pagination'] = $this->setPages($limit,$workers_count);
    $this->load->view('common/header');
    $this->load->view("work/work_matching", $clean_player);
    $this->load->view('common/footer');
    }

    public function top_sorts(){
      if(empty($this->input->get('per_page'))){
        $newdata=[
          "search"=>$this->input->post('search'),
          "jobs"=>$this->input->post('jobs'),
          "area"=>$this->input->post('area'),
          "employment"=>$this->input->post('employment'),
          "shift"=>(int)$this->input->post('shift'),
          "time"=>(int)$this->input->post('time'),
          "salary"=>$this->input->post('salary'),
          "salarys"=>(int)$this->input->post('salarys'),
          "treatment"=>$this->input->post('treatment'),
          "emvironment"=>$this->input->post('emvironment'),
          "welcome"=>$this->input->post('welcome'),
          "form"=>$this->input->post('form'),
        ];
        $this->session->set_userdata($newdata);
        }

      $this->output->set_header('X-Frame-Options: DENY');
      $limit = 5;
      if(!$this->input->get('per_page')){
        $offset=0;
      }else{
        $offset = (int)$this->input->get('per_page') ;
      }

      $this->load->model("model_sort");
      $player['job_array'] = $this->model_sort->top_detail_hopejob($limit,$offset,$newdata);
      $jobs_count = $this->model_sort->top_detail_hopejobs();

      $clean_player['sorts'] = html_escape($newdata);
      $clean_player = html_escape($player);
      $clean_player['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $clean_player['sort_pagination'] = $this->top_setPage($limit,$jobs_count);
      $this->load->view("sort/top_sort", $clean_player);
    }

      public function top_setPage($limit,$num)
      {
          $this->load->Library("pagination");
          $config['base_url']='http://yakyu.com/index.php/sort/top_detail_sorts/';
          $config['total_rows']=$num;
          $config['per_page'] = $limit;
          $config['reuse_query_string'] = TRUE;
          $config['page_query_string'] = TRUE;
          $this->pagination->initialize($config);
          return $this->pagination->create_links();
      }

      public function top_detail_sorts()
      {
      $this->output->set_header('X-Frame-Options: DENY');
      $limit = 5;
      if(!$this->input->get('per_page')){
        $offset=0;
      }else{
        $offset = (int)$this->input->get('per_page') ;
      }
      $newdata = $_SESSION;

      $this->load->model("model_sort");
      $player['job_array'] = $this->model_sort->detail_hopejob($limit,$offset);
      $jobs_count = $this->model_sort->detail_hopejobs($newdata);

      $clean_player = html_escape($player);
      $clean_player['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $clean_player['sort_pagination'] = $this->top_setPages($limit,$jobs_count);
      $this->load->view("sort/top_sort", $clean_player);
      }
  public function top_detail_sort()
  {

    if(empty($this->input->get('per_page'))){
      $newdata=[
        "jobs"=>$this->input->post('jobs'),
        "area"=>$this->input->post('area'),
        "employment"=>$this->input->post('employment'),
        "shift"=>(int)$this->input->post('shift'),
        "time"=>(int)$this->input->post('time'),
        "salary"=>$this->input->post('salary'),
        "salarys"=>(int)$this->input->post('salarys'),
        "treatment"=>$this->input->post('treatment'),
        "emvironment"=>$this->input->post('emvironment'),
        "welcome"=>$this->input->post('welcome'),
        "form"=>$this->input->post('form'),
      ];
      $this->session->set_userdata($newdata);
      }

    $this->output->set_header('X-Frame-Options: DENY');
    $limit = 5;
    if(!$this->input->get('per_page')){
      $offset=0;
    }else{
      $offset = (int)$this->input->get('per_page') ;
    }

    $this->load->model("model_sort");
    $player['job_array'] = $this->model_sort->detail_hopejob($limit,$offset,$newdata);
    $jobs_count = $this->model_sort->detail_hopejobs();

    $clean_player['sorts'] = html_escape($newdata);
    $clean_player = html_escape($player);
    $clean_player['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $clean_player['sort_pagination'] = $this->top_setPages($limit,$jobs_count);
    $this->load->view("sort/top_sort", $clean_player);
  }
  public function top_setPages($limit,$num)
    {
        $this->load->Library("pagination");
        $config['base_url']='http://yakyu.com/index.php/sort/top_detail_sorts/';
        $config['total_rows']=$num;
        $config['per_page'] = $limit;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}