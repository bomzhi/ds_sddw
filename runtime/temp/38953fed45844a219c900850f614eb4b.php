<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:92:"D:\php\PHPTutorial\WWW\ds_sddw\public/../application/home\view\default\mall\index\index.html";i:1545196757;s:80:"D:\php\PHPTutorial\WWW\ds_sddw\application\home\view\default\base\base_home.html";i:1545196757;s:79:"D:\php\PHPTutorial\WWW\ds_sddw\application\home\view\default\base\mall_top.html";i:1545811969;s:82:"D:\php\PHPTutorial\WWW\ds_sddw\application\home\view\default\base\mall_header.html";i:1545196757;s:82:"D:\php\PHPTutorial\WWW\ds_sddw\application\home\view\default\base\mall_server.html";i:1545196757;s:82:"D:\php\PHPTutorial\WWW\ds_sddw\application\home\view\default\base\mall_footer.html";i:1545196757;}*/ ?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo (isset($html_title) && ($html_title !== '')?$html_title:\think\Config::get('site_name')); ?></title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand" />
        <meta name="keywords" content="<?php echo (isset($seo_keywords) && ($seo_keywords !== '')?$seo_keywords:''); ?>" />
        <meta name="description" content="<?php echo (isset($seo_description) && ($seo_description !== '')?$seo_description:''); ?>" />
        <link rel="stylesheet" href="<?php echo HOME_SITE_ROOT; ?>/css/common.css">
        <link rel="stylesheet" href="<?php echo HOME_SITE_ROOT; ?>/css/home_header.css">
        <link rel="stylesheet" href="<?php echo PLUGINS_SITE_ROOT; ?>/font-awesome/css/font-awesome.min.css">
        <script>
            var BASESITEROOT = "<?php echo BASE_SITE_ROOT; ?>";
            var HOMESITEROOT = "<?php echo HOME_SITE_ROOT; ?>";
            var BASESITEURL = "<?php echo BASE_SITE_URL; ?>";
            var HOMESITEURL = "<?php echo HOME_SITE_URL; ?>";
        </script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery-2.1.4.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/common.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.validate.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/additional-methods.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/layer/layer.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
    </head>
    <body>
        <div id="append_parent"></div>
        <div id="ajaxwaitid"></div>
        <div class="public-top">
            <div class="w1200">
                <span class="top-link">
                    <?php echo \think\Lang::get('welcome_to'); ?> <em><?php echo \think\Config::get('site_name'); ?></em>
                </span>
                <ul class="login-regin">
                    <?php if(\think\Session::get('member_id')): ?>
                    <li class="line"> <a href="<?php echo url('Member/index'); ?>"><?php echo \think\Session::get('member_name'); ?></a></li>
                    <li> <a href="<?php echo url('Login/Logout'); ?>"><?php echo \think\Lang::get('exit'); ?></a></li>
                    <?php else: ?>
                    <li class="line"> <a href="<?php echo url('Login/login'); ?>"><?php echo \think\Lang::get('please_log'); ?></a></li>
                    <li> <a href="<?php echo url('Login/register'); ?>"><?php echo \think\Lang::get('free_registration'); ?></a></li>
                    <?php endif; ?>
                </ul>
                <span class="top-link">
                    <strong style="margin-left:30px;"><?php echo \think\Lang::get('ds_attention'); ?><a href="http://www.csdeshang.com" target="_blank">www.csdeshang.com</a> <?php echo \think\Lang::get('ds_continuous_update'); ?></strong>&nbsp;
                    <?php echo \think\Lang::get('ds_purchase_authorization'); ?>：<a target="_blank" href="<?php echo HTTP_TYPE; ?>wpa.qq.com/msgrd?v=3&uin=858761000&site=qq&menu=yes"><img border="0" src="<?php echo HTTP_TYPE; ?>wpa.qq.com/pa?p=2:858761000:51" alt="<?php echo \think\Lang::get('click_here_send_message'); ?>" title="<?php echo \think\Lang::get('click_here_send_message'); ?>"/></a>
                </span>
                <ul class="quick_list">
                    <li>
                        <span class="outline"></span>
                        <span class="blank"></span>
                        <a href="<?php echo url('Member/index'); ?>"><?php echo \think\Lang::get('ds_user_center'); ?><b></b></a>
                        <div class="dropdown-menu">
                            <ol>
                                <li><a href="<?php echo url('Memberorder/index'); ?>"><?php echo \think\Lang::get('ds_buying_goods'); ?></a></li>
                                <li><a href="<?php echo url('Memberfavorites/fglist'); ?>"><?php echo \think\Lang::get('ds_care_about'); ?></a></li>
                                <li><a href="<?php echo url('Memberfavorites/fslist'); ?>"><?php echo \think\Lang::get('ds_the_shop'); ?></a></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <span class="outline"></span>
                        <span class="blank"></span>
                        <a href="<?php echo url('Seller/index'); ?>"><?php echo \think\Lang::get('business_center'); ?><b></b></a>
                        <div class="dropdown-menu">
                            <ol>
                                <?php if(\think\Session::get('seller_id')): ?>
                                <li><a href="<?php echo url('Seller/index'); ?>"><?php echo \think\Lang::get('ds_shop_overview'); ?></a></li>
                                <li><a href="<?php echo url('Sellerorder/index'); ?>"><?php echo \think\Lang::get('ds_member_path_store_order'); ?></a></li>
                                <li><a href="<?php echo url('Sellergoodsonline/index'); ?>"><?php echo \think\Lang::get('promotion_goods_manage'); ?></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo url('Showjoinin/index'); ?>"><?php echo \think\Lang::get('tenants'); ?></a></li>
                                <li><a href="<?php echo url('Sellerlogin/login'); ?>"><?php echo \think\Lang::get('merchant_login'); ?></a></li>
                                <?php endif; ?>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <span class="outline"></span>
                        <span class="blank"></span>
                        <a href="<?php echo url('Memberfavorites/fglist'); ?>"><?php echo \think\Lang::get('ds_favorites'); ?><b></b></a>
                        <div class="dropdown-menu">
                            <ol>
                                <li><a href="<?php echo url('Memberfavorites/fglist'); ?>"><?php echo \think\Lang::get('ds_merchandise_collection'); ?></a></li>
                                <li><a href="<?php echo url('Memberfavorites/fslist'); ?>"><?php echo \think\Lang::get('ds_store_collect'); ?></a></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <span class="outline"></span>
                        <span class="blank"></span>
                        <a href="javascript:void(0)"><?php echo \think\Lang::get('ds_customer_center'); ?><b></b></a>
                        <div class="dropdown-menu">
                            <ol>
                                <li><a href="<?php echo url('Article/index',['ac_id'=>2]); ?>"><?php echo \think\Lang::get('ds_help_center'); ?></a></li>
                                <li><a href="<?php echo url('Article/index',['ac_id'=>5]); ?>"><?php echo \think\Lang::get('ds_after_sales_service'); ?></a></li>
                                <li><a href="<?php echo url('Article/index',['ac_id'=>6]); ?>"><?php echo \think\Lang::get('ds_complaint_center'); ?></a></li>
                            </ol>
                        </div>
                    </li>
                    <li class="moblie-qrcode">
                        <span class="outline"></span>
                        <span class="blank"></span>
                        <a href="javascript:void(0)"><?php echo \think\Lang::get('wechat_end'); ?></a>
                        <div class="dropdown-menu">
                            <img src="<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_COMMON; ?>/<?php echo \think\Config::get('site_logowx'); ?>" width="90" height="90" />
                        </div>
                    </li>
                    <?php if(\think\Config::get('switching_language_state') == '1'): ?>
                    <li>
                        <span class="outline"></span>
                        <span class="blank"></span>
                        <a href="javascript:void(0)"><?php echo \think\Config::get('default_lang'); ?><b></b></a>
                        <div class="dropdown-menu">
                            <ol>
                                <li><a href="javascript:change_lang('zh-cn')"><?php echo \think\Lang::get('ds_zh_cn'); ?></a></li>
                                <li><a href="javascript:change_lang('en-us')"><?php echo \think\Lang::get('ds_en_us'); ?></a></li>
                            </ol>
                        </div>
                    </li>
                    <?php endif; ?>
                    <!--
                    <li class="app-qrcode">
                        <span class="outline"></span>
                        <span class="blank"></span>
                        <a href="javascript:void(0)">APP</a>
                        <div class="dropdown-menu">
                            <img width="90" height="90" src="<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_COMMON; ?>/<?php echo \think\Config::get('site_logowx'); ?>" />
                            <h3>扫描二维码</h3>
                            <p>下载手机客户端</p>
                        </div>
                    </li>
                    -->
                </ul>
            </div>
        </div>
        
        
        
        <!--左侧导航栏-->
