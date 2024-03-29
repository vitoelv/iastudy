<?php

/**
 * ECSHOP 地区列表管理文件
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: area_manage.php 14079 2008-01-28 10:33:06Z testyang $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$exc = new exchange($ecs->table('region'), $db, 'region_id', 'region_name');

/* act操作项的初始化 */
if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'list';
}
else
{
    $_REQUEST['act'] = trim($_REQUEST['act']);
}

/*------------------------------------------------------ */
//-- 列出某地区下的所有地区列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    admin_priv('area_manage');

    /* 取得参数：上级地区id */
    $region_id = empty($_REQUEST['pid']) ? 0 : intval($_REQUEST['pid']);
    $smarty->assign('parent_id',    $region_id);

    /* 取得列表显示的地区的类型 */
    if ($region_id == 0)
    {
        $region_type = 0;
    }
    else
    {
        $region_type = $exc->get_name($region_id, 'region_type') + 1;
    }
    $smarty->assign('region_type',  $region_type);

    /* 获取地区列表 */
    $region_arr = area_list($region_id);
    $smarty->assign('region_arr',   $region_arr);

    /* 当前的地区名称 */
    if ($region_id > 0)
    {
        $area_name = $exc->get_name($region_id);
        $area = '[ '. $area_name . ' ] ';
        if ($region_arr)
        {
            $area .= $region_arr[0]['type'];
        }
    }
    else
    {
        $area = $_LANG['country'];
    }
    $smarty->assign('area_here',    $area);

    /* 返回上一级的链接 */
    if ($region_id > 0)
    {
        $parent_id = $exc->get_name($region_id, 'parent_id');
        $action_link = array('text' => $_LANG['back_page'], 'href' => 'area_manage.php?act=list&&pid=' . $parent_id);
    }
    else
    {
        $action_link = '';
    }
    $smarty->assign('action_link',  $action_link);

    /* 赋值模板显示 */
    $smarty->assign('ur_here',      $_LANG['05_area_list']);
    $smarty->assign('full_page',    1);

    assign_query_info();
    $smarty->display('area_list.htm');
}

/*------------------------------------------------------ */
//-- 添加新的地区
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'add_area')
{
    check_authz_json('area_manage');

    $parent_id      = intval($_POST['parent_id']);
    $region_name    = trim($_POST['region_name']);
    $region_type    = intval($_POST['region_type']);

    if (empty($region_name))
    {
        make_json_error($_LANG['region_name_empty']);
    }

    /* 查看区域是否重复 */
    if (!$exc->is_only('region_name', $region_name, 0, "parent_id = '$parent_id'"))
    {
        make_json_error($_LANG['region_name_exist']);
    }

    $sql = "INSERT INTO " . $ecs->table('region') . " (parent_id, region_name, region_type) ".
           "VALUES ('$parent_id', '$region_name', '$region_type')";
    if ($GLOBALS['db']->query($sql, 'SILENT'))
    {
        admin_log($region_name, 'add','area');

        /* 获取地区列表 */
        $region_arr = area_list($parent_id);
        $smarty->assign('region_arr',   $region_arr);

        $smarty->assign('region_type', $region_type);

        make_json_result($smarty->fetch('area_list.htm'));
    }
    else
    {
        make_json_error($_LANG['add_area_error']);
    }
}

/*------------------------------------------------------ */
//-- 编辑区域名称
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'edit_area_name')
{
    check_authz_json('area_manage');

    $id = intval($_POST['id']);
    $region_name = trim($_POST['val']);

    if (empty($region_name))
    {
        make_json_error($_LANG['region_name_empty']);
    }

    $msg = '';

    /* 查看区域是否重复 */
    $parent_id = $exc->get_name($id, 'parent_id');
    if (!$exc->is_only('region_name', $region_name, $id, "parent_id = '$parent_id'"))
    {
        make_json_error($_LANG['region_name_exist']);
    }

    if ($exc->edit("region_name = '$region_name'", $id))
    {
        admin_log($region_name, 'edit', 'area');
        make_json_result(stripslashes($region_name));
    }
    else
    {
        make_json_error($db->error());
    }
}

/*------------------------------------------------------ */
//-- 删除区域
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'drop_area')
{
    check_authz_json('area_manage');

    $id = intval($_REQUEST['id']);

    $sql = "SELECT * FROM " . $ecs->table('region') . " WHERE region_id = '$id'";
    $region = $db->getRow($sql);

    /* 如果底下有下级区域,不能删除 */
    $sql = "SELECT COUNT(*) FROM " . $ecs->table('region') . " WHERE parent_id = '$id'";
    if ($db->getOne($sql) > 0)
    {
        make_json_error($_LANG['parent_id_exist']);
    }

    if ($exc->drop($id))
    {
        admin_log(addslashes($region['region_name']), 'remove', 'area');

        /* 获取地区列表 */
        $region_arr = area_list($region['parent_id']);
        $smarty->assign('region_arr',   $region_arr);
        $smarty->assign('region_type', $region['region_type']);

        make_json_result($smarty->fetch('area_list.htm'));
    }
    else
    {
        make_json_error($db->error());
    }
}

?>