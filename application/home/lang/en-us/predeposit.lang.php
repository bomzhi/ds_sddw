<?php

/**
 * 预存款功能公用
 */
$lang['predeposit_no_record']	 			= 'There are no qualifying records';
$lang['predeposit_unavailable']	 			= 'System does not open the predeposit function';
$lang['predeposit_parameter_error']			= 'Parameter error';
$lang['predeposit_record_error']			= 'Error recording information';
$lang['predeposit_userrecord_error']		= 'Member information error';
$lang['predeposit_payment']					= 'Method of payment';
$lang['predeposit_addtime']					= 'Creation time';
$lang['predeposit_apptime']					= 'To apply for time';
$lang['predeposit_checktime']					= 'Audit time';
$lang['predeposit_paytime']					= 'Time of payment';
$lang['predeposit_addtime_to']				= 'To';
$lang['predeposit_trade_no']				= 'Transaction no';
$lang['predeposit_adminremark']				= "Administrator's note";
$lang['predeposit_recordstate']				= 'Record state';
$lang['predeposit_paystate']				= 'State';
$lang['predeposit_backlist']				= 'Returns a list of';
$lang['predeposit_pricetype']				= 'Deposit type';
$lang['predeposit_pricetype_available']		= 'Amount available';
$lang['predeposit_pricetype_freeze']		= 'Amount frozen';
$lang['predeposit_price']					= 'Amount of';
$lang['predeposit_payment_error']			= 'Wrong payment method';
/**
 * 充值功能公用
 */
$lang['predeposit_rechargesn']					= 'Phone';
$lang['predeposit_rechargewaitpaying']			= 'Did not pay';
$lang['predeposit_rechargepaysuccess']			= 'Have to pay';
$lang['predeposit_rechargestate_auditing']		= 'In the review';
$lang['predeposit_rechargestate_approved']		= 'Approved';
$lang['predeposit_rechargestate_completed']		= 'Has been completed';
$lang['predeposit_rechargestate_closed']		= 'Closed';
$lang['predeposit_recharge_price']				= 'Top-up amount';
$lang['predeposit_recharge_huikuanname']		= 'Name of remitter';
$lang['predeposit_recharge_huikuanbank']		= 'Remittance bank';
$lang['predeposit_recharge_huikuandate']		= 'Remittance date';
$lang['predeposit_recharge_memberremark']		= 'Member of the note';
$lang['predeposit_recharge_success']			= 'Top-up success';
$lang['predeposit_recharge_fail']				= 'Top-up failure';
$lang['predeposit_recharge_pay']				= 'Pay';
$lang['predeposit_recharge_view']				= 'Check the details';
$lang['predeposit_recharge_paydesc']			= 'Prepaid deposit order';
$lang['predeposit_recharge_pay_offline']		= 'To be confirmed';
/**
 * 充值添加
 */
$lang['predeposit_recharge_add_pricenull_error']			= 'Please add the recharge amount';
$lang['predeposit_recharge_add_pricemin_error']				= 'A number whose recharge amount is greater than or equal to 0.01';
/**
 * 充值信息删除
 */
$lang['predeposit_recharge_del_success']		= 'Recharge information deleted successfully';
$lang['predeposit_recharge_del_fail']		= 'Failed to delete recharge information';
/**
 * 提现功能公用
 */
$lang['predeposit_cashsn']				= 'Application';
$lang['predeposit_cashmanage']			= 'Cash management';
$lang['predeposit_cashwaitpaying']		= 'Waiting for the payment';
$lang['predeposit_cashpaysuccess']		= 'Pay for success';
$lang['predeposit_cashstate_auditing']	= 'In the review';
$lang['predeposit_cashstate_completed']	= 'Has been completed';
$lang['predeposit_cashstate_closed']		= 'Closed';
$lang['predeposit_cash_price']				= 'Withdrawal amount';
$lang['predeposit_cash_shoukuanname']			= 'Name of account holder';
$lang['predeposit_cash_shoukuanbank']			= 'Collecting bank';
$lang['predeposit_cash_shoukuanaccount']		= 'Payment account';
$lang['predeposit_cash_shoukuanname_tip']	= 'It is strongly suggested that priority should be given to the four major state-owned Banks (bank of China, China construction bank, industrial and commercial bank of China and agricultural bank of China)<br/>. Please fill in the name of the branch of the bank you have an account with. For virtual accounts, you can fill in "alipay" and "tenpay"';
$lang['predeposit_cash_shoukuanaccount_tip']	= 'Bank account or virtual account (alipay, tenpay, etc.)';
$lang['predeposit_cash_shoukuanauser_tip']	= 'Name of the account holder of the collection account';
$lang['predeposit_cash_shortprice_error']		= 'Advance deposit amount is insufficient';
$lang['predeposit_cash_price_tip']				= 'Current available amount';

