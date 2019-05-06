<?php

namespace app\home\controller;

use think\Lang;

class Membersnsfriend extends BaseMember {

    public function _initialize() {
        parent::_initialize(); // TODO: Change the autogenerated stub
        Lang::load(APP_PATH . 'home/lang/'.config('default_lang').'/member_snsfriend.lang.php');
    }

    private function m_sex($sextype) {
        switch ($sextype) {
            case 1:
                return 'male';
                break;
            case 2:
                return 'female';
                break;
            default:
                return '';
                break;
        }
    }

    /**
     * 找人首页
     */
    public function index() {

        // 查看推荐
        $mtag_list = db('snsmembertag')->where(array('mtag_recommend' => 1))->order('mtag_sort asc')->select();
        if (!empty($mtag_list)) {
            // 查询已关注好友 ，不显示已关注好友
            $friend_array = db('snsfriend')->field('friend_tomid')->where(array('friend_frommid' => session('member_id')))->select();
            $friendid_array[] = session('member_id');
            if (!empty($friend_array)) {
                foreach ($friend_array as $val) {
                    $friendid_array[] = $val['friend_tomid'];
                }
            }

            $mtagid_array = array();
            foreach ($mtag_list as $val) {
                $mtagid_array[] = $val['mtag_id'];
            }

            // 查询会员
            $where['sns_mtagmember.mtag_id'] = array('in', $mtagid_array); //查询条件
            $where['sns_mtagmember.member_id'] = array('not in', $friendid_array);

            $tagmember_list = db('snsmtagmember')->alias('sns_mtagmember')
                            ->field('sns_mtagmember.*,member.member_avatar,member.member_name')
                            ->join('__MEMBER__ member', 'sns_mtagmember.member_id=member.member_id')
                            ->where($where)
                            ->order('sns_mtagmember.recommend desc, sns_mtagmember.member_id asc')
                            ->limit(count($mtagid_array) * 20)->select();

            // 整理

            $tagmember_list = array_under_reset($tagmember_list, 'mtag_id', 2);
            $this->assign('mtag_list', $mtag_list);
            $this->assign('tagmember_list', $tagmember_list);
        }
        $this->assign('type', 'index');

        $this->setMemberCurItem('find');
        $this->setMemberCurMenu('member_snsfriend');
        return $this->fetch($this->template_dir . 'member_snsfriend_find');
    }

    /**
     * 找人搜索列表
     */
    public function findlist() {

        $searchname = trim(input('post.searchname'));
        if(empty($searchname)){
            $this->error(lang('searchname_not_empty'));
        }

        //查询关注会员id
        $followlist = db('snsfriend')->field('friend_tomid, friend_followstate')->where(array('friend_frommid' => session('member_id')))->select();
        unset($condition_arr);
        $followlist_new = array();
        if (!empty($followlist)) {
            foreach ($followlist as $k => $v) {
                $followlist_new[$v['friend_tomid']] = $v;
            }
        }

        //查询会员
        // 查询条件
        $where = array();
        $where['member_state'] = 1;
        $where['member_id'] = array('neq', session('member_id'));
        $where['member_name'] = array('like', '%' . $searchname . '%'); // 会员名称
        // 省份
        $member_provinceid = intval(input('post.provinceid'));
        if ($member_provinceid > 0) {
            $where['member_provinceid'] = $member_provinceid;
        }
        // 城市
        $member_cityid = intval(input('post.cityid'));
        if ($member_cityid > 0) {
            $where['member_cityid'] = $member_cityid;
        }
        // 地区
        $member_areaid = intval(input('post.areaid'));
        if ($member_areaid > 0) {
            $where['member_areaid'] = $member_areaid;
        }
        // 性别
        $member_sex = intval(input('post.sex'));
        if ($member_sex > 0) {
            $where['member_sex'] = $member_sex;
        }
        // 年龄
        $member_birthday = intval(input('post.age'));
        if ($member_birthday > 0) {
            switch ($member_birthday) {
                case 1:
                    $s_time = strtotime((date('Y') - 18) . '-' . date('m') . '-' . date('d'));
                    $e_time = strtotime(date('Y-m-d'));
                    $where['member_birthday'] = array('BETWEEN', $s_time . ',' . $e_time);
                    break;
                case 2:
                    $s_time = strtotime((date('Y') - 24) . '-' . date('m-d'));
                    $e_time = strtotime((date('Y') - 18) . '-' . date('m') . '-' . (date('d') - 1));
                    $where['member_birthday'] = array('BETWEEN', $s_time . ',' . $e_time);
                    break;
                case 3:
                    $s_time = strtotime((date('Y') - 30) . '-' . date('m-d'));
                    $e_time = strtotime((date('Y') - 24) . '-' . date('m') . '-' . (date('d') - 1));
                    $where['member_birthday'] = array('BETWEEN', $s_time . ',' . $e_time);
                    break;
                case 4:
                    $s_time = strtotime((date('Y') - 35) . '-' . date('m-d'));
                    $e_time = strtotime((date('Y') - 30) . '-' . date('m') . '-' . (date('d') - 1));
                    $where['member_birthday'] = array('BETWEEN', $s_time . ',' . $e_time);
                    break;
                case 5:
                    $e_time = strtotime((date('Y') - 35) . '-' . date('m') . '-' . (date('d') - 1));
                    $where['member_birthday'] = array('elt', $e_time);
                    break;
            }
        }

        $memberlist = db('member')->where($where)->limit(50)->select();
        if (!empty($memberlist)) {
            $followid_arr = array_keys($followlist_new);
            foreach ($memberlist as $k => $v) {
                if (in_array($v['member_id'], $followid_arr)) {
                    $v['followstate'] = $followlist_new[$v['member_id']]['friend_followstate'];
                } else {
                    $v['followstate'] = 0;
                }
                //性别
                $v['sex_class'] = $this->m_sex($v['member_sex']);
                $memberlist[$k] = $v;
            }
        }
        $this->assign('memberlist', $memberlist);
        $this->setMemberCurItem('find');
        $this->setMemberCurMenu('member_snsfriend');
        return $this->fetch($this->template_dir . 'member_snsfriend_findlist');
    }