<div class="ds-appbar">
    <div class="ds-appbar-tabs" id="appBarTabs">
        <?php if(\think\Session::get('is_login')): ?>
        <div class="user" dstype="a-barUserInfo">
            <div class="avatar"><img src="<?php echo get_member_avatar(\think\Session::get('avatar')); ?>"/></div>
            <p><?php echo \think\Lang::get('sns_me'); ?></p>
        </div>
        <div class="user-info" dstype="barUserInfo" style="display:none;"><i class="arrow"></i>
            <div class="avatar"><img src="<?php echo get_member_avatar(\think\Session::get('avatar')); ?>"/></div>
            <dl>
                <dt>Hi, <?php echo \think\Session::get('member_name'); ?></dt>
                <dd><?php echo \think\Lang::get('ds_current_level'); ?>：<strong dstype="barMemberGrade"><?php echo \think\Session::get('level_name'); ?></strong></dd>
                <dd><?php echo \think\Lang::get('ds_current_experience'); ?>：<strong dstype="barMemberExp"><?php echo \think\Session::get('member_exppoints'); ?></strong></dd>
            </dl>
        </div>
       <?php else: ?>
        <div class="user TA_delay" dstype="a-barLoginBox">
            <div class="avatar TA"><img src="<?php echo get_member_avatar(\think\Session::get('avatar')); ?>"/></div>
            <p class="TA"><?php echo \think\Lang::get('login_notlogged'); ?></p>
        </div>
        <?php endif; ?>
        <ul class="tools">
            <?php if(\think\Config::get('node_site_use') == '1'): ?>
            <li><a href="javascript:void(0);" id="chat_show_user" class="chat TA_delay"><span class="fa fa-commenting"></span><span class="tit"><?php echo \think\Lang::get('ds_chat'); ?></span><i id="new_msg" class="new_msg" style="display:none;"></i></a></li>
            <?php endif; ?>
            <li><a href="javascript:void(0);" onclick="toglle_bar('rtoolbar_cart')" id="rtoolbar_cart" class="cart TA_delay"><span class="fa fa-shopping-cart"></span><span class="tit"><?php echo \think\Lang::get('ds_cart'); ?></span><i id="rtoobar_cart_count" class="new_msg" style="display:none;"></i></a></li>
            <li><a href="javascript:void(0);" onclick="toglle_bar('compare')" id="compare" class="compare TA_delay"><span class="fa fa-exchange"></span><span class="tit"><?php echo \think\Lang::get('ds_comparison'); ?></span></a></li>
            <li>
                <a href="javascript:void(0);" id="qrcode" class="qrcode TA_delay"><span class="fa fa-qrcode"></span>
                    <span class="tit tit-box">
                        <?php echo \think\Lang::get('ds_mobile_shopping_better'); ?><br>
                        <img src="<?php echo HOME_SITE_URL; ?>/qrcode?url=<?php echo WAP_SITE_URL; ?>" width="110" height="110" />
                        <em class="tips_arrow"></em>
                    </span>
                </a>
            </li>
            <li><a href="javascript:void(0);" onclick="$('html,body').animate({scrollTop: '0px'}, 500)" id="gotop" class="gotop TA_delay" style="position: fixed;bottom: 0"><span class="fa fa-chevron-up"></span><span class="tit"><?php echo \think\Lang::get('ds_top'); ?></span></a></li>
        </ul>
        <div class="content-box" id="content-compare">
            <div class="top">
                <h3><?php echo \think\Lang::get('ds_comparison'); ?></h3>
                <a href="javascript:void(0);" class="close fa fa-angle-double-right" title="<?php echo \think\Lang::get('ds_hidden'); ?>"></a></div>
            <div id="comparelist"></div>
        </div>
        <div class="content-box" id="content-cart">
            <div class="top">
                <h3><?php echo \think\Lang::get('ds_my_shopping_cart'); ?></h3>
                <a href="javascript:void(0);" class="close fa fa-angle-double-right" title="<?php echo \think\Lang::get('ds_hidden'); ?>"></a></div>
            <div id="rtoolbar_cartlist"></div>
        </div>
    </div>
</div>
        
<script type="text/javascript">

    //动画显示边条内容区域
    $(function() {
        $(".close").click(function(){
            close_bar();
        });
        // 右侧bar用户信息
        $('div[dstype="a-barUserInfo"]').click(function(){
            $('div[dstype="barUserInfo"]').toggle();
        });
        // 右侧bar登录
        $('div[dstype="a-barLoginBox"]').click(function(){
            login_dialog();
        });

        <?php if($cart_goods_num > 0): ?>
            $('#rtoobar_cart_count').html(<?php echo $cart_goods_num; ?>).show();
        <?php endif; ?>
    });
    function toglle_bar(item){
        //判断侧边栏是否已拉出
        if(parseInt($('.ds-appbar').css('width')) == 36){
            $('.ds-appbar').css('width','306px');
        }
        //判断选中项是否已显示
        if(!$("#"+item).hasClass('active')){
            $('.tools li > a').removeClass('active');
            $("#"+item).addClass('active');
            $('.content-box').removeClass('active');
            
            switch(item){
                case 'rtoolbar_cart':
                    $("#rtoolbar_cartlist").load("<?php echo url('Cart/ajax_load','type=html'); ?>");
                    $("#content-cart").addClass('active');
                    break;
                case 'compare':   
                    loadCompare(false);
                    $("#content-compare").addClass('active');
                    break;
            }
        }else{
            //关闭
            close_bar();
            $(".chat-list").css("display",'none');
        }
        
    }
    function close_bar(){
        $('.tools li > a').removeClass('active');
        $('.content-box').removeClass('active');
        $('.ds-appbar').css('width','36px');
    }
