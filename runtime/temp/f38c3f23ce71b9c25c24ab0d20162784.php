<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\php\PHPTutorial\WWW\ds_orgion\public/../application/admin\view\login\index.html";i:1545196757;s:74:"D:\php\PHPTutorial\WWW\ds_orgion\application\admin\view\public\header.html";i:1545196757;s:74:"D:\php\PHPTutorial\WWW\ds_orgion\application\admin\view\public\footer.html";i:1545196757;}*/ ?>
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




 
<style>
    body{background-image:url(<?php echo ADMIN_SITE_ROOT; ?>/images/wallpage/bg_<?php echo rand(1,8); ?>.jpg););background-size: cover;}
</style>
<div class="login">
    <div class="login_body">
        <div class="login_header">
            <img src="<?php echo ADMIN_SITE_ROOT; ?>/images/logo.png"/>
        </div>
        <div class="login_content">
            <form method="post" id="login_form">
                <div class="form-group">
                    <input type="text" name="admin_name" placeholder="用户名" required class="text">
                </div>
                <div class="form-group">
                    <input type="password" name="admin_password" placeholder="密码" required  class="text">
                </div>
                <div class="form-group">
                    <input type="text" name="captcha" placeholder="验证码" required  class="text" style="width:60%;float:left;">
                    <img src="<?php echo captcha_src(); ?>" style="width:30%;height:38px;" id="change_captcha"/>
                </div>
                <div class="form-group">
                    <input type="button" class="btn" id="login_btn" value="登录" style="width:100%"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).keyup(function (event) {
        if (event.keyCode == 13) {
            login_form();
        }
    });
    $('#login_btn').on('click', function () {
        login_form();
    });
    function login_form()
    {
        var _form = $('#login_form');
        $.ajax({
            type: "POST",
            url: "<?php echo url('Login/index'); ?>",
            data: _form.serialize(),
            dataType: 'json',
            success: function (res) {
                layer.msg(res.message, {time: 1500}, function () {
                    if (res.code == 10000) {
                        location.href = "<?php echo url('Index/index'); ?>";
                    } else {
                        $('#change_captcha').attr('src', '<?php echo captcha_src(); ?>?' + (new Date().getTime()));
                    }
                });
            }
        });
    }
    $('#change_captcha').click(function () {
        $(this).attr('src', '<?php echo captcha_src(); ?>?' + (new Date().getTime()));
    });
</script>
 




