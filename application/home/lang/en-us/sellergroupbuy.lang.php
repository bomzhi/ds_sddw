<?php
/**
 * 抢购状态
 */
$lang['groupbuy_state_all'] = 'Up all';
$lang['groupbuy_state_verify'] = 'Not audit';
$lang['groupbuy_state_cancel'] = 'Has been cancelled';
$lang['groupbuy_state_progress'] = 'Have been through';
$lang['groupbuy_state_fail'] = 'Audit failure';
$lang['groupbuy_state_close'] = 'Has ended';

/**
 * 抢购字段
 **/
$lang['group_template'] = 'Snap up activities';
$lang['group_template_tip'] = 'Select the event and time period to attend';
$lang['group_name'] = 'For the name';
$lang['group_name_tip'] = 'To snap up a title name length of up to 30 characters';
$lang['group_goods_sel'] = 'Choose goods';
$lang['group_help'] = 'For instructions';
$lang['start_time'] = 'Start time';
$lang['end_time'] = 'End of time';
$lang['goods_price'] = 'Commodity price';
$lang['goods_storage'] = 'Merchandise inventory';
$lang['store_price'] = 'Mall price';
$lang['groupbuy_price'] = 'For the price';
$lang['groupbuy_price_tip'] = 'Price shall be the promotion price of the commodity when participating in the activity <br/> must be between 0.01 and 1000000 (unit: yuan)<br/> price shall include postage, and the system of the commodity price shall not charge postage by default';
$lang['limit_type'] = 'Limit type';
$lang['virtual_quantity'] = 'Number of virtual';
$lang['min_quantity'] = 'To rob the number';
$lang['sale_quantity'] = 'Amount for purchasing';
$lang['max_num'] = 'Total number of goods';
$lang['group_intro'] = 'This musical';
$lang['group_pic'] = 'Snap up pictures';
$lang['group_edit'] = 'Edit content';

$lang['groupbuy_class'] = 'For category';
$lang['groupbuy_class_tip'] = 'Please select the category of the item to be snapped up';
$lang['groupbuy_area'] = 'Area';
$lang['groupbuy_goods'] = 'Buying goods';
$lang['groupbuy_goods_explain'] = 'Click on the top input box to select the item to be snapped up from the published item';
$lang['min_quantity_explain'] = 'Lowest number of successful runs, by default, is "1"';
$lang['virtual_quantity_explain'] = 'Virtual purchase quantity is only used for the front desk display and does not affect the transaction record';
$lang['sale_quantity_explain'] = 'maximum quantity available for each buyer ID, unlimited quantity please fill in "0"';
$lang['max_num_explain'] = 'Total number of items to be purchased should be equal to or less than the inventory quantity of the item <br/> please confirm in advance that the inventory quantity of the item to be participated is sufficient';
$lang['group_pic_explain'] = 'To snap up images for the event page, please use images in width 440 pixels, height 293 pixels, and size within 1M. <br/> supports JPG, jpeg, GIF, PNG.';
$lang['group_pic_explain2'] = 'To snap up images with recommended bits on the side of the page and recommended bits on the home page, please use images with a width of 210 pixels, a height of 180 pixels, and a size of 1M. <br/> supports uploading in JPG, jpeg, GIF, PNG format.';
$lang['groupbuy_message_not_start'] = 'Rush has yet to begin';
$lang['groupbuy_message_close'] = 'Rush is over';
$lang['groupbuy_message_start'] = 'Please place your order as soon as possible';
$lang['groupbuy_message_success'] = 'Buy to succeed can continue to buy';

/**
 * 错误提示
 **/
