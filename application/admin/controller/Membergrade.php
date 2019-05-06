<?php
namespace app\admin\controller;

use think\Lang;
class Membergrade extends AdminControl
{
    public function _initialize()
    {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/Membergrade.lang.php');
    }
    public function index() {
        $config_model = model('config');
        $list_config = $config_model->getConfigList();
        $list_config['member_grade'] = $list_config['member_grade'] ? unserialize($list_config['member_grade']) : array();
        if (request()->isPost()) {

            $update_arr = array();
            if ($_POST['mg']) {
                $mg_arr = array();
                $i = 1;
                foreach ($_POST['mg'] as $k => $v) {
                    $mg_arr[$i]['level'] = $i;
                    $mg_arr[$i]['level_name'] = 'V' . $i;
                    //所需经验值
                    $mg_arr[$i]['exppoints'] = intval($v['exppoints']);
                    $i++;
                }
                $update_arr['member_grade'] = serialize($mg_arr);
            } else {
                $update_arr['member_grade'] = '';
            }
            $result = true;
            if ($update_arr) {
                $result = $config_model->editConfig($update_arr);
            }
            if ($result) {
                $this->log(lang('ds_edit').lang('ds_member_grade'), 1);
                $this->success(lang('ds_common_save_succ'));
            } else {
                $this->log(lang('ds_edit').lang('ds_member_grade'), 0);
                $this->error(lang('ds_common_save_fail'));
            }
        } else {
            $this->assign('list_setting', $list_config);
            $this->setAdminCurItem('index');
            return $this->fetch();
        }
    }
    
    /**
     * 获取卖家栏目列表,针对控制器下的栏目
     */
    protected function getAdminItemList() {
        $menu_array = array(
            array(
                'name' => 'index',
                'text' => '管理',
                'url' => url('Membergrade/index')
            )
        );
        return $menu_array;
    }
}