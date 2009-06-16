<?php

/**
 * ECSHOP 配送方式管理程序
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: shipping.php 14079 2008-01-28 10:33:06Z testyang $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$exc = new exchange($ecs->table('shipping'), $db, 'shipping_code', 'shipping_name');

/*------------------------------------------------------ */
//-- 配送方式列表
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'list')
{
    $modules = read_modules('../includes/modules/shipping');

    for ($i = 0; $i < count($modules); $i++)
    {
        $lang_file = ROOT_PATH.'languages/' .$_CFG['lang']. '/shipping/' .$modules[$i]['code']. '.php';

        if (file_exists($lang_file))
        {
            include_once($lang_file);
        }

        /* 检查该插件是否已经安装 */
        $sql = "SELECT shipping_id, shipping_name, shipping_desc, insure, support_cod FROM " .$ecs->table('shipping'). " WHERE shipping_code='" .$modules[$i]['code']. "'";
        $row = $db->GetRow($sql);

        if ($row)
        {
            /* 插件已经安装了，获得名称以及描述 */
            $modules[$i]['id']      = $row['shipping_id'];
            $modules[$i]['name']    = $row['shipping_name'];
            $modules[$i]['desc']    = $row['shipping_desc'];
            $modules[$i]['insure_fee']  = $row['insure'];
            $modules[$i]['cod']     = $row['support_cod'];
            $modules[$i]['install'] = 1;

            if (isset($modules[$i]['insure']) && ($modules[$i]['insure'] === false))
            {
                $modules[$i]['is_insure']  = 0;
            }
            else
            {
                $modules[$i]['is_insure']  = 1;
            }
        }
        else
        {
            $modules[$i]['name']    = $_LANG[$modules[$i]['code']];
            $modules[$i]['desc']    = $_LANG[$modules[$i]['desc']];
            $modules[$i]['insure_fee']  = empty($modules[$i]['insure'])? 0 : $modules[$i]['insure'];
            $modules[$i]['cod']     = $modules[$i]['cod'];
            $modules[$i]['install'] = 0;
        }
    }

    $smarty->assign('ur_here', $_LANG['03_shipping_list']);
    $smarty->assign('modules', $modules);
    assign_query_info();
    $smarty->display('shipping_list.htm');
}

/*------------------------------------------------------ */
//-- 安装配送方式
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'install')
{
    admin_priv('ship_manage');

    $set_modules = true;
    include_once(ROOT_PATH . 'includes/modules/shipping/' . $_GET['code'] . '.php');

    /* 检查该配送方式是否已经安装 */
    $sql = "SELECT shipping_id FROM " .$ecs->table('shipping'). " WHERE shipping_code = '$_GET[code]'";
    $id = $db->GetOne($sql);

    if ($id > 0)
    {
        /*
         该配送方式已经安装过, 将该配送方式的状态设置为 enable
         */
        $db->query("UPDATE " .$ecs->table('shipping'). " SET enabled = 1 WHERE shipping_code = '$_GET[code]' LIMIT 1");
    }
    else
    {
        /*
         该配送方式没有安装过, 将该配送方式的信息添加到数据库
         */
        $insure = empty($modules[0]['insure']) ? 0 : $modules[0]['insure'];
        $sql = "INSERT INTO " . $ecs->table('shipping') . " (" .
                    "shipping_code, shipping_name, shipping_desc, insure, support_cod, enabled" .
                ") VALUES (" .
                    "'" . addslashes($modules[0]['code']). "', '" . addslashes($_LANG[$modules[0]['code']]) . "', '" .
                    addslashes($_LANG[$modules[0]['desc']]) . "', '$insure', '" . intval($modules[0]['cod']) . "', 1)";
        $db->query($sql);
        $id = $db->insert_Id();
    }

    /* 记录管理员操作 */
    admin_log(addslashes($_LANG[$modules[0]['code']]), 'install', 'shipping');

    /* 提示信息 */
    $lnk[] = array('text' => $_LANG['add_shipping_area'], 'href' => 'shipping_area.php?act=add&shipping=' . $id);
    $lnk[] = array('text' => $_LANG['go_back'], 'href' => 'shipping.php?act=list');
    sys_msg(sprintf($_LANG['install_succeess'], $_LANG[$modules[0]['code']]), 0, $lnk);
}

