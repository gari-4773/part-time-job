<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Upload extends CI_Controller
{
  //本登録から事業者画像アップロードフォーム
  public function office_upload()
  {
    $img['id'] = $this->input->get('id');
    $img['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/upload", $img);
  }
  //本登録から求職者画像アップロードフォーム
  public function worker_upload()
  {
    $img['id'] = $this->input->get('id');
    $img['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/work_upload", $img);
  }
  //事業者画像アップロードフォーム
  public function office_update()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_office");
    $row = $this->model_office->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("main/login");
      return;
    }
    $img['id'] = $this->input->get('id');
    $img['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/upload", $img);
  }
  //求職者画像アップロードフォーム
  public function worker_update()
  {
    $id = $_SESSION['id'];
    $this->load->model("model_worker");
    $row = $this->model_worker->get_flag($id);
    if (!$this->session->userdata("is_logged_in") || $row != 0) {
      redirect("worker/login");
      return;
    }
    $img['id'] = $this->input->get('id');
    $img['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );
    $this->load->view("signup/work_upload", $img);
  }
  //事業者画像アップロード処理
  public function office_imgupload()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "img",
        "label" => "ファイル",
        "rules" => "callback_validate_image|callback_image_extension|callback_image_size"
      ]
    ];
    $this->form_validation->set_rules($config);
    $config = array(
      'upload_path' => './assets/images/office/',
      'allowed_types' => 'gif|jpg|png',
      'overwrite' => true,
      'encrypt_name' => true,
      'remove_spaces' => true
    );
    $this->load->library('upload', $config);
    if ($this->form_validation->run()) {
      $this->upload->do_upload('img');
      $datas = array('upload_data' => $this->upload->data());
      foreach ($datas as $upload_data) {
        $config = array(
          "source_image" => $upload_data['full_path'],
          "new_image" => './assets/images/resize_office/',
          "maintain_ratio" => true,
          "width" => 300,
          "height" => 300
        );
      }
      $this->load->library("image_lib", $config);
      $this->image_lib->resize();
      $this->load->model("model_offices");
      if ($this->model_offices->add_img($datas)) {
        $array = ['success' => true];
      } else {
        echo "本登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'img_error' => form_error('img')
      ];
    }
    exit(json_encode($array));
  }
  //求職者画像アップロード処理
  public function worker_imgupload()
  {
    header("Content-type: application/json; charset=UTF-8");
    $this->load->library("form_validation");
    $config = [
      [
        "field" => "img",
        "label" => "ファイル",
        "rules" => "callback_validate_image|callback_image_extension|callback_image_size"
      ]
    ];
    $this->form_validation->set_rules($config);
    $config = array(
      'upload_path' => './assets/images/work/',
      'allowed_types' => 'gif|jpg|png',
      'overwrite' => true,
      'encrypt_name' => true,
      'remove_spaces' => true
    );
    $this->load->library('upload', $config);
    if ($this->form_validation->run()) {
      $this->upload->do_upload('img');
      $datas = array('upload_data' => $this->upload->data());
      foreach ($datas as $upload_data) {
        $config = array(
          "source_image" => $upload_data['full_path'],
          "new_image" => './assets/images/resize_work/',
          "maintain_ratio" => true,
          "width" => 300,
          "height" => 300
        );
      }
      $this->load->library("image_lib", $config);
      $this->image_lib->resize();
      $this->load->model("model_workers");
      if ($this->model_workers->add_img($datas)) {
        $array = ['success' => true];
      } else {
        echo "本登録できませんでした。";
      }
    } else {
      $array = [
        'error' => true,
        'img_error' => form_error('img')
      ];
    }
    exit(json_encode($array));
  }
  public function validate_image()
  {
    if ((!isset($_FILES['img'])) || $_FILES['img']['size'] == 0) {
      $this->form_validation->set_message('validate_image', 'ファイルを選択してください。');
      return false;
    } else {
      return true;
    }
  }
  public function image_extension()
  {
    if (isset($_FILES['img']) && $_FILES['img']['size'] != 0) {
      $allowedExts = array("jpeg", "jpg", "png", "JPG", "JPEG", "PNG");
      $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
    }
    if (!in_array($ext, $allowedExts)) {
      $this->form_validation->set_message('image_extension', "無効な拡張子です。<br>(利用可能拡張子:jpeg,jpg,png)");
      return false;
    }
    return true;
  }
  public function image_size()
  {
    $check = TRUE;
    if (filesize($_FILES['img']['tmp_name']) > 2000000) {
      $this->form_validation->set_message('image_size', 'ファイルサイズは上限20MBです。');
      $check = FALSE;
    }
    return $check;
  }
}
