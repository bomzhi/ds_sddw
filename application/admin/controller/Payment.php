<?php

namespace app\admin\controller;

use think\Lang;

class Payment extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/payment.lang.php');
    }

    /**
     * 支付方式
     */
    public function index() {
        $payment_model = model('payment');
        //获取数据库中已安装的支付方式
        $install_payment_list = $payment_model->getPaymentList(array('payment_code' => array('neq', 'predeposit')));
        $install_payment_list = ds_change_arraykey($install_payment_list,'payment_code');
        //获取已存在的支付列表文件
        $file_payment_list = $payment_model->get_builtin();
        
        foreach ($file_payment_list as $key => $value)
        {
            if(array_key_exists($key, $install_payment_list)){
                $file_payment_list[$key]['install'] = 1;
                //已安装的支付，配置信息使用数据库中配置信息
                $file_payment_list[$key]['payment_config'] = $install_payment_list[$key]['payment_config'];
                $file_payment_list[$key]['payment_state'] = $install_payment_list[$key]['payment_state'];
            }else{
                $file_payment_list[$key]['install'] = 0;
                $file_payment_list[$key]['payment_state'] = 0;
            }
        }
        
        $this->assign('payment_list', $file_payment_list);
        $this->setAdminCurItem('index');
        return $this->fetch();
    }
    /**
     * 安装支付方式
     */
    function install()
    {
        $payment_code = input('param.payment_code');
        $payment_mod = model('payment');
        $payment = model('payment')->getPaymentInfo(array('payment_code'=>$payment_code));
        if (empty($payment)) {
            $file_payment = include_once(PLUGINS_PATH . '/payments/' . $payment_code . '/payment.info.php');
            $data['payment_code'] = $file_payment['payment_code'];
            $data['payment_name'] = $file_payment['payment_name'];
            $data['payment_state'] = 1;
            $data['payment_platform'] = $file_payment['payment_platform'];
            $data['payment_config'] = serialize(array());
            $resutlt = $payment_mod->addPayment($data);
            if($resutlt){
                ds_json_encode('10000', lang('ds_common_op_succ'));
            }else{
                ds_json_encode('10001', lang('ds_common_op_fail'));
            }
        } else {
            ds_json_encode('10001', lang('ds_common_op_fail'));
        }
    }
    /**
     * 编辑
     */
    public function edit() {
        $payment_model = model('payment');
        $payment_code = trim(input('param.payment_code'));
        $install_payment = $payment_model->getPaymentInfo(array('payment_code' => $payment_code));
            $file_payment = include_once(PLUGINS_PATH . '/payments/' . $install_payment['payment_code'] . '/payment.info.php');
            
            if(is_array($file_payment['payment_config'])){
                $install_payment_config = unserialize($install_payment['payment_config']);
                unset($install_payment['payment_config']);
                foreach ($file_payment['payment_config'] as $key => $value){
                    $install_payment['payment_config'][$key]['name'] = $value['name'];
                    $install_payment['payment_config'][$key]['type'] = $value['type'];
                    $install_payment['payment_config'][$key]['desc'] = lang($value['name'].'_desc');
                    $install_payment['payment_config'][$key]['lable'] = lang($value['name']);
                    $install_payment['payment_config'][$key]['value'] = isset($install_payment_config[$value['name']])?$install_payment_config[$value['name']]:$value['value'];
                }
            }
        if (!(request()->isPost())) {
            
            $this->assign('payment', $install_payment);
            return $this->fetch();
        } else {
            $data = array();
            $data['payment_state'] = intval(input('post.payment_state'));
            $config_info = array();
            if (isset($_POST['cfg_value']) && is_array($_POST['cfg_value'])){
                for ($i = 0; $i < count($_POST['cfg_value']); $i++){
                    $config_info[trim($_POST['cfg_name'][$i])] = trim($_POST['cfg_value'][$i]);
                }
            }
            if(isset($_POST['cfg_name2']) && is_array($_POST['cfg_name2'])){
                for ($i = 0; $i < count($_POST['cfg_name2']); $i++){
                    $cfg_value2=isset($install_payment_config[trim($_POST['cfg_name2'][$i])])?$install_payment_config[trim($_POST['cfg_name2'][$i])]:'';
                    $file=array();
                    foreach ($_FILES['cfg_value2'] as $key => $value) {
                        $file[$key] = $value[$i];
                    }
                    if (!empty($file['name'])) {
                        $upload_file = PLUGINS_PATH . '/payments/' . $install_payment['payment_code'] . '/asserts';
                        $file = request()->file('cfg_value2.'.$i);
                        $result = $file->move($upload_file,false);
                        if ($result) {
                            $cfg_value2 = $result->getFilename();
                        }
                    }
                    $config_info[trim($_POST['cfg_name2'][$i])] = $cfg_value2;
                }
            }
            $data['payment_config'] = serialize($config_info);
            $payment_model->editPayment($data, array('payment_code' => $payment_code));
            dsLayerOpenSuccess(lang('ds_common_op_succ'));
//            $this->success(lang('ds_common_op_succ'), 'Payment/index');
        }
    }
    
    /**
     * 删除支付方式,卸载
     */
    public function del()
    {
        $payment_model = model('payment');
        $payment_code = trim(input('param.payment_code'));
        $condition['payment_code'] = $payment_code;
        $result = $payment_model->delPayment($condition);
        if($result){
            ds_json_encode('10000', lang('ds_common_op_succ'));
        }else{
            ds_json_encode('10001', lang('ds_common_op_fail'));
        }
    }
    

    
    /**
     * 获取卖家栏目列表,针对控制器下的栏目
     */
    protected function getAdminItemList() {
        $menu_array = array(
            array(
                'name' => 'index',
                'text' => '支付方式',
                'url' => url('Payment/index')
            ),
        );
        return $menu_array;
    }

}

?>