/*------------------------------------------------------ */
//-- 卸载配送方式
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'uninstall')
{
    global $ecs, $_LANG;

    admin_priv('ship_manage');

    /* 获得该配送方式的ID */
    $row = $db->GetRow("SELECT shipping_id, shipping_name FROM " .$ecs->table('shipping'). " WHERE shipping_code='$_GET[code]'");
    $shipping_id = $row['shipping_id'];
    $shipping_name = $row['shipping_name'];

    /* 删除 shipping_fee 以及 shipping 表中的数据 */
    if ($row)
    {
        $all = $db->getCol("SELECT shipping_area_id FROM " .$ecs->table('shipping_area'). " WHERE shipping_id='$shipping_id'");
        $in  = db_create_in(join(',', $all));

        $db->query("DELETE FROM " .$ecs->table('area_region'). " WHERE shipping_area_id $in");
        $db->query("DELETE FROM " .$ecs->table('shipping_area'). " WHERE shipping_id='$shipping_id'");
        $db->query("DELETE FROM " .$ecs->table('shipping'). " WHERE shipping_id='$shipping_id'");

        /* 记录管理员操作 */
        admin_log(addslashes($shipping_name), 'uninstall', 'shipping');

        $lnk[] = array('text' => $_LANG['go_back'], 'href'=>'shipping.php?act=list');
        sys_msg(sprintf($_LANG['uninstall_success'], $shipping_name), 0, $lnk);
    }
}

/*------------------------------------------------------ */
//-- 编辑配送方式名称
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'edit_name')
{
    /* 检查权限 */
    check_authz_json('ship_manage');

    /* 取得参数 */
    $id  = trim($_POST['id']);
    $val = trim($_POST['val']);

    /* 检查名称是否为空 */
    if (empty($val))
    {
        make_json_error($_LANG['no_shipping_name']);
    }

    /* 检查名称是否重复 */
    if (!$exc->is_only('shipping_name', $val, $id))
    {
        make_json_error($_LANG['repeat_shipping_name']);
    }

    /* 更新支付方式名称 */
    $exc->edit("shipping_name = '$val'", $id);
    make_json_result(stripcslashes($val));
}

/*------------------------------------------------------ */
//-- 编辑配送方式描述
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'edit_desc')
{
    /* 检查权限 */
    check_authz_json('ship_manage');

    /* 取得参数 */
    $id = trim($_POST['id']);
    $val = trim($_POST['val']);

    /* 更新描述 */
    $exc->edit("shipping_desc = '$val'", $id);
    make_json_result(stripcslashes($val));
}

/*------------------------------------------------------ */
//-- 修改配送方式保价费
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'edit_insure')
{
    /* 检查权限 */
    check_authz_json('ship_manage');

    /* 取得参数 */
    $id = trim($_POST['id']);
    $val = trim($_POST['val']);
    if (empty($val))
    {
        $val = 0;
    }
    else
    {
        $val = make_semiangle($val); //全角转半角
        if (strpos($val, '%') === false)
        {
            $val = floatval($val);
        }
        else
        {
            $val = floatval($val) . '%';
        }
    }

    /* 检查该插件是否支持保价 */
    $set_modules = true;
    include_once(ROOT_PATH . 'includes/modules/shipping/' .$id. '.php');
    if (isset($modules[0]['insure']) && $modules[0]['insure'] === false)
    {
        make_json_error($_LANG['not_support_insure']);
    }

    /* 更新保价费用 */
    $exc->edit("insure = '$val'", $id);
    make_json_result(stripcslashes($val));
}
elseif($_REQUEST['act'] == 'shipping_priv')
{
    check_authz_json('ship_manage');

    make_json_result('');
}

?>