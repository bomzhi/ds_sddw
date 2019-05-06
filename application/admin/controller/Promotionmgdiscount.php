<?php

namespace app\admin\controller;

use think\Lang;

class Promotionmgdiscount extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/promotionmgdiscount.lang.php');
        //自动开启会员等级折扣
        if (intval(input('param.mgdiscount_allow')) === 1) {
            $config_model = model('config');
            $update_array = array();
            $update_array['mgdiscount_allow'] = 1;
            $config_model->editConfig($update_array);
        }
    }

    /**
     * 显示店铺统一设置的 会员等级折扣
     */
    public function mgdiscount_store() {
        $store_model = model('store');
        $condition = array();
        $condition['store_name'] = array('like', '%' . input('param.store_name') . '%');
        $store_list = $store_model->getStoreList($condition, 10, 'store_id desc');
        foreach($store_list as $key=>$store){
            $store_list[$key]['store_mgdiscount_arr'] = $this->_get_mgdiscount_arr($store['store_mgdiscount']);
        }
        
        $this->assign('store_list', $store_list);
        $this->assign('show_page', $store_model->page_info->render());

        $this->setAdminCurItem('mgdiscount_store');
        return $this->fetch();
    }

    /**
     * 显示店铺针对单个商品设置的 会员等级折扣
     */
    public function mgdiscount_goods() {
        $goods_model = model('goods');
        $condition['goods_mgdiscount'] = array('neq', '');
        $goods_list = $goods_model->getGoodsCommonOnlineList($condition);
        foreach ($goods_list as $key => $goods) {
            $goods_list[$key]['goods_mgdiscount_arr'] = $this->_get_mgdiscount_arr($goods['goods_mgdiscount']);
        }
        $this->assign('show_page', $goods_model->page_info->render());
        $this->assign('goods_list', $goods_list);
        $this->setAdminCurItem('mgdiscount_goods');
        return $this->fetch();
    }
    

    /**
     * 通过系统会员等级和现有数据比对得出数值
     * @param type $mgdiscount_arr_temp
     * @return type
     */
    private function _get_mgdiscount_arr($mgdiscount_arr_temp)
    {
        $mgdiscount_arr_temp = @unserialize($mgdiscount_arr_temp);

        $member_model = model('member');
        //系统等级设置
        $membergrade_arr = $member_model->getMemberGradeArr();

        $mgdiscount_arr = array();
        foreach ($membergrade_arr as $key => $value) {
            $mgdiscount_arr[$key] = $value;
            $mgdiscount_arr[$key]['level_discount'] = isset($mgdiscount_arr_temp[$key]['level_discount'])?$mgdiscount_arr_temp[$key]['level_discount']:10;
        }
        return $mgdiscount_arr;
    }

    /**
     * 会员等级设置
     */
    public function mgdiscount_setting() {
        if (!(request()->isPost())) {
            $config_model = model('config');
            $setting = $config_model->getConfigList();
            $this->assign('setting', $setting);
            return $this->fetch();
        } else {
            $mgdiscount_price = intval(input('post.mgdiscount_price'));
            if ($mgdiscount_price === 0) {
                $mgdiscount_price = 20;
            }
            $config_model = model('config');
            $update_array = array();
            $update_array['mgdiscount_price'] = $mgdiscount_price;
            $result = $config_model->editConfig($update_array);
            if ($result) {
                $this->log('修改会员等级折扣价格为' . $mgdiscount_price . '元');
                dsLayerOpenSuccess(lang('setting_save_success'));
            } else {
                $this->error(lang('setting_save_fail'));
            }
        }
    }

    /**
     * 页面内导航菜单
     *
     * @param string $menu_key 当前导航的menu_key
     * @param array $array 附加菜单
     * @return
     */
    protected function getAdminItemList() {
        $menu_array = array(
            array(
                'name' => 'mgdiscount_store',
                'text' => lang('mgdiscount_store'),
                'url' => url('Promotionmgdiscount/mgdiscount_store')
            ), array(
                'name' => 'mgdiscount_goods',
                'text' => lang('mgdiscount_goods'),
                'url' => url('Promotionmgdiscount/mgdiscount_goods')
            ), array(
                'name' => 'mgdiscount_setting',
                'text' => lang('mgdiscount_setting'),
                'url' => "javascript:dsLayerOpen('" . url('Promotionmgdiscount/mgdiscount_setting') . "','" . lang('mgdiscount_setting') . "')"
            ),
        );
        return $menu_array;
    }

}
