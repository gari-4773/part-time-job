<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Email extends CI_Controller
{
	//事業者メールアドレス変更
	public function mail_validation()
	{
		header("Content-type: application/json; charset=UTF-8");
		$this->load->library("form_validation");
		$config = [
			[
				"field" => "mail",
				"label" => "メールアドレス",
				"rules" => "trim|required|valid_email",
				"errors" => [
					"required" => "メールアドレスは入力必須です。",
					"valid_email" => "メールアドレスが不正です。"
				]
			]
		];
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			//ランダムキーを生成する
			$key = md5(uniqid());
			$to = $_POST['mail'];
			$subject = "メール変更について。";
			$body = "メール変更受け付けました。\n";
			$body .= "<'" . base_url() . "index.php/mail/check_office_mail/$key'>\nこちらをクリックして、登録を完了してください。ただし、こちらのURLは60分を過ぎると無効になりますのでご注意下さい。\n\n";
			$body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
			$team['id'] = $this->input->post("id");
			$this->load->model("model_temporary");
			if ($this->model_temporary->add_mail($key, $team)) {
				$this->load->library('mailclass');
				$this->mailclass->php_mailer($to, NULL, $subject, $body);
				$array = ['success' => true];
			} else {
				echo "送信できませんでした。";
			}
		} else {
			$array = [
				'error' => true,
				'mail_error' => form_error('mail')
			];
		}
		exit(json_encode($array));
	}
	//求職者メールアドレス変更
	public function work_mail_validation()
	{
		header("Content-type: application/json; charset=UTF-8");
		$this->load->library("form_validation");
		$config = [
			[
				"field" => "mail",
				"label" => "メールアドレス",
				"rules" => "trim|required|valid_email",
				"errors" => [
					"required" => "メールアドレスは入力必須です。",
					"valid_email" => "メールアドレスが不正です。"
				]
			]
		];
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			//ランダムキーを生成する
			$key = md5(uniqid());
			$to = $_POST['mail'];
			$subject = "メール変更について。";
			$body = "メール変更受け付けました。\n";
			$body .= "<'" . base_url() . "index.php/mail/check_worker_mail/$key'>\nこちらをクリックして、登録を完了してください。ただし、こちらのURLは60分を過ぎると無効になりますのでご注意下さい。\n\n";
			$body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
			$team['id'] = $this->input->post("id");
			$this->load->model("model_temporary");
			if ($this->model_temporary->add_mail($key, $team)) {
				$this->load->library('mailclass');
				$this->mailclass->php_mailer($to, NULL, $subject, $body);
				$array = ['success' => true];
			} else {
				echo "送信できませんでした。";
			}
		} else {
			$array = [
				'error' => true,
				'mail_error' => form_error('mail')
			];
		}
		exit(json_encode($array));
	}
	//事業者パスワード変更
	public function email_validation()
	{
		header("Content-type: application/json; charset=UTF-8");
		$this->load->library("form_validation");
		$config = [
			[
				"field" => "mail",
				"label" => "メールアドレス",
				"rules" => "trim|required|valid_email",
				"errors" => [
					"required" => "メールアドレスは入力必須です。",
					"valid_email" => "メールアドレスが不正です。"
				]
			]
		];
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			//ランダムキーを生成する
			$key = md5(uniqid());
			$to = $_POST['mail'];
			$subject = "パスワード変更について";
			$body = "パスワード変更受け付けました\n";
			$body .= "<'" . base_url() . "index.php/password/check_office_pass/$key'>\nこちらをクリックして、登録を完了してください。ただし、こちらのURLは60分を過ぎると無効になりますのでご注意下さい。\n\n";
			$body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
			$this->load->model("model_office");
			$team['id'] = $this->model_office->get_id($to);
			if (!empty($team['id'])) {
				$this->load->model("model_temporary");
				if ($this->model_temporary->add_mail($key, $team)) {
					$this->load->library('mailclass');
					$this->mailclass->php_mailer($to, NULL, $subject, $body);
					$array = ['success' => true];
				} else {
					echo "送信できませんでした。";
				}
			} else {
				$array = ['error' => true];
			}
		} else {
			$array = [
				'error' => true,
				'mail_error' => form_error('mail')
			];
		}
		exit(json_encode($array));
	}
	//求職者パスワード変更
	public function work_email_validation()
	{
		header("Content-type: application/json; charset=UTF-8");
		$this->load->library("form_validation");
		$config = [
			[
				"field" => "mail",
				"label" => "メールアドレス",
				"rules" => "trim|required|valid_email",
				"errors" => [
					"required" => "メールアドレスは入力必須です。",
					"valid_email" => "メールアドレスが不正です。"
				]
			]
		];
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			//ランダムキーを生成する
			$key = md5(uniqid());
			$to = $_POST['mail'];
			$subject = "パスワード変更について";
			$body = "パスワード変更受け付けました\n";
			$body .= "<'" . base_url() . "index.php/password/check_worker_pass/$key'>\nこちらをクリックして、登録を完了してください。ただし、こちらのURLは60分を過ぎると無効になりますのでご注意下さい。\n\n";
			$body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
			$this->load->model("model_worker");
			$team['id'] = $this->model_worker->get_id($to);
			if (!empty($team['id'])) {
				$this->load->model("model_temporary");
				if ($this->model_temporary->add_mail($key, $team)) {
					$this->load->library('mailclass');
					$this->mailclass->php_mailer($to, NULL, $subject, $body);
					$array = ['success' => true];
				} else {
					echo "送信できませんでした。";
				}
			} else {
				$array = [
					'error' => true,
					'mail_error' => ''
				];
			}
		} else {
			$array = [
				'error' => true,
				'mail_error' => form_error('mail')
			];
		}
		exit(json_encode($array));
	}
	public function transfer_mail()
	{
		$id = $_SESSION['id'];
		$this->load->model("model_office");
		$row = $this->model_office->get_flag($id);
		if (!$this->session->userdata("is_logged_in") || $row != 0) {
			redirect("main/login");
			return;
		}
		$this->output->set_header('X-Frame-Options: DENY', false);
		$worker_id = $this->input->post("id");
		$this->load->model('model_worker');
		$worker = $this->model_worker->get_email($worker_id);
		$to = $_SESSION['mail'];
		$subject = "マッチング申請を承りました。";
		$body = "いつもEISバイトマッチングサービスをご利用いただきありがとうございます。\n";
		$body .= "-------------------------------------------------------------------\n\n";
		$body .= "マッチングに伴う決済が完了しましたら、".$worker[0]['name']."様とのマッチング処理をさせていただきたいと存じます。\nつきましては、下記の銀行口座に振込をお願いします。\n\n";
		$body .= "振込先：○○銀行\n\n";
		$body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
		$this->load->library('mailclass');
    	$this->mailclass->php_mailer($to,NULL,$subject,$body);
		exit(json_encode(['mail' => '送信完了']));
	}
}