</script> 

<link rel="stylesheet" href="<?php echo HOME_SITE_ROOT; ?>/css/home.css">
<div class="header clearfix">
    <div class="w1200">
        <div class="logo">
            <a href="<?php echo HOME_SITE_URL; ?>"><img src="<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_COMMON; ?>/<?php echo \think\Config::get('site_logo'); ?>"/></a>
        </div>
        <div class="top_search">
            <div class="top_search_box">
                <div id="search">
                    <ul class="tab" dstype="<?php echo \think\Request::instance()->controller(); ?>">
                        <li class="current"><span><?php echo \think\Lang::get('site_search_goods'); ?></span><i class="arrow"></i></li>
                        <li style="display: none;"><span><?php echo \think\Lang::get('site_search_store'); ?></span></li>
                    </ul>
                </div>
                <div class="form_fields">
                    <form class="search-form" id="search-form" method="get" action="<?php echo url('Search/goods'); ?>">
                        <input placeholder="<?php echo \think\Lang::get('search_merchandise_keywords'); ?>" name="keyword" id="keyword" type="text" class="keyword" value="<?php echo \think\Request::instance()->param('keyword'); ?>" maxlength="60" />
                        <input type="submit" id="button" value="<?php echo \think\Lang::get('ds_common_search'); ?>" class="submit">
                    </form>
                </div>
            </div>
            <ul class="top_search_keywords">
                <?php if(is_array($hot_search) || $hot_search instanceof \think\Collection || $hot_search instanceof \think\Paginator): if( count($hot_search)==0 ) : echo "" ;else: foreach($hot_search as $hot_k=>$hot_keyword): ?>
                <li <?php if($hot_k==0): ?>class="first"<?php endif; ?>><a href="<?php echo HOME_SITE_URL; ?>/Search/index.html?keyword=<?php echo $hot_keyword; ?>"><?php echo $hot_keyword; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="user_menu">
            <dl class="my-mall">
                <dt><span class="ico fa fa-user-o"></span><?php echo \think\Lang::get('ds_user_center'); ?><i class="arrow"></i></dt>
                <dd>
                    <div class="sub-title">
                        <h4></h4>
                        <a href="<?php echo url('Member/index'); ?>" class="arrow"><?php echo \think\Lang::get('ds_my_user_center'); ?><i></i></a>
                    </div>
                    <div class="user-centent-menu">
                        <ul>
                            <li><a href="<?php echo url('Membermessage/message'); ?>"><?php echo \think\Lang::get('ds_message'); ?>(<span>0</span>)</a></li>
                            <li><a href="<?php echo url('Memberorder/index'); ?>" class="arrow"><?php echo \think\Lang::get('ds_my_order'); ?><i></i></a></li>
                            <li><a href="<?php echo url('Memberconsult/index'); ?>"><?php echo \think\Lang::get('ds_consulting_reply'); ?>(<span id="member_consult">0</span>)</a></li>
                            <li><a href="<?php echo url('Memberfavorites/fglist'); ?>" class="arrow"><?php echo \think\Lang::get('ds_favorites'); ?><i></i></a></li>
                            <li><a href="<?php echo url('Membervoucher/index'); ?>"><?php echo \think\Lang::get('ds_vouchers'); ?>(<span id="member_voucher">0</span>)</a></li>
                            <li><a href="<?php echo url('Memberpoints/index'); ?>" class="arrow"><?php echo \think\Lang::get('ds_my_points'); ?><i></i></a></li>
                        </ul>
                    </div>
                    <div class="browse-history">
                        <div class="part-title">
                            <h4><?php echo \think\Lang::get('ds_recently_browsed_items'); ?></h4>
                            <span style="float:right;"><a href="<?php echo url('Membergoodsbrowse/listinfo'); ?>"><?php echo \think\Lang::get('ds_full_history'); ?></a></span>
                        </div>
                        <ul>
                            <li class="no-goods"><img class="loading" src="<?php echo HOME_SITE_ROOT; ?>/images/loading.gif"></li>
                        </ul>
                    </div>
                </dd>
            </dl>
            <dl class="my-cart">
                <dt><span class="ico fa fa-shopping-cart"></span><?php echo \think\Lang::get('ds_shopping_cart_settlement'); ?><i class="arrow"></i></dt>
                <dd>
                    <div class="sub-title">
                        <h4><?php echo \think\Lang::get('ds_latest_additions'); ?></h4>
                    </div>
                    <div class="incart-goods-box">
                        <div class="incart-goods"><div class="no-order"><span><?php echo \think\Lang::get('ds_shopping_cart_empty'); ?></span></div></div>
                    </div>
                    <div class="checkout"> <span class="total-price"></span><a href="<?php echo url('Cart/index'); ?>" class="btn-cart"><?php echo \think\Lang::get('ds_checkout_cart'); ?></a> </div>
                </dd>
                <div class="addcart-goods-num"><?php echo $cart_goods_num; ?></div>
            </dl>
        </div>
    </div>
</div>


