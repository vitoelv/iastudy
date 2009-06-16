<?php

/**
 * ECSHOP 缺货处理管理程序
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-02-01 23:40:15 +0800 (星期五, 01 二月 2008) $
 * $Id: goods_booking.php 14122 2008-02-01 15:40:15Z testyang $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

/*------------------------------------------------------ */
//-- 列出所有订购信息
/*------------------------------------------------------ */
if ($_REQUEST['act']=='list_all')
{
    $smarty->assign('ur_here',      $_LANG['list_all']);
    $smarty->assign('full_page',    1);

    $list = get_bookinglist();

    $smarty->assign('booking_list', $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('booking_list.htm');
}

/*------------------------------------------------------ */
//-- 翻页、排序
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'query')
{
    $list = get_bookinglist();

    $smarty->assign('booking_list', $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('booking_list.htm'), '',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}

/*------------------------------------------------------ */
//-- 删除缺货登记
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'remove')
{
    check_authz_json('booking');

    $id = intval($_GET['id']);

    $db->query("DELETE FROM " .$ecs->table('booking_goods'). " WHERE rec_id='$id'");

    $url = 'goods_booking.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

/*------------------------------------------------------ */
//-- 显示详情
/*------------------------------------------------------ */
if ($_REQUEST['act']=='detail')
{
    $id = intval($_REQUEST['id']);

    $smarty->assign('booking',      get_booking_info($id));
    $smarty->assign('ur_here',      $_LANG['detail']);
    $smarty->assign('action_link',  array('text' => $_LANG['06_undispose_booking'], 'href'=>'goods_booking.php?act=list_all'));
    $smarty->display('booking_info.htm');
}

/*------------------------------------------------------ */
//-- 处理提交数据
/*------------------------------------------------------ */
if ($_REQUEST['act'] =='update')
{
    /* 权限判断 */
    admin_priv('booking');

    $dispose_note = !empty($_POST['dispose_note']) ? trim($_POST['dispose_note']) : '';

    $sql = "UPDATE  ".$ecs->table('booking_goods').
            " SET is_dispose='1', dispose_note='$dispose_note', ".
                    "dispose_time='" .gmtime(). "', dispose_user='".$_SESSION['admin_name']."'".
            " WHERE rec_id='$_REQUEST[rec_id]'";
    $db->query($sql);

    ecs_header("Location: ?act=detail&id=".$_REQUEST['rec_id']."\n");
    exit;
}

/**
 * 获取订购信息
 *
 * @access  public
 *
 * @return array
 */
function get_bookinglist()
{
    /* 查询条件 */
    $filter['keywords']   = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
    $filter['dispose']    = empty($_REQUEST['dispose']) ? 0 : intval($_REQUEST['dispose']);
    $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'sort_order' : trim($_REQUEST['sort_by']);
    $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

    $where = (!empty($_REQUEST['keywords'])) ? " AND g.goods_name LIKE '%" . mysql_like_quote($filter['keywords']) . "%' " : '';
    $where .= (!empty($_REQUEST['dispose'])) ? " AND bg.is_dispose = '$filter[dispose]' " : '';

    $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['ecs']->table('booking_goods'). ' AS bg, '.
            $GLOBALS['ecs']->table('goods'). ' AS g '.
            "WHERE bg.goods_id = g.goods_id $where";
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);

    /* 分页大小 */
    $filter = page_and_size($filter);

    /* 获取活动数据 */
    $sql = 'SELECT bg.rec_id, bg.link_man, g.goods_id, g.goods_name, bg.goods_number, bg.booking_time, bg.is_dispose '.
            'FROM ' .$GLOBALS['ecs']->table('booking_goods'). ' AS bg, ' .$GLOBALS['ecs']->table('goods'). ' AS g '.
            "WHERE bg.goods_id = g.goods_id $where " .
            "ORDER BY $filter[sort_by] $filter[sort_order] ".
            "LIMIT ". $filter['start'] .", $filter[page_size]";
    $row = $GLOBALS['db']->getAll($sql);

    foreach ($row AS $key => $val)
    {
        $row[$key]['booking_time'] = local_date($GLOBALS['_CFG']['time_format'], $val['booking_time']);
    }
    $filter['keywords'] = stripslashes($filter['keywords']);
    $arr = array('item' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

/**
 * 获得缺货登记的详细信息
 *
 * @param   integer     $id
 *
 * @return  array
 */
function get_booking_info($id)
{
    global $ecs, $db, $_CFG, $_LANG;

    $sql ="SELECT bg.rec_id, bg.user_id, IFNULL(u.user_name, '$_LANG[guest_user]') AS user_name, ".
                "bg.link_man, g.goods_name, bg.goods_id, bg.goods_number, ".
                "bg.booking_time, bg.goods_desc,bg.dispose_user, bg.dispose_time, bg.email, ".
                "bg.tel, bg.dispose_note ,bg.dispose_user, bg.dispose_time,bg.is_dispose  ".
            "FROM " . $ecs->table('booking_goods')." AS bg ".
            "LEFT JOIN " . $ecs->table('goods') . " AS g ON g.goods_id=bg.goods_id ".
            "LEFT JOIN " . $ecs->table('users') . " AS u ON u.user_id=bg.user_id ".
            "WHERE bg.rec_id ='$id'";

    $res = $db->GetRow($sql);

    /* 格式化时间 */
    $res['booking_time'] = local_date($_CFG['time_format'],$res['booking_time']);
    if (!empty($res['dispose_time']))
    {
        $res['dispose_time'] = local_date($_CFG['time_format'],$res['dispose_time']);
    }

    return $res;
}

?>