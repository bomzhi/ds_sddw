<?php

namespace app\admin\controller;


use think\Lang;

class Pointprod extends AdminControl
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/pointprod.lang.php');
    }

    /**
     * 积分礼品列表
     */
    public function index()
    {
        $pointprod_model = model('pointprod');

        //获得兑换商品的上下架状态
        $pgoodsshowstate_arr = $pointprod_model->getPgoodsShowState();
        //获得兑换商品的推荐状态
        $pgoodsrecommendstate_arr = $pointprod_model->getPgoodsRecommendState();

        //条件
        $where = array();
        $pgoods_name = trim(input('param.pg_name'));
        if ($pgoods_name) {
            $where['pgoods_name'] = array('like', "%{$pgoods_name}%");
        }
        switch (trim(input('param.pg_state'))) {
            case 'show':
                $where['pgoods_show'] = $pgoodsshowstate_arr['show'][0];
                break;
            case 'nshow':
                $where['pgoods_show'] = $pgoodsshowstate_arr['unshow'][0];
                break;
            case 'commend':
                $where['pgoods_commend'] = $pgoodsrecommendstate_arr['commend'][0];
                break;
        }
        $prod_list = $pointprod_model->getPointProdList($where, '*', 'pgoods_sort asc,pgoods_id desc', 0, 10);
        //信息输出
        $this->assign('prod_list', $prod_list);
        $this->assign('show_page', $pointprod_model->page_info->render());
        $this->setAdminCurItem('index');
        return $this->fetch();
    }

    /**
     * 积分礼品添加
     */
    public function prod_add()
    {
        $hourarr = array(
            '00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17',
            '18', '19', '20', '21', '22', '23'
        );
        $upload_model = model('upload');
        if (request()->isPost()) {
            //验证表单
            $data = [
                'goodsname' => input('post.goodsname'), 'goodsprice' => input('post.goodsprice'),
                'goodspoints' => input('post.goodspoints'), 'goodsserial' => input('post.goodsserial'),
                'goodsstorage' => input('post.goodsstorage'), 'sort' => input('post.sort'),
            ];
            if (input('post.sort') == 1) {
                $data['limitnum'] = input('postlimitnumsort');
            }
            if (input('post.islimittime')) {
                $data['starttime'] = input('post.starttime');
                $data['endtime'] = input('post.endtime');
            }

            $point_validate = validate('point');
            if (!$point_validate->scene('prod_add')->check($data)) {
                $this->error($point_validate->getError());
            }
            $pointprod_model = model('pointprod');
            $goods_array = array();
            $goods_array['pgoods_name'] = trim(input('post.goodsname'));
            $goods_array['pgoods_tag'] = trim(input('post.goodstag'));
            $goods_array['pgoods_price'] = trim(input('post.goodsprice'));

            $goods_array['pgoods_points'] = trim(input('post.goodspoints'));
            $goods_array['pgoods_serial'] = trim(input('post.goodsserial'));
            $goods_array['pgoods_storage'] = intval(input('post.goodsstorage'));


            $goods_array['pgoods_islimit'] = intval(input('post.islimit'));
            if ($goods_array['pgoods_islimit'] == 1) {
                $goods_array['pgoods_limitnum'] = intval(input('post.limitnum'));
            }
            else {
                $goods_array['pgoods_limitnum'] = 0;
            }
            $goods_array['pgoods_islimittime'] = intval(input('post.islimittime'));
            if ($goods_array['pgoods_islimittime'] == 1) {
                //如果添加了开始时间
                if (trim(input('post.starttime'))) {
                    $starttime = trim(input('post.starttime'));
                    $sdatearr = explode('-', $starttime);
                    $starttime = mktime(intval(input('post.starthour')), 0, 0, $sdatearr[1], $sdatearr[2], $sdatearr[0]);
                    unset($sdatearr);
                }
                if (trim(input('post.endtime'))) {
                    $endtime = trim(input('post.endtime'));
                    $edatearr = explode('-', $endtime);
                    $endtime = mktime(intval(input('post.endhour')), 0, 0, $edatearr[1], $edatearr[2], $edatearr[0]);
                }
                $goods_array['pgoods_starttime'] = $starttime;
                $goods_array['pgoods_endtime'] = $endtime;
            }
            else {
                $goods_array['pgoods_starttime'] = '';
                $goods_array['pgoods_endtime'] = '';
            }
            $goods_array['pgoods_show'] = trim(input('post.showstate'));
            $goods_array['pgoods_commend'] = trim(input('post.commendstate'));
            $goods_array['pgoods_addtime'] = TIMESTAMP;

            //$goods_array['pgoods_state'] = trim($_POST['forbidstate']);

            $goods_array['pgoods_close_reason'] = trim(input('post.forbidreason'));
            $goods_array['pgoods_keywords'] = trim(input('post.keywords'));
            $goods_array['pgoods_description'] = trim(input('post.description'));

            $goods_array['pgoods_body'] = trim(input('post.pgoods_body'));
            $goods_array['pgoods_sort'] = intval(input('post.sort'));

            $goods_array['pgoods_limitmgrade'] = intval(input('post.limitgrade'));

            //添加礼品代表图片

            $indeximg_succ = false;

            if (!empty($_FILES['goods_images']['name'])) {

                $upload_file= BASE_UPLOAD_PATH . DS. ATTACH_POINTPROD;
                $file = request()->file('goods_images');
                $info = $file->rule('uniqid')->validate(['ext'=>ALLOW_IMG_EXT])->move($upload_file);
                if($info){
                    $indeximg_succ = true;
                    $file_name=$info->getFilename();
                    $goods_array['pgoods_image'] =$file_name;
                    ds_create_thumb($upload_file, $info->getFilename(), '60,240', '60,240','_small,_normal');
                }
                else {
                    $this->error($file->getError());
                }
            }

            $state = $pointprod_model->addPointgoods($goods_array);
            if ($state) {
                //礼品代表图片数据入库
                if ($indeximg_succ) {
                    $insert_array = array();
                    $insert_array['file_name'] = $file_name;
                    $insert_array['upload_type'] = 5;
                    $insert_array['file_size'] = filesize($upload_file. DS . $file_name);
                    $insert_array['item_id'] = $state;
                    $insert_array['upload_time'] = time();
                    $upload_model->addUpload($insert_array);
                }
                //更新积分礼品描述图片
                $file_idstr = '';
                $condition = array();
                $condition['upload_type'] =6;
                $condition['item_id'] =0;
                
                if (isset($_POST['file_id'])&&is_array($_POST['file_id']) && count($_POST['file_id']) > 0) {
                    $file_idstr = "'" . implode("','", $_POST['file_id']) . "'";
                    $condition['upload_id'] = array('in',$file_idstr);
                }
                $upload_model->editUpload(array('item_id' => $state), $condition);

                $this->log(lang('admin_pointprod_add_title') . '[' . input('post.goodsname') . ']');
                $this->success(lang('admin_pointprod_add_success'), 'pointprod/index');
            }
        }
        //模型实例化
        $where = array();
        $where['upload_type'] = '6';
        $where['item_id'] = '0';
        $file_upload = $upload_model->getUploadList($where);
        $this->assign('file_upload', $file_upload);
        $this->assign('PHPSESSID', session_id());
        $hourarr = array(
            '00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17',
            '18', '19', '20', '21', '22', '23'
        );
        $this->assign('hourarr', $hourarr);
        //会员级别
        $member_grade = model('member')->getMemberGradeArr();

        $this->assign('member_grade', $member_grade);
        $this->setAdminCurItem('prod_add');
        return $this->fetch();
    }

    /**
     * 积分礼品编辑
     */
    public function prod_edit()
    {
        $hourarr = array(
            '00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17',
            '18', '19', '20', '21', '22', '23'
        );
        $upload_model = model('upload');
        $pg_id = intval(input('param.pg_id'));
        if (!$pg_id) {
            $this->error(lang('admin_pointprod_parameter_error'), 'pointprod/index');
        }
        $pointprod_model = model('pointprod');
        //查询礼品记录是否存在
        $prod_info = $pointprod_model->getPointProdInfo(array('pgoods_id' => $pg_id));

        if (!$prod_info) {
            $this->error(lang('admin_pointprod_record_error'), 'pointprod/index');
        }
        if (request()->isPost()) {
            //验证表单
            $data = [
                'goodsname' => input('post.goodsname'), 'goodsprice' => input('post.goodsprice'),
                'goodspoints' => input('post.goodspoints'), 'goodsserial' => input('post.goodsserial'),
                'goodsstorage' => input('post.goodsstorage'), 'sort' => input('post.sort'),
            ];

            if (input('post.islimit') == 1) {
                $data['limitnum'] = input('post.limitnum');
            }
            if (input('post.islimittime')) {
                $data['starttime'] = input('post.starttime');
                $data['endtime'] = input('post.endtime');
            }

            $point_validate = validate('point');
            if (!$point_validate->scene('prod_edit')->check($data)) {
                $this->error($point_validate->getError());
            }

            //实例化店铺商品模型
            $pointprod_model = model('pointprod');

            $goods_array = array();
            $goods_array['pgoods_name'] = trim(input('post.goodsname'));
            $goods_array['pgoods_tag'] = trim(input('post.goodstag'));
            $goods_array['pgoods_price'] = trim(input('post.goodsprice'));

            $goods_array['pgoods_points'] = trim(input('post.goodspoints'));
            $goods_array['pgoods_serial'] = trim(input('post.goodsserial'));
            $goods_array['pgoods_storage'] = intval(input('post.goodsstorage'));
            $goods_array['pgoods_islimit'] = intval(input('post.islimit'));
            if ($goods_array['pgoods_islimit'] == 1) {
                $goods_array['pgoods_limitnum'] = intval(input('post.limitnum'));
            }
            else {
                $goods_array['pgoods_limitnum'] = 0;
            }
            $goods_array['pgoods_islimittime'] = intval(input('post.islimittime'));
            if ($goods_array['pgoods_islimittime'] == 1) {
                //如果添加了开始时间
                if (trim(input('post.starttime'))) {
                    $starttime = trim(input('post.starttime'));
                    $sdatearr = explode('-', $starttime);
                    $starttime = mktime(intval(input('post.starthour')), 0, 0, $sdatearr[1], $sdatearr[2], $sdatearr[0]);
                    unset($sdatearr);
                }
                if (trim(input('post.endtime'))) {
                    $endtime = trim(input('post.endtime'));
                    $edatearr = explode('-', $endtime);
                    $endtime = mktime(intval(input('post.endhour')), 0, 0, $edatearr[1], $edatearr[2], $edatearr[0]);
                }
                $goods_array['pgoods_starttime'] = $starttime;
                $goods_array['pgoods_endtime'] = $endtime;
            }
            else {
                $goods_array['pgoods_starttime'] = '';
                $goods_array['pgoods_endtime'] = '';
            }
            $goods_array['pgoods_show'] = trim(input('post.showstate'));
            $goods_array['pgoods_commend'] = trim(input('post.commendstate'));

            $goods_array['pgoods_close_reason'] = trim(input('post.forbidreason'));
            $goods_array['pgoods_keywords'] = trim(input('post.keywords'));
            $goods_array['pgoods_description'] = trim(input('post.description'));

            $goods_array['pgoods_body'] = trim(input('post.pgoods_body'));

            $goods_array['pgoods_sort'] = intval(input('post.sort'));
            $goods_array['pgoods_limitmgrade'] = intval(input('post.limitgrade'));

            //添加礼品代表图片
            $indeximg_succ = false;

            if (!empty($_FILES['goods_images']['name'])) {
                $upload_file = BASE_UPLOAD_PATH . DS . ATTACH_POINTPROD;
                $file = request()->file('goods_images');
                $info = $file->rule('uniqid')->validate(['ext' => ALLOW_IMG_EXT])->move($upload_file);
                if ($info) {
                    $indeximg_succ = true;
                    $file_name = $info->getFilename();
                    $goods_array['pgoods_image'] = $file_name;
                    ds_create_thumb($upload_file, $info->getFilename(), '60,240', '60,240','_small,_normal');
                } else {
                    $this->error($file->getError());
                }
            }

            $state = $pointprod_model->editPointProd($goods_array, array('pgoods_id' => $prod_info['pgoods_id']));
            if ($state) {
                //礼品代表图片数据入库
                if ($indeximg_succ) {
                    //删除原有图片
                    $upload_list = $upload_model->getUploadList(array('upload_type' => 5,'item_id' => $prod_info['pgoods_id']));

                    if (is_array($upload_list) && count($upload_list) > 0) {
                        $upload_idarr = array();
                        foreach ($upload_list as $v) {
                            //批量删除图片
                            ds_unlink($upload_file, $v['file_name']);
                            $upload_idarr[] = $v['upload_id'];
                        }
                        //删除图片
                        $condition = array();
                        $condition['upload_id'] = array('in',$upload_idarr);
                        $upload_model->delUpload($upload_idarr);
                    }
                    $insert_array = array();
                    $insert_array['file_name'] = $file_name;
                    $insert_array['upload_type'] = 5;
                    $insert_array['file_size'] = filesize($upload_file . DS . $file_name);
                    $insert_array['item_id'] = $prod_info['pgoods_id'];
                    $insert_array['upload_time'] = time();
                    $upload_model->addUpload($insert_array);
                }
                //更新积分礼品描述图片
                
                $file_idstr = '';
                $condition = array();
                $condition['upload_type'] =6;
                $condition['item_id'] =0;
                if (isset($_POST['file_id'])&&is_array($_POST['file_id']) && count($_POST['file_id']) > 0) {
                    $file_idstr = "'" . implode("','", $_POST['file_id']) . "'";
                    $condition['upload_id'] = array('in',$file_idstr);
                }
                $upload_model->editUpload(array('item_id' => $prod_info['pgoods_id']), $condition);
                
                
                $this->log(lang('ds_edit').lang('admin_pointprodp') . '[' . input('post.goodsname') . ']');
                $this->success(lang('admin_pointprod_edit_success'), 'pointprod/index');
            }
            $this->error(lang('admin_pointprod_edit_fail'));
        }
        else {
            $where = array();
            $where['upload_type'] = '6';
            $where['item_id'] = $prod_info['pgoods_id'];
            $file_upload = $upload_model->getUploadList($where);
            //会员级别
            $member_grade = model('member')->getMemberGradeArr();
            $this->assign('member_grade', $member_grade);
            $this->assign('file_upload', $file_upload);
            $this->assign('PHPSESSID', session_id());
            $this->assign('hourarr', $hourarr);
            $this->assign('prod_info', $prod_info);
            $this->setAdminCurItem('prod_edit');
            return $this->fetch();
        }
    }

    /**
     * 删除积分礼品
     */
    public function prod_drop()
    {
        $pg_id = input('param.pg_id');
        $pg_id_array = ds_delete_param($pg_id);
        if($pg_id_array === FALSE){
            ds_json_encode('10001', lang('admin_pointprod_parameter_error'));
        }
        $pointprod_model = model('pointprod');
        $result = $pointprod_model->delPointProdById($pg_id_array);
        if ($result) {
            $this->log(lang('ds_del').lang('admin_pointprodp') . '[ID:' . $pg_id . ']');
            ds_json_encode('10000', lang('admin_pointprod_del_success'));
        }
        else {
            ds_json_encode('10001', lang('admin_pointprod_del_fail'));
        }
    }

    /**
     * 积分礼品异步状态修改
     */
    public function ajax()
    {
        //礼品上架,礼品推荐,礼品禁售
        $id = intval(input('param.id'));
        if ($id <= 0) {
            echo 'false';
            exit;
        }
        $pointprod_model = model('pointprod');
        $update_array = array();
        $update_array[input('param.column')] = trim(input('param.value'));
        $pointprod_model->editPointProd($update_array, array('pgoods_id' => $id));
        echo 'true';
        exit;
    }

    /**
     * 积分礼品上传
     */
    public function pointprod_pic_upload()
    {
        /**
         * 上传图片
         */

        $file_name = '';
        $upload_file = BASE_UPLOAD_PATH . DS . ATTACH_POINTPROD;
        $file_object = request()->file('fileupload');
        if ($file_object) {
            $info = $file_object->rule('uniqid')->validate(['ext' => ALLOW_IMG_EXT])->move($upload_file);
            if ($info) {
                $file_name = $info->getFilename();
            } else {
                echo $file_object->getError();
                exit;
            }
        } else {
            echo 'error';
            exit;
        }
        
        /**
         * 模型实例化
         */
        $upload_model = model('upload');
        /**
         * 图片数据入库
         */
        $insert_array = array();
        $insert_array['file_name'] = $file_name;
        $insert_array['upload_type'] = '6';
        $insert_array['file_size'] = $_FILES['fileupload']['size'];
        $insert_array['upload_time'] = time();
        $insert_array['item_id'] = input('param.item_id',0);
        $result = $upload_model->addUpload($insert_array);
        if ($result) {
            $data = array();
            $data['file_id'] = $result;
            $data['file_name'] = $file_name;
            $data['file_path'] = UPLOAD_SITE_URL.'/' .ATTACH_POINTPROD.'/'.$file_name;
            /**
             * 整理为json格式
             */
            $output = json_encode($data);
            echo $output;
        }
    }

    /**
     * ajax操作删除已上传图片
     */
    public function ajaxdelupload()
    {
        //删除文章图片
        if (intval(input('param.file_id')) > 0) {
            $upload_model = model('upload');
            /**
             * 删除图片
             */
            $file_array = $upload_model->getOneUpload(intval(input('param.file_id')));
            @unlink(BASE_UPLOAD_PATH . DS . ATTACH_POINTPROD . DS . $file_array['file_name']);
            /**
             * 删除信息
             */
            $condition = array();
            $condition['upload_id'] = intval(input('param.file_id'));
            $upload_model->delUpload($condition);
            echo 'true';
            exit;
        }
        else {
            echo 'false';
            exit;
        }
    }

    protected function getAdminItemList()
    {
        $menu_array = array(
            array(
                'name' => 'index', 'text' => '礼品列表', 'url' => url('Pointprod/index')
            ), array(
                'name' => 'prod_add', 'text' => '新增礼品', 'url' => url('Pointprod/prod_add')
            ), array(
                'name' => 'add', 'text' => '兑换列表', 'url' => url('Pointorder/pointorder_list')
            ),
        );
        if (request()->action() == 'prod_edit') {
            $menu_array[] = array(
                'name' => 'prod_edit', 'text' => '编辑礼品', 'url' => '#'
            );
        }

        return $menu_array;
    }
}