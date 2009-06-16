<?php

/**
 * ECSHOP 訂單管理語言文件
 * ============================================================================
 * 版權所有 (C) 2005-2006 北京億商互動科技發展有限公司，並保留所有權利。
 * 網站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 這是一個免費開源的軟件；這意味著您可以在不用於商業目的的前提下對程序代碼
 * 進行修改、使用和再發布。
 * ============================================================================
 * $Author: fenghl $
 * $Date: 2008-02-15 11:22:13 +0800 (星期五, 15 二月 2008) $
 * $Id: order.php 14139 2008-02-15 03:22:13Z fenghl $
 */

/* 訂單搜尋 */
$_LANG['order_sn'] = '訂單號';
$_LANG['consignee'] = '收貨人';
$_LANG['all_status'] = '訂單狀態';

$_LANG['cs'][OS_UNCONFIRMED] = '待確認';
$_LANG['cs'][CS_AWAIT_PAY] = '待付款';
$_LANG['cs'][CS_AWAIT_SHIP] = '待發貨';
$_LANG['cs'][CS_FINISHED] = '已完成';
$_LANG['cs'][OS_CANCELED] = '取消';
$_LANG['cs'][OS_INVALID] = '無效';
$_LANG['cs'][OS_RETURNED] = '退貨';

/* 訂單狀態 */
$_LANG['os'][OS_UNCONFIRMED] = '未確認';
$_LANG['os'][OS_CONFIRMED] = '已確認';
$_LANG['os'][OS_CANCELED] = '取消';
$_LANG['os'][OS_INVALID] = '無效';
$_LANG['os'][OS_RETURNED] = '退貨';

$_LANG['ss'][SS_UNSHIPPED] = '未發貨';
$_LANG['ss'][SS_PREPARING] = '配貨中';
$_LANG['ss'][SS_SHIPPED] = '已發貨';
$_LANG['ss'][SS_RECEIVED] = '收貨確認';

$_LANG['ps'][PS_UNPAYED] = '未付款';
$_LANG['ps'][PS_PAYING] = '付款中';
$_LANG['ps'][PS_PAYED] = '已付款';

/* 訂單操作 */
$_LANG['label_operable_act'] = '目前可執行操作：';
$_LANG['label_action_note'] = '操作備註：';
$_LANG['label_invoice_note'] = '發貨備註：';
$_LANG['label_invoice_no'] = '發貨單號：';
$_LANG['label_cancel_note'] = '取消原因：';
$_LANG['notice_cancel_note'] = '（會記錄在商家給客戶的留言中）';
$_LANG['op_confirm'] = '確認';
$_LANG['op_pay'] = '付款';
$_LANG['op_prepare'] = '配貨';
$_LANG['op_ship'] = '發貨';
$_LANG['op_cancel'] = '取消';
$_LANG['op_invalid'] = '無效';
$_LANG['op_return'] = '退貨';
$_LANG['op_unpay'] = '設為未付款';
$_LANG['op_unship'] = '未發貨';
$_LANG['op_receive'] = '已收貨';
$_LANG['op_assign'] = '指派給';
$_LANG['op_after_service'] = '售後';
$_LANG['act_ok'] = '操作成功';
$_LANG['notice_gb_ship'] = '備註：團購活動未處理為成功前，不能發貨';
$_LANG['back_list'] = '返回訂單列表';
$_LANG['op_remove'] = '刪除';
$_LANG['op_you_can'] = '您可進行的操作';

/* 訂單列表 */
$_LANG['order_amount'] = '應付金額';
$_LANG['total_fee'] = '總金額';
$_LANG['shipping_name'] = '配送方式';
$_LANG['pay_name'] = '付款方式';
$_LANG['address'] = '地址';
$_LANG['order_time'] = '下單時間';
$_LANG['detail'] = '查看';
$_LANG['phone'] = '電話';
$_LANG['group_buy'] = '（團購）';

$_LANG['js_languages']['remove_confirm'] = '刪除訂單將清除該訂單的所有資料。您確定要這麼做嗎？';

/* 訂單搜尋 */
$_LANG['label_order_sn'] = '訂單號：';
$_LANG['label_all_status'] = '訂單狀態：';
$_LANG['label_user_name'] = '購貨人：';
$_LANG['label_consignee'] = '收貨人：';
$_LANG['label_email'] = '電子郵件：';
$_LANG['label_address'] = '地址：';
$_LANG['label_zipcode'] = '郵遞區號：';
$_LANG['label_tel'] = '電話：';
$_LANG['label_mobile'] = '手機：';
$_LANG['label_shipping'] = '配送方式：';
$_LANG['label_payment'] = '付款方式：';
$_LANG['label_order_status'] = '訂單狀態：';
$_LANG['label_pay_status'] = '付款狀態：';
$_LANG['label_shipping_status'] = '發貨狀態：';
$_LANG['label_area'] = '所在地區：';
$_LANG['label_time'] = '下單時間：';

