<?php
$lang['voucher_unavailable']    = 'Voucher function has not been turned on';
$lang['voucher_quotastate_activity']	= 'Normal';
$lang['voucher_quotastate_cancel']    = 'Cancel';
$lang['voucher_quotastate_expire']    = 'Expire';
$lang['voucher_templatestate_usable']	= 'Effective';
$lang['voucher_templatestate_disabled']= 'Failure';
$lang['voucher_quotalist']= 'Package list';
$lang['voucher_applyquota']= 'Application package';
$lang['voucher_applyadd']= 'Purchase plan';
$lang['voucher_templateadd']= 'New vouchers';
$lang['voucher_templateedit']= 'Edit voucher';
$lang['voucher_templateinfo']= 'Vouchers detailed';
/**
 * 套餐申请
 */
$lang['voucher_apply_num_error']= 'Quantities cannot be empty and must be integers between 1 and 12';
$lang['voucher_apply_fail']= 'Package application failed';
$lang['voucher_apply_succ']= 'Package application is successful. Please wait for review';
$lang['voucher_apply_date']= 'Application date';
$lang['voucher_apply_num']    		= 'Number of applications';
$lang['voucher_apply_addnum']    		= 'Quantity of package purchase';
$lang['voucher_apply_add_tip1']    		= 'The purchase unit is a month (30 days), with a maximum of 12 months at a time. You can issue the voucher activity on a monthly basis within the purchase cycle';
$lang['voucher_apply_add_tip2']    		= 'You need to pay %s yuan per month';
$lang['voucher_apply_add_tip3']    		= 'Publish activity %s at most per month';
$lang['voucher_apply_add_tip4']    		= 'Package time is calculated from the approval';
$lang['voucher_apply_add_confirm1']    	= 'You need to pay in total';
$lang['voucher_apply_add_confirm2']    	= 'Yuan, confirm the purchase?';
$lang['voucher_apply_buy_succ']			= 'Successful package purchase';

/**
 * 套餐
 */
$lang['voucher_quota_startdate']    	= 'Start date';
$lang['voucher_quota_enddate']    		= 'End date';
$lang['voucher_quota_timeslimit']    	= 'Activity limit';
$lang['voucher_quota_publishedtimes']   = 'Number of published activities';
$lang['voucher_quota_residuetimes']    	= 'Number of remaining activities';
/**
 * 代金券模板
 */
$lang['voucher_template_quotanull']			= 'There is no package available at the moment, please apply for the package first';
$lang['voucher_template_noresidual']		= "Activity in the current package is full %s activity information, can not publish the activity again";
$lang['voucher_template_pricelisterror']	= 'There is a problem with the denomination of the platform voucher. Please contact the customer service for help';
$lang['voucher_template_title_error'] 		= "Template name cannot be empty and cannot be greater than 50 characters";
$lang['voucher_template_total_error'] 		= "Available quantity cannot be empty and must be an integer";
$lang['voucher_template_price_error']		= "Template denomination shall not be empty and must be an integer, and the denomination shall not be greater than the limit";
$lang['voucher_template_limit_error'] 		= "Template usage limits cannot be empty and must be digital";
$lang['voucher_template_describe_error'] 	= "Template description cannot be empty and cannot be greater than 255 characters";
$lang['voucher_template_title']			= 'Voucher name';
$lang['voucher_template_enddate']		= 'Period of validity';
$lang['voucher_template_enddate_tip']		= 'Period of validity shall be within the period of validity of the package, and the package in use shall be valid for';
$lang['voucher_template_price']			= 'Denomination';
$lang['voucher_template_total']			= 'Total amount payable';
$lang['voucher_template_eachlimit']		= 'Each limit get';
$lang['voucher_template_eachlimit_item']= 'There is no limit';
$lang['voucher_template_eachlimit_unit']= 'Zhang';
$lang['voucher_template_orderpricelimit']	= 'Consumption amount';
$lang['voucher_template_describe']		= 'Voucher description';
$lang['voucher_template_styleimg']		= 'Select voucher skin';
$lang['voucher_template_styleimg_text']	= 'Store coupons';
$lang['voucher_template_image']			= 'Voucher picture';
$lang['voucher_template_image_tip']		= 'The picture will be displayed in the voucher module in the center of points. Click save after uploading. The recommended size is 160*160px.';
$lang['voucher_template_list_tip1'] = "1. After the voucher is invalid, the user cannot get the voucher, but the voucher already received can still be used";
$lang['voucher_template_list_tip2'] = "2. The coupon template and the issued voucher will automatically become invalid after expiration";
$lang['voucher_template_backlist'] 	= "Back list";
$lang['voucher_template_giveoutnum']= 'Have to receive';
$lang['voucher_template_usednum']	= 'Has been used';
/**
 * 代金券
 */
$lang['voucher_voucher_state'] = "State";
$lang['voucher_voucher_state_unused'] = "Don't use";
$lang['voucher_voucher_state_used'] = "Has been used";
$lang['voucher_voucher_state_expire'] = "Expired";
$lang['voucher_voucher_price'] = "Pirce";
$lang['voucher_voucher_storename'] = "Apply store";
$lang['voucher_voucher_indate'] = "Period validity";
$lang['voucher_voucher_usecondition'] = "Conditions use";
$lang['voucher_voucher_usecondition_desc'] = "Orders with";
$lang['voucher_voucher_vieworder'] = "View order";
$lang['voucher_voucher_readytouse'] = "Use immediately";
$lang['voucher_voucher_code'] = "Code";

//index
$lang['set_meal_renewal']		= 'Set a renewal';
$lang['set_expiration_time']		= 'Set expiration time';
$lang['please_buy_package_first']		= 'There is no package available at the moment, please buy the package first';
$lang['deduction_settlement_payment_days']		= 'Relevant fees will be deducted from the payment days settlement of the store';

//templateadd
$lang['store_classification']		= 'Store classification';
$lang['blank_defaults']		= 'Blank expires after 30 days by default';
$lang['image_upload']		= 'Image upload';

$lang['voucher_template_eachlimit']		= 'Each limit get';

//controller
$lang['buy_voucher_package'] = 'Buy a voucher package';
$lang['buy'] = 'Buy';
$lang['voucher_plan'] = 'Voucher set, unit price';