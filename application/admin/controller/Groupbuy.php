<?php

/**
 * 抢购管理
 */

namespace app\admin\controller;

use think\Lang;

class Groupbuy extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/groupbuy.lang.php');
    }

    /**
     * 进行中抢购列表，只可推荐
     *
     */
    public function index() {
        $groupbuy_model = model('groupbuy');

        $condition = array();
        if (!empty(input('param.groupbuy_name'))) {
            $condition['groupbuy_name'] = array('like', '%' . input('param.groupbuy_name') . '%');
        }
        if ((input('param.store_name'))) {
            $condition['store_name'] = array('like', '%' . input('param.store_name') . '%');
        }
        if ((input('param.groupbuy_state'))) {
            $condition['groupbuy_state'] = input('param.groupbuy_state');
        }
        $groupbuy_list = $groupbuy_model->getGroupbuyExtendList($condition, 10);
        $this->assign('groupbuy_list', $groupbuy_list);
        $this->assign('show_page', $groupbuy_model->page_info->render());
        $this->assign('groupbuy_state_array', $groupbuy_model->getGroupbuyStateArray());

        $this->setAdminCurItem('index');

        // 输出自营店铺IDS
        $this->assign('flippedOwnShopIds', array_flip(model('store')->getOwnShopIds()));
        
        $this->assign('filtered', $condition ? 1 : 0); //是否有查询条件
        $this->assign('flippedOwnShopIds', '');
        return $this->fetch();
    }

    /**
     * 审核通过
     */
    public function groupbuy_review_pass() {
        $groupbuy_id = intval(input('post.groupbuy_id'));

        if($groupbuy_id<=0){
            $this->error(lang('param_error'));
        }
        
        $groupbuy_model = model('groupbuy');
        $result = $groupbuy_model->reviewPassGroupbuy($groupbuy_id);
        if ($result) {
            $this->log('通过抢购活动申请，抢购编号' . $groupbuy_id, null);
            // 添加队列
            $groupbuy_info = $groupbuy_model->getGroupbuyInfo(array('groupbuy_id' => $groupbuy_id));
            $this->addcron(array(
                'exetime' => $groupbuy_info['groupbuy_starttime'], 'exeid' => $groupbuy_info['goods_commonid'],
                'type' => 5
            ));
            $this->addcron(array(
                'exetime' => $groupbuy_info['groupbuy_endtime'], 'exeid' => $groupbuy_info['goods_commonid'],
                'type' => 6
            ));
            $this->success(lang('ds_common_op_succ'), 'Groupbuy/index');
        } else {
            $this->error(lang('ds_common_op_fail'));
        }
    }

    /**
     * 审核失败
     */
    public function groupbuy_review_fail() {
        $groupbuy_id = intval(input('post.groupbuy_id'));

        $groupbuy_model = model('groupbuy');
        $result = $groupbuy_model->reviewFailGroupbuy($groupbuy_id);
        if ($result) {
            $this->log('拒绝抢购活动申请，抢购编号' . $groupbuy_id, null);
            $this->success(lang('ds_common_op_succ'), 'Groupbuy/index');
        } else {
            $this->error(lang('ds_common_op_fail'));
        }
    }

    /**
     * 取消
     */
    public function groupbuy_cancel() {
        $groupbuy_id = intval(input('post.groupbuy_id'));

        $groupbuy_model = model('groupbuy');
        $result = $groupbuy_model->cancelGroupbuy($groupbuy_id);
        if ($result) {
            $this->log('取消抢购活动，抢购编号' . $groupbuy_id, null);
            $this->success(lang('ds_common_op_succ'), 'Groupbuy/index');
        } else {
            $this->error(lang('ds_common_op_fail'));
        }
    }

    /**
     * 删除
     */
    public function groupbuy_del() {
        $groupbuy_id = intval(input('param.groupbuy_id'));
        $groupbuy_model = model('groupbuy');
        $result = $groupbuy_model->delGroupbuy(array('groupbuy_id' => $groupbuy_id));
        if ($result) {
            $this->log('删除抢购活动，抢购编号' . $groupbuy_id, null);
            ds_json_encode(10000, lang('ds_common_op_succ'));
        } else {
            ds_json_encode(10001, lang('ds_common_op_fail'));
        }
    }

    /**
     * ajax修改抢购信息
     */
    public function ajax() {

        $result = true;
        $update_array = array();
        $where_array = array();

        switch (input('param.branch')) {
            case 'gclass_sort':
                $groupbuyclass_model = model('groupbuyclass');
                $update_array['gclass_sort'] = input('param.value');
                $where_array['gclass_id'] = input('param.id');
                $result = $groupbuyclass_model->update($update_array, $where_array);
                // 删除抢购分类缓存
                model('groupbuy')->dropCachedData('groupbuy_classes');
                break;
            case 'gclass_name':
                $groupbuyclass_model = model('groupbuyclass');
                $update_array['gclass_name'] = input('param.value');
                $where_array['gclass_id'] = input('param.id');
                $result = $groupbuyclass_model->update($update_array, $where_array);
                // 删除抢购分类缓存
                model('groupbuy')->dropCachedData('groupbuy_classes');
                $this->log(lang('groupbuy_class_edit_success') . '[ID:' . input('param.id') . ']', null);
                break;
            case 'recommended':
                $groupbuy_model = model('groupbuy');
                $update_array['groupbuy_recommended'] = input('param.value');
                $where_array['groupbuy_id'] = input('param.id');
                $result = $groupbuy_model->editGroupbuy($update_array, $where_array);
                break;
        }
        if ($result) {
            echo 'true';
            exit;
        } else {
            echo 'false';
            exit;
        }
    }

    /**
     * 套餐管理
     * */
    public function groupbuy_quota() {
        $groupbuyquota_model = model('groupbuyquota');

        $condition = array();
        $condition['store_name'] = array('like', '%' . input('param.store_name') . '%');
        $groupbuyquota_list = $groupbuyquota_model->getGroupbuyquotaList($condition, 10, 'groupbuyquota_endtime desc');
        $this->assign('groupbuyquota_list', $groupbuyquota_list);
        $this->assign('show_page', $groupbuyquota_model->page_info->render());

        $this->setAdminCurItem('groupbuy_quota');
        return $this->fetch();
    }

    /**
     * 抢购类别列表
     */
    public function class_list() {

        $groupbuyclass_model = model('groupbuyclass');
        $groupbuyclass_list = $groupbuyclass_model->getTreeList();
        $this->setAdminCurItem('class_list');
        $this->assign('groupbuyclass_list', $groupbuyclass_list);
        return $this->fetch();
    }

    /**
     * 添加抢购分类页面
     */
    public function class_add() {

        $groupbuyclass_model = model('groupbuyclass');
        $param = array();
        $param['gclass_parent_id'] = 0;
        $groupbuyclass_list = $groupbuyclass_model->getGroupbuyclassList($param);
        $this->assign('groupbuyclass_list', $groupbuyclass_list);

        $this->setAdminCurItem('class_add');
        $this->assign('parent_id', input('param.parent_id'));
        return $this->fetch();
    }

    /**
     * 保存添加的抢购类别
     */
    public function class_save() {

        $gclass_id = intval(input('post.gclass_id'));
        $param = array();
        $param['gclass_name'] = trim(input('post.input_gclass_name'));
        if (empty($param['gclass_name'])) {
            $this->error(lang('class_name_error'), '');
        }
        $param['gclass_sort'] = intval(input('post.input_sort'));
        $param['gclass_parent_id'] = intval(input('post.input_parent_id'));

        $groupbuyclass_model = model('groupbuyclass');

        // 删除抢购分类缓存
        model('groupbuy')->dropCachedData('groupbuy_classes');

        if (empty($gclass_id)) {
            //新增
            if ($groupbuyclass_model->addGroupbuyclass($param)) {
                $this->log(lang('groupbuy_class_add_success') . '[ID:' . $gclass_id . ']', null);
                dsLayerOpenSuccess(lang('groupbuy_class_add_success'));
            } else {
                $this->error(lang('groupbuy_class_add_fail'));
            }
        } else {
            //编辑
            if ($groupbuyclass_model->editGroupbuyclass($param, array('gclass_id' => $gclass_id))) {
                $this->log(lang('groupbuy_class_edit_success') . '[ID:' . $gclass_id . ']', null);
                dsLayerOpenSuccess(lang('groupbuy_class_edit_success'));
            } else {
                $this->error(lang('groupbuy_class_edit_fail'));
            }
        }
    }

    /**
     * 删除抢购类别
     */
    public function class_drop() {

        $gclass_id = trim(input('param.gclass_id'));
        if (empty($gclass_id)) {
            $this->error(lang('param_error'), '');
        }

        $groupbuyclass_model = model('groupbuyclass');
        //获得所有下级类别编号
        $all_gclass_id = $groupbuyclass_model->getAllClassId(explode(',', $gclass_id));
        $condition = array();
        $condition['gclass_id'] = array('in',implode(',', $all_gclass_id));
        if ($groupbuyclass_model->delGroupbuyclass($condition)) {
            // 删除抢购分类缓存
            model('groupbuy')->dropCachedData('groupbuy_classes');
            $this->log(lang('groupbuy_class_drop_success') . '[ID:' . implode(',', $all_gclass_id) . ']', null);
            ds_json_encode(10000, lang('groupbuy_class_drop_success'));
        } else {
            ds_json_encode(10001, lang('groupbuy_class_drop_fail'));
        }
    }

    /**
     * 抢购价格区间列表
     */
    public function price_list() {

        $groupbuypricerange_model = model('groupbuypricerange');
        $groupbuypricerange_list = $groupbuypricerange_model->getGroupbuypricerangeList();
        $this->assign('groupbuypricerange_list', $groupbuypricerange_list);

        $this->setAdminCurItem('price_list');
        return $this->fetch();
    }

    /**
     * 添加抢购价格区间页面
     */
    public function price_add() {
        $price_info = [
            'gprange_id' => '', 'gprange_name' => '', 'gprange_start' => '', 'gprange_end' => '',
        ];
        $this->assign('price_info', $price_info);
        $this->setAdminCurItem('price_add');
        return $this->fetch();
    }

    /**
     * 编辑抢购价格区间页面
     */
    public function price_edit() {

        $gprange_id = intval(input('param.gprange_id'));
        if (empty($gprange_id)) {
            $this->error(lang('param_error'), '');
        }

        $groupbuypricerange_model = model('groupbuypricerange');

        $price_info = $groupbuypricerange_model->getOneGroupbuypricerange($gprange_id);
        if (empty($price_info)) {
            $this->error(lang('param_error'), '');
        }
        $this->assign('price_info', $price_info);

        $this->setAdminCurItem('price_edit');
        return $this->fetch('price_add');
    }

    /**
     * 保存添加的抢购价格区间
     */
    public function price_save() {

        $gprange_id = intval(input('post.gprange_id'));
        $param = array();
        $param['gprange_name'] = trim(input('post.gprange_name'));
        if (empty($param['gprange_name'])) {
            $this->error(lang('range_name_error'), '');
        }
        $param['gprange_start'] = intval(input('post.gprange_start'));
        $param['gprange_end'] = intval(input('post.gprange_end'));

        $groupbuypricerange_model = model('groupbuypricerange');

        if (empty($gprange_id)) {
            //新增
            if ($groupbuypricerange_model->addGroupbuypricerange($param)) {
                dkcache('groupbuy_price');
                $this->log(lang('groupbuy_price_range_add_success') . '[' . input('post.gprange_name') . ']', null);
                dsLayerOpenSuccess(lang('groupbuy_price_range_add_success'));
            } else {
                $this->error(lang('groupbuy_price_range_add_fail'));
            }
        } else {
            //编辑
            if ($groupbuypricerange_model->editGroupbuypricerange($param, array('gprange_id' => $gprange_id))) {
                dkcache('groupbuy_price');
                $this->log(lang('groupbuy_price_range_edit_success') . '[' . input('post.gprange_name') . ']', null);
                dsLayerOpenSuccess(lang('groupbuy_price_range_edit_success'));
            } else {
//                $this->error(lang('groupbuy_price_range_edit_fail'), url('Groupbuy/price_list'));
                $this->error(lang('groupbuy_price_range_edit_fail'));
            }
        }
    }

    /**
     * 删除抢购价格区间
     */
    public function price_drop() {
        
        
        $gprange_id = input('param.gprange_id');
        $gprange_id_array = ds_delete_param($gprange_id);
        if ($gprange_id_array === FALSE) {
            $this->error(lang('param_error'));
        }
        
        $condition = array();
        $condition['gprange_id'] = array('in',$gprange_id_array);
        $groupbuypricerange_model = model('groupbuypricerange');
        if ($groupbuypricerange_model->delGroupbuypricerange($condition)) {
            dkcache('groupbuy_price');
            $this->log(lang('groupbuy_price_range_drop_success') . '[ID:' . $gprange_id . ']', null);
            ds_json_encode(10000, lang('groupbuy_price_range_drop_success'));
        } else {
            ds_json_encode(10001, lang('groupbuy_price_range_drop_fail'));
        }
    }

    /**
     * 设置
     * */
    public function groupbuy_setting() {
        if (!(request()->isPost())) {
            $config_model = model('config');
            $setting = $config_model->getConfigList();
            $this->assign('setting', $setting);
            return $this->fetch();
        } else {
            $groupbuy_price = intval(input('post.groupbuy_price'));
            if ($groupbuy_price < 0) {
                $groupbuy_price = 0;
            }

            $groupbuy_review_day = intval(input('post.groupbuy_review_day'));
            if ($groupbuy_review_day < 0) {
                $groupbuy_review_day = 0;
            }

            $config_model = model('config');
            $update_array = array();
            $update_array['groupbuy_price'] = $groupbuy_price;
            $update_array['groupbuy_review_day'] = $groupbuy_review_day;
            $result = $config_model->editConfig($update_array);
            if ($result) {
                $this->log('修改抢购套餐价格为' . $groupbuy_price . '元');
                dsLayerOpenSuccess(lang('ds_common_op_succ'));
            } else {
                $this->error(lang('ds_common_op_fail'));
            }
        }
    }

    /**
     * 幻灯片设置
     */
    public function slider() {
        $config_model = model('config');
        if (request()->isPost()) {
            $update = array();
            $fprefix = 'home/groupbuy/slider';
            $upload_file = BASE_UPLOAD_PATH . DS . $fprefix;
            if (!empty($_FILES['live_pic1']['name'])) {
                $file = request()->file('live_pic1');
                $info = $file->rule('uniqid')->validate(['ext' => ALLOW_IMG_EXT])->move($upload_file);
                if ($info) {
                    $update['live_pic1'] = $info->getSaveName();
                } else {
                    $this->error($file->getError());
                }
            }

            if (!empty(input('post.live_link1'))) {
                $update['live_link1'] = input('post.live_link1');
            }

            if (!empty($_FILES['live_pic2']['name'])) {
                $file = request()->file('live_pic2');
                $info = $file->rule('uniqid')->validate(['ext' => ALLOW_IMG_EXT])->move($upload_file);
                if ($info) {
                    $update['live_pic2'] = $info->getSaveName();
                } else {
                    $this->error($file->getError());
                }
            }

            if (!empty(input('post.live_link2'))) {
                $update['live_link2'] = input('post.live_link2');
            }

            if (!empty($_FILES['live_pic3']['name'])) {
                $file = request()->file('live_pic3');
                $info = $file->rule('uniqid')->validate(['ext' => ALLOW_IMG_EXT])->move($upload_file);
                if ($info) {
                    $update['live_pic3'] = $info->getSaveName();
                } else {
                    $this->error($file->getError());
                }
            }

            if (!empty(input('post.live_link3'))) {
                $update['live_link3'] = input('post.live_link3');
            }

            if (!empty($_FILES['live_pic4']['name'])) {
                $file = request()->file('live_pic4');
                $info = $file->rule('uniqid')->validate(['ext' => ALLOW_IMG_EXT])->move($upload_file);
                if ($info) {
                    $update['live_pic4'] = $info->getSaveName();
                } else {
                    $this->error($file->getError());
                }
            }

            if (!empty(input('post.live_link4'))) {
                $update['live_link4'] = input('post.live_link4');
            }

            $list_setting = $config_model->getConfigList();
            $result = $config_model->editConfig($update);
            if ($result) {
                if ($list_setting['live_pic1'] != '' && isset($update['live_pic1'])) {
                    @unlink($upload_file . DS . $list_setting['live_pic1']);
                }

                if ($list_setting['live_pic2'] != '' && isset($update['live_pic2'])) {
                    @unlink($upload_file . DS . $list_setting['live_pic2']);
                }

                if ($list_setting['live_pic3'] != '' && isset($update['live_pic3'])) {
                    @unlink($upload_file . DS . $list_setting['live_pic3']);
                }

                if ($list_setting['live_pic4'] != '' && isset($update['live_pic4'])) {
                    @unlink($upload_file . $list_setting['live_pic4']);
                }
                $this->log('修改抢购幻灯片设置', 1);
                $this->success(lang('ds_common_op_succ'));
            } else {
                $this->error(lang('ds_common_op_fail'));
            }
        } else {


            $list_setting = $config_model->getConfigList();
            $this->assign('list_setting', $list_setting);
            $this->setAdminCurItem('slider');
            return $this->fetch();
        }
    }

    /**
     * 幻灯片清空
     */
    public function slider_clear() {
        $config_model = model('config');
        $update = array();
        $update['live_pic1'] = '';
        $update['live_link1'] = '';
        $update['live_pic2'] = '';
        $update['live_link2'] = '';
        $update['live_pic3'] = '';
        $update['live_link3'] = '';
        $update['live_pic4'] = '';
        $update['live_link4'] = '';
        $res = $config_model->editConfig($update);
        if ($res) {
            $this->log('清空抢购幻灯片设置', 1);
            echo json_encode(array('result' => 'true'));
        } else {
            echo json_encode(array('result' => 'false'));
        }
        exit;
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
                'name' => 'index', 
                'text' => '抢购活动',
                'url' => url('Groupbuy/index')
            ), array(
                'name' => 'groupbuy_quota', 
                'text' => '套餐管理', 
                'url' => url('Groupbuy/groupbuy_quota')
            ), array(
                'name' => 'class_list',
                'text' => lang('groupbuy_class_list'),
                'url' => url('Groupbuy/class_list')
            ), array(
                'name' => 'price_list', 
                'text' => lang('groupbuy_price_list'),
                'url' => url('Groupbuy/price_list')
            ), array(
                'name' => 'groupbuy_setting',
                'text' => '设置',
                'url' => "javascript:dsLayerOpen('".url('Groupbuy/groupbuy_setting')."','设置')"
            ), array(
                'name' => 'slider',
                'text' => '幻灯片管理',
                'url' => url('Groupbuy/slider')
            ),
        );
        return $menu_array;
    }

}
