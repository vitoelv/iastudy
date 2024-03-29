<?php

/**
 * ECSHOP 賀卡管理語言項
 * ============================================================================
 * 版權所有 (C) 2005-2006 北京億商互動科技發展有限公司，並保留所有權利。
 * 網站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 這是一個免費開源的軟件；這意味著您可以在不用於商業目的的前提下對程序代碼
 * 進行修改、使用和再發佈。
 * ============================================================================
 * $Author: refly $
 * $Date: 2007-11-26 21:10:53 +0800 (星期一, 26 十一月 2007) $
 * $Id: card.php 13757 2007-11-26 13:10:53Z refly $
*/



$_LANG['card_name']         = '賀卡名稱';
$_LANG['card_fee']          = '賀卡費用';
$_LANG['free_money']        = '免賀卡費用門檻';
$_LANG['card_img']          = '賀卡圖片';
$_LANG['card_desc']         = '賀卡描述';

$_LANG['card_edit']         = '編輯賀卡';

$_LANG['drop_card_img']     = '刪除賀卡圖片';
$_LANG['confirm_drop_card_img'] = '你確認刪除該賀卡圖片嗎？';
$_LANG['drop_card_img_success'] = '刪除賀卡圖片成功';

$_LANG['card_edit_lnk'] = '重新編輯該賀卡';
$_LANG['card_list_lnk'] = '返回列表頁面';

/*幫助信息*/
$_LANG['notice_cardfee']    = '使用這個賀卡所需要付款的費用，免費時設定為0';
$_LANG['notice_cardfreemoney']    = '當用戶消費金額超過這個值時，將免費使用這個賀卡<br />設定為0表明必須付款賀卡費用';

$_LANG['warn_cardimg']       = '你已經上傳過圖片。再次上傳時將覆蓋原圖片';

/*提示信息*/
$_LANG['cardname_exist']     ='賀卡名 %s 已經存在';
$_LANG['cardadd_succeed']    ='已成功新增';
$_LANG['carddrop_fail']      ='刪除失敗';
$_LANG['carddrop_succeed']   ='刪除成功';
$_LANG['cardedit_succeed']   ='賀卡 %s 修改成功';
$_LANG['cardedit_fail']    ='賀卡 %s 修改失敗';
$_LANG['drop_confirm']       ='你確認要刪除這筆記錄嗎？';
$_LANG['enter_num']          ='請輸入一個數字！';

$_LANG['no_cardname']        ='你輸入的卡片名稱為空！';

$_LANG['back_list']          ='返回賀卡列表';
$_LANG['continue_add']       ='繼續新增新賀卡';

$_LANG['upfile_type_error']  = "只能上傳jpg，gif，png類型的圖片";

$_LANG['upfile_error']       = "圖片無法上傳，請確定data目錄下所有子目錄皆為可寫入資料";

/*JS 語言項*/
$_LANG['js_languages']['no_cardname'] = '沒有輸入賀卡名';
$_LANG['js_languages']['cardfee_un_num'] = '賀卡費用為空或不是數字';
$_LANG['js_languages']['cardmoney_un_num'] = '賀卡免費額度為空或不是數字';

?>