<div class="mall_nav">
    <div class="w1200">
        <div class="all_categorys">
            <div class="mt">
                <i></i>
                <h3><a href="<?php echo url('Category/goods'); ?>"><?php echo \think\Lang::get('ds_all_commodity_classes'); ?></a></h3>
            </div>
            <div class="mc">
                <ul class="menu">
                    <?php if(!(empty($header_categories) || (($header_categories instanceof \think\Collection || $header_categories instanceof \think\Paginator ) && $header_categories->isEmpty()))): $i = 0; if(is_array($header_categories) || $header_categories instanceof \think\Collection || $header_categories instanceof \think\Paginator): if( count($header_categories)==0 ) : echo "" ;else: foreach($header_categories as $key=>$val): $i++; ?>
                    <li cat_id="<?php echo $val['gc_id']; ?>" <?php if($i>11): ?>style="display:none;"<?php endif; ?>>
                        <div class="class">
                            <span class="arrow"></span>
                            <?php if(!(empty($val['pic']) || (($val['pic'] instanceof \think\Collection || $val['pic'] instanceof \think\Paginator ) && $val['pic']->isEmpty()))): ?>
                            <span class="ico"><img src="<?php echo $val['pic']; ?>"></span>
                            <?php else: ?>
                            <span class="iconfont category-ico-<?php echo $i; ?>"></span>
                            <?php endif; ?>
                            <h4><a href="<?php echo url('Search/index',['cate_id'=>$val['gc_id']]); ?>"><?php echo $val['gc_name']; ?></a></h4>
                        </div>
                        <div class="sub-class" cat_menu_id="<?php echo $val['gc_id']; ?>">
                            <div class="sub-class-content">
                                <div class="recommend-class">
                                    <?php if(!(empty($val['cn_classs']) || (($val['cn_classs'] instanceof \think\Collection || $val['cn_classs'] instanceof \think\Paginator ) && $val['cn_classs']->isEmpty()))): if(is_array($val['cn_classs']) || $val['cn_classs'] instanceof \think\Collection || $val['cn_classs'] instanceof \think\Paginator): if( count($val['cn_classs'])==0 ) : echo "" ;else: foreach($val['cn_classs'] as $k=>$v): ?>
                                    <span><a href="<?php echo url('Search/index',['cate_id'=>$v['gc_id']]); ?>" title="<?php echo $v['gc_name']; ?>"><?php echo $v['gc_name']; ?></a></span>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </div>
                                <?php if(!(empty($val['class2']) || (($val['class2'] instanceof \think\Collection || $val['class2'] instanceof \think\Paginator ) && $val['class2']->isEmpty()))): if(is_array($val['class2']) || $val['class2'] instanceof \think\Collection || $val['class2'] instanceof \think\Paginator): if( count($val['class2'])==0 ) : echo "" ;else: foreach($val['class2'] as $k=>$v): ?>
                                <dl>
                                    <dt>
                                    <h3><a href="<?php echo url('Search/index',['cate_id'=>$v['gc_id']]); ?>"><?php echo $v['gc_name']; ?></a></h3>
                                    </dt>
                                    <dd class="goods-class">
                                        <?php if(!(empty($v['class3']) || (($v['class3'] instanceof \think\Collection || $v['class3'] instanceof \think\Paginator ) && $v['class3']->isEmpty()))): if(is_array($v['class3']) || $v['class3'] instanceof \think\Collection || $v['class3'] instanceof \think\Paginator): if( count($v['class3'])==0 ) : echo "" ;else: foreach($v['class3'] as $k3=>$v3): ?>
                                        <a href="<?php echo url('Search/index',['cate_id'=>$v3['gc_id']]); ?>"><?php echo $v3['gc_name']; ?></a>
                                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </dd>
                                </dl>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </div>
                            <div class="sub-class-right">
                                <?php if(!(empty($val['cn_brands']) || (($val['cn_brands'] instanceof \think\Collection || $val['cn_brands'] instanceof \think\Paginator ) && $val['cn_brands']->isEmpty()))): ?>
                                <div class="brands-list">
                                    <ul>
                                        <?php if(is_array($val['cn_brands']) || $val['cn_brands'] instanceof \think\Collection || $val['cn_brands'] instanceof \think\Paginator): if( count($val['cn_brands'])==0 ) : echo "" ;else: foreach($val['cn_brands'] as $key=>$brand): ?>
                                        <li>
                                            <a href="<?php echo url('Brand/brand_goods',['brand_id'=>$brand['brand_id']]); ?>" title="<?php echo $brand['brand_name']; ?>"><?php if(($brand['brand_pic'] != '')): ?><img src="<?php echo brand_image($brand['brand_pic']); ?>"/><?php endif; ?>
                                                <span><?php echo $brand['brand_name']; ?></span>
                                            </a>
                                        </li>
                                       <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <div class="adv-promotions">
                                    <?php if(isset($val['goodscn_adv1']) && $val['goodscn_adv1'] != ''): ?>
                                    <a <?php if($val['goodscn_adv1_link'] == ''): ?>href="javascript:;"<?php else: ?>target="_blank" href="<?php echo $val['goodscn_adv1_link']; endif; ?>><img src="<?php echo $val['goodscn_adv1']; ?>" data-url="<?php echo $val['goodscn_adv1']; ?>" class="scrollLoading" /></a>
                                    <?php endif; if(isset($val['goodscn_adv2']) && $val['goodscn_adv2'] != ''): ?>
                                    <a <?php if($val['goodscn_adv2_link'] == ''): ?>href="javascript:;"<?php else: ?>target="_blank" href="<?php echo $val['goodscn_adv2_link']; endif; ?>><img src="<?php echo $val['goodscn_adv2']; ?>" data-url="<?php echo $val['goodscn_adv2']; ?>" class="scrollLoading" /></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </ul>
            </div>
        </div>
        <ul class="site_menu">
            <li><a href="<?php echo url('Index/index'); ?>" class="current"><?php echo \think\Lang::get('ds_index'); ?></a></li>
            <?php foreach($navs['middle'] as $nav): ?>
            <li><a href="<?php echo $nav['nav_url']; ?>" <?php if($nav['nav_new_open'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $nav['nav_title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>





<!--面包屑导航 BEGIN-->
<?php if(!(empty($nav_link_list) || (($nav_link_list instanceof \think\Collection || $nav_link_list instanceof \think\Paginator ) && $nav_link_list->isEmpty()))): ?>
<div class="dsh-breadcrumb-layout">
    <div class="dsh-breadcrumb w1200"><i class="fa fa-home"></i>
        <?php foreach($nav_link_list as $nav_link): if(empty($nav_link['link']) || (($nav_link['link'] instanceof \think\Collection || $nav_link['link'] instanceof \think\Paginator ) && $nav_link['link']->isEmpty())): ?>
        <span><?php echo $nav_link['title']; ?></span>
        <?php else: ?>
        <span><a href="<?php echo $nav_link['link']; ?>"><?php echo $nav_link['title']; ?></a></span><span class="arrow">></span>
        <?php endif; endforeach; ?>
    </div>
</div>
<?php endif; ?>
<!--面包屑导航 END-->


<script>
    $(function() {
	//首页左侧分类菜单
	$(".all_categorys ul.menu").find("li").each(
		function() {
			$(this).hover(
				function() {
				    var cat_id = $(this).attr("cat_id");
					var menu = $(this).find("div[cat_menu_id='"+cat_id+"']");
					menu.show();
					$(this).addClass("hover");					
					var menu_height = menu.height();
					if (menu_height < 60) menu.height(80);
					menu_height = menu.height();
					var li_top = $(this).position().top;
					$(menu).css("top",-li_top + 40);
				},
				function() {
					$(this).removeClass("hover");
				    var cat_id = $(this).attr("cat_id");
					$(this).find("div[cat_menu_id='"+cat_id+"']").hide();
				}
			);
		}
	);

        $(".user_menu dl").hover(function() {
            $(this).addClass("hover");
        }, function() {
            $(this).removeClass("hover");
        });
        $('.user_menu .my-mall').mouseover(function() {
            // 最近浏览的商品
            load_history_information();
            $(this).unbind('mouseover');
        });
        $('.user_menu .my-cart').mouseover(function() {
            // 运行加载购物车
            load_cart_information();
            $(this).unbind('mouseover');
        });
    });
    
</script>


<link rel="stylesheet" href="<?php echo HOME_SITE_ROOT; ?>/css/index.css">
<script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.SuperSlide.2.1.1.js"></script>
<style>
    .mall_nav{border-bottom:none;}
    .mall_nav .all_categorys .mc{display: block;}
</style>
<div class="clear"></div>
<!-- HomeFocusLayout Begin-->
<div class="home-focus-layout">
    <div class="bd">
        <ul>
            <?php $ap_id =1;$ad_position = db("advposition")->cache(3600)->column("ap_id,ap_name,ap_width,ap_height","ap_id");$result = db("adv")->where("ap_id=$ap_id  and adv_enabled = 1 and adv_startdate < 1557104400 and adv_enddate > 1557104400 ")->order("adv_sort desc")->cache(3600)->limit("10")->select();
if(!in_array($ap_id,array_keys($ad_position)) && $ap_id)
{
  db("advposition")->insert(array(
         "ap_id"=>$ap_id,
         "ap_name"=>request()->module()."/".request()->controller()."/".request()->action()."页面自动增加广告位 $ap_id ",
  ));
  $ad_position[$ap_id]=array();
  \think\Cache::clear();  
}


$c = 10- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && input("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "adv_id" => 0,
          "adv_code" => "/public/images/not_adv.jpg",
          "adv_link" => ADMIN_SITE_URL."/Adv/adv_add/ap_id/$ap_id.html",
          "adv_title"   =>"暂无广告图片",
          "not_adv" => 1,
          "adv_target" => "_self",
          "ap_id"   =>$ap_id,
      );  
    }
}

foreach($result as $key=>$v):       

    $v["position"] = $ad_position[$v["ap_id"]]; 
    $v["adv_link"] = HOME_SITE_URL."/Advclick/Advclick/adv_id/".$v["adv_id"].".html";
    $v["adv_target"] = "_blank"; 
    if(input("get.edit_ad") && !isset($v["not_adv"]) )
    {
        
        $v["style"] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v["adv_link"] = ADMIN_SITE_URL."/Adv/adv_edit/adv_id/".$v['adv_id'].".html";
        $v["adv_title"] = $ad_position[$v["ap_id"]]["ap_name"]."===".$v["adv_title"];
        $v["adv_target"] = "_self";
        $v["adv_style"] = "filter:alpha(opacity=30); -moz-opacity:0.3; -khtml-opacity: 0.3; opacity: 0.3";
    }
    ?>
            <li style="background: url(<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_ADV; ?>/<?php echo $v['adv_code']; ?>) center top no-repeat rgb(35, 35, 35); display: none;background-color: <?php echo (isset($v['adv_bgcolor']) && ($v['adv_bgcolor'] !== '')?$v['adv_bgcolor']:''); ?>" style="<?php echo (isset($v['adv_style']) && ($v['adv_style'] !== '')?$v['adv_style']:''); ?>">
                <a href="<?php echo $v['adv_link']; ?>" target="<?php echo $v['adv_target']; ?>" title="<?php echo $v['adv_title']; ?>">&nbsp;</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="hd">
        <ul>
            <?php $ap_id =1;$ad_position = db("advposition")->cache(3600)->column("ap_id,ap_name,ap_width,ap_height","ap_id");$result = db("adv")->where("ap_id=$ap_id  and adv_enabled = 1 and adv_startdate < 1557104400 and adv_enddate > 1557104400 ")->order("adv_sort desc")->cache(3600)->limit("10")->select();
if(!in_array($ap_id,array_keys($ad_position)) && $ap_id)
{
  db("advposition")->insert(array(
         "ap_id"=>$ap_id,
         "ap_name"=>request()->module()."/".request()->controller()."/".request()->action()."页面自动增加广告位 $ap_id ",
  ));
  $ad_position[$ap_id]=array();
  \think\Cache::clear();  
}


$c = 10- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && input("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "adv_id" => 0,
          "adv_code" => "/public/images/not_adv.jpg",
          "adv_link" => ADMIN_SITE_URL."/Adv/adv_add/ap_id/$ap_id.html",
          "adv_title"   =>"暂无广告图片",
          "not_adv" => 1,
          "adv_target" => "_self",
          "ap_id"   =>$ap_id,
      );  
    }
}

