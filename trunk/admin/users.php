<?php

/**
 * ECSHOP 会员管理程序
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: users.php 14079 2008-01-28 10:33:06Z testyang $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

/*------------------------------------------------------ */
//-- 用户帐号列表
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'list')
{
    $sql = "SELECT rank_id, rank_name, min_points FROM ".$ecs->table('user_rank')." ORDER BY min_points ASC ";
    $rs = $db->query($sql);

    $ranks = array();
    while ($row = $db->FetchRow($rs))
    {
        $ranks[$row['rank_id']] = $row['rank_name'];
    }

    $smarty->assign('user_ranks',   $ranks);
    $smarty->assign('ur_here',      $_LANG['03_users_list']);
    $smarty->assign('action_link',  array('text' => $_LANG['04_users_add'], 'href'=>'users.php?act=add'));

    $user_list = user_list();

    $smarty->assign('user_list',    $user_list['user_list']);
    $smarty->assign('filter',       $user_list['filter']);
    $smarty->assign('record_count', $user_list['record_count']);
    $smarty->assign('page_count',   $user_list['page_count']);
    $smarty->assign('full_page',    1);
    $smarty->assign('sort_user_id', '<img src="images/sort_desc.gif">');

    assign_query_info();
    $smarty->display('users_list.htm');
}

/*------------------------------------------------------ */
//-- ajax返回用户列表
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $user_list = user_list();

    $smarty->assign('user_list',    $user_list['user_list']);
    $smarty->assign('filter',       $user_list['filter']);
    $smarty->assign('record_count', $user_list['record_count']);
    $smarty->assign('page_count',   $user_list['page_count']);

    $sort_flag  = sort_flag($user_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('users_list.htm'), '', array('filter' => $user_list['filter'], 'page_count' => $user_list['page_count']));
}

/*------------------------------------------------------ */
//-- 添加会员帐号
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{
    /* 检查权限 */
    admin_priv('users_manage');

    $user = array(  'rank_points'   => $_CFG['register_points'],
                    'pay_points'    => $_CFG['register_points'],
                    'sex'           => 0,
                    'credit_line'   => 0
                    );

    $smarty->assign('ur_here',          $_LANG['04_users_add']);
    $smarty->assign('action_link',      array('text' => $_LANG['03_users_list'], 'href'=>'users.php?act=list'));
    $smarty->assign('form_action',      'insert');
    $smarty->assign('user',             $user);
    $smarty->assign('special_ranks',    get_rank_list(true));

    assign_query_info();
    $smarty->display('user_info.htm');
}

/*------------------------------------------------------ */
//-- 添加会员帐号
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'insert')
{
    /* 检查权限 */
    admin_priv('users_manage');
    $username = empty($_POST['username']) ? '' : trim($_POST['username']);
    $password = empty($_POST['password']) ? '' : trim($_POST['password']);
    $email = empty($_POST['email']) ? '' : trim($_POST['email']);
    $sex = empty($_POST['sex']) ? 0 : intval($_POST['sex']);
    $sex = in_array($sex, array(0, 1, 2)) ? $sex : 0;
    $birthday = $_POST['birthdayYear'] . '-' .  $_POST['birthdayMonth'] . '-' . $_POST['birthdayDay'];
    $rank = empty($_POST['user_rank']) ? 0 : intval($_POST['user_rank']);
    $credit_line = empty($_POST['credit_line']) ? 0 : floatval($_POST['credit_line']);

    $users =& init_users();

    if (!$users->add_user($username, $password, $email, $sex, $birthday, gmtime()))
    {
        /* 插入会员数据失败 */
        if ($users->error == ERR_USERNAME_EXISTS)
        {
            $msg = $_LANG['username_exists'];
        }
        elseif ($users->error == ERR_EMAIL_EXISTS)
        {
            $msg = $_LANG['email_exists'];
        }
        else
        {
            die('Error:'.$users->error_msg());
        }
        sys_msg($msg, 1);
    }

    /* 注册送积分 */
    if (!empty($GLOBALS['_CFG']['register_points']))
    {
        log_account_change($_SESSION['user_id'], 0, 0, $GLOBALS['_CFG']['register_points'], $GLOBALS['_CFG']['register_points'], $_LANG['register_points']);
    }

    /* 更新会员的其它信息 */
    $other =  array();
    $other['credit_line'] = $credit_line;
    $other['user_rank'] = $rank;
    foreach ($_POST['other'] as $key=>$val)
    {
        if (!empty($val))
        {
            $other[$key] = htmlspecialchars(trim($val));
        }
    }
    $db->autoExecute($ecs->table('users'), $other, 'UPDATE', "user_name = '$username'");
    
    /* 记录管理员操作 */
    admin_log($_POST['username'], 'add', 'users');

    /* 提示信息 */
    $link[] = array('text' => $_LANG['go_back'], 'href'=>'users.php?act=list');
    sys_msg(sprintf($_LANG['add_success'], htmlspecialchars(stripslashes($_POST['username']))), 0, $link);

}