/* 訂單詳情 */
$_LANG['prev'] = '前一個訂單';
$_LANG['next'] = '後一個訂單';
$_LANG['print_order'] = '列印訂單';
$_LANG['print_order_sn'] = '訂單編號：';
$_LANG['print_buy_name'] = '購 貨 人：';
$_LANG['label_consignee_address'] = '收貨地址：';

$_LANG['order_info'] = '訂單資料';
$_LANG['base_info'] = '基本資料';
$_LANG['other_info'] = '其他資料';
$_LANG['consignee_info'] = '收貨人資料';
$_LANG['fee_info'] = '費用資料';
$_LANG['action_info'] = '操作資料';

$_LANG['label_how_oos'] = '缺貨處理：';
$_LANG['label_how_surplus'] = '餘額處理：';
$_LANG['label_pack'] = '包裝：';
$_LANG['label_card'] = '賀卡：';
$_LANG['label_card_message'] = '賀卡祝福語：';
$_LANG['label_order_time'] = '下單時間：';
$_LANG['label_pay_time'] = '付款時間：';
$_LANG['label_shipping_time'] = '發貨時間：';
$_LANG['label_sign_building'] = '大樓名稱：';
$_LANG['label_best_time'] = '最佳送貨時間：';
$_LANG['label_inv_type'] = '發票類型：';
$_LANG['label_inv_payee'] = '發票抬頭：';
$_LANG['label_inv_content'] = '發票內容：';
$_LANG['label_postscript'] = '客戶給商家的留言：';
$_LANG['label_region'] = '所在地區：';

$_LANG['label_shop_url'] = '網址：';
$_LANG['label_shop_address'] = '地址：';
$_LANG['label_service_phone'] = '電話：';
$_LANG['label_print_time'] = '列印時間：';

$_LANG['goods_info'] = '商品資料';
$_LANG['goods_name'] = '商品名稱';
$_LANG['goods_name_brand'] = '商品名稱 [ 品牌 ]';
$_LANG['goods_sn'] = '貨號';
$_LANG['goods_price'] = '價格';
$_LANG['goods_number'] = '數量';
$_LANG['goods_attr'] = '屬性';
$_LANG['storage'] = '庫存';
$_LANG['subtotal'] = '小計';
$_LANG['label_total'] = '合計：';
$_LANG['label_total_weight'] = '商品總重量：';

$_LANG['label_goods_amount'] = '商品總金額：';
$_LANG['label_discount'] = '折扣：';
$_LANG['label_tax'] = '發票稅額：';
$_LANG['label_shipping_fee'] = '配送費用：';
$_LANG['label_insure_fee'] = '保價費用：';
$_LANG['label_pay_fee'] = '付款費用：';
$_LANG['label_pack_fee'] = '包裝費用：';
$_LANG['label_card_fee'] = '賀卡費用：';
$_LANG['label_money_paid'] = '已付款金額：';
$_LANG['label_surplus'] = '使用餘額：';
$_LANG['label_integral'] = '使用積點：';
$_LANG['label_bonus'] = '使用折價券：';
$_LANG['label_order_amount'] = '訂單總金額：';
$_LANG['label_money_dues'] = '應付款金額：';
$_LANG['label_money_refund'] = '應退款金額：';
$_LANG['label_to_buyer'] = '商家給客戶的留言：';
$_LANG['save_order'] = '儲存訂單';
$_LANG['notice_gb_order_amount'] = '（備註：團購如果有保證金，第一次只需支付保證金和相應的支付費用）';

$_LANG['action_user'] = '操作者：';
$_LANG['action_time'] = '操作時間';
$_LANG['order_status'] = '訂單狀態';
$_LANG['pay_status'] = '付款狀態';
$_LANG['shipping_status'] = '發貨狀態';
$_LANG['action_note'] = '備註';
$_LANG['pay_note'] = '支付備註：';

$_LANG['sms_time_format'] = 'm月j日G時';
$_LANG['order_shipped_sms'] = '您的訂單%s已於%s發貨 [%s]';
$_LANG['order_removed'] = '訂單刪除成功。';
$_LANG['return_list'] = '返回訂單列表';

/* 訂單處理提示 */
$_LANG['surplus_not_enough'] = '該訂單使用 %s 餘額付款，現在使用者餘額不足';
$_LANG['integral_not_enough'] = '該訂單使用 %s 積點付款，現在使用者積點不足';
$_LANG['bonus_not_available'] = '該訂單使用折價券付款，現在折價券不可用';

