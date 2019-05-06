<?php

namespace app\admin\controller;

use think\Lang;

class Express extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/express.lang.php');
    }

    public function index() {
        $letter = input('get.letter');
        $condition = array();
        if (preg_match('/^[A-Z]$/', $letter)) {
            $condition['express_letter'] = $letter;
        }
        $express_model = model('express');
        $express_list = $express_model->getAllExpresslist($condition,10);
        $this->assign('show_page', $express_model->page_info->render());
        $this->assign('express_list', $express_list);
        $this->setAdminCurItem('index');
        return $this->fetch();
    }

    /**
     * ajax操作
     */
    public function ajax() {
        $branch = input('get.branch');
        $column = input('get.column');
        $value = trim(input('get.value'));
        $id = intval(input('get.id'));
        switch ($branch) {
            case 'state':
                $express_model = model('express');
                $update_array = array();
                $update_array['express_id'] = $id;
                $update_array[$column] = $value;
                $express_model->update($update_array);
                dkcache('express');
                $this->log(lang('ds_edit').lang('express_name').lang('express_state') . '[ID:' . $id . ']', 1);
                echo 'true';
                exit;
                break;
            case 'order':
                $_GET['value'] = $_GET['value'] == 0 ? 2 : 1;
                $express_model = model('express');
                $update_array = array();
                $update_array['express_id'] = $id;
                $update_array[$column] = $value;
                $express_model->update($update_array);
                dkcache('express');
                $this->log(lang('ds_edit').lang('express_name').lang('express_state') . '[ID:' . $id . ']', 1);
                echo 'true';
                exit;
                break;
            case 'express_zt_state':
                $express_model = model('express');
                $update_array = array();
                $update_array['express_id'] = $id;
                $update_array[$column] = $value;
                $express_model->update($update_array);
                dkcache('express');
                $this->log(lang('ds_edit').lang('express_name').lang('express_state') . '[ID:' . $id . ']', 1);
                echo 'true';
                exit;
                break;
        }
        dkcache('express');
    }

}

?>