/*------------------------------------------------------ */
//-- 编辑用户帐号
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'edit')
{
    /* 检查权限 */
    admin_priv('users_manage');

    $sql = "SELECT u.user_name, u.sex, u.birthday, u.pay_points, u.rank_points, u.user_rank , u.user_money, u.frozen_money, u.credit_line, u.parent_id, u2.user_name as parent_username, u.qq, u.msn, u.office_phone, u.home_phone, u.mobile_phone ".
        " FROM " .$ecs->table('users'). " u LEFT JOIN " . $ecs->table('users') . " u2 ON u.parent_id = u2.user_id WHERE u.user_id='$_GET[id]'";

    $row = $db->GetRow($sql);

    $users  =& init_users();
    $user   = $users->get_user_info($row['user_name']);

    $sql = "SELECT u.user_id, u.sex, u.birthday, u.pay_points, u.rank_points, u.user_rank , u.user_money, u.frozen_money, u.credit_line, u.parent_id, u2.user_name as parent_username, u.qq, u.msn, u.office_phone, u.home_phone, u.mobile_phone ".
        " FROM " .$ecs->table('users'). " u LEFT JOIN " . $ecs->table('users') . " u2 ON u.parent_id = u2.user_id WHERE u.user_id='$_GET[id]'";

    $row = $db->GetRow($sql);

    if ($row)
    {
        $user['user_id']        = $row['user_id'];
        $user['sex']            = $row['sex'];
        $user['birthday']       = date($row['birthday']);
        $user['pay_points']     = $row['pay_points'];
        $user['rank_points']    = $row['rank_points'];
        $user['user_rank']      = $row['user_rank'];
        $user['user_money']     = $row['user_money'];
        $user['frozen_money']   = $row['frozen_money'];
        $user['credit_line']    = $row['credit_line'];
        $user['formated_user_money'] = price_format($row['user_money']);
        $user['formated_frozen_money'] = price_format($row['frozen_money']);
        $user['parent_id']      = $row['parent_id'];
        $user['parent_username']= $row['parent_username'];
        $user['qq']             = $row['qq'];
        $user['msn']            = $row['msn'];
        $user['office_phone']   = $row['office_phone'];
        $user['home_phone']     = $row['home_phone'];
        $user['mobile_phone']   = $row['mobile_phone'];
    }
    else
    {
        $user['sex']            = 0;
        $user['pay_points']     = 0;
        $user['rank_points']    = 0;
        $user['user_money']     = 0;
        $user['frozen_money']   = 0;
        $user['credit_line']    = 0;
        $user['formated_user_money'] = price_format(0);
        $user['formated_frozen_money'] = price_format(0);
     }

    assign_query_info();
    $smarty->assign('ur_here',          $_LANG['users_edit']);
    $smarty->assign('action_link',      array('text' => $_LANG['03_users_list'], 'href'=>'users.php?act=list&' . list_link_postfix()));
    $smarty->assign('user',             $user);
    $smarty->assign('form_action',      'update');
    $smarty->assign('special_ranks',    get_rank_list(true));
    $smarty->display('user_info.htm');
}

/*------------------------------------------------------ */
//-- 更新用户帐号
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'update')
{
    /* 检查权限 */
    admin_priv('users_manage');
    $username = empty($_POST['username']) ? '' : trim($_POST['username']);
    //$password = empty($_POST['password']) ? '' : trim($_POST['password']);
    $email = empty($_POST['email']) ? '' : trim($_POST['email']);
    $sex = empty($_POST['sex']) ? 0 : intval($_POST['sex']);
    $sex = in_array($sex, array(0, 1, 2)) ? $sex : 0;
    $birthday = $_POST['birthdayYear'] . '-' .  $_POST['birthdayMonth'] . '-' . $_POST['birthdayDay'];
    $rank = empty($_POST['user_rank']) ? 0 : intval($_POST['user_rank']);
    $credit_line = empty($_POST['credit_line']) ? 0 : floatval($_POST['credit_line']);

    $users  =& init_users();

    if (!$users->edit_user(array('username'=>$username, 'email'=>$email, 'gender'=>$sex, 'bday'=>$birthday )))
    {
        if ($users->error == ERR_EMAIL_EXISTS)
        {
            $msg = $_LANG['email_exists'];
        }
        else
        {
            $msg = $_LANG['edit_user_failed'];
        }
        sys_msg($msg, 1);
    }

    /* 更新会员的其它信息 */
    $other =  array();
    $other['credit_line'] = $credit_line;
    $other['user_rank'] = $rank;
    foreach ($_POST['other'] as $key=>$val)
    {
        if (!empty($val))
        {
            $other[$key] = htmlspecialchars(trim($val));
        }
    }
    $db->autoExecute($ecs->table('users'), $other, 'UPDATE', "user_name = '$username'");

    /* 记录管理员操作 */
    admin_log($username, 'edit', 'users');

    /* 提示信息 */
    $links[0]['text']    = $_LANG['goto_list'];
    $links[0]['href']    = 'users.php?act=list&' . list_link_postfix();
    $links[1]['text']    = $_LANG['go_back'];
    $links[1]['href']    = 'javascript:history.back()';

    sys_msg($_LANG['update_success'], 0, $links);

}