    /**
     * 加关注
     */
    public function addfollow() {
        $mid = intval(input('param.mid'));
        if ($mid <= 0) {
            ds_json_encode(10001,lang('wrong_argument'));
        }
        //验证会员信息
        $member_model = model('member');
        $condition_arr = array();
        $condition_arr['member_state'] = "1";
        $condition_arr['member_id'] = array('in', array($mid, session('member_id')));
        $member_list = $member_model->getMemberList($condition_arr);
        unset($condition_arr);
        if (empty($member_list)) {
            ds_json_encode(10001,lang('snsfriend_member_error'));
        }
        $self_info = array();
        $member_info = array();
        foreach ($member_list as $k => $v) {
            if ($v['member_id'] == session('member_id')) {
                $self_info = $v;
            } else {
                $member_info = $v;
            }
        }
        if (empty($self_info) || empty($member_info)) {
            ds_json_encode(10001,lang('snsfriend_member_error'));
        }
        //验证是否已经存在好友记录
        $snsfriend_model = model('snsfriend');
        $friend_count = $snsfriend_model->getSnsfriendCount(array('friend_frommid' => session('member_id'), 'friend_tomid' => "$mid"));
        if ($friend_count > 0) {
            ds_json_encode(10001,lang('snsfriend_havefollowed'));
        }
        //查询对方是否已经关注我，从而判断关注状态
        $friend_info = $snsfriend_model->getOneSnsfriend(array('friend_frommid' => "{$mid}", 'friend_tomid' => session('member_id')));
        $insert_arr = array();
        $insert_arr['friend_frommid'] = "{$self_info['member_id']}";
        $insert_arr['friend_frommname'] = "{$self_info['member_name']}";
        $insert_arr['friend_frommavatar'] = "{$self_info['member_avatar']}";
        $insert_arr['friend_tomid'] = "{$member_info['member_id']}";
        $insert_arr['friend_tomname'] = "{$member_info['member_name']}";
        $insert_arr['friend_tomavatar'] = "{$member_info['member_avatar']}";
        $insert_arr['friend_addtime'] = time();
        if (empty($friend_info)) {
            $insert_arr['friend_followstate'] = '1'; //单方关注
        } else {
            $insert_arr['friend_followstate'] = '2'; //双方关注
        }
        $result = $snsfriend_model->addSnsfriend($insert_arr);
        if ($result) {
            //更新对方关注状态
            if (!empty($friend_info)) {
                $snsfriend_model->editSnsfriend(array('friend_followstate' => '2'), array('friend_id' => "{$friend_info['friend_id']}"));
            }
            ds_json_encode(10000,'',array('state' => $insert_arr['friend_followstate']));
        } else {
            ds_json_encode(10001,'');
        }
    }

    /**
     * 取消关注
     */
    public function delfollow() {
        $mid = intval(input('param.mid'));
        if ($mid <= 0) {
            ds_json_encode(10001,lang('wrong_argument'));
        }
        //取消关注
        $snsfriend_model = model('snsfriend');
        $result = $snsfriend_model->delSnsfriend(array('friend_frommid' => session('member_id'), 'friend_tomid' => "$mid"));
        if ($result) {
            //更新对方的关注状态
            $snsfriend_model->editSnsfriend(array('friend_followstate' => '1'), array('friend_frommid' => "$mid", 'friend_tomid' => session('member_id')));
            ds_json_encode(10000,'');
        } else {
            ds_json_encode(10001,'');
        }
    }

