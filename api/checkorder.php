<?php

/**
 * ECSHOP 检查订单 API
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 19:27:47 +0800 (星期一, 28 一月 2008) $
 * $Id: checkorder.php 14080 2008-01-28 11:27:47Z testyang $
*/

define('IN_ECS', true);

require('./init.php');
require_once(ROOT_PATH . 'includes/lib_order.php');
require_once('../includes/cls_json.php');

$json = new JSON;

$res = array('error' => 0, 'new_orders' => 0, 'new_paid' => 0);

/* 检查密码是否正确 */
$sql = "SELECT COUNT(*) ".
        " FROM " . $ecs->table('admin_user') .
        " WHERE user_name = '" . trim($_REQUEST['username']). "' AND password = '" . md5(trim($_REQUEST['password'])) . "'";

if ($db->getOne($sql))
{
    /* 新订单 */
    $sql = 'SELECT COUNT(*) FROM ' . $ecs->table('order_info').
            " WHERE order_status = " . OS_UNCONFIRMED;
    $res['new_orders'] = $db->getOne($sql);

    /* 待发货的订单： */
    $sql   = 'SELECT COUNT(*)'.
                ' FROM ' .$ecs->table('order_info') .
                " WHERE 1 ". order_query_sql('await_ship');
    $res['new_paid']  = $db->getOne($sql);
}
else
{
    $res['error'] = 1;
}

$val = $json->encode($res);

die($val);

?>