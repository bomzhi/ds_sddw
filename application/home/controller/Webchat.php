<?php
namespace app\home\controller;
use think\Lang;

class Webchat extends BaseMember {

    public function _initialize() {
        parent::_initialize(); // TODO: Change the autogenerated stub
        Lang::load(APP_PATH . 'home/lang/'.config('default_lang').'/webchat.lang.php');
    }

    /**
     * add msg
     *
     */
    public function send_msg() {
        $webchat_model = model('webchat');
        $member_id = session('member_id');
        $member_name = session('member_name');
        $f_id = intval(input('param.f_id'));
        $t_id = intval(input('param.t_id'));
        $t_name = trim(input('param.t_name'));
        if (($member_id < 1) || ($member_id != $f_id))
            $this->chaterror(lang('ds_member_chat_login'));
        $member = $webchat_model->getMember($t_id);
        if ($t_name != $member['member_name'])
            $this->chaterror(lang('ds_member_chat_name_error'));

        $msg = array();
        $msg['f_id'] = $f_id;
        $msg['f_name'] = $member_name;
        $msg['t_id'] = $t_id;
        $msg['t_name'] = $t_name;
        $msg['t_msg'] = trim(input('param.t_msg'));
        if ($msg['t_msg'] != '')
            $chat_msg = $webchat_model->addChatmsg($msg);
        if ($chat_msg['m_id']) {
            $this->json($chat_msg);
        } else {
            $this->chaterror(lang('ds_member_chat_add_error'));
        }
    }

    /**
     * friends info
     *
     */
    public function get_user_list() {
        $member_list = array();
        $webchat_model = model('webchat');
        $member_id = session('member_id');
        $member_name = session('member_name');
        $f_id = intval(input('f_id'));
        if (($member_id < 1) || ($member_id != $f_id))
            $this->chaterror(lang('ds_member_chat_login'));
        $n = intval(input('n'));
        if ($n < 1)
            $n = 50;
        $member_list = $webchat_model->getFriendList(array('friend_frommid' => $f_id), $n, $member_list);
        $chat_add_time = date("Y-m-d");
        $chat_add_time30 = strtotime($chat_add_time) - 60 * 60 * 24 * 30;
        $member_list = $webchat_model->getRecentList(array('f_id' => $f_id, 'chatmsg_addtime' => array('egt', $chat_add_time30)), 10, $member_list);
        $member_list = $webchat_model->getRecentFromList(array('t_id' => $f_id, 'chatmsg_addtime' => array('egt', $chat_add_time30)), 10, $member_list);
        $this->json($member_list);
    }

    /**
     * 商家客服
     *
     */
    public function get_seller_list() {
        $member_list = array();
        $webchat_model = model('webchat');
        $member_id = session('member_id');
        $member_name = session('member_name');
        $store_id = session('store_id');
        $f_id = intval(input('f_id'));
        if (($member_id < 1) || ($member_id != $f_id)){
            $this->chaterror(lang('ds_member_chat_login'));
        }
        $n = intval(input('n'));
        if ($n < 1)
            $n = 50;
        if (!session('seller_list')) {
            $member_list = $webchat_model->getWebchatSellerList(array('seller.store_id' => $store_id), $n, $member_list);
            session('seller_list', $member_list);
        } else {
            $member_list = session('seller_list');
        }
        $chat_add_time = date("Y-m-d");
        $chat_add_time30 = strtotime($chat_add_time) - 60 * 60 * 24 * 30;
        $member_list = $webchat_model->getRecentList(array('f_id' => $f_id, 'chatmsg_addtime' => array('egt', $chat_add_time30)), 10, $member_list);
        $member_list = $webchat_model->getRecentFromList(array('t_id' => $f_id, 'chatmsg_addtime' => array('egt', $chat_add_time30)), 10, $member_list);
        $this->json($member_list);
    }

    /**
     * member info
     *
     */
    public function get_info() {
        if (session('member_id') < 1)
            $this->chaterror(lang('ds_member_chat_login'));
        $val = '';
        $member = array();
        $webchat_model = model('webchat');
        $types = array('member_id', 'member_name', 'store_id', 'member');
        $key = input('t');
        $member_id = intval(input('u_id'));
        if (trim($key) != '' && in_array($key, $types)) {
            $member = $webchat_model->getMember($member_id);
            $this->json($member);
        }
    }

    /**
     * chat log
     *
     */
    public function get_chat_log() {
        $member_id = session('member_id');
        $f_id = intval(input('f_id'));
        $t_id = intval(input('t_id'));
        if (($member_id < 1) || ($member_id != $f_id))
            $this->chaterror(lang('ds_member_chat_login'));
        $add_time_to = date("Y-m-d");
        $time_from = array();
        $time_from['7'] = strtotime($add_time_to) - 60 * 60 * 24 * 7;
        $time_from['15'] = strtotime($add_time_to) - 60 * 60 * 24 * 15;
        $time_from['30'] = strtotime($add_time_to) - 60 * 60 * 24 * 30;

        $key = input('get.t');
        if (trim($key) != '' && array_key_exists($key, $time_from)) {
            $webchat_model = model('webchat');
            $chat_log = array();
            $list = array();
            $condition_sql = " chatlog_addtime >= '" . $time_from[$key] . "' ";
            $condition_sql .= " and ((f_id = '" . $f_id . "' and t_id = '" . $t_id . "') or (f_id = '" . $t_id . "' and t_id = '" . $f_id . "'))";
            $list = $webchat_model->getChatlogList($condition_sql, '10');
            $chat_log['list'] = $list;
            $chat_log['total_page'] = $webchat_model->page_info->lastPage();
            $this->json($chat_log);
        }
    }

    /**
     * 商品图片和名称
     *
     */
    public function get_goods_info() {
        $webchat_model = model('webchat');
        $goods_id = intval(input('goods_id'));
        $goods = $webchat_model->getGoodsInfo($goods_id);
        $this->json($goods);
    }

    /**
     * 店铺推荐商品图片和名称
     *
     */
    public function get_goods_list() {
        $s_id = intval(input('s_id'));
        if ($s_id > 0) {
            $goods_model = model('goods');
            $list = $goods_model->getGoodsCommendList($s_id, 4);
            if (!empty($list) && is_array($list)) {
                foreach ($list as $k => $v) {
                    $v['goods_promotion_price'] = ds_price_format($v['goods_promotion_price']);
                    $v['url'] = url('Goods/index', array('goods_id' => $v['goods_id']));
                    $v['pic'] = goods_thumb($v, 240);
                    $list[$k] = $v;
                }
            }
            $this->json($list);
        }
    }

    /**
     * get session
     *
     */
    public function get_session() {
        $key = input('key');
        $val = '';
        if (session($key))
            $val = session($key);
        echo $val;
        exit;
    }

    /**
     * json
     *
     */
    public function json($json) {
        echo input('get.callback') . '(' . json_encode($json) . ')';
        exit;
    }

    /**
     * error
     *
     */
    public function chaterror($msg = '') {
        $this->json(array('error' => $msg));
    }

}