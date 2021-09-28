<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Change extends CI_Controller
{
    //求人情報変更処理
    public function update_ams()
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
                    "max_length" => "仕事内容は100文字以内で入力してください。"
                ]
            ],
            [
                "field" => "time",
                "label" => "労働時間",
                "rules" => 'trim|required',
                "errors" => [
                    "required" => "労働時間は入力必須です。"
                ]
            ],
            [
                "field" => "branch",
                "label" => "支店名",
                "rules" => 'trim|max_length[100]',
                "errors" => [
                    "max_length" => "仕事内容は100文字以内で入力してください。"
                ]
            ],
            [
                "field" => "access",
                "label" => "アクセス",
                "rules" => 'trim|max_length[100]',
                "errors" => [
                    "max_length" => "アクセスは100文字以内で入力してください。"
                ]
            ],
            [
                "field" => "skill",
                "label" => "資格",
                "rules" => 'trim|max_length[200]',
                "errors" => [
                    "max_length" => "資格は200文字以内で入力してください。"
                ]
            ],
            [
                "field" => "remarks",
                "label" => "その他",
                "rules" => 'trim|max_length[500]',
                "errors" => [
                    "max_length" => "その他は500文字以内で入力してください。"
                ]
            ],
            [
                "field" => "money",
                "label" => "単価",
                "rules" => 'trim|required|numeric|max_length[8]',
                "errors" => [
                    "required" => "単価は入力必須です。",
                    "numeric" => "単価は半角数字でのみです。",
                    "max_length"=>"単価は8桁以内で入力してください"
                ]
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $day = date("Y-m-d H:i:s");
            $this->load->model("model_jobs");
            if ($this->model_jobs->update_job($day)) {
                $array = ['success' => true];
            } else {
                echo "選手情報変更できませんでした。";
            }
        } else {
            $array = [
                'error' => true,
                'work_error' => form_error('work'),
                'time_error' => form_error('time'),
                'money_error' => form_error('money'),
                'branch_error' => form_error('branch'),
                'access_error' => form_error('access'),
                'skill_error' => form_error('skill'),
                'remarks_error' => form_error('remarks')
            ];
        }
        exit(json_encode($array));
    }
    public function update_profile()
    {
        header("Content-type: application/json; charset=UTF-8");
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "office",
                "label" => "事業所名",
                "rules" => 'trim|required|max_length[30]',
                "errors" => [
                    "required" => "事業所名は入力必須です。",
                    "max_length" => "事業所名は30文字以内で入力してください。"
                ]
            ],
            [
                "field" => "name",
                "label" => "担当者名",
                "rules" => 'trim|required|max_length[30]',
                "errors" => [
                    "required" => "担当者名は入力必須です。",
                    "max_length" => "担当者名は30文字以内で入力してください。"
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
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $this->load->model("model_offices");
            if ($this->model_offices->update_office()) {
                $array = ['success' => true];
            } else {
                echo "チーム編集できませんでした。";
            }
        } else {
            $array = [
                'error' => true,
                'office_error' => form_error('office'),
                'name_error' => form_error('name'),
                'tel_error' => form_error('tel')
            ];
        }
        exit(json_encode($array));
    }
    //求職者プロフィール変更処理
    public function update_worker_profile()
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
                "label" => "氏名",
                "rules" => 'trim|required|max_length[30]',
                "errors" => [
                    "required" => "ニックネームは入力必須です。",
                    "max_length" => "ニックネームは30文字以内で入力してください。"
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
                "field" => "skill",
                "label" => "資格",
                "rules" => 'trim|max_length[100]',
                "errors" => [
                    "max_length" => "資格・スキルは100文字以内で入力してください。"
                ]
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $this->load->model("model_workers");
            if ($this->model_workers->update_worker()) {
                $array = ['success' => true];
            } else {
                echo "チーム編集できませんでした。";
            }
        } else {
            $array = [
                'error' => true,
                'name_error' => form_error('name'),
                'nickname_error' => form_error('name'),
                'tel_error' => form_error('tel'),
                'skill_error' => form_error('skill')
            ];
        }
        exit(json_encode($array));
    }
}
