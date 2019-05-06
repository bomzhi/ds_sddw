<?php

/**
 * 积分管理
 */

namespace app\admin\controller;

use think\Lang;

class Points extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/points.lang.php');
    }

    public function index() {
        if (!request()->isPost()) {
            $condition_arr = array();
            $mname = input('param.mname');
            if (!empty($mname)) {
                $condition_arr['pl_membername'] = array('like', '%' . $mname . '%');
            }
            $aname = input('param.aname');
            if (!empty($aname)) {
                $condition_arr['pl_adminname'] = array('like', '%' . $aname . '%');
            }
            $stage = input('get.stage');
            if ($stage) {
                $condition_arr['pl_stage'] = trim($stage);
            }
            $stime = input('get.stime');
            $etime = input('get.etime');
            $if_start_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $stime);
            $if_end_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $etime);
            $start_unixtime = $if_start_time ? strtotime($stime) : null;
            $end_unixtime = $if_end_time ? strtotime($etime) : null;
            if ($start_unixtime || $end_unixtime) {
                $condition_arr['pl_addtime'] = array('between', array($start_unixtime, $end_unixtime));
            }
            
            $search_desc = trim(input('param.description'));
            if (!empty($search_desc)) {
                $condition_arr['pl_desc'] = array('like', "%" . $search_desc . "%");
            }


            $points_model = model('points');
            $list_log = $points_model->getPointslogList($condition_arr, 10, '*', '');

            $this->assign('pointslog', $list_log);
            $this->assign('show_page', $points_model->page_info->render());
            $this->setAdminCurItem('index');
            return $this->fetch();
        }
    }

    //积分明细查询
    function pointslog() {
        if (!request()->isPost()) {
            return $this->fetch();
        } else {
            $data = [
                'member_name' => input('post.member_name'),
                'points_type' => input('post.points_type'),
                'points_num' => intval(input('post.points_num')),
                'points_desc' => input('post.points_desc'),
            ];
            $point_validate = validate('point');
            if (!$point_validate->scene('pointslog')->check($data)) {
                $this->error($point_validate->getError());
            }

            $member_name = $data['member_name'];
            $member_info = model('member')->getMemberInfo(array('member_name' => $member_name));
            if (!is_array($member_info) || count($member_info) <= 0) {
                $this->error(lang('admin_points_userrecord_error'));
            }
            if ($data['points_type'] == 2 && $data['points_num'] > $member_info['member_points']) {
                $this->error(lang('admin_points_points_short_error') . $member_info['member_points']);
            }
            //积分数据记录
            $insert_arr['pl_memberid'] = $member_info['member_id'];
            $insert_arr['pl_membername'] = $member_info['member_name'];
            if ($data['points_type'] == 2) {
                $insert_arr['pl_points'] = -$data['points_num'];
            } else {
                $insert_arr['pl_points'] = $data['points_num'];
            }
            $insert_arr['pl_desc'] = $data['points_desc'];
            $insert_arr['pl_adminname'] = session('admin_name');
            $obj_points = model('points');

            $result = $obj_points->savePointslog('system', $insert_arr);
            if ($result) {
                dsLayerOpenSuccess(lang('ds_common_op_succ'));
            } else {
                $this->error(lang('error'), 'Points/index');
            }
        }
    }

    public function checkmember() {
        $name = trim(input('param.name'));
        if (!$name) {
            exit(json_encode(array('id' => 0)));
        }
        $obj_member = model('member');
        $member_info = $obj_member->getMemberInfo(array('member_name' => $name));
        if (is_array($member_info) && count($member_info) > 0) {
            echo json_encode(array('id' => $member_info['member_id'], 'name' => $member_info['member_name'], 'points' => $member_info['member_points']));
        } else {
            exit(json_encode(array('id' => 0)));
            die;
        }
    }

    protected function getAdminItemList() {
        $menu_array = array(
            array(
                'name' => 'index',
                'text' => '积分明细',
                'url' => url('Points/index')
            ),
            array(
                'name' => 'pointslog',
                'text' => '积分调整',
                'url' => "javascript:dsLayerOpen('".url('Points/pointslog')."','积分调整')"
            )
        );
        return $menu_array;
    }

}
