<?php

/**
 * ECSHOP WAP首页
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: goods_list.php 14079 2008-01-28 10:33:06Z testyang $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

$type = !empty($_GET['type']) ? $_GET['type'] : 'best';
if ($type != 'best' && $type != 'promote' && $type != 'hot' && $type != 'new')
{
    $type = 'best';
}
$smarty->assign('type', $type);

$goods = get_recommend_goods($type);
$num = count($goods);
if ($num > 0)
{
    foreach ($goods as $key => $data)
    {
        $sort_array[$data['id']] = $key;
    }
    krsort($sort_array);
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
    foreach ($sort_array as $goods_key)
    {
        if (($i > ($page_num * ($page - 1 ))) && ($i <= ($page_num * $page)))
        {
            $price = empty($goods[$goods_key]['promote_price_org']) ? $goods[$goods_key]['shop_price'] : $goods[$goods_key]['promote_price'];
            //$wml_data .= "<a href='goods.php?id={}'>".encode_output($goods[$goods_key]['name'])."</a>[".encode_output($price)."]<br/>";
            $goods_data[] = array('i' => $i , 'price' => encode_output($price) , 'id' => $goods[$goods_key]['id'] , 'name' => encode_output($goods[$goods_key]['name']));
        }
        $i++;
    }
    $smarty->assign('goods_data', $goods_data);
    $pagebar = get_wap_pager($num, $page_num, $page, 'goods_list.php?type='.$type, 'page');
    $smarty->assign('pagebar' , $pagebar);
}

$smarty->assign('footer', get_footer());
$smarty->display('goods_list.wml');

?>