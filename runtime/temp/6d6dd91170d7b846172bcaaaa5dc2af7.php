<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:88:"D:\php\PHPTutorial\WWW\ds_orgion\public/../application/admin\view\dashboard\welcome.html";i:1546073894;s:74:"D:\php\PHPTutorial\WWW\ds_orgion\application\admin\view\public\header.html";i:1545196757;s:79:"D:\php\PHPTutorial\WWW\ds_orgion\application\admin\view\public\admin_items.html";i:1545196757;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DsMall(php)B2B2C商城系统后台</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo ADMIN_SITE_ROOT; ?>/css/admin.css">
        <link rel="stylesheet" href="<?php echo ADMIN_SITE_ROOT; ?>/iconfont/iconfont.css">
        <link rel="stylesheet" href="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery-ui/jquery-ui.min.css">
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery-2.1.4.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.validate.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.cookie.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/common.js"></script>
        <script src="<?php echo ADMIN_SITE_ROOT; ?>/js/admin.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/perfect-scrollbar.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/layer/layer.js"></script>
        <script type="text/javascript">
            var BASESITEROOT = "<?php echo BASE_SITE_ROOT; ?>";
            var ADMINSITEROOT = "<?php echo ADMIN_SITE_ROOT; ?>";
            var BASESITEURL = "<?php echo BASE_SITE_URL; ?>";
            var HOMESITEURL = "<?php echo HOME_SITE_URL; ?>";
            var ADMINSITEURL = "<?php echo ADMIN_SITE_URL; ?>";
        </script>
    </head>
    <body>
        <div id="append_parent"></div>
        <div id="ajaxwaitid"></div>







<div class="page welcome">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3><?php echo \think\Lang::get('ds_welcome'); ?></h3>
                <h5></h5>
            </div>
            <?php if($admin_item): ?>
