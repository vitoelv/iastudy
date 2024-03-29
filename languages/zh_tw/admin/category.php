<?php

/**
 * ECSHOP 商品分類管理語言文件
 * ============================================================================
 * 版權所有 (C) 2005-2006 北京億商互動科技發展有限公司，並保留所有權利。
 * 網站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 這是一個免費開源的軟件；這意味著您可以在不用於商業目的的前提下對程序代碼
 * 進行修改、使用和再發佈。
 * ============================================================================
 * $Author: refly $
 * $Date: 2007-11-26 21:10:53 +0800 (星期一, 26 十一月 2007) $
 * $Id: category.php 13757 2007-11-26 13:10:53Z refly $
*/

/* 商品分類字段信息 */
$_LANG['cat_id'] = '編號';
$_LANG['cat_name'] = '分類名稱';
$_LANG['isleaf'] = '不允許';
$_LANG['noleaf'] = '允許';
$_LANG['keywords'] = '關鍵字';
$_LANG['cat_desc'] = '分類描述';
$_LANG['parent_id'] = '上層分類';
$_LANG['sort_order'] = '排序';
$_LANG['measure_unit'] = '商品數量單位';
$_LANG['delete_info'] = '刪除所選取的';
$_LANG['category_edit'] = '編輯商品分類';
$_LANG['move_goods'] = '轉移分類內的商品';
$_LANG['cat_top'] = '最上層分類';
$_LANG['show_in_nav'] = '是否顯示在導覽列';
$_LANG['cat_style'] = '分類的樣式表檔案';
$_LANG['is_show'] = '是否顯示';
$_LANG['goods_number'] = '商品數量';

$_LANG['nav'] = '導覽列';

$_LANG['back_list'] = '返回分類列表';
$_LANG['continue_add'] = '繼續新增分類';

$_LANG['notice_style'] = '您可以為每一個商品分類指定一個樣式表檔案。例如檔案存放在 themes 目錄下則鍵入：themes/style.css';

$_LANG['grade'] = '價格區間個數';
$_LANG['notice_grade'] = '該選項表示該分類下商品最低價與最高價之間的劃分的等級個數，填0表示不做分級';
$_LANG['short_grade'] = '價格分級';

/* 操作提示信息 */
$_LANG['catname_empty'] = '分類名稱不能為空!';
$_LANG['catname_exist'] = '已存在相同的分類名稱!';
$_LANG["parent_isleaf"] = '所選分類不能是底層分類!';
$_LANG["cat_isleaf"] = '不是底層分類或還存在有商品,不能刪除!';
$_LANG["cat_noleaf"] = '底下還有其它子分類,不能修改為底層分類!';
$_LANG["is_leaf_error"] = '所選擇的上層分類不能是目前分類或者目前分類的下層分類!';

$_LANG['catadd_succed'] = '新商品分類新增成功!';
$_LANG['catedit_succed'] = '商品分類編輯成功!';
$_LANG['catdrop_succed'] = '商品分類刪除成功!';
$_LANG['catremove_succed'] = '商品分類轉移成功!';
$_LANG['move_cat_success'] = '轉移商品分類已成功完成!';

$_LANG['cat_move_desc'] = '什麼是轉移商品分類?';
$_LANG['select_source_cat'] = '選擇要轉移的分類';
$_LANG['select_target_cat'] = '選擇目標分類';
$_LANG['source_cat'] = '從此分類';
$_LANG['target_cat'] = '轉移到';
$_LANG['start_move_cat'] = '開始轉移';
$_LANG['cat_move_notic'] = '在新增商品或者在商品管理中,如果需要對商品的分類進行變更,那麼你可以通過此功能,正確管理你的商品分類。';

$_LANG['cat_move_empty'] = '你沒有正確選擇商品分類!';

$_LANG['sel_goods_type'] = '請選擇商品類型';
$_LANG['sel_filter_attr'] = '請選擇篩選屬性';
$_LANG['filter_attr'] = '篩選屬性';
$_LANG['filter_attr_notic'] = '篩選屬性可在前分類頁面篩選商品';


/*JS 語言項*/
$_LANG['js_languages']['catname_empty'] = '分類名稱不能為空!';
$_LANG['js_languages']['unit_empyt'] = '數量單位不能為空!';
$_LANG['js_languages']['is_leafcat'] = '您選取的分類是一個底層分類。\r\n新分類的上層分類不能是一個底層分類';
$_LANG['js_languages']['not_leafcat'] = '您選取的分類不是一個底層分類。\r\n商品的分類轉移只能在底層分類之間才可以操作。';



?>