    /**
     * 批量加关注
     */
    public function batch_addfollow() {
        // 验证参数
        if (trim(input('param.ids')) == '') {
            ds_json_encode(10001,lang('wrong_argument'));
        }
        $ids = explode(',', trim(input('param.ids')));
        if (empty($ids)) {
            ds_json_encode(10001,lang('wrong_argument'));
        }

        $member_info = db('member')->where('member_id',session('member_id'))->find();
        if (empty($member_info)) {
            ds_json_encode(10001,lang('snsfriend_member_error'));
        }

        // 将被关注会员列表
        $pm_array = db('member')->where(array('member_id' => array('in', $ids)))->select();

        // 查询是否已经关注
        $gz_array = db('snsfriend')->where(array('friend_frommid' => session('member_id'), 'friend_tomid' => array('in', $ids)))->select();
        $gz_array = array_under_reset($gz_array, 'friend_tomid', 1);
        // 查询对方是否关注我
        $bgz_array = db('snsfriend')->where(array('friend_frommid' => array('in', $ids), 'friend_tomid' => session('member_id')))->select();
        $bgz_array = array_under_reset($bgz_array, 'friend_frommid', 1);

        if (!empty($pm_array)) {
            $insert_array = array();
            foreach ($pm_array as $val) {
                if (isset($gz_array[$val['member_id']]))   // 已关注跳出循环
                    continue;
                if ($val['member_id'] == session('member_id')) // 不关注自己
                    continue;
                $insert = array();
                $insert['friend_frommid'] = $member_info['member_id'];
                $insert['friend_frommname'] = $member_info['member_name'];
                $insert['friend_frommavatar'] = $member_info['member_avatar'];
                $insert['friend_tomid'] = $val['member_id'];
                $insert['friend_tomname'] = $val['member_name'];
                $insert['friend_tomavatar'] = $val['member_avatar'];
                $insert['friend_addtime'] = time();
                if (isset($bgz_array[$val['member_id']])) {
                    $insert['friend_followstate'] = 2;
                    db('snsfriend')->update(array('friend_followstate' => 2, 'friend_id' => $bgz_array[$val['member_id']]['friend_id']));
                } else {
                    $insert['friend_followstate'] = 1;
                }
                $insert_array[] = $insert;
            }
            // 插入
            db('snsfriend')->insertAll($insert_array);
        }

        ds_json_encode(10000,lang('snsfriend_follow_succ'));
    }

    /**
     * 关注列表页面
     */
    public function follow() {
        $snsfriend_model = model('snsfriend');
        //关注列表
        $follow_list = $snsfriend_model->getSnsfriendList(array('friend_frommid' => session('member_id')), '*', 10, 'detail');
        if (!empty($follow_list)) {
            foreach ($follow_list as $k => $v) {
                $v['sex_class'] = $this->m_sex($v['member_sex']);
                $follow_list[$k] = $v;
            }
        }
        $this->assign('follow_list', $follow_list);
        $this->assign('show_page', $snsfriend_model->page_info->render());
        $this->setMemberCurItem('follow');
        $this->setMemberCurMenu('member_snsfriend');
        return $this->fetch($this->template_dir . 'member_snsfriend_follow');
    }

    /**
     * 粉丝列表
     */
    public function fan() {
        $snsfriend_model = model('snsfriend');
        //关注列表

        $fan_list = $snsfriend_model->getSnsfriendList(array('friend_tomid' => session('member_id')), '*', 10, 'fromdetail');
        if (!empty($fan_list)) {
            foreach ($fan_list as $k => $v) {
                $v['sex_class'] = $this->m_sex($v['member_sex']);
                $fan_list[$k] = $v;
            }
        }
        $this->assign('fan_list', $fan_list);
        $this->assign('show_page', $snsfriend_model->page_info->render());
        $this->setMemberCurItem('fan');
        $this->setMemberCurMenu('member_snsfriend');
        return $this->fetch($this->template_dir . 'member_snsfriend_fan');
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string	$menu_type	导航类型
     * @param string 	$menu_key	当前导航的menu_key
     * @param array 	$array		附加菜单
     * @return
     */
    protected function getMemberItemList() {
        $menu_array = array(
            array('name' => 'find', 'text' => lang('snsfriend_findmember'), 'url' => url('Membersnsfriend/index')),
            array('name' => 'follow', 'text' => lang('snsfriend_follow'), 'url' => url('Membersnsfriend/follow')),
            array('name' => 'fan', 'text' => lang('snsfriend_fans'), 'url' => url('Membersnsfriend/fan'))
        );
        return $menu_array;
    }

}
