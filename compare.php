<?php

/**
 * ECSHOP 商品比较程序
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: compare.php 14079 2008-01-28 10:33:06Z testyang $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

if (!empty($_REQUEST['goods']) && is_array($_REQUEST['goods']) && count($_REQUEST['goods']) > 1)
{
    $where = db_create_in($_REQUEST['goods'], 'id_value');
    $sql = "SELECT id_value , AVG(comment_rank) AS cmt_rank, COUNT(*) AS cmt_count" .
           " FROM " .$ecs->table('comment') .
           " WHERE $where AND comment_type = 0".
           ' GROUP BY id_value ';
    $query = $db->query($sql);
    $cmt = array();
    while ($row = $db->fetch_array($query))
    {
        $cmt[$row['id_value']] = $row;
    }

    $where = db_create_in($_REQUEST['goods'], 'g.goods_id');
    $sql = "SELECT g.goods_id, g.goods_type, g.goods_name, g.shop_price, g.goods_weight, g.goods_thumb, g.goods_brief, ".
                "a.attr_name, v.attr_value, a.attr_id, b.brand_name ".
            "FROM " .$ecs->table('goods'). " AS g ".
            "LEFT JOIN " . $ecs->table('goods_attr'). " AS v ON v.goods_id = g.goods_id ".
            "LEFT JOIN " . $ecs->table('attribute') . " AS a ON a.attr_id = v.attr_id " .
            "LEFT JOIN " . $ecs->table('brand') . " AS b ON g.brand_id = b.brand_id " .
            "WHERE g.is_delete = 0 AND $where ".
            "ORDER BY a.attr_id";
    $res = $db->query($sql);
    $arr = array();
    $ids = $_REQUEST['goods'];
    $attr_name = array();
    $type_id = 0;
    while ($row = $db->fetchRow($res))
    {
        $goods_id = $row['goods_id'];
        $type_id = $row['goods_type'];
        $arr[$goods_id]['goods_id']     = $goods_id;
        $arr[$goods_id]['url']          = build_uri('goods', array('gid' => $goods_id), $row['goods_name']);
        $arr[$goods_id]['goods_name']   = $row['goods_name'];
        $arr[$goods_id]['shop_price']   = $row['shop_price'];
        $arr[$goods_id]['goods_weight'] = (intval($row['goods_weight']) > 0) ?
                                           ceil($row['goods_weight']) . $_LANG['kilogram'] : ceil($row['goods_weight'] * 1000) . $_LANG['gram'];
        $arr[$goods_id]['goods_thumb']  = empty($row['goods_thumb']) ? $GLOBALS['_CFG']['no_picture'] : $row['goods_thumb'];
        $arr[$goods_id]['goods_brief']  = $row['goods_brief'];
        $arr[$goods_id]['brand_name']   = $row['brand_name'];

        $arr[$goods_id]['properties'][$row['attr_id']]['name']  = $row['attr_name'];
        $arr[$goods_id]['properties'][$row['attr_id']]['value'] = $row['attr_value'];

        if (!isset($arr[$goods_id]['comment_rank']))
        {
            $arr[$goods_id]['comment_rank']   = isset($cmt[$goods_id]) ? ceil($cmt[$goods_id]['cmt_rank']) : 0;
            $arr[$goods_id]['comment_number'] = isset($cmt[$goods_id]) ? $cmt[$goods_id]['cmt_count']      : 0;
            $arr[$goods_id]['comment_number'] = sprintf($_LANG['comment_num'], $arr[$goods_id]['comment_number']);
        }

        $tmp = $ids;
        $key = array_search($goods_id, $tmp);

        if ($key !== null && $key !== false)
        {
            unset($tmp[$key]);
        }

        $arr[$goods_id]['ids'] = !empty($tmp) ? "goods[]=" . implode('&amp;goods[]=', $tmp) : '';
    }

    $sql = "SELECT attr_id,attr_name FROM " . $ecs->table('attribute') . " WHERE cat_id='$type_id' ORDER BY attr_id";

    $attribute = array();

    $query = $db->query($sql);
    while ($rt = $db->fetch_array($query))
    {
        $attribute[$rt['attr_id']] = $rt['attr_name'];
    }

    $smarty->assign('attribute', $attribute);
    $smarty->assign('goods_list', $arr);
}
else
{
    show_message($_LANG['compare_no_goods']);
    exit;
}

assign_template();
$position = assign_ur_here(0, $_LANG['goods_compare']);
$smarty->assign('page_title', $position['title']);    // 页面标题
$smarty->assign('ur_here',    $position['ur_here']);  // 当前位置

$smarty->assign('categories', get_categories_tree()); // 分类树
$smarty->assign('helps',      get_shop_help());       // 网店帮助

assign_dynamic('compare');

$smarty->display('compare.dwt');

?>