$lang['groupbuy_unavailable'] = 'Snap up function was not enabled';
$lang['no_groupbuy_template_in_progress'] = 'There is no snap up in progress';
$lang['no_groupbuy_info'] = 'No snap up information';
$lang['no_groupbuy_template_soon'] = 'There was no imminent rush';
$lang['no_groupbuy_template_history'] = 'There is no history of panic buying';
$lang['no_groupbuy'] = 'No information is currently available';
$lang['param_error'] = 'Param error';
$lang['group_name_error'] = 'Snap up names cannot be empty';
$lang['group_goods_error'] = 'Please choose to snap up the goods';
$lang['group_help_error'] = 'Buy instructions cannot be empty';
$lang['start_time_error'] = 'Start time cannot be empty';
$lang['end_time_error'] = 'End time cannot be empty';
$lang['groupbuy_price_error'] = 'Please enter the correct purchase price';
$lang['group_pic_error'] = 'Snap images cannot be empty and must be JPG/GIF/PNG format';
$lang['min_quantity_error'] = 'Quantity cannot be empty and must be an integer greater than 0';
$lang['virtual_quantity_error'] = 'Virtual number cannot be empty and must be an integer';
$lang['sale_quantity_error'] = 'Purchase limit cannot be empty; it must be an integer';
$lang['max_num_error'] = 'Total number of items cannot be empty and must be smaller than current inventory';
$lang['groupbuy_none'] = 'There is no ongoing snap up activity on the platform';
$lang['group_goods_is_exist'] = 'This item is already on sale. Please choose another item';
$lang['goods_info'] = 'Commodity information';
$lang['buyer_list'] = 'Purchase records';
$lang['store_info'] = 'Store information';
$lang['groupbuy_not_state'] = 'Rush has yet to begin';
$lang['groupbuy_closed'] = 'Rush is over';
$lang['goods_not_enough'] = 'Understock';
$lang['groupbuy_not_enough'] = 'Insufficient balance';
$lang['groupbuy_sale_quantity'] = 'You can only buy at most';
$lang['can_not_buy'] = 'You are not allowed to buy your own published products';

$lang['groupbuy_add_success'] = 'Please wait for the review of the successful launch of the snap up activity';
$lang['groupbuy_add_fail'] = 'Launch of the snap up campaign failed';
$lang['groupbuy_edit_success'] = 'Snap up the event editor successfully';
$lang['groupbuy_edit_fail'] = 'Snap up activity editor fails';
$lang['groupbuy_quota_add_success'] = 'Purchased the event package successfully';

/**
 * 文字
 **/
$lang['groupbuy_title'] = 'Goods to snap up';
$lang['groupbuy_soon'] = 'Is about to begin';
$lang['groupbuy_history'] = 'Past to snap up';
$lang['text_year'] = 'Year';
$lang['text_month'] = 'Month';
$lang['text_day'] = 'Day';
$lang['text_tian'] = 'Tian';
$lang['text_hour'] = 'Hour';
$lang['text_minute'] = 'Minute';
$lang['text_second'] = 'Second';
$lang['text_to'] = 'To';
$lang['text_di'] = 'Di';
$lang['text_qi'] = 'Qi';
$lang['text_groupbuy'] = 'Mall to snap up';
$lang['text_groupbuy_list'] = 'For a list of';
$lang['text_groupbuy_detail'] = 'For the details';
$lang['text_goods_price'] = 'Original price';
$lang['text_zhe'] = 'Zhe';
$lang['text_discount'] = 'Discount';
$lang['text_save'] = 'Save';
$lang['groupbuy_buy'] = 'I want to rob';
$lang['groupbuy_close'] = 'Has ended';
$lang['text_end_time'] = 'End of period';
$lang['text_start_time'] = 'From the beginning of the period';
$lang['text_no_limit'] = 'There is no limit';
$lang['text_class'] = 'Classification';
$lang['text_price'] = 'Price';
$lang['text_unit_price'] = 'Unit price';
$lang['text_default'] = 'Default';
$lang['text_sale'] = 'Sale';
$lang['text_rebate'] = 'Discount';
$lang['text_order'] = 'Order';
$lang['text_country'] = 'National';
$lang['text_people'] = 'People';
$lang['text_buy'] = 'Have to buy';
$lang['text_jiangyu'] = 'Will be in';
$lang['text_start'] = 'Open on time rob';
$lang['see_store'] = 'Hit the shops';
$lang['see_goods'] = 'To check the goods';
$lang['to_see'] = 'Go and see';
$lang['history_hot'] = 'Top sellers in the past';
$lang['current_hot'] = 'Hot snap';
$lang['text_buyer'] = 'Buyers';
$lang['text_buy_count'] = 'Purchase quantity';
$lang['text_buy_now'] = 'Buy now';
$lang['text_buy_time'] = 'Place the order of time';
$lang['text_piece'] = 'Jian';
$lang['text_goods_buy'] = 'Goods have been snapped up';
$lang['text_goods_store'] = 'Store';
$lang['text_goods_commend'] = 'Shop recommendation';
$lang['text_read_agree1'] = 'I have read';
$lang['text_read_agree2'] = 'And I agree to';
$lang['text_agreement'] = 'Snap up service agreement';
$lang['agree_must'] = 'You must agree to this agreement';
$lang['store_goods_album_insert_users_photo'] = 'Insert photo album';
$lang['text_remain'] = 'Remaining';

