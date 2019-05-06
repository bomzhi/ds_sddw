<?php
namespace app\common\model;
use think\Model;
class Arrivalnotice extends Model
{
    /**
     * 通知列表
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $field 字段
     * @param number $limit 数量限制
     * @param string $order 排序
     * @return array
     */
    public function getArrivalNoticeList($condition = array(), $field = '*', $limit = '', $order = 'arrivalnotice_id desc') {
        return db('arrivalnotice')->where($condition)->field($field)->limit($limit)->order($order)->select();
    }

    /**
     * 单条通知
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param string $field 字段
     * @return type
     */
    public function getArrivalNoticeInfo($condition, $field = '*') {
        return db('arrivalnotice')->where($condition)->field($field)->find();
    }

    /**
     * 通知数量
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $order 排序
     * @return array
     */
    public function getArrivalNoticeCount($condition) {
        return db('arrivalnotice')->where($condition)->count();
    }


    /**
     * 添加通知
     * @access public
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool
     */
    public function addArrivalNotice($data) {
        $data['arrivalnotice_addtime'] = TIMESTAMP;
        return db('arrivalnotice')->insertGetId($data);
    }

    /**
     * 删除通知
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @return bool
     */
    public function delArrivalNotice($condition) {
        return db('arrivalnotice')->where($condition)->delete();
    }
}