foreach($result as $key=>$v):       

    $v["position"] = $ad_position[$v["ap_id"]]; 
    $v["adv_link"] = HOME_SITE_URL."/Advclick/Advclick/adv_id/".$v["adv_id"].".html";
    $v["adv_target"] = "_blank"; 
    if(input("get.edit_ad") && !isset($v["not_adv"]) )
    {
        
        $v["style"] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v["adv_link"] = ADMIN_SITE_URL."/Adv/adv_edit/adv_id/".$v['adv_id'].".html";
        $v["adv_title"] = $ad_position[$v["ap_id"]]["ap_name"]."===".$v["adv_title"];
        $v["adv_target"] = "_self";
        $v["adv_style"] = "filter:alpha(opacity=30); -moz-opacity:0.3; -khtml-opacity: 0.3; opacity: 0.3";
    }
    ?>
            <li class=""></li>
            <?php endforeach; ?>
        </ul>
    </div>


    <div class="right-sidebar">
        <div class="mod_personal_center">
            <?php if(\think\Session::get('is_login')): ?>
            <div class="avata_pic_wrap">
                <a id="index_account_icon_login" href="<?php echo url('Member/index'); ?>" target="_blank"><img class="lazyload"  data-original="<?php echo get_member_avatar(\think\Session::get('avatar')); ?>"></a>
            </div>
            <div class="info_wrap">
                <div class="login_box">
                    <div class="user_info clearfix">
                        <em>Hi，<?php echo session('member_name'); ?></em>
                    </div>
             
                    <div class="clearfix treasure">
                        <a href="<?php echo url('Memberorder/index',['state_type'=>'state_new']); ?>" target="_blank" class="gold_coin">
                            <em><?php echo $member_order_info['order_nopay_count']; ?></em>
                            <p><?php echo \think\Lang::get('pending_payment'); ?></p>
                        </a>
                        <a href="<?php echo url('Memberorder/index',['state_type'=>'state_send']); ?>" target="_blank" class="gold_coin">
                            <em><?php echo $member_order_info['order_noreceipt_count']; ?></em>
                            <p><?php echo \think\Lang::get('pending_receipt'); ?></p>
                        </a>
                        <a href="<?php echo url('Memberorder/index',['state_type'=>'state_noeval']); ?>" target="_blank">
                            <em><?php echo $member_order_info['order_noeval_count']; ?></em>
                            <p><?php echo \think\Lang::get('pending_comment'); ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="avata_pic_wrap">
                <a id="index_account_icon_unlogin" href="javascript:void(0)"><img class="lazyload"  data-original="<?php echo get_member_avatar(\think\Session::get('avatar')); ?>"></a>
            </div>
            <div class="info_wrap">
                <div class="unlogin_box">
                    <div class="title">Hi~<?php echo \think\Lang::get('hello'); ?>!</div>
                    <div class="tips">
                    </div>
                    <div class="btn_wrap">
                        <a href="<?php echo url('Login/login'); ?>" class="login_btn"><?php echo \think\Lang::get('login'); ?></a>
                        <a href="<?php echo url('Login/register'); ?>" class="regist_btn"><?php echo \think\Lang::get('login_index_regist_now_2'); ?></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="top_line">
                <div class="vip_list">
                    <a href="javascript:void(0)">
                        <i class="fa fa-heart-o" style="background:#ff9b1b"></i>
                        <p class="vip_item_text"><?php echo \think\Lang::get('buyer_protection'); ?></p>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="fa fa-thumbs-o-up" style="background:#52a6ff"></i>
                        <p class="vip_item_text"><?php echo \think\Lang::get('merchant_authentication'); ?></p>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="fa fa-handshake-o" style="background:#57c15b"></i>
                        <p class="vip_item_text"><?php echo \think\Lang::get('secure_transaction'); ?></p>
                    </a>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="notice_list">
                <?php foreach($index_articles as $i_a): ?>
                <a title="<?php echo $i_a['article_title']; ?>" href="<?php if($i_a['article_url'] !=''): ?><?php echo $i_a['article_url']; else: ?><?php echo url('Article/show',['article_id'=>$i_a['article_id']]); endif; ?>" target="_blank">
                    <span><?php echo $i_a['article_title']; ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!--HomeFocusLayout End-->

