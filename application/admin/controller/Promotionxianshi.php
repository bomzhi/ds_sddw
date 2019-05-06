<?php
/**
 * 限时折扣
 */

namespace app\admin\controller;
use think\Lang;

class Promotionxianshi extends AdminControl
{
    public function _initialize()
    {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/promotionxianshi.lang.php');
    }


    /**
     * 活动列表
     **/
    public function index()
    {
        //自动开启限时折扣
        if (intval(input('param.promotion_allow')) === 1) {
            $config_model = model('config');
            $update_array = array();
            $update_array['promotion_allow'] = 1;
            $config_model->editConfig($update_array);
        }

        $xianshi_model = model('pxianshi');
        $condition = array();
        if (!empty(input('param.xianshi_name'))) {
            $condition['xianshi_name'] = array('like', '%' . input('param.xianshi_name') . '%');
        }
        if (!empty(input('param.store_name'))) {
            $condition['store_name'] = array('like', '%' . input('param.store_name') . '%');
        }
        if (!empty(input('param.state'))) {
            $condition['xianshi_state'] = intval(input('param.state'));
        }
        $xianshi_list = $xianshi_model->getXianshiList($condition, 10, 'xianshi_state desc, xianshi_end_time desc');
        $this->assign('xianshi_list', $xianshi_list);
        $this->assign('show_page', $xianshi_model->page_info->render());
        $this->assign('xianshi_state_array', $xianshi_model->getXianshiStateArray());

        $this->setAdminCurItem('xianshi_list');
        // 输出自营店铺IDS
        
        $this->assign('filtered', $condition ? 1 : 0); //是否有查询条件
        $this->assign('flippedOwnShopIds', array_flip(model('store')->getOwnShopIds()));
        return $this->fetch();
    }

    /**
     * 限时折扣活动取消
     **/
    public function xianshi_cancel()
    {
        $xianshi_id = intval(input('param.xianshi_id'));
        $xianshi_model = model('pxianshi');
        $result = $xianshi_model->cancelXianshi(array('xianshi_id' => $xianshi_id));
        if ($result) {
            $this->log('取消限时折扣活动，活动编号' . $xianshi_id);
            ds_json_encode(10000, lang('ds_common_op_succ'));
        }
        else {
            ds_json_encode(10001, lang('ds_common_op_fail'));
        }
    }

    /**
     * 限时折扣活动删除
     **/
    public function xianshi_del()
    {
        $xianshi_model = model('pxianshi');
        $xianshi_id = input('param.xianshi_id');
        $xianshi_id_array = ds_delete_param($xianshi_id);
        if($xianshi_id_array === FALSE){
            ds_json_encode(10001, lang('param_error'));
        }
        $condition = array('xianshi_id' => array('in', $xianshi_id_array));
        $result = $xianshi_model->delXianshi($condition);
        if ($result) {
            $this->log('删除限时折扣活动，活动编号' . $xianshi_id);
            ds_json_encode(10000, lang('ds_common_op_succ'));
        }
        else {
            ds_json_encode(10001, lang('ds_common_op_fail'));
        }
    }

    /**
     * 活动详细信息
     **/
    public function xianshi_detail()
    {
        $xianshi_id = intval(input('param.xianshi_id'));

        $xianshi_model = model('pxianshi');
        $xianshigoods_model = model('pxianshigoods');

        $xianshi_info = $xianshi_model->getXianshiInfoByID($xianshi_id);
        if (empty($xianshi_info)) {
            $this->error(lang('param_error'));
        }
        $this->assign('xianshi_info', $xianshi_info);

        //获取限时折扣商品列表
        $condition = array();
        $condition['xianshi_id'] = $xianshi_id;
        $xianshigoods_list = $xianshigoods_model->getXianshigoodsExtendList($condition,5);
        $this->assign('xianshigoods_list', $xianshigoods_list);
        $this->assign('show_page',$xianshigoods_model->page_info->render());
        return $this->fetch();
    }

    /**
     * 套餐管理
     **/
    public function xianshi_quota()
    {
        $xianshiquota_model = model('pxianshiquota');

        $condition = array();
        $condition['store_name'] = array('like', '%' . input('param.store_name') . '%');
        $xianshiquota_list = $xianshiquota_model->getXianshiquotaList($condition, 10, 'xianshiquota_endtime desc');
        $this->assign('xianshiquota_list', $xianshiquota_list);
        $this->assign('show_page', $xianshiquota_model->page_info->render());

        $this->setAdminCurItem('xianshi_quota');
        return $this->fetch();

    }

    /**
     * 设置
     **/
   public function xianshi_setting() {
        if (!(request()->isPost())) {
            $config_model = model('config');
            $setting = $config_model->getConfigList();
            $this->assign('setting', $setting);
            return $this->fetch();
        } else {
            $promotion_xianshi_price = intval(input('post.promotion_xianshi_price'));
            if ($promotion_xianshi_price === 0) {
                $promotion_xianshi_price = 20;
            }

            $config_model = model('config');
            $update_array = array();
            $update_array['promotion_xianshi_price'] = $promotion_xianshi_price;

            $result = $config_model->editConfig($update_array);
            if ($result) {
                $this->log('修改限时折扣价格为' . $promotion_xianshi_price . '元');
                dsLayerOpenSuccess(lang('setting_save_success'));
            } else {
                $this->error(lang('setting_save_fail'));
            }
        }
    }

    /**
     * ajax修改抢购信息
     */
    public function ajax()
    {
        $result = true;
        $update_array = array();
        $where_array = array();

        switch (input('param.branch')) {
            case 'recommend':
                $pxianshigoods_model = model('pxianshigoods');
                $update_array['xianshigoods_recommend'] = input('param.value');
                $where_array['xianshigoods_id'] = input('param.id');
                $result = $pxianshigoods_model->editXianshigoods($update_array, $where_array);
                break;
        }

        if ($result) {
            echo 'true';
            exit;
        }
        else {
            echo 'false';
            exit;
        }

    }


    /*
     * 发送消息
     */
    private function send_message($member_id, $member_name, $message)
    {
        $param = array();
        $param['from_member_id'] = 0;
        $param['member_id'] = $member_id;
        $param['to_member_name'] = $member_name;
        $param['message_type'] = '1';//表示为系统消息
        $param['msg_content'] = $message;
        $message_model = model('message');
        return $message_model->addMessage($param);
    }

    /**
     * 页面内导航菜单
     *
     * @param string $menu_key 当前导航的menu_key
     * @param array $array 附加菜单
     * @return
     */
    protected function getAdminItemList()
    {
        $menu_array = array(
            array(
                'name' => 'xianshi_list', 'text' => lang('xianshi_list'), 'url' => url('Promotionxianshi/index')
            ), array(
                'name' => 'xianshi_quota', 'text' => lang('xianshi_quota'),
                'url' => url('Promotionxianshi/xianshi_quota')
            ), array(
                'name' => 'xianshi_setting',
                'text' => lang('xianshi_setting'),
                'url' => "javascript:dsLayerOpen('".url('Promotionxianshi/xianshi_setting')."','".lang('xianshi_setting')."')"
            ),
        );
        if (request()->action() == 'xianshi_detail')
            $menu_array[] = array(
                'name' => 'xianshi_detail', 'text' => lang('xianshi_detail'),
                'url' => url('Promotionxianshi/xianshi_detail')
            );
        return $menu_array;
    }
}