/**
 * index
 */
$lang['groupbuy_index_no_right']			= 'Your store level does not have this permission';
$lang['groupbuy_index_in_audit']			= 'Your store rating is under review';
$lang['groupbuy_index_add_success']			= 'Add snap up activity successfully';
$lang['groupbuy_index_add_fail']			= 'Adding snap up activities failed';
$lang['groupbuy_index_not_exists']			= 'No snap - up was found';
$lang['groupbuy_index_modify_success']		= 'Modified snap - up was successful';
$lang['groupbuy_index_modify_fail']			= 'Modified snap - up failed';
$lang['groupbuy_index_default_spec']		= 'Default specification';
$lang['groupbuy_index_all_group']			= 'Up all';
$lang['groupbuy_index_unpublish']			= 'Not release';
$lang['groupbuy_index_canceled']			= 'Has been cancelled';
$lang['groupbuy_index_going']				= 'Ongoing';
$lang['groupbuy_index_finished']			= 'Has been completed';
$lang['groupbuy_index_ended']				= 'Has ended';
$lang['groupbuy_index_num']					= '(People number)';
$lang['groupbuy_index_amount']				= '(Number )';
$lang['groupbuy_index_desc']				= 'Instructions';
$lang['groupbuy_index_order_num']			= 'Order number';
$lang['groupbuy_index_input_name']			= 'Please fill in the name of snap up';
$lang['groupbuy_index_desc']				= 'For instructions';
$lang['groupbuy_index_end_time']			= 'End of time';
$lang['groupbuy_index_search_first']		= 'Please search for the goods first';
$lang['groupbuy_index_input_right_num']		= 'Please fill in the number of participants correctly';
$lang['groupbuy_index_input_right_amount']	= 'Please fill in the number of pieces correctly';
$lang['groupbuy_index_def_quantity_error']  = 'Please fill in the order number correctly';
$lang['groupbuy_index_goods_sum_null']		= 'Total merchandise cannot be empty';
$lang['groupbuy_index_goods_sum_one']		= 'Total number of goods cannot be less than 1';
$lang['groupbuy_index_input_right_price']	= 'Please fill in the purchase price correctly';
$lang['groupbuy_index_max_per_user_error']  = 'Please fill in the quantity per person correctly';
$lang['groupbuy_index_input_price']			= 'Please fill out the offer';
$lang['groupbuy_index_base_info']			= 'Buy basic information';
$lang['groupbuy_index_activity_name']		= 'Name of the event';
$lang['groupbuy_index_publish_now']			= 'Immediately release';
$lang['groupbuy_index_yes']					= 'Yes';
$lang['groupbuy_index_no']					= 'No';
$lang['groupbuy_index_publish_tip']			= 'If "published immediately," information other than "snap up instructions" cannot be changed';
$lang['groupbuy_index_start_time']			= 'Start time';
$lang['groupbuy_index_end_time']			= 'End time';
$lang['groupbuy_index_goods_info']			= 'Buying information';
$lang['groupbuy_index_choose_goods']		= 'Choose goods';
$lang['groupbuy_index_order_num_now']		= 'Have order number';
$lang['groupbuy_index_order_num_published']	= 'Number of orders displayed after publication';
$lang['groupbuy_index_condition']			= 'Limiting conditions';
$lang['groupbuy_index_by_num']				= 'Compete with the number of successful buyers';
$lang['groupbuy_index_by_amount']			= 'To purchase the quantity of products to compete';
$lang['groupbuy_index_group_num']			= 'To rob the number';
$lang['groupbuy_index_group_espect_num']	= 'Expected number of subscribers who can complete the snap u';
$lang['groupbuy_index_group_amount']		= 'To rob the number';
$lang['groupbuy_index_group_espect_amount']	= 'Expected number of orders that can be completed';
$lang['groupbuy_index_amount_limit']		= 'Each of';
$lang['groupbuy_index_amount_limit_tip']	= 'Maximum number of pieces that each responder can order is 0';
$lang['groupbuy_index_goods_sum']			= 'Total number of goods';
$lang['groupbuy_index_amount_max_limit']	= 'Maximum quantity that can be ordered by all participants is the default number of goods in stock';
$lang['groupbuy_index_intro']				= 'This musical';
$lang['groupbuy_index_spec_price']			= 'Specifications and price';
$lang['groupbuy_index_spec']				= 'Specifications';
$lang['groupbuy_index_stock']				= 'Inventory';
$lang['groupbuy_index_store_price']			= 'Store price';
$lang['groupbuy_index_group_price']			= 'Buying price';
$lang['groupbuy_index_search']				= 'Query';
$lang['groupbuy_index_submit']				= 'Submit';
$lang['groupbuy_index_new_group']			= 'New to snap up';
$lang['groupbuy_index_activity_state']		= 'Active state';
$lang['groupbuy_index_start_time']			= 'Starting time';
$lang['groupbuy_index_group_num']			= 'Have to snap up';
$lang['groupbuy_index_to']					= 'To';
$lang['groupbuy_index_year']				= 'Year';
$lang['groupbuy_index_month']				= 'Month';
$lang['groupbuy_index_day']					= 'Day';
$lang['groupbuy_index_publish_tip']			= 'Cannot be edited after publication except for modification instructions. Are you sure you want to publish';
$lang['groupbuy_index_publish']				= 'Release';
$lang['groupbuy_index_del_tip']				= 'If the purchase is completed, deleting the purchase will result in unordered users being unable to place orders. Are you sure you want to do so';
$lang['groupbuy_index_order']				= 'Order';
$lang['groupbuy_index_order_state']			= 'Order situation';
$lang['groupbuy_index_finish_tip']			= 'This action will set the snap up to the success state.';
$lang['groupbuy_index_finish']				= 'Complete';
$lang['groupbuy_index_end']				    = 'End of reservation';
$lang['groupbuy_index_no_record']			= 'No eligible goods were found';
$lang['groupbuy_index_loading_list']		= 'Loading the list of items';
$lang['groupbuy_index_no_goods']			= 'No relevant goods were found';
$lang['groupbuy_index_choose_goods']		= 'Choose goods';
$lang['groupbuy_index_goods_name']			= 'Name of commodity';
$lang['groupbuy_index_store_class']			= 'This store classification';
$lang['groupbuy_index_please_choose']		= 'All categories';
$lang['groupbuy_index_search_back']			= 'Please search from above first';
$lang['groupbuy_index_publish_success']		= 'Release success';
$lang['groupbuy_index_change_to_finish']		= 'Status has been changed to complete';
$lang['groupbuy_index_group_canceled']			= 'Rush has been cancelled';
$lang['groupbuy_index_modify_intro_success']	= 'Revised product description was successful';
$lang['groupbuy_index_modify_order_num_sucess']	= 'Revised order number is successful';
$lang['groupbuy_index_cancel_reason']			= 'Cancel the reason';
$lang['groupbuy_index_username']				= 'User name';
$lang['groupbuy_index_linkman']					= 'Contact';
$lang['groupbuy_index_phone']					= 'Contact phone number';
$lang['groupbuy_index_jian']					= 'Jian';
$lang['groupbuy_index_no_record_now']			= 'No order record';
$lang['groupbuy_index_del_success']		= 'Delete snap - up was successful';
$lang['groupbuy_index_del_fail']		= 'Delete snap - up failed';
$lang['groupbuy_index_datefail']		= 'Date cannot be less than the date, \n defaults to 7 days!';
$lang['groupbuy_index_startdatefail']		= 'Buying start time is not earlier than the day, \n default to start time for the day!';

