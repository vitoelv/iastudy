<?php

/**
 * ECSHOP 商品分类页
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: category.php 14079 2008-01-28 10:33:06Z testyang $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

$c_id = !empty($_GET['c_id']) ? intval($_GET['c_id']) : 0;
if ($c_id <= 0)
{
    exit();
}
$cat_array = get_categories_tree($c_id);
$smarty->assign('c_id', $c_id);
$cat_name = $db->getOne('SELECT cat_name FROM ' . $ecs->table('category') . ' WHERE cat_id=' . $c_id);
$smarty->assign('cat_name', $cat_name);
if (!empty($cat_array[$c_id]['children']))
{
    foreach ($cat_array[$c_id]['children'] as $key => $child_data)
    {
        $cat_array[$c_id]['children'][$key]['name'] = encode_output($child_data['name']);
    }
    $smarty->assign('cat_children', $cat_array[$c_id]['children']);
}
$cat_goods = assign_cat_goods($c_id, 0, 'wap');
$num = count($cat_goods['goods']);
if ($num > 0)
{
    $page_num = '10';
    $page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
    $pages = ceil($num / $page_num);
    if ($page <= 0)
    {
        $page = 1;
    }
    if ($pages == 0)
    {
        $pages = 1;
    }
    if ($page > $pages)
    {
        $page = $pages;
    }
    $i = 1;
    foreach ($cat_goods['goods'] as $goods_data)
    {
        if (($i > ($page_num * ($page - 1 ))) && ($i <= ($page_num * $page)))
        {
            $price = empty($goods_info['promote_price_org']) ? $goods_data['shop_price'] : $goods_data['promote_price'];
            //$wml_data .= "<a href='goods.php?id={$goods_data['id']}'>".encode_output($goods_data['name'])."</a>[".encode_output($price)."]<br/>";
            $data[] = array('i' => $i , 'price' => encode_output($price) , 'id' => $goods_data['id'] , 'name' => encode_output($goods_data['name']));
        }
        $i++;
    }
    $smarty->assign('goods_data', $data);
    $pagebar = get_wap_pager($num, $page_num, $page, 'category.php?c_id='.$c_id, 'page');
    $smarty->assign('pagebar', $pagebar);
}

$pcat_array = get_parent_cats($c_id);
if (!empty($pcat_array[1]['cat_name']))
{
    $smarty->assign('pcat_array', $pcat_array[1]);
}

$smarty->assign('footer', get_footer());
$smarty->display('category.wml');

?>