<div class="home-scroll w1200 mt10">
    <div class="bd">
        <ul>
            <li>
                <?php $ap_id =2;$ad_position = db("advposition")->cache(3600)->column("ap_id,ap_name,ap_width,ap_height","ap_id");$result = db("adv")->where("ap_id=$ap_id  and adv_enabled = 1 and adv_startdate < 1557104400 and adv_enddate > 1557104400 ")->order("adv_sort desc")->cache(3600)->limit("10")->select();
if(!in_array($ap_id,array_keys($ad_position)) && $ap_id)
{
  db("advposition")->insert(array(
         "ap_id"=>$ap_id,
         "ap_name"=>request()->module()."/".request()->controller()."/".request()->action()."页面自动增加广告位 $ap_id ",
  ));
  $ad_position[$ap_id]=array();
  \think\Cache::clear();  
}


$c = 10- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && input("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "adv_id" => 0,
          "adv_code" => "/public/images/not_adv.jpg",
          "adv_link" => ADMIN_SITE_URL."/Adv/adv_add/ap_id/$ap_id.html",
          "adv_title"   =>"暂无广告图片",
          "not_adv" => 1,
          "adv_target" => "_self",
          "ap_id"   =>$ap_id,
      );  
    }
}

foreach($result as $key=>$v):       

    $v["position"] = $ad_position[$v["ap_id"]]; 
    $v["adv_link"] = HOME_SITE_URL."/Advclick/Advclick/adv_id/".$v["adv_id"].".html";
    $v["adv_target"] = "_blank"; 
    if(input("get.edit_ad") && !isset($v["not_adv"]) )
    {
        
        $v["style"] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v["adv_link"] = ADMIN_SITE_URL."/Adv/adv_edit/adv_id/".$v['adv_id'].".html";
        $v["adv_title"] = $ad_position[$v["ap_id"]]["ap_name"]."===".$v["adv_title"];
        $v["adv_target"] = "_self";
        $v["adv_style"] = "filter:alpha(opacity=30); -moz-opacity:0.3; -khtml-opacity: 0.3; opacity: 0.3";
    }
    ?>
                <a href="<?php echo $v['adv_link']; ?>" target="<?php echo $v['adv_target']; ?>" title="">
                    <img class="lazyload" data-original="<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_ADV; ?>/<?php echo $v['adv_code']; ?>" style="<?php echo (isset($v['adv_style']) && ($v['adv_style'] !== '')?$v['adv_style']:''); ?>">
                </a>
                <?php endforeach; ?>
            </li>
        </ul>
        <a class="ctrl prev" href="javascript:void(0)"><</a>
        <a class="ctrl next" href="javascript:void(0)">></a>
    </div>
</div>




<div class="home-sale-layout w1200 mt20">
    <div class="hd">
        <ul class="tabs-nav">
            <li class="tabs-selected on"><i class="arrow"></i><h3><?php echo \think\Lang::get('recommendation'); ?></h3></li>
            <li class=""><i class="arrow"></i><h3><?php echo \think\Lang::get('discount'); ?></h3></li>
            <li class=""><i class="arrow"></i><h3><?php echo \think\Lang::get('latest_hot_sale'); ?></h3></li>
            <li class=""><i class="arrow"></i><h3><?php echo \think\Lang::get('shopping_frenzy'); ?></h3></li>
        </ul>
    </div>
    <div class="bd tabs-panel">
        <ul style="display: block;">
            <?php if(!(empty($recommend_list) || (($recommend_list instanceof \think\Collection || $recommend_list instanceof \think\Paginator ) && $recommend_list->isEmpty()))): if(is_array($recommend_list) || $recommend_list instanceof \think\Collection || $recommend_list instanceof \think\Paginator): if( count($recommend_list)==0 ) : echo "" ;else: foreach($recommend_list as $key=>$goods): ?>
            <li>
                <dl>
                    
                    <dd class="goods-thumb">
                        <a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>">
                            <img class="lazyload" data-original="<?php echo goods_cthumb($goods['goods_image']); ?>" alt="<?php echo $goods['goods_name']; ?>">
                        </a>
                    </dd>
                    <dt class="goods-name"><a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>" title="<?php echo $goods['goods_name']; ?>"><?php echo $goods['goods_name']; ?></a></dt>
                    <dd class="goods-price"><em>￥<?php echo $goods['goods_price']; ?></em></dd>
                </dl>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
        <ul style="display: none;">
            <?php if(!(empty($promotion_list) || (($promotion_list instanceof \think\Collection || $promotion_list instanceof \think\Paginator ) && $promotion_list->isEmpty()))): if(is_array($promotion_list) || $promotion_list instanceof \think\Collection || $promotion_list instanceof \think\Paginator): if( count($promotion_list)==0 ) : echo "" ;else: foreach($promotion_list as $key=>$goods): ?>
            <li>
                <dl>
                    
                    <dd class="goods-thumb">
                        <a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>">
                            <img class="lazyload" data-original="<?php echo goods_cthumb($goods['goods_image']); ?>" alt="<?php echo $goods['goods_name']; ?>">
                        </a>
                    </dd>
                    <dt class="goods-name"><a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>" title="<?php echo $goods['goods_name']; ?>"><?php echo $goods['goods_name']; ?></a></dt>
                    <dd class="goods-price"><?php echo \think\Lang::get('shopping_mall_price'); ?>：<em>￥<?php echo $goods['xianshigoods_price']; ?></em></dd>
                </dl>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
        <ul style="display: none;">
            <?php if(!(empty($new_list) || (($new_list instanceof \think\Collection || $new_list instanceof \think\Paginator ) && $new_list->isEmpty()))): if(is_array($new_list) || $new_list instanceof \think\Collection || $new_list instanceof \think\Paginator): if( count($new_list)==0 ) : echo "" ;else: foreach($new_list as $key=>$goods): ?>
            <li>
                <dl>
                    
                    <dd class="goods-thumb">
                        <a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>">
                            <img class="lazyload" data-original="<?php echo goods_cthumb($goods['goods_image']); ?>" alt="<?php echo $goods['goods_name']; ?>">
                        </a>
                    </dd>
                    <dt class="goods-name"><a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>" title="<?php echo $goods['goods_name']; ?>"><?php echo $goods['goods_name']; ?></a></dt>
                    <dd class="goods-price"><?php echo \think\Lang::get('shopping_mall_price'); ?>：<em>￥<?php echo $goods['goods_price']; ?></em></dd>
                </dl>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
        <ul style="display: none;">
            <?php if(!(empty($groupbuy_list) || (($groupbuy_list instanceof \think\Collection || $groupbuy_list instanceof \think\Paginator ) && $groupbuy_list->isEmpty()))): if(is_array($groupbuy_list) || $groupbuy_list instanceof \think\Collection || $groupbuy_list instanceof \think\Paginator): if( count($groupbuy_list)==0 ) : echo "" ;else: foreach($groupbuy_list as $key=>$goods): ?>
            <li>
                <dl>
                    
                    <dd class="goods-thumb">
                        <a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>">
                            <img class="lazyload" data-original="<?php echo groupbuy_thumb($goods['groupbuy_image']); ?>" alt="<?php echo $goods['goods_name']; ?>">
                        </a>
                    </dd>
                    <dt class="goods-name"><a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>" title="<?php echo $goods['goods_name']; ?>"><?php echo $goods['goods_name']; ?></a></dt>
                    <dd class="goods-price"><?php echo \think\Lang::get('shopping_mall_price'); ?>：<em>￥<?php echo $goods['groupbuy_price']; ?></em></dd>
                </dl>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
    </div>