//groupbuy_add
$lang['snap_up_subtitles']			= 'Snap up subtitles';
$lang['snap_up_subtitle_word_limit']			= 'Snap up activity subtitle can be entered in up to 30 characters';
$lang['start_time_cannot_less_than']			= 'Start time cannot be less than';
$lang['start_time_cannot_greater_than']			= 'Start time cannot be greater than';
$lang['search_store_items']			= 'Step 1: search for in-store items';
$lang['special_goods_not_allowed']			= 'A direct search without entering a name will show all ordinary items in the store and special items cannot be entered.';
$lang['implement_uniform_purchase_prices']			= 'All specifications of the item SKU will be subject to uniform purchase price when the purchase is effective';
$lang['snap_up_photos']			= 'Snap up photos';
$lang['image_upload']			= 'Image upload';
$lang['snap_recommended_images']			= 'Snap up recommended images';
$lang['start_time_cannot_empty']			= 'Start time cannot be empty';
$lang['start_time_must_greater']			= 'Start time must be greater than';
$lang['end_snap_time_cannot_empty']			= 'End of snap up time cannot be empty';
$lang['snap_must_less']			= 'End of snap up must be less than';
$lang['must_greater_start_time']			= 'End time must be greater than the start time';
$lang['product_participated_simultaneous_events']			= 'Product has participated in simultaneous events';
$lang['price_must_less_price_goods']			= 'Price must be less than the price of the goods';
$lang['snap_images_cannot_empty']			= 'Snap up images cannot be empty';