/*------------------------------------------------------ */
//-- 批量删除会员帐号
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'batch_remove')
{
    /* 检查权限 */
    admin_priv('users_drop');

    if (isset($_POST['checkboxes']))
    {
        $sql = "SELECT user_name FROM " . $ecs->table('users') . " WHERE user_id " . db_create_in($_POST['checkboxes']);
        $col = $db->getCol($sql);
        $count = count($col);
        /* 通过插件来删除用户 */
        $users =& init_users();
        $users->remove_user($col);

        admin_log('', 'batch_remove', 'users');

        $lnk[] = array('text' => $_LANG['go_back'], 'href'=>'users.php?act=list');
        sys_msg(sprintf($_LANG['batch_remove_success'], $count), 0, $lnk);
    }
    else
    {
        $lnk[] = array('text' => $_LANG['go_back'], 'href'=>'users.php?act=list');
        sys_msg($_LANG['no_select_user'], 0, $lnk);
    }
}

/* 编辑用户名 */
elseif ($_REQUEST['act'] == 'edit_username')
{
    /* 检查权限 */
    check_authz_json('users_manage');

    $username = empty($_REQUEST['val']) ? '' : trim($_REQUEST['val']);
    $id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);

    if ($id == 0)
    {
        make_json_error('NO USER ID');
        return;
    }

    if ($username == '')
    {
        make_json_error($GLOBALS['_LANG']['username_empty']);
        return;
    }

    $users =& init_users();

    if ($users->edit_user($id, $username))
    {
        if ($_CFG['integrate_code'] != 'ecshop')
        {
            /* 更新商城会员表 */
            $db->query('UPDATE ' .$ecs->table('users'). " SET user_name = '$username' WHERE user_id = '$id'");
        }

        admin_log(addslashes($username), 'edit', 'users');
        make_json_result(stripcslashes($username));
    }
    else
    {
        $msg = ($users->error == ERR_USERNAME_EXISTS) ? $GLOBALS['_LANG']['username_exists'] : $GLOBALS['_LANG']['edit_user_failed'];
        make_json_error($msg);
    }
}

/*------------------------------------------------------ */
//-- 编辑email
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_email')
{
    /* 检查权限 */
    check_authz_json('users_manage');

    $id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);
    $email = empty($_REQUEST['val']) ? '' : trim($_REQUEST['val']);

    $users =& init_users();

    $sql = "SELECT user_name FROM " . $ecs->table('users') . " WHERE user_id = '$id'";
    $username = $db->getOne($sql);


    if (is_email($email))
    {
        if ($users->edit_user(array('username'=>$username, 'email'=>$email)))
        {
            admin_log(addslashes($username), 'edit', 'users');

            make_json_result(stripcslashes($email));
        }
        else
        {
            $msg = ($users->error == ERR_EMAIL_EXISTS) ? $GLOBALS['_LANG']['email_exists'] : $GLOBALS['_LANG']['edit_user_failed'];
            make_json_error($msg);
        }
    }
    else
    {
        make_json_error($GLOBALS['_LANG']['invalid_email']);
    }
}

/*------------------------------------------------------ */
//-- 删除会员帐号
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'remove')
{
    /* 检查权限 */
    admin_priv('users_drop');

    $sql = "SELECT user_name FROM " . $ecs->table('users') . " WHERE user_id = '" . $_GET['id'] . "'";
    $username = $db->getOne($sql);
    /* 通过插件来删除用户 */
    $users =& init_users();
    $users->remove_user($username); //已经删除用户所有数据

    /* 记录管理员操作 */
    admin_log(addslashes($username), 'remove', 'users');

    /* 提示信息 */
    $link[] = array('text' => $_LANG['go_back'], 'href'=>'users.php?act=list');
    sys_msg(sprintf($_LANG['remove_success'], $username), 0, $link);
}