</div>
<div class="floor_wrap">
<?php if(is_array($floor_block) || $floor_block instanceof \think\Collection || $floor_block instanceof \think\Paginator): if( count($floor_block)==0 ) : echo "" ;else: foreach($floor_block as $k=>$vo): ?>
<div class="<?php if($k>4): ?>style2<?php endif; ?> floor floor<?php echo $k+1; ?> w1200">
    <div class="floor-left">
        <div class="title">
            <h2 title="<?php echo $vo['gc_name']; ?>"><?php echo $vo['gc_name']; ?></h2>
        </div>
        <?php if($k<5): ?>
        <div class="left-ads">
            <?php switch($k): case "0": $var2=8; break; case "1": $var2=9; break; case "2": $var2=10; break; case "3": $var2=11; break; case "4": $var2=12; break; endswitch; if($k<5): $ap_id =$var2;$ad_position = db("advposition")->cache(3600)->column("ap_id,ap_name,ap_width,ap_height","ap_id");$result = db("adv")->where("ap_id=$ap_id  and adv_enabled = 1 and adv_startdate < 1557104400 and adv_enddate > 1557104400 ")->order("adv_sort desc")->cache(3600)->limit("1")->select();
if(!in_array($ap_id,array_keys($ad_position)) && $ap_id)
{
  db("advposition")->insert(array(
         "ap_id"=>$ap_id,
         "ap_name"=>request()->module()."/".request()->controller()."/".request()->action()."页面自动增加广告位 $ap_id ",
  ));
  $ad_position[$ap_id]=array();
  \think\Cache::clear();  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && input("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "adv_id" => 0,
          "adv_code" => "/public/images/not_adv.jpg",
          "adv_link" => ADMIN_SITE_URL."/Adv/adv_add/ap_id/$ap_id.html",
          "adv_title"   =>"暂无广告图片",
          "not_adv" => 1,
          "adv_target" => "_self",
          "ap_id"   =>$ap_id,
      );  
    }
}

foreach($result as $key=>$v):       

    $v["position"] = $ad_position[$v["ap_id"]]; 
    $v["adv_link"] = HOME_SITE_URL."/Advclick/Advclick/adv_id/".$v["adv_id"].".html";
    $v["adv_target"] = "_blank"; 
    if(input("get.edit_ad") && !isset($v["not_adv"]) )
    {
        
        $v["style"] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v["adv_link"] = ADMIN_SITE_URL."/Adv/adv_edit/adv_id/".$v['adv_id'].".html";
        $v["adv_title"] = $ad_position[$v["ap_id"]]["ap_name"]."===".$v["adv_title"];
        $v["adv_target"] = "_self";
        $v["adv_style"] = "filter:alpha(opacity=30); -moz-opacity:0.3; -khtml-opacity: 0.3; opacity: 0.3";
    }
    ?>
            <a href="<?php echo $v['adv_link']; ?>" target="<?php echo $v['adv_target']; ?>" title="">
                <img class="lazyload" data-original="<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_ADV; ?>/<?php echo $v['adv_code']; ?>" style="<?php echo (isset($v['adv_style']) && ($v['adv_style'] !== '')?$v['adv_style']:''); ?>">
            </a>
            <?php endforeach; endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="floor-right">
        <ul class="tabs-nav hd">
            <?php if(is_array($vo['goods_list']) || $vo['goods_list'] instanceof \think\Collection || $vo['goods_list'] instanceof \think\Paginator): if( count($vo['goods_list'])==0 ) : echo "" ;else: foreach($vo['goods_list'] as $list_key=>$list): ?>
            <li <?php if($list_key == '0'): ?>class="on"<?php endif; ?>><h3><?php echo $list['gc_name']; ?></h3></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="goods-list bd">
            <?php if(is_array($vo['goods_list']) || $vo['goods_list'] instanceof \think\Collection || $vo['goods_list'] instanceof \think\Paginator): if( count($vo['goods_list'])==0 ) : echo "" ;else: foreach($vo['goods_list'] as $list_key=>$list): ?>
            <ul <?php if($list_key == '0'): ?>style="display:block"<?php endif; ?>>
                <?php if(!(empty($list['gc_list']) || (($list['gc_list'] instanceof \think\Collection || $list['gc_list'] instanceof \think\Paginator ) && $list['gc_list']->isEmpty()))): if(is_array($list['gc_list']) || $list['gc_list'] instanceof \think\Collection || $list['gc_list'] instanceof \think\Paginator): if( count($list['gc_list'])==0 ) : echo "" ;else: foreach($list['gc_list'] as $goods_key=>$goods): if(($k<5 && $goods_key<8) || $k>4): ?>
                <li>
                    <dl>
                        
                        <dd class="goods-thumb">
                            <a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>">
                                <img class="lazyload" data-original="<?php echo goods_cthumb($goods['goods_image']); ?>" alt="<?php echo $goods['goods_name']; ?>"/>
                            </a>
                        </dd>
                        <dt class="goods-name"><a target="_blank" href="<?php echo url('Goods/index',['goods_id'=>$goods['goods_id']]); ?>" title="<?php echo $goods['goods_name']; ?>"><?php echo $goods['goods_name']; ?></a></dt>
                        <dd class="goods-price">
                            <em><?php echo $goods['goods_price']; ?><?php echo \think\Lang::get('currency_zh'); ?></em>
                            <span class="original"><?php echo $goods['goods_marketprice']; ?><?php echo \think\Lang::get('currency_zh'); ?></span>
                        </dd>
                    </dl>
                </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>

<div class="w1200 floor-banner">
    <?php switch($k): case "0": $var3=3; break; case "1": $var3=4; break; case "2": $var3=5; break; case "3": $var3=6; break; case "4": $var3=7; break; endswitch; if($k<5): $ap_id =$var3;$ad_position = db("advposition")->cache(3600)->column("ap_id,ap_name,ap_width,ap_height","ap_id");$result = db("adv")->where("ap_id=$ap_id  and adv_enabled = 1 and adv_startdate < 1557104400 and adv_enddate > 1557104400 ")->order("adv_sort desc")->cache(3600)->limit("1")->select();