/* 購貨人資料 */
$_LANG['display_buyer'] = '顯示購貨人資料';
$_LANG['buyer_info'] = '購貨人資料';
$_LANG['pay_points'] = '消費積點';
$_LANG['rank_points'] = '等級積點';
$_LANG['user_money'] = '帳戶餘額';
$_LANG['email'] = '電子郵件';
$_LANG['rank_name'] = '會員等級';
$_LANG['bonus_count'] = '折價券數量';
$_LANG['zipcode'] = '郵遞區號';
$_LANG['tel'] = '電話';
$_LANG['mobile'] = '行動電話';

/* 合併訂單 */
$_LANG['order_sn_not_null'] = '請填寫要合併的訂單號';
$_LANG['two_order_sn_same'] = '要合併的兩個訂單號不能相同';
$_LANG['order_not_exist'] = '訂單 %s 不存在';
$_LANG['os_not_unconfirmed_or_confirmed'] = ' % 的訂單狀態不是「未確認」或「已確認」';
$_LANG['ps_not_unpayed'] = '訂單 %s 的付款狀態不是「未付款」';
$_LANG['ss_not_unshipped'] = '訂單 %s 的發貨狀態不是「未發貨」';
$_LANG['order_user_not_same'] = '要合併的兩個訂單不是同一個使用者的訂單';
$_LANG['merge_invalid_order'] = '對不起，您選擇合併的訂單無法進行合併操作。';

$_LANG['from_order_sn'] = '子訂單：';
$_LANG['to_order_sn'] = '主訂單：';
$_LANG['merge'] = '合併';
$_LANG['notice_order_sn'] = '當兩個訂單不一致時，合併後的訂單資料（如：付款方式、配送方式、包裝、賀卡、折價券等）以主訂單準。';
$_LANG['js_languages']['confirm_merge'] = '您確實要合併這兩個訂單嗎？';

/* 批處理 */
$_LANG['pls_select_order'] = '請選擇您要操作的訂單';
$_LANG['no_fulfilled_order'] = '沒有滿足操作條件的訂單。';
$_LANG['updated_order'] = '更新的訂單：';
$_LANG['order'] = '訂單：';
$_LANG['confirm_order'] = '無法設置為確認狀態';
$_LANG['invalid_order'] = '無法設置為無效';
$_LANG['cancel_order'] = '無法取消';
$_LANG['remove_order'] = '無法被移除';

/* 編輯訂單打印版型 */
$_LANG['edit_order_templates'] = '編輯訂單列印版型';
$_LANG['template_resetore'] = '還原版型';
$_LANG['edit_template_success'] = '編輯訂單列印版型操作成功!';
$_LANG['remark_fittings'] = '（配件）';
$_LANG['remark_gift'] = '（贈品）';
$_LANG['remark_favourable'] = '（特惠品）';

/* 訂單來源統計 */
$_LANG['from_order'] = '訂單來源：';
$_LANG['from_ad_js'] = '廣告：';
$_LANG['from_goods_js'] = '商品站外JS投放';
$_LANG['from_self_site'] = '來自本站';
$_LANG['from'] = '來自網站：';

/* 新增、編輯訂單 */
$_LANG['add_order'] = '新增訂單';
$_LANG['edit_order'] = '編輯訂單';
$_LANG['step']['user'] = '請選擇您要為哪個會員下訂單';
$_LANG['step']['goods'] = '選擇商品';
$_LANG['step']['consignee'] = '設定收貨人資料';
$_LANG['step']['shipping'] = '選擇配送方式';
$_LANG['step']['payment'] = '選擇付款方式';
$_LANG['step']['other'] = '設定其他資料';
$_LANG['step']['money'] = '設定費用';
$_LANG['anonymous'] = '匿名使用者';
$_LANG['by_useridname'] = '按會員編號或會員名搜尋';
$_LANG['button_prev'] = '上一步';
$_LANG['button_next'] = '下一步';
$_LANG['button_finish'] = '完成';
$_LANG['button_cancel'] = '取消';
$_LANG['name'] = '名稱';
$_LANG['desc'] = '描述';
$_LANG['shipping_fee'] = '配送費';
$_LANG['free_money'] = '免費額度';
$_LANG['insure'] = '保價費';
$_LANG['pay_fee'] = '手續費';
$_LANG['pack_fee'] = '包裝費';
$_LANG['card_fee'] = '賀卡費';
$_LANG['no_pack'] = '不要包裝';
$_LANG['no_card'] = '不要賀卡';
$_LANG['add_to_order'] = '加入訂單';
$_LANG['calc_order_amount'] = '計算訂單金額';
$_LANG['available_surplus'] = '可用餘額：';
$_LANG['available_integral'] = '可用積點：';
$_LANG['available_bonus'] = '可用折價券：';
$_LANG['admin'] = '管理員新增';
$_LANG['search_goods'] = '按商品編號或商品名稱或商品貨號搜尋';
$_LANG['category'] = '分類';
$_LANG['brand'] = '品牌';
$_LANG['user_money_not_enough'] = '使用者餘額不足';
$_LANG['pay_points_not_enough'] = '使用者積點不足';
$_LANG['money_paid_enough'] = '已付款金額比商品總金額和各種費用之和還多，請先退款';
$_LANG['price_note'] = '備註：商品價格中已包含屬性加價';
$_LANG['select_pack'] = '選擇包裝';
$_LANG['select_card'] = '選擇賀卡';
$_LANG['select_shipping'] = '請先選擇配送方式';
$_LANG['want_insure'] = '我要保價';
$_LANG['update_goods'] = '更新商品';
$_LANG['notice_user'] = '<strong>注意：</strong>搜尋結果只顯示前20筆記錄，如果沒有找到相' .
        '應會員，請更精確地查找。另外，如果該會員是從討論區註冊的，且沒有在商城登入過，' .
        '也無法找到，需要先在商城登入。';