/*------------------------------------------------------ */
//--  收货地址查看
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'address_list')
{
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $sql = "SELECT a.*, c.region_name AS country_name, p.region_name AS province, ct.region_name AS city_name, d.region_name AS district_name ".
           " FROM " .$ecs->table('user_address'). " as a ".
           " LEFT JOIN " . $ecs->table('region') . " AS c ON c.region_id = a.country " .
           " LEFT JOIN " . $ecs->table('region') . " AS p ON p.region_id = a.province " .
           " LEFT JOIN " . $ecs->table('region') . " AS ct ON ct.region_id = a.city " .
           " LEFT JOIN " . $ecs->table('region') . " AS d ON d.region_id = a.district " .
           " WHERE user_id='$id'";
    $address = $db->getAll($sql);
    $smarty->assign('address',          $address);
    assign_query_info();
    $smarty->assign('ur_here',          $_LANG['address_list']);
    $smarty->assign('action_link',      array('text' => $_LANG['03_users_list'], 'href'=>'users.php?act=list&' . list_link_postfix()));
    $smarty->display('user_address_list.htm');
}

/*------------------------------------------------------ */
//-- 脱离推荐关系
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'remove_parent')
{
    /* 检查权限 */
    admin_priv('users_manage');

    $sql = "UPDATE " . $ecs->table('users') . " SET parent_id = 0 WHERE user_id = '" . $_GET['id'] . "'";
    $db->query($sql);

    /* 记录管理员操作 */
    $sql = "SELECT user_name FROM " . $ecs->table('users') . " WHERE user_id = '" . $_GET['id'] . "'";
    $username = $db->getOne($sql);
    admin_log(addslashes($username), 'edit', 'users');

    /* 提示信息 */
    $link[] = array('text' => $_LANG['go_back'], 'href'=>'users.php?act=list');
    sys_msg(sprintf($_LANG['update_success'], $username), 0, $link);
}


/**
 *  返回用户列表数据
 *
 * @access  public
 * @param
 *
 * @return void
 */
function user_list()
{
    $result = get_filter();
    if ($result === false)
    {
        /* 过滤条件 */
        $filter['keywords'] = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
        $filter['rank'] = empty($_REQUEST['rank']) ? 0 : intval($_REQUEST['rank']);
        $filter['pay_points_gt'] = empty($_REQUEST['pay_points_gt']) ? 0 : intval($_REQUEST['pay_points_gt']);
        $filter['pay_points_lt'] = empty($_REQUEST['pay_points_lt']) ? 0 : intval($_REQUEST['pay_points_lt']);

        $filter['sort_by']    = empty($_REQUEST['sort_by'])    ? 'user_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC'     : trim($_REQUEST['sort_order']);

        $ex_where = ' WHERE 1 ';
        if ($filter['keywords'])
        {
            $ex_where .= " AND user_name LIKE '%" . mysql_like_quote($filter['keywords']) ."%'";
        }
        if ($filter['rank'])
        {
            $sql = "SELECT min_points, max_points, special_rank FROM ".$GLOBALS['ecs']->table('user_rank')." WHERE rank_id = '$filter[rank]'";
            $row = $GLOBALS['db']->getRow($sql);
            if ($row['special_rank'] > 0)
            {
                /* 特殊等级 */
                $ex_where .= " AND user_rank = '$filter[rank]' ";
            }
            else
            {
                $ex_where .= " AND rank_points >= " . intval($row['min_points']) . " AND rank_points < " . intval($row['max_points']);
            }
        }
        if ($filter['pay_points_gt'])
        {
             $ex_where .=" AND pay_points >= '$filter[pay_points_gt]' ";
        }
        if ($filter['pay_points_lt'])
        {
            $ex_where .=" AND pay_points < '$filter[pay_points_lt]' ";
        }

        $filter['record_count'] = $GLOBALS['db']->getOne("SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('users') . $ex_where);

        /* 分页大小 */
        $filter = page_and_size($filter);
        $sql = "SELECT user_id, user_name, email, reg_time ".
                " FROM " . $GLOBALS['ecs']->table('users') . $ex_where .
                " ORDER by " . $filter['sort_by'] . ' ' . $filter['sort_order'] .
                " LIMIT " . $filter['start'] . ',' . $filter['page_size'];

        $filter['keywords'] = stripslashes($filter['keywords']);
        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }

    $user_list = $GLOBALS['db']->getAll($sql);

    $count = count($user_list);
    for ($i=0; $i<$count; $i++)
    {
        $user_list[$i]['reg_time'] = local_date($GLOBALS['_CFG']['date_format'], $user_list[$i]['reg_time']);
    }

    $arr = array('user_list' => $user_list, 'filter' => $filter,
        'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

?>