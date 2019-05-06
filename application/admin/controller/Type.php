<?php

/*
 * 类型管理
 */

namespace app\admin\controller;

use think\Lang;

class Type extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/type.lang.php');
    }

    public function index() {
        $type_model = model('type');
        $type_list = $type_model->getTypeList('', 10);
        // 获取分页显示
        $this->assign('type_list', $type_list);
        $this->assign('show_page', $type_model->page_info->render());
        $this->setAdminCurItem('index');
        return $this->fetch();
    }

    /*
     * 新增类型
     */

    public function type_add() {
        if (!(request()->isPost())) {
            $type = [
                'class_id' => 0,
            ];
            $this->assign('type', $type);
            //设置类型关联的分类
            $gc_list = model('goodsclass')->getGoodsclassListByParentId(0);
            $this->assign('gc_list', $gc_list);
            
            $this->setAdminCurItem('type_add');
            return $this->fetch('type_form');
        } else {


            $data = array(
                'type_name' => input('post.type_name'),
                'type_sort' => input('post.type_sort'),
                'class_id' => input('post.class_id'),
                'class_name' => input('post.class_name'),
            );
            $type_validate = validate('type');
            if (!$type_validate->scene('type_add')->check($data)) {
                $this->error($type_validate->getError());
            }

            //添加类型
            $type_model = model('type');
            $type_id = $type_model->typeAdd('type', $data);
            if (empty($type_id)) {
                $this->error(lang('ds_common_save_fail'));
            }

            //添加类型与品牌对应
            if (!empty($_POST['brand_id'])) {
                $brand_array = $_POST['brand_id'];
                if (is_array($brand_array)) {
                    foreach ($brand_array as $brand_id) {
                        $typebrand[] = array('type_id' => $type_id, 'brand_id' => $brand_id);
                    }
                    $type_model->addTypebrand($typebrand);
                }
            }
            //添加类型与规格对应
            if (!empty($_POST['spec_id'])) {
                $spec_array = $_POST['spec_id'];
                if (is_array($spec_array)) {
                    foreach ($spec_array as $sp_id) {
                        $typespec[] = array('type_id' => $type_id, 'sp_id' => $sp_id);
                    }
                    $type_model->addTypespec($typespec);
                }
            }

            //添加类型属性
            if (!empty($_POST['at_value'])) {
                $attribute_array = $_POST['at_value'];
                foreach ($attribute_array as $v) {
                    if ($v['value'] != '') {
                        //属性值
                        //添加属性
                        $attr_array = array();
                        $attr_array['attr_name'] = $v['name'];
                        $attr_array['attr_value'] = $v['value'];
                        $attr_array['type_id'] = $type_id;
                        $attr_array['attr_sort'] = $v['sort'];
                        $attr_array['attr_show'] = isset($v['show']) && $v['show'] == "on" ? 1 : 0;
                        $attr_id = $type_model->typeAdd('attribute', $attr_array);
                        if (!$attr_id) {
                            $this->error(lang('type_index_related_fail'));
                        }
                        //添加属性值
                        $attr_value = explode(',', $v['value']);
                        if (!empty($attr_value)) {
                            $attr_array = array();
                            foreach ($attr_value as $val) {
                                $tpl_array = array();
                                $tpl_array['attrvalue_name'] = $val;
                                $tpl_array['attr_id'] = $attr_id;
                                $tpl_array['type_id'] = $type_id;
                                $tpl_array['attrvalue_sort'] = 0;
                                $attr_array[] = $tpl_array;
                            }
                            $return = model('attribute')->addAttributeValueAll($attr_array);
                            if (!$return) {
                                $this->error(lang('type_index_related_fail'));
                            }
                        }
                    }
                }
            }
            $this->success(lang('ds_common_op_succ'), 'Type/index');
        }
    }

    public function type_edit() {
        $type_id = input('param.type_id');
        if (empty($type_id)) {
            $this->error(lang('param_error'));
        }
        $type_model = model('type');
        if (!(request()->isPost())) {
            $type = $type_model->getOneType(array('type_id' => $type_id));
            if(empty($type)){
                $this->error(lang('param_error'));
            }
            $this->assign('type', $type);
            //设置类型关联的分类
            $gc_list = model('goodsclass')->getGoodsclassListByParentId(0);
            $this->assign('gc_list', $gc_list);
            //根据相同分类检索出对应的品牌
            $b_related = $this->getBrand($type['class_id'],$type_id);
            $this->assign('brand_list', $b_related);
            //根据相同分类检索出对应的规格
            $sp_related = $this->getSpec($type['class_id'],$type_id);
            $this->assign('spec_list', $sp_related);
            //属性
            $attr_list = $type_model->typeRelatedList('attribute', array('type_id' => $type_id));
            $this->assign('attr_list', $attr_list);
            $this->setAdminCurItem('type_edit');
            return $this->fetch('type_form');
        } else {

            $data = array(
                'type_name' => input('post.type_name'),
                'type_sort' => input('post.type_sort'),
                'class_id' => input('post.class_id'),
                'class_name' => input('post.class_name'),
            );
            $type_validate = validate('type');
            if (!$type_validate->scene('type_edit')->check($data)) {
                $this->error($type_validate->getError());
            }

            //更新前删除对应类型与品牌关联
            $type_model->delTypebrand(array('type_id' => $type_id));
            //添加类型与品牌对应
            if (!empty($_POST['brand_id'])) {
                $brand_array = $_POST['brand_id'];
                if (is_array($brand_array)) {
                    foreach ($brand_array as $brand_id) {
                        $typebrand[] = array('type_id' => $type_id, 'brand_id' => $brand_id);
                    }
                    $type_model->addTypebrand($typebrand);
                }
            }
            //添加类型与规格对应
            //更新前删除对应类型与规格关联
            $type_model->delTypespec(array('type_id' => $type_id));
            if (!empty($_POST['spec_id'])) {
                $spec_array = $_POST['spec_id'];
                if (is_array($spec_array)) {
                    foreach ($spec_array as $sp_id) {
                        $typespec[] = array('type_id' => $type_id, 'sp_id' => $sp_id);
                    }
                    $type_model->addTypespec($typespec);
                }
            }

            //添加类型属性
            if (!empty($_POST['at_value'])) {
                $attribute_array = $_POST['at_value'];
                foreach ($attribute_array as $v) {

                    // 要删除的属性id
                    $del_array = array();
                    if (!empty($_POST['a_del'])) {
                        $del_array = $_POST['a_del'];
                    }

                    if (isset($v['attr_id']) && !in_array($v['attr_id'], $del_array)) {
                        //原属性修改
                        $attr_array = array();
                        $attr_array['attr_name'] = $v['name'];
                        $attr_array['type_id'] = $type_id;
                        $attr_array['attr_sort'] = $v['sort'];
                        $attr_array['attr_show'] = isset($v['show']) && $v['show'] == "on" ? 1 : 0;
                        $condition = array();
                        $condition['type_id'] = $type_id;
                        $condition['attr_id'] = intval($v['attr_id']);
                        $return = $type_model->editAttribute($condition,$attr_array);
                    } else if (!isset($v['form_submit'])) {
                        //添加新属性
                        if ($v['value'] != '') {
                            //属性值
                            //添加属性
                            $attr_array = array();
                            $attr_array['attr_name'] = $v['name'];
                            $attr_array['attr_value'] = $v['value'];
                            $attr_array['type_id'] = $type_id;
                            $attr_array['attr_sort'] = $v['sort'];
                            $attr_array['attr_show'] = isset($v['show']) && $v['show'] == "on" ? 1 : 0;
                            $attr_id = $type_model->typeAdd('attribute', $attr_array);
                            if (!$attr_id) {
                                $this->error(lang('type_index_related_fail'));
                            }
                            //添加属性值
                            $attr_value = explode(',', $v['value']);
                            if (!empty($attr_value)) {
                                $attr_array = array();
                                foreach ($attr_value as $val) {
                                    $tpl_array = array();
                                    $tpl_array['attrvalue_name'] = $val;
                                    $tpl_array['attr_id'] = $attr_id;
                                    $tpl_array['type_id'] = $type_id;
                                    $tpl_array['attrvalue_sort'] = 0;
                                    $attr_array[] = $tpl_array;
                                }
                                $return = model('attribute')->addAttributeValueAll($attr_array);
                                if (!$return) {
                                    $this->error("添加属性值失败");
                                }
                            }
                        }
                    }
                }

                // 删除属性
                $del_array = array();
                if (!empty($_POST['a_del'])) {
                    $del_array = $_POST['a_del'];
                    foreach ($del_array as $key => $del_id) {
                        $type_model->delAttribute(array('attr_id' => $del_id));
                        $type_model->delAttributevalue(array('attr_id' => $del_id));
                    }
                }

                //更新属性信息
                $type_array = array();
                $type_array['type_name'] = trim(input('post.type_name'));
                $type_array['type_sort'] = trim(input('post.type_sort'));
                $type_array['class_id'] = input('post.class_id');
                $type_array['class_name'] = input('post.class_name');
                $type_model->editType(array('type_id' => $type_id),$type_array);
            }
            dsLayerOpenSuccess(lang('ds_common_op_succ'));
        }
    }

    public function attr_edit() {
        $type_model = model('type');
        $attr_id = input('param.attr_id');
        if (empty($attr_id)) {
            $this->error(lang('param_error'));
        }
        if (!(request()->isPost())) {
            $attribute = $type_model->getOneAttribute(array('attr_id' => $attr_id));
            $this->assign('attribute', $attribute);
            $attributevalue_list = $type_model->getAttributevalueList(array('attr_id' => $attr_id));
            $this->assign('attributevalue_list', $attributevalue_list);
            $this->setAdminCurItem('attr_edit');
            return $this->fetch();
        } else {
            $data = array(
                'attr_name' => input('post.attr_name'),
                'type_id' => input('post.type_id'),
                'attr_show' => input('post.attr_show'),
                'attr_sort' => input('post.attr_sort'),
            );
            $type_validate = validate('type');
            if (!$type_validate->scene('attr_edit')->check($data)) {
                $this->error($type_validate->getError());
            }

            $del_array = array();
            if (!empty($_POST['attr_del'])) {
                $del_array = $_POST['attr_del'];
            }
            //更新属性值表
            $attr_value = $_POST['attr_value'];
            $attr_array = array();
            // 要删除的属性值id
            $del_array = array();
            if (!empty($_POST['attr_del'])) {
                $del_array = $_POST['attr_del'];
            }
            if (!empty($attr_value) && is_array($attr_value)) {
                foreach ($attr_value as $key => $val) {

                    if (isset($val['form_submit']) && !in_array(intval($key), $del_array)) {  // 属性已修改
                        $update = array();
                        $update['attrvalue_name'] = $val['name'];
                        $update['attrvalue_sort'] = intval($val['sort']);
                        $type_model->editAttributevalue(array('attrvalue_id' => intval($key)),$update);

                        $attr_array[] = $val['name'];
                    } else if (!isset($val['form_submit'])) {

                        $insert = array();
                        $insert['attrvalue_name'] = $val['name'];
                        $insert['attr_id'] = $attr_id;
                        $insert['type_id'] = input('post.type_id');
                        $insert['attrvalue_sort'] = intval($val['sort']);
                        $type_model->addAttributevalue($insert);

                        $attr_array[] = $val['name'];
                    }
                }
                // 删除属性
                if ($del_array) {
                    foreach ($del_array as $key => $value) {
                        $type_model->delAttributevalue($value);
                    }
                }
            }

            //更新属性
            $data['attr_value'] = implode(',', $attr_array);
            $type_model->editAttribute(array('attr_id' => $attr_id),$data);
            // 不需要返回
            $this->success(lang('ds_common_op_succ'), 'Type/index');
        }
    }

    /*
     * 删除类型
     */
    public function type_drop() {
        $type_model = model('type');
        $type_id = input('param.type_id');
        if (empty($type_id)) {
            ds_json_encode(10001, lang('param_error'));
        }
        $condition = array();
        $condition['type_id'] = $type_id;
        //更新前删除对应类型与品牌关联
        $type_model->delTypebrand($condition);
        //更新前删除对应类型与规格关联
        $type_model->delTypespec($condition);
        //删除属性
        $type_model->delAttribute($condition);
        //删除属性值
        $type_model->delAttributevalue($condition);
        //删除类型
        $result = $type_model->delType($condition);
        if ($result) {
            ds_json_encode(10000, '删除经营类目成功');
        } else {
            ds_json_encode(10001, lang('error'));
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
                'url' => url('Type/index')
            ),
        );

        if (request()->action() == 'type_add' || request()->action() == 'index') {
            $menu_array[] = array(
                'name' => 'type_add',
                'text' => '新增类型',
                'url' => url('Type/type_add')
            );
        }
        if (request()->action() == 'type_edit') {
            $menu_array[] = array(
                'name' => 'type_edit',
                'text' => '编辑类型',
                'url' => ''
            );
        }
        if (request()->action() == 'attr_edit') {
            $menu_array[] = array(
                'name' => 'type_edit',
                'text' => '编辑属性',
                'url' => ''
            );
        }
        return $menu_array;
    }
    function getSpecRelated($type_id){
        //规格关联列表
        $type_model = model('type');
            $spec_related = $type_model->typeRelatedList('typespec', array('type_id' => $type_id), 'sp_id');
            $sp_related = array();
            if (is_array($spec_related) && !empty($spec_related)) {
                foreach ($spec_related as $val) {
                    $sp_related[] = $val['sp_id'];
                }
            }
            unset($spec_related);
            return $sp_related;
    }
    function getBrandRelated($type_id){
        //类型与品牌关联列表
        $type_model = model('type');
            $brand_related = $type_model->typeRelatedList('typebrand', array('type_id' => $type_id), 'brand_id');
            $b_related = array();
            if (is_array($brand_related) && !empty($brand_related)) {
                foreach ($brand_related as $val) {
                    $b_related[] = $val['brand_id'];
                }
            }
            unset($brand_related);
            return $b_related;
    }
    function getSpec($class_id,$type_id=0){
        
        $goodsclass_model = model('goodsclass');
        $in_gc_id='0';
        //分类是否存在
        if($class_id && db('goodsclass')->where('gc_id',$class_id)->value('gc_id')){
            $parent_gc_list=$goodsclass_model->getGoodsclassLineForTag($class_id);
            if(is_array($parent_gc_list) && !empty($parent_gc_list)){
                //获取分类的父分类ID
                if(isset($parent_gc_list['gc_id_1'])){
                    $in_gc_id.=','.$parent_gc_list['gc_id_1'];
                }
                if(isset($parent_gc_list['gc_id_2'])){
                    $in_gc_id.=','.$parent_gc_list['gc_id_2'];
                }
                if(isset($parent_gc_list['gc_id_3'])){
                    $in_gc_id.=','.$parent_gc_list['gc_id_3'];
                }
            }
        }
        
            //根据相同分类检索出对应的规格
            $spec_model = model('spec');
            $condition = array();
            $condition['gc_id'] = array('in',$in_gc_id);    
            $spec_list = $spec_model->getSpecList($condition);
            $s_list = array();
            $sp_related = array();
            if($type_id){
                $sp_related=$this->getSpecRelated($type_id);
            }
            if (is_array($spec_list) && !empty($spec_list)) {
                foreach ($spec_list as $k => $val) {
                    $val['checked']= in_array($val['sp_id'], $sp_related)?1:0;
                    $s_list[$val['gc_id']]['spec'][$k] = $val;
                    $s_list[$val['gc_id']]['name'] = $val['gc_name'];
                }
            }
            ksort($s_list);
            return $s_list;
    }
    function getBrand($class_id,$type_id=0){
        $goodsclass_model = model('goodsclass');
        
        $in_gc_id[]=0;
        //分类是否存在
        if($class_id && db('goodsclass')->where('gc_id',$class_id)->value('gc_id')){
            $parent_gc_list=$goodsclass_model->getGoodsclassLineForTag($class_id);
            if(is_array($parent_gc_list) && !empty($parent_gc_list)){
                //获取分类的父分类ID
                if(isset($parent_gc_list['gc_id_1'])){
                    $in_gc_id[]=$parent_gc_list['gc_id_1'];
                }
                if(isset($parent_gc_list['gc_id_2'])){
                    $in_gc_id[]=$parent_gc_list['gc_id_2'];
                }
                if(isset($parent_gc_list['gc_id_3'])){
                    $in_gc_id[]=$parent_gc_list['gc_id_3'];
                }
            }
        }
        $brand_model = model('brand');
            $brand_list = $brand_model->getBrandPassedList(array('gc_id'=>array('in',$in_gc_id)));
            $b_list = array();
            $b_related = array();
            if($type_id){
                $b_related=$this->getBrandRelated($type_id);
            }
            if (is_array($brand_list) && !empty($brand_list)) {
                foreach ($brand_list as $k => $val) {
                    $val['checked']= in_array($val['brand_id'], $b_related)?1:0;
                    $b_list[$val['gc_id']]['brand'][$k] = $val;
                    $b_list[$val['gc_id']]['name'] = $val['brand_class'];
                }
            }
            ksort($b_list);
            return $b_list;
    }
    function ajaxGetSpecAndBrand(){
        $class_id=intval(input('class_id'));
        $type_id=intval(input('type_id'));
        $s_list=$this->getSpec($class_id,$type_id);
        $b_list=$this->getBrand($class_id,$type_id);
        echo json_encode(array('s_list'=>$s_list,'b_list'=>$b_list));
        return;
    }
}

?>
