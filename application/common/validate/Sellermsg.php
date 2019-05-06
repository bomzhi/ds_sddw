<?php

namespace app\common\validate;


use think\Validate;

class Sellermsg extends Validate
{
    protected $rule = [
        ['short_number', '^1[0-9]{10}$', '请填写正确的手机号码'],
        ['mail_number', 'email', '请填写正确的邮箱']
    ];

    protected $scene = [
        'save_msg_setting' => ['short_number','mail_number'],
    ];
}