$_LANG['amount_increase'] = '由於您修改了訂單，導致訂單總金額增加，需要再次付款';
$_LANG['amount_decrease'] = '由於您修改了訂單，導致訂單總金額減少，需要退款';
$_LANG['continue_shipping'] = '由於您修改了收貨人所在地區，導致原來的配送方式不再可用，請重新選擇配送方式';
$_LANG['continue_payment'] = '由於您修改了配送方式，導致原來的付款方式不再可用，請重新選擇配送方式';
$_LANG['refund'] = '退款';
$_LANG['cannot_edit_order_shipped'] = '您不能修改已發貨的訂單';
$_LANG['address_list'] = '從已有收貨地址中選擇：';
$_LANG['order_amount_change'] = '訂單總金額由 %s 變為 %s';
$_LANG['shipping_note'] = '說明：因為訂單已發貨，修改配送方式將不會改變配送費和保價費。';
$_LANG['change_use_surplus'] = '編輯訂單 %s ，改變使用預付款支付的金額';
$_LANG['change_use_integral'] = '編輯訂單 %s ，改變使用積點支付的數量';
$_LANG['return_order_surplus'] = '由於取消、無效或退貨操作，退回支付訂單 %s 時使用的預付款';
$_LANG['return_order_integral'] = '由於取消、無效或退貨操作，退回支付訂單 %s 時使用的積點';
$_LANG['order_gift_integral'] = '訂單 %s 贈送的積點';
$_LANG['return_order_gift_integral'] = '由於退貨或未發貨操作，退回訂單 %s 贈送的積點';

$_LANG['js_languages']['input_price'] = '自定義價格';
$_LANG['js_languages']['pls_search_user'] = '請搜尋並選擇會員';
$_LANG['js_languages']['confirm_drop'] = '確認要刪除該商品嗎？';
$_LANG['js_languages']['invalid_goods_number'] = '商品數量不正確';
$_LANG['js_languages']['pls_search_goods'] = '请搜索并选择商品';
$_LANG['js_languages']['pls_select_area'] = '请完整选择所在地区';
$_LANG['js_languages']['pls_select_shipping'] = '請選擇配送方式';
$_LANG['js_languages']['pls_select_payment'] = '請選擇付款方式';
$_LANG['js_languages']['pls_select_pack'] = '請選擇包裝';
$_LANG['js_languages']['pls_select_card'] = '請選擇賀卡';
$_LANG['js_languages']['pls_input_note'] = '請您填寫備註！';
$_LANG['js_languages']['pls_input_cancel'] = '請您填寫取消原因！';
$_LANG['js_languages']['pls_select_refund'] = '請選擇退款方式！';
$_LANG['js_languages']['pls_select_agency'] = '請選擇辦事處！';
$_LANG['js_languages']['pls_select_other_agency'] = '該訂單現在就屬於這個辦事處，請選擇其他辦事處！';

/* 訂單操作 */
$_LANG['order_operate'] = '訂單操作：';
$_LANG['label_refund_amount'] = '退款金額：';
$_LANG['label_handle_refund'] = '退款方式：';
$_LANG['label_refund_note'] = '退款說明：';
$_LANG['return_user_money'] = '退回使用者餘額';
$_LANG['create_user_account'] = '產生退款申請';
$_LANG['not_handle'] = '不處理，誤操作時選擇此項';

$_LANG['order_refund'] = '訂單退款：%s';
$_LANG['order_pay'] = '訂單付款：%s';

$_LANG['send_mail_fail'] = '發送郵件失敗';

$_LANG['send_message'] = '發送/查看留言';
?>