$lang['predeposit_cash_availablereducedesc']	=  'Members apply for cash withdrawal to reduce the amount of advance deposits';
$lang['predeposit_cash_freezeadddesc']	=  'Members apply for cash withdrawal to increase the amount of frozen deposits';
$lang['predeposit_cash_availableadddesc']	=  'Members delete withdrawals and increase the amount of advance deposits';
$lang['predeposit_cash_freezereducedesc']	=  'Members delete withdrawals and reduce the amount of frozen deposits';

/**
 * 提现添加
 */
$lang['predeposit_cash_add_shoukuannamenull_error']		= 'Please fill in the name of the payee';
$lang['predeposit_cash_add_shoukuanbanknull_error']		= 'Please fill in the receiving bank';
$lang['predeposit_cash_add_pricemin_error']				= 'Withdrawal amount is a number greater than or equal to 0.01';
$lang['predeposit_cash_add_enough_error']				= 'Insufficient account balance';
$lang['predeposit_cash_add_pricenull_error']			= 'Please fill in the withdrawal amount';
$lang['predeposit_cash_add_shoukuanaccountnull_error']	= 'Please fill out the collection account';
$lang['predeposit_cash_add_success']					= 'Your withdrawal application has been successfully submitted, please wait for the system processing';
$lang['predeposit_cash_add_fail']						= 'Failed to add withdrawal information';
/**
 * 提现信息删除
 */
$lang['predeposit_cash_del_success']	= 'Withdrawal information deleted successfully';
$lang['predeposit_cash_del_fail']		= 'Withdrawal information deletion failed';
/**
 * 支付接口
 */
$lang['predeposit_payment_pay_fail']		= 'Top-up failure';
$lang['predeposit_payment_pay_success']		= 'Recharge successful, is heading to my order';
$lang['predepositrechargedesc']	=  'Top-up';
/**
 * 出入明细 
 */
$lang['predeposit_log_stage'] 			= 'Type';
$lang['predeposit_log_stage_recharge']	= 'Top-up';
$lang['predeposit_log_stage_cash']		= 'Withdrawal';
$lang['predeposit_log_stage_order']		= 'Consumption';
$lang['predeposit_log_stage_artificial']= 'Manually modify';
$lang['predeposit_log_stage_system']	= 'System';
$lang['predeposit_log_stage_income']	= 'Income';
$lang['predeposit_log_desc']			= 'Changes that';

//pd_cash_list
$lang['predeposit_application_withdrawal']	= 'Apply';

//pd_log_list
$lang['predeposit_online_recharge']	= 'Online';
$lang['predeposit_spending']	= 'Spending';
$lang['predeposit_freeze']	= 'Freeze';
$lang['predeposit_pay']	= 'Pay';
$lang['predeposit_recharge_card_recharge']	= 'Top-up';
$lang['predeposit_available_balance']	= 'Balance available on top up card';
$lang['predeposit_freeze_balance']	= 'Freeze top up card balance';

//rechargecard_add
$lang['predeposit_recharge_card_number']	= 'Platform recharge card number';
$lang['predeposit_enter_card_number']	= 'Please enter the platform top-up card number';
$lang['predeposit_card_length_less']	= 'Length of the card number is less than 50';


//controller
$lang['platform_recharge_card_number_cannot_empty']	= 'Platform top-up card number shall not be empty and the length shall not be greater than 50';
$lang['platform_recharge_card_successfully_used']	= 'Platform recharge card was successfully used';
$lang['please_enter_payment_password']	= 'Please enter the payment password';
$lang['payment_password_error']	= 'Payment password error';
$lang['detail_list']	= 'Detail list';
$lang['prepaid_phone_list']	= 'Prepaid phone list';
$lang['withdrawal_list']	= 'Withdrawal list';
$lang['balance_recharge_card']	= 'Balance of recharge card';

return $lang;