//groupbuy_add_vr
$lang['no_more_buying_virtual_goods']			= 'End of the rush must not be greater than the expiration of the virtual item';
$lang['expiry_date_buying_package']			= "And snap up the plan's expiration date";
$lang['display_all_virtual_goods_store']			= 'A direct search without entering a name will show all virtual items in the store';
$lang['snap_recommended_images']			= 'Snap up recommended images';
$lang['snap_classification']			= 'For classification';
$lang['select_category_virtual_panic_buying']			= 'Please select the category of this virtual snap up';
$lang['maximum_quantity_available']			= 'Maximum number of each buyer ID can be purchased, which cannot be greater than the limited quantity of the virtual goods themselves. Please fill in "0" for unlimited quantity.';
$lang['virtual_product_expiration_time']			= 'End time must be less than the virtual item expiration time';
$lang['simultaneous_activities']			= 'Product has participated in simultaneous events';
$lang['limited_quantity_intended_product_itself']			= 'Limit purchase quantity of virtual buying activity cannot be greater than the limit purchase quantity of virtual goods itself';

//groupbuy_quota_add
$lang['purchase_unit_month']			= 'The purchase unit is a month (30 days), and you can release the snap up activity within the purchase cycle';
$lang['need_pay_monthly']			= 'You need to pay every month (30 days)';
$lang['deduction_settlement_payment_days']			= 'Relevant fees will be deducted from the payment days settlement of the store';
$lang['need_pay_total']			= 'Confirm purchase?You need to pay in total';
$lang['quantity_cannot_empty']			= 'Quantity cannot be empty and must be a number';

//index
$lang['new_virtual_goods_snap']			= 'New virtual goods to snap up';
$lang['new_virtual_panic_buying']			= 'New virtual panic buying';
$lang['set_renewal']			= 'Set a renewal';
$lang['purchase_plan']			= 'Purchase plan';
$lang['purchase_plan1']			= '1、Click the new snap up button to add a snap up activity';
$lang['purchase_plan2']			= '2、If the release of virtual shopping activities, please click the new virtual shopping button';
$lang['set_expiration_time']			= 'Set expiration time';
$lang['please_buy_package_first']			= 'There is no package available at the moment, please buy the package first';
$lang['package_instructions1']			= '1、Click the buy package and renew button to buy or renew the package';
$lang['package_instructions2']			= '2、Click the new snap up button to add a snap up activity';
$lang['package_instructions3']			= '3、If the release of virtual shopping activities, please click the new virtual shopping button';
$lang['package_instructions4']			= 'Relevant fees will be deducted from the payment days settlement of the store';
$lang['snap_type']			= 'Snap up type';
$lang['online_rob']			= 'Online rob';
$lang['virtual_rob']			= 'Virtual rob';
$lang['browse_number']			= 'Browse number';
$lang['virtual_exchange']			= 'Virtual exchange';

//search_goods
$lang['sale_price']			= 'Sale price';
$lang['choose_snap_merchandise']			= 'Choose to snap up merchandise';

//controller
$lang['purchase_quantity_cannot_empty']			= 'Purchase quantity cannot be empty';
$lang['buy']			= 'Buy';
$lang['buy_to_snap_up']			= 'Buy to snap up';
$lang['snap_up_package']			= 'Unit price of the package';
$lang['virtual_panic_buying']			= 'Limit purchase quantity (%d) of the virtual buying activity cannot be greater than the limit purchase quantity of the virtual goods (%d).';
$lang['release_snap_up']			= 'Release snap up activity, snap up name:';
