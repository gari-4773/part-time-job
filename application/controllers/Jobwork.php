<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jobwork extends CI_Controller
{
    //求人登録
    public function register_validation()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "work",
                "label" => "仕事内容",
                "rules" => 'trim|required|max_length[100]',
                "errors" => [
                    "required" => "仕事内容は入力必須です。",
                    "max_length" => "仕事内容は100文字以内です。"
                ]
            ],
            [
                "field" => "jobname",
                "label" => "仕事内容",
                "rules" => 'trim|required|max_length[50]',
                "errors" => [
                    "required" => "求人名は入力必須です。",
                    "max_length" => "求人名は50文字以内です。"
                ]
            ],
            [
                "field" => "time",
                "label" => "労働時間",
                "rules" => 'trim|required',
                "errors" => [
                    "required" => "労働時間は選択必須です。"
                ]
            ],
            [
                "field" => "money",
                "label" => "単価",
                "rules" => 'trim|required|numeric|max_length[8]',
                "errors" => [
                    "required" => "単価は入力必須です。",
                    "numeric"  => "単価は半角数字のみで入力してください。",
                    "max_length"=>"単価は8桁以内で入力してください。"
                ]
            ],
            [
                "field" => "shift",
                "label" => "シフト",
                "rules" => "trim|required",
                "errors" => [
                    "required" => "シフトは選択必須です。"
                ]
            ],
            [
                "field" => "category",
                "label" => "業種",
                "rules" => "trim|required",
                "errors" => [
                    "required" => "業種は選択必須です。"
                ]
            ],
            [
                "field" => "address",
                "label" => "勤務地",
                "rules" => "trim|required",
                "errors" => [
                    "required" => "勤務地は選択必須です。"
                ]
            ],
            [
                "field" => "employment",
                "label" => "雇用形態",
                "rules" => "trim|required",
                "errors" => [
                    "required" => "雇用形態は選択必須です。"
                ]
            ],
            [
                "field" => "salarys",
                "label" => "給与区分",
                "rules" => "trim|required",
                "errors" => [
                    "required" => "給与区分は選択必須です。"
                ]
            ],
            [
                "field" => "school",
                "label" => "学歴",
                "rules" => "trim|required",
                "errors" => [
                    "required" => "学歴は選択必須です。"
                ]
            ],
            [
                "field" => "salary",
                "label" => "給与支払日",
                "rules" => "trim|required",
                "errors" => [
                    "required" => "給与支払日は選択必須です。"
                ]
            ],
            [
                "field" => "branch",
                "label" => "支店名",
                "rules" => "trim|max_length[50]",
                "errors" => [
                    "max_length" => "支店名は50文字以内で入力してください。"
                ]
            ],
            [
                "field" => "access",
                "label" => "アクセス",
                "rules" => "trim|max_length[200]",
                "errors" => [
                    "max_length" => "アクセスは200文字以内で入力してください。",
                ]
            ],
            [
                "field" => "skill",
                "label" => "資格",
                "rules" => "trim|max_length[200]",
                "errors" => [
                    "max_length" => "給与支払は200文字以内で入力してください。"
                ]
            ],
            [
                "field" => "remarks",
                "label" => "その他備考",
                "rules" => "trim|max_length[500]",
                "errors" => [
                    "max_length" => "待遇面その他は500文字以内で入力してください。"
                ]
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $day = date("Y-m-d H:i:s");
            $this->load->model("model_jobs");
            if ($this->model_jobs->add_jobs($day)) {
                $array = ['success' => true];
            } else {
                echo "求人登録できませんでした。";
            }
        } else {
            $array = [
                'error' => true,
                'work_error' => form_error('work'),
                'jobname_error' => form_error('jobname'),
                'time_error' => form_error('time'),
                'money_error' => form_error('money'),
                'shift_error' => form_error('shift'),
                'category_error' => form_error('category'),
                'address_error' => form_error('address'),
                'employment_error' => form_error('employment'),
                'salarys_error' => form_error('salarys'),
                'school_error' => form_error('school'),
                'salary_error' => form_error('salary'),
                'branch_error' => form_error('branch'),
                'access_error' => form_error('access'),
                'skill_error' => form_error('skill'),
                'remarks_error' => form_error('remarks')
            ];
        }
        exit(json_encode($array));
    }
    public function check_signup_worker($key)
    {
        $this->output->set_header('X-Frame-Options: DENY', false);
        $this->load->model("model_temporary");
        if ($this->model_temporary->is_valid_key($key)) {    //キーが正しい場合は、以下を実行
            $data["row_array"] = $this->model_temporary->is_valid_key($key);
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view("signup/work_master", $data);
        } else {
            echo "URLが間違っているか、アクセス期限が過ぎています。";
        }
    }
    //求職者本登録
    public function register_password()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "name",
                "label" => "氏名",
                "rules" => 'trim|required|max_length[30]',
                "errors" => [
                    "required" => "氏名は入力必須です。",
                    "max_length" => "氏名は30文字以内で入力してください。"
                ]
            ],
            [
                "field" => "nickname",
                "label" => "ニックネーム",
                "rules" => 'trim|required|max_length[30]',
                "errors" => [
                    "required" => "ニックネームは入力必須です。",
                    "max_length" => "ニックネームは30文字以内で入力してください。"
                ]
            ],
            [
                "field" => "birth",
                "label" => "生年",
                "rules" => "required",
                "errors" => [
                    "required" => "生年は選択必須です。"
                ]
            ],
            [
                "field" => "tel",
                "label" => "電話番号",
                "rules" => "trim|required|regex_match[/^[0-9]+$/]|min_length[10]|max_length[11]",
                "errors" => [
                    "required" => "電話番号は入力必須です。",
                    "regex_match" => "電話番号が不正です。",
                    "min_length" => "電話番号は10~11桁で入力してください。",
                    "max_length" => "電話番号は10~11桁で入力してください。"
                ]
            ],
            [
                "field" => "mail",
                "label" => "メールアドレス",
                "rules" => "trim|required|valid_email|is_unique[worker.mail]",
                "errors" => [
                    "required" => "メールアドレスは入力必須です。",
                    "valid_email" => "メールアドレスが不正です。",
                    "is_unique" => "既に登録されているメールアドレスです。"
                ]
            ],
            [
                "field" => "sex",
                "label" => "性別",
                "rules" => "required",
                "errors" => [
                    "required" => "性別は選択必須です。"
                ]
            ],
            [
                "field" => "school_year",
                "label" => "学年",
                "rules" => "required",
                "errors" => [
                    "required" => "学年は選択必須です。"
                ]
            ],
            [
                "field" => "address",
                "label" => "住所",
                "rules" => "required",
                "errors" => [
                    "required" => "住所は選択必須です。"
                ]
            ],
            [
                "field" => "schools",
                "label" => "最終学歴",
                "rules" => "required",
                "errors" => [
                    "required" => "最終学歴は選択必須です。"
                ]
            ],
            [
                "field" => "hope_work",
                "label" => "希望職種",
                "rules" => "required",
                "errors" => [
                    "required" => "希望職種は選択必須です。"
                ]
            ],
            [
                "field" => "skill",
                "label" => "資格",
                "rules" => 'trim|max_length[100]',
                "errors" => [
                    "max_length" => "資格・スキルは100文字以内で入力してください。"
                ]
            ],
            [
                "field" => "pass",
                "label" => "パスワード",
                "rules" => "trim|required|min_length[6]|alpha_numeric",
                "errors" => [
                    "required" => "パスワードは入力必須です。",
                    "min_length" => "パスワードは最低6文字以上にしてください。",
                    "alpha_numeric" => "パスワードは半角英数字のみにしてください。"
                ]
            ],
            [
                "field" => "chkpass",
                "label" => "パスワード確認",
                "rules" => "trim|required|matches[pass]",
                "errors" => [
                    "required" => "確認パスワードは入力必須です。",
                    "matches" => "上記と同じパスワードを入力してください。"
                ]
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $to = $this->input->post("mail");
            $subject = "本登録完了しました。";
            $body = "ご登録ありがとうございます。\n登録が完了しましたことをお知らせ致します。\n";
            $body .= "-------------------------------------------------------------------\nログイン時に必要な情報について\n ・メールアドレス：このメールアドレス\n ・パスワード：本登録時に入力したパスワード\n";
            $body .= "<'" . base_url() . "index.php/main/login'>\nこちらからログインして、本サービスをご利用ください。\n\n";
            $body .= "-------------------------------------------------------------------\nこちらのメールは送信専用です。返信はお控え下さいますよう、よろしくお願いします。\n\n";
            $this->load->model("model_workers");
            if ($this->model_workers->add_workers($to)) {
                $this->load->library('mailclass');
                $this->mailclass->php_mailer($to, NULL, $subject, $body);
                $this->load->model("model_worker");
                $worker['id'] = $this->model_worker->get_id($to);
                $array = [
                    'success' => true,
                    'id' => $worker['id']
                ];
            } else {
                echo "本登録できませんでした。";
            }
        } else {
            $array = [
                'error' => true,
                'name_error' => form_error('name'),
                'nickname_error' => form_error('nickname'),
                'birth_error' => form_error('birth'),
                'tel_error' => form_error('tel'),
                'mail_error' => form_error('mail'),
                'sex_error' => form_error('sex'),
                'schoolyear_error' => form_error('school_year'),
                'address_error' => form_error('address'),
                'schools_error' => form_error('schools'),
                'hopework_error' => form_error('hope_work'),
                'skill_error' => form_error('skill'),
                'pass_error' => form_error('pass'),
                'chkpass_error' => form_error('chkpass')
            ];
        }
        exit(json_encode($array));
    }
}