<ul class="tab-base ds-row">
    <?php if(is_array($admin_item) || $admin_item instanceof \think\Collection || $admin_item instanceof \think\Paginator): if( count($admin_item)==0 ) : echo "" ;else: foreach($admin_item as $key=>$item): ?>
    <li><a href="<?php echo $item['url']; ?>" <?php if($item['name'] == $curitem): ?>class="current"<?php endif; ?>><span><?php echo $item['text']; ?></span></a></li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php endif; ?>
        </div>
    </div>

    <ul class="info-message">
        <?php if($version_message): ?>
        <li><?php echo $version_message; ?></li>
        <?php endif; ?>
    </ul>

    <!--会员-->
    <div class="info-panel">
        <div class="mt">
            <?php echo \think\Lang::get('dashboard_wel_member_des'); ?>：<em id="statistics_member"></em>
        </div>
        <div class="mc">
            <ul>
                <li class="none">
                    <a href="<?php echo url('Member/member'); ?>">
                        <div class="p_header bg-79BAD0">
                            <i class="iconfont">&#xe609;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_new_add'); ?></div>
                            <div class="p_num" id="statistics_week_add_member">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Predeposit/pdcash_list'); ?>">
                        <div class="p_header bg-EC7E7F">
                            <i class="iconfont">&#xe642;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_predeposit_get'); ?></div>
                            <div class="p_num" id="statistics_cashlist">0</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!--店铺-->
    <div class="info-panel">
        <div class="mt">
           <?php echo \think\Lang::get('dashboard_wel_store_des'); ?>：<em id="statistics_store"></em>
        </div>
        <div class="mc">
            <ul>
                <li class="none">
                    <a href="<?php echo url('Store/store_joinin'); ?>">
                        <div class="p_header bg-86CE86">
                            <i class="iconfont">&#xe63b;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_store_new'); ?></div>
                            <div class="p_num" id="statistics_store_joinin">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Store/store_bind_class_applay_list',['state'=>0]); ?>">
                        <div class="p_header bg-E9BB5F">
                            <i class="iconfont">&#xe604;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_category_apply'); ?></div>
                            <div class="p_num" id="statistics_store_bind_class_applay">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Store/reopen_list',['storereopen_state'=>1]); ?>">
                        <div class="p_header bg-79BAD0">
                            <i class="iconfont">&#xe660;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_reopen_apply'); ?></div>
                            <div class="p_num" id="statistics_store_reopen_applay">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Store/store',['store_type'=>'expired']); ?>">
                        <div class="p_header bg-EC7E7F">
                            <i class="iconfont">&#xe610;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_expired'); ?></div>
                            <div class="p_num" id="statistics_store_expired">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Store/store',['store_type'=>'expire']); ?>">
                        <div class="p_header bg-9C6CCD">
                            <i class="iconfont">&#xe610;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_expire'); ?></div>
                            <div class="p_num" id="statistics_store_expire">0</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!--商品-->
    <div class="info-panel">
        <div class="mt">
            <?php echo \think\Lang::get('dashboard_wel_total_goods'); ?>：<em id="statistics_goods"></em>
        </div>
        <div class="mc">
            <ul>
                <li class="none">
                    <a href="<?php echo url('Goods/index'); ?>">
                        <div class="p_header bg-E9BB5F">
                            <i class="iconfont">&#xe661;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_new_add'); ?></div>
                            <div class="p_num" id="statistics_week_add_product">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Goods/index',['type'=>'waitverify','search_verify'=>10]); ?>">
                        <div class="p_header bg-79BAD0">
                            <i class="iconfont">&#xe661;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_goods_waitverify'); ?></div>
                            <div class="p_num" id="statistics_product_verify">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Inform/inform_list'); ?>">
                        <div class="p_header bg-EC7E7F">
                            <i class="iconfont">&#xe66b;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_inform'); ?></div>
                            <div class="p_num" id="statistics_inform_list">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Brand/brand_apply'); ?>">
                        <div class="p_header bg-9C6CCD">
                            <i class="iconfont">&#xe66c;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_brnad_applay'); ?></div>
                            <div class="p_num" id="statistics_brand_apply">0</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!--交易-->
    <div class="info-panel">
        <div class="mt">
            <?php echo \think\Lang::get('dashboard_wel_trade_des'); ?>：<em id="statistics_order"></em>
        </div>
        <div class="mc">
            <ul>
                <li class="none">
                    <a href="<?php echo url('Refund/refund_manage'); ?>">
                        <div class="p_header bg-86CE86">
                            <i class="iconfont">&#xe624;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('order_refund'); ?></div>
                            <div class="p_num" id="statistics_refund">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Returnmanage/return_manage'); ?>">
                        <div class="p_header bg-EC7E7F">
                            <i class="iconfont">&#xe642;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('order_return'); ?></div>
                            <div class="p_num" id="statistics_return">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Vrrefund/refund_manage'); ?>">
                        <div class="p_header bg-86CE86">
                            <i class="iconfont">&#xe654;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('ds_vrrefund'); ?></div>
                            <div class="p_num" id="statistics_vr_refund">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Complain/complain_new_list'); ?>">
                        <div class="p_header bg-79BAD0">
                            <i class="iconfont">&#xe621;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_complain'); ?></div>
                            <div class="p_num" id="statistics_complain_new_list">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Complain/complain_handle_list'); ?>">
                        <div class="p_header bg-6C93CD">
                            <i class="iconfont">&#xe621;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_complain_handle'); ?></div>
                            <div class="p_num" id="statistics_complain_handle_list">0</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!--营销-->
    <div class="info-panel">
        <div class="mt">
            <?php echo \think\Lang::get('dashboard_wel_stat_des'); ?>
        </div>
        <div class="mc">
            <ul>
                <li class="none">
                    <a href="<?php echo url('Groupbuy/index'); ?>">
                        <div class="p_header bg-E9BB5F">
                            <i class="iconfont">&#xe634;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_groupbuy'); ?></div>
                            <div class="p_num" id="dashboard_wel_groupbuy">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Pointorder/pointorder_list',['porderstate'=>'waitship']); ?>">
                        <div class="p_header bg-6CCDA5">
                            <i class="iconfont">&#xe622;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_point_order'); ?></div>
                            <div class="p_num" id="dashboard_wel_point_order">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Bill/show_statis',['bill_state'=>'2']); ?>">
                        <div class="p_header bg-6C93CD">
                            <i class="iconfont">&#xe631;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_check_billno'); ?></div>
                            <div class="p_num" id="dashboard_wel_check_billno">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Bill/show_statis',['bill_state'=>'3']); ?>">
                        <div class="p_header bg-6CCDA5">
                            <i class="iconfont">&#xe674;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_pay_billno'); ?></div>
                            <div class="p_num" id="dashboard_wel_pay_billno">0</div>
                        </div>
                    </a>
                </li>
                <li class="none">
                    <a href="<?php echo url('Mallconsult/index'); ?>">
                        <div class="p_header bg-86CE86">
                            <i class="iconfont">&#xe66d;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('ds_mall_consult'); ?></div>
                            <div class="p_num" id="statistics_mall_consult">0</div>
                        </div>
                    </a>
                </li>
                <!--
                <li class="none">
                    <a href="<?php echo url('Delivery/index',['sign'=>'verify']); ?>">
                        <div class="p_header bg-9C6CCD">
                            <i class="iconfont">&#xe676;</i>
                        </div>
                        <div class="p_content">
                            <div class="p_text"><?php echo \think\Lang::get('dashboard_wel_delivery'); ?></div>
                            <div class="p_num" id="dashboard_wel_delivery">0</div>
                        </div>
                    </a>
                </li>
                -->
            </ul>
        </div>
    </div>


    <div class="info-system">
        <div class="mt">
            <h3><?php echo \think\Lang::get('dashboard_wel_version_info'); ?></h3>
        </div>
        <div class="mc">
            <table cellpadding="0" cellspacing="0" class="system_table">
                <tbody>
                <tr>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_version'); ?></td>
                    <td><?php echo $statistics['version']; ?></td>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_install_date'); ?></td>
                    <td><?php echo $statistics['setup_date']; ?></td>
                </tr>
                <tr>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_program_development'); ?></td>
                    <td><?php echo \think\Lang::get('dashboard_wel_deshangwangluo'); ?></td>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_all_right_reserved'); ?></td>
                    <td><?php echo \think\Lang::get('dashboard_wel_piracy_must_be_studied'); ?></td>
                </tr>
                <tr>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_aboutus_website'); ?>:</td>
                    <td><a href="http://www.csdeshang.com" target="_blank"><?php echo \think\Lang::get('dashboard_aboutus_website'); ?></a></td>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_aboutus_bbs'); ?>:</td>
                    <td><a href="http://bbs.csdeshang.com" target="_blank"><?php echo \think\Lang::get('dashboard_wel_communication_bbs'); ?></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="info-system">
        <div class="mt">
            <h3><?php echo \think\Lang::get('dashboard_wel_sys_info'); ?></h3>
        </div>
        <div class="mc">
            <table cellpadding="0" cellspacing="0" class="system_table">
                <tbody>
                <tr>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_thinkphp_version'); ?></td>
                    <td><?php echo THINK_VERSION; ?></td>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_class_library_file_suffix'); ?></td>
                    <td><?php echo EXT; ?></td>
                </tr>
                <tr>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_server_os'); ?></td>
                    <td><?php echo $statistics['os']; ?></td>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_server_domain_ip'); ?>:</td>
                    <td><?php echo $statistics['domain']; ?> [ <?php echo $statistics['ip']; ?> ]</td>
                </tr>
                <tr>
                    <td class="gray_bg">WEB <?php echo \think\Lang::get('dashboard_wel_server'); ?></td>
                    <td><?php echo $statistics['web_server']; ?></td>
                    <td class="gray_bg">PHP <?php echo \think\Lang::get('dashboard_wel_version'); ?></td>
                    <td><?php echo $statistics['php_version']; ?></td>
                </tr>
                <tr>
                    <td class="gray_bg">MYSQL <?php echo \think\Lang::get('dashboard_wel_version'); ?></td>
                    <td><?php echo $statistics['sql_version']; ?></td>
                    <td class="gray_bg">GD <?php echo \think\Lang::get('dashboard_wel_version'); ?>:</td>
                    <td><?php echo $statistics['gdinfo']; ?></td>
                </tr>
                <tr>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_file_uplode_limit'); ?>:</td>
                    <td><?php echo $statistics['fileupload']; ?></td>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_max_occupied_memory'); ?>:</td>
                    <td><?php echo $statistics['memory_limit']; ?></td>
                </tr>
                <tr>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_max_ex_time'); ?>:</td>
                    <td><?php echo $statistics['max_ex_time']; ?></td>
                    <td class="gray_bg"><?php echo \think\Lang::get('dashboard_wel_safe_mode'); ?>:</td>
                    <td><?php echo $statistics['safe_mode']; ?></td>
                </tr>
                <tr>
                    <td class="gray_bg">Zlib<?php echo \think\Lang::get('dashboard_wel_support'); ?>:</td>
                    <td><?php echo $statistics['zlib']; ?></td>
                    <td class="gray_bg">Curl<?php echo \think\Lang::get('dashboard_wel_support'); ?>:</td>
                    <td><?php echo $statistics['curl']; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        var normal = [];
        var work = ['week_add_member', 'week_add_product','store_joinin', 'store_bind_class_applay', 'store_reopen_applay', 'store_expired', 'store_expire', 'brand_apply', 'cashlist', 'groupbuy_verify_list', 'points_order', 'complain_new_list', 'complain_handle_list', 'product_verify', 'inform_list', 'refund', 'return', 'vr_refund', 'cms_article_verify', 'cms_picture_verify', 'circle_verify', 'check_billno', 'pay_billno', 'mall_consult', 'delivery_point', 'offline'];
        $(document).ready(function () {
            $.getJSON("<?php echo url('Dashboard/statistics'); ?>", function (data) {
                $.each(data, function (k, v) {
                    $("#statistics_" + k).html(v);
                    console.log(k);
                    if (v != 0 && $.inArray(k, work) !== -1) {
                        $("#statistics_" + k).parent().parent().parent().removeClass('none').addClass('high');
                    } else if (v == 0 && $.inArray(k, normal) !== -1) {
                        $("#statistics_" + k).parent().parent().parent().removeClass('normal').addClass('none');
                    }
                });
            });
        });
    </script>
</div>