if(!in_array($ap_id,array_keys($ad_position)) && $ap_id)
{
  db("advposition")->insert(array(
         "ap_id"=>$ap_id,
         "ap_name"=>request()->module()."/".request()->controller()."/".request()->action()."页面自动增加广告位 $ap_id ",
  ));
  $ad_position[$ap_id]=array();
  \think\Cache::clear();  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && input("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "adv_id" => 0,
          "adv_code" => "/public/images/not_adv.jpg",
          "adv_link" => ADMIN_SITE_URL."/Adv/adv_add/ap_id/$ap_id.html",
          "adv_title"   =>"暂无广告图片",
          "not_adv" => 1,
          "adv_target" => "_self",
          "ap_id"   =>$ap_id,
      );  
    }
}

foreach($result as $key=>$v):       

    $v["position"] = $ad_position[$v["ap_id"]]; 
    $v["adv_link"] = HOME_SITE_URL."/Advclick/Advclick/adv_id/".$v["adv_id"].".html";
    $v["adv_target"] = "_blank"; 
    if(input("get.edit_ad") && !isset($v["not_adv"]) )
    {
        
        $v["style"] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v["adv_link"] = ADMIN_SITE_URL."/Adv/adv_edit/adv_id/".$v['adv_id'].".html";
        $v["adv_title"] = $ad_position[$v["ap_id"]]["ap_name"]."===".$v["adv_title"];
        $v["adv_target"] = "_self";
        $v["adv_style"] = "filter:alpha(opacity=30); -moz-opacity:0.3; -khtml-opacity: 0.3; opacity: 0.3";
    }
    ?>
    <a href="<?php echo $v['adv_link']; ?>" target="<?php echo $v['adv_target']; ?>" title="">
        <img class="lazyload" data-original="<?php echo UPLOAD_SITE_URL; ?>/<?php echo ATTACH_ADV; ?>/<?php echo $v['adv_code']; ?>" style="<?php echo (isset($v['adv_style']) && ($v['adv_style'] !== '')?$v['adv_style']:''); ?>">
    </a>
    <?php endforeach; endif; ?>
</div>
<script>
    jQuery(".floor<?php echo $k+1; ?> .floor-right").slide({mainCell: ".bd", autoPlay: false, interTime: 5000});
</script>
<?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<div class="wrapper mt10"></div>
<div class="index-link wrapper">
    <dl class="website">
        <dt><?php echo \think\Lang::get('cooperative_partner'); ?> | <?php echo \think\Lang::get('friendship_link'); ?><b></b></dt>
        <dd>
            <?php if(!(empty($link_list) || (($link_list instanceof \think\Collection || $link_list instanceof \think\Paginator ) && $link_list->isEmpty()))): if(is_array($link_list) || $link_list instanceof \think\Collection || $link_list instanceof \think\Paginator): if( count($link_list)==0 ) : echo "" ;else: foreach($link_list as $key=>$val): ?>
            <a href="<?php echo $val['link_url']; ?>" target="_blank" title="<?php echo $val['link_title']; ?>"><?php echo str_cut($val['link_title'],15); ?></a>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </dd>
    </dl>
</div>
<div class="footer-line"></div>
<!--首页底部保障开始-->

<!--首页底部保障结束-->
<!--StandardLayout Begin-->

<!--StandardLayout End-->




<script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.SuperSlide.2.1.1.js"></script>
<script>
    //轮播
    jQuery(".home-focus-layout").slide({mainCell: ".bd ul", autoPlay: true, delayTime: 500, interTime: 5000});
    jQuery(".home-scroll").slide({mainCell: ".bd li", autoPage: true,autoPlay: true, delayTime: 1000, effect: "left", interTime: 5000, vis: 5});
    jQuery(".home-sale-layout").slide({autoPlay: false, });
</script>



<div class="server">
    <div class="ensure">
        <a href="#"></a>
        <a href="#"></a>
        <a href="#"></a>
        <a href="#"></a>
    </div>
    <div class="mall_desc">
        <?php if(!(empty($article_list) || (($article_list instanceof \think\Collection || $article_list instanceof \think\Paginator ) && $article_list->isEmpty()))): if(is_array($article_list) || $article_list instanceof \think\Collection || $article_list instanceof \think\Paginator): $_5ccf8eace4657 = is_array($article_list) ? array_slice($article_list,0,4, true) : $article_list->slice(0,4, true); if( count($_5ccf8eace4657)==0 ) : echo "" ;else: foreach($_5ccf8eace4657 as $key=>$art): ?>
        <dl> 
            <dt><?php echo $art['ac_name']; ?></dt>
            <dd>
                <?php if(!(empty($art['list']) || (($art['list'] instanceof \think\Collection || $art['list'] instanceof \think\Paginator ) && $art['list']->isEmpty()))): if(is_array($art['list']) || $art['list'] instanceof \think\Collection || $art['list'] instanceof \think\Paginator): if( count($art['list'])==0 ) : echo "" ;else: foreach($art['list'] as $key=>$list): ?>
                <a href="<?php if($list['article_url'] !=''): ?><?php echo $list['article_url']; else: ?><?php echo url('Article/show',['article_id'=>$list['article_id']]); endif; ?>"><?php echo $list['article_title']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </dd>
        </dl>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        <dl class="mall_mobile">
            <dt><?php echo \think\Lang::get('mobile_mall'); ?></dt>
            <dd>
                <a href="#" class="join">
                    <img src="<?php echo HOME_SITE_URL; ?>/qrcode?url=<?php echo WAP_SITE_URL; ?>" width="105" height="105" >
                </a>
            </dd> 
        </dl>
    </div>
</div>






<?php if(\think\Config::get('node_site_use') == '1' && !isset($wait)): ?>
<?php echo get_chat(); endif; ?>
<script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.cookie.js"></script>
<script src="<?php echo HOME_SITE_ROOT; ?>/js/compare.js"></script>
<link rel="stylesheet" href="<?php echo PLUGINS_SITE_ROOT; ?>/perfect-scrollbar.min.css">
<script src="<?php echo PLUGINS_SITE_ROOT; ?>/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo PLUGINS_SITE_ROOT; ?>/js/qtip/jquery.qtip.min.js"></script>
<link href="<?php echo PLUGINS_SITE_ROOT; ?>/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.lazyload.min.js"></script>
<script>
    //懒加载
    $("img.lazyload").lazyload({
//        placeholder : "<?php echo HOME_SITE_ROOT; ?>/images/loading.gif",
        effect: "fadeIn",
        skip_invisible : false,
        threshold : 200,
    });
</script>
<div class="footer-info">
    <div class="links w1200">
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('about_us'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('contact_us'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('merchant_presence'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('marketing_center'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('mobile_mall'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('link'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('sales_alliance'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('mall_community'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank"><?php echo \think\Lang::get('mall_public_benefit'); ?></a>|
        <a href="http://www.csdeshang.com/" target="_blank">English Site</a>
    </div>
    <p class="copyright"><?php echo \think\Config::get('flow_static_code'); ?></p>
</div>
