<?php

/**
 * ECSHOP 短信模块 之 控制器
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: sms.php 14079 2008-01-28 10:33:06Z testyang $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/cls_sms.php');

$action = isset($_REQUEST['act']) ? $_REQUEST['act'] : 'display_my_info';
$sms = new sms();

switch ($action)
{
    /* 注册短信服务。*/
    case 'register' :
        $email      = isset($_POST['email'])    ? $_POST['email']       : '';
        $password   = isset($_POST['password']) ? $_POST['password']    : '';
        $domain     = isset($_POST['domain'])   ? $_POST['domain']      : '';
        $phone      = isset($_POST['phone'])    ? $_POST['phone']       : '';

        $result = $sms->register($email, $password, $domain, $phone);

        $link[] = array('text'  =>  $_LANG['back'],
                        'href'  =>  'sms.php?act=display_my_info');

        if ($result === true)//注册成功
        {
            sys_msg($_LANG['register_ok'], 0, $link);
        }
        else
        {
            @$error_detail = $_LANG['server_errors'][$sms->errors['server_errors']['error_no']]
                          . $_LANG['api_errors']['register'][$sms->errors['api_errors']['error_no']];
            sys_msg($_LANG['register_error'] . $error_detail, 1, $link);
        }

        break;

    /* 启用短信服务。 */
    case 'enable' :
        $username = isset($_POST['email'])      ? $_POST['email']       : '';
        //由于md5函数对空串也加密，所以要进行判空操作
        $password = isset($_POST['password']) && $_POST['password'] !== ''
                ? md5($_POST['password'])
                : '';

        $result = $sms->restore($username, $password);

        $link[] = array('text'  =>  $_LANG['back'],
                        'href'  =>  'sms.php?act=display_my_info');

        if ($result === true)//启用成功
        {
            sys_msg($_LANG['enable_ok'], 0, $link);
        }
        else
        {
            @$error_detail = $_LANG['server_errors'][$sms->errors['server_errors']['error_no']]
                          . $_LANG['api_errors']['auth'][$sms->errors['api_errors']['error_no']];
            sys_msg($_LANG['enable_error'] . $error_detail, 1, $link);
        }

        break;

    /* 注销短信特服信息 */
    case 'disable' :
        $result = $sms->clear_my_info();

        $link[] = array('text'  =>  $_LANG['back'],
                        'href'  =>  'sms.php?act=display_my_info');

        if ($result === true)//注销成功
        {
            sys_msg($_LANG['disable_ok'], 0, $link);
        }
        else
        {
            sys_msg($_LANG['disable_error'], 1, $link);
        }

        break;

    /* 显示短信发送界面，如果尚未注册或启用短信服务则显示注册界面。 */
    case 'display_send_ui' :
        if ($sms->has_registered())
        {
            $smarty->assign('ur_here', $_LANG['03_sms_send']);
            assign_query_info();
            $smarty->display('sms_send_ui.htm');
        }
        else
        {
            $smarty->assign('ur_here', $_LANG['register_sms']);
            $smarty->assign('sms_site_info', $sms->get_site_info());
            assign_query_info();
            $smarty->display('sms_register_ui.htm');
        }

        break;

    /* 发送短信 */
    case 'send_sms' :
        $phone     = isset($_POST['phone'])     ? $_POST['phone']       : '';
        $msg       = isset($_POST['msg'])       ? $_POST['msg']         : '';
        $send_date = isset($_POST['send_date']) ? $_POST['send_date']   : '';

        $result = $sms->send($phone, $msg, $send_date);

        $link[] = array('text'  =>  $_LANG['back'] . $_LANG['03_sms_send'],
                        'href'  =>  'sms.php?act=display_send_ui');

        if ($result === true)//发送成功
        {
            sys_msg($_LANG['send_ok'], 0, $link);
        }
        else
        {
            @$error_detail = $_LANG['server_errors'][$sms->errors['server_errors']['error_no']]
                          . $_LANG['api_errors']['send'][$sms->errors['api_errors']['error_no']];
            sys_msg($_LANG['send_error'] . $error_detail, 1, $link);
        }

        break;

    /* 显示发送记录的查询界面，如果尚未注册或启用短信服务则显示注册界面。 */
    case 'display_send_history_ui' :
        if ($sms->has_registered())
        {
            $smarty->assign('ur_here', $_LANG['05_sms_send_history']);
            assign_query_info();
            $smarty->display('sms_send_history_query_ui.htm');
        }
        else
        {
            $smarty->assign('ur_here', $_LANG['register_sms']);
            $smarty->assign('sms_site_info', $sms->get_site_info());
            assign_query_info();
            $smarty->display('sms_register_ui.htm');
        }

        break;

    /* 获得发送记录，如果客户端支持XSLT，则直接发送XML格式的文本到客户端；
       否则在服务器端把XML转换成XHTML后发送到客户端。
    */
    case 'get_send_history' :
        $start_date = isset($_POST['start_date'])   ? $_POST['start_date']  : '';
        $end_date   = isset($_POST['end_date'])     ? $_POST['end_date']    : '';
        $page_size  = isset($_POST['page_size'])    ? $_POST['page_size']   : 20;
        $page       = isset($_POST['page'])         ? $_POST['page']        : 1;

        $is_xslt_supported = isset($_POST['is_xslt_supported']) ? $_POST['is_xslt_supported'] : 'no';
        if ($is_xslt_supported === 'yes')
        {
            $xml = $sms->get_send_history_by_xml($start_date, $end_date, $page_size, $page);
            header('Content-Type: application/xml; charset=utf-8');
            //TODO:判断错误信息，链上XSLT
            echo $xml;
        }
        else
        {
            $result = $sms->get_send_history($start_date, $end_date, $page_size, $page);

            if ($result !== false)
            {
                $smarty->assign('sms_send_history', $result);
                $smarty->assign('ur_here', $_LANG['05_sms_send_history']);

                /* 分页信息 */
                $turn_page = array( 'total_records' => $result['count'],
                                    'total_pages'   => intval(ceil($result['count']/$page_size)),
                                    'page'          => $page,
                                    'page_size'     => $page_size);
                $smarty->assign('turn_page', $turn_page);
                $smarty->assign('start_date', $start_date);
                $smarty->assign('end_date', $end_date);

                assign_query_info();

                $smarty->display('sms_send_history.htm');
            }
            else
            {
                $link[] = array('text'  =>  $_LANG['back_send_history'],
                                'href'  =>  'sms.php?act=display_send_history_ui');

                @$error_detail = $_LANG['server_errors'][$sms->errors['server_errors']['error_no']]
                              . $_LANG['api_errors']['get_history'][$sms->errors['api_errors']['error_no']];

                sys_msg($_LANG['history_query_error'] . $error_detail, 1, $link);
            }
        }

        break;

    /* 显示充值页面 */
    case 'display_charge_ui' :
        if ($sms->has_registered())
        {
            $smarty->assign('ur_here', $_LANG['04_sms_charge']);
            assign_query_info();
            $sms_charge = array();
            $sms_charge['charge_url'] = $sms->get_url('charge');
            $sms_charge['login_info'] = $sms->get_login_info();
            $smarty->assign('sms_charge', $sms_charge);
            $smarty->display('sms_charge_ui.htm');
        }
        else
        {
            $smarty->assign('ur_here', $_LANG['register_sms']);
            $smarty->assign('sms_site_info', $sms->get_site_info());
            assign_query_info();
            $smarty->display('sms_register_ui.htm');
        }

        break;

    /* 显示充值记录的查询界面，如果尚未注册或启用短信服务则显示注册界面。 */
    case 'display_charge_history_ui' :
        if ($sms->has_registered())
        {
            $smarty->assign('ur_here', $_LANG['06_sms_charge_history']);
            assign_query_info();
            $smarty->display('sms_charge_history_query_ui.htm');
        }
        else
        {
            $smarty->assign('ur_here', $_LANG['register_sms']);
            $smarty->assign('sms_site_info', $sms->get_site_info());
            assign_query_info();
            $smarty->display('sms_register_ui.htm');
        }

        break;

    /* 获得充值记录，如果客户端支持XSLT，则直接发送XML格式的文本到客户端；
       否则在服务器端把XML转换成XHTML后发送到客户端。
    */
    case 'get_charge_history' :
        $start_date = isset($_POST['start_date'])   ? $_POST['start_date']  : '';
        $end_date   = isset($_POST['end_date'])     ? $_POST['end_date']    : '';
        $page_size  = isset($_POST['page_size'])    ? $_POST['page_size']   : 20;
        $page       = isset($_POST['page'])         ? $_POST['page']        : 1;

        $is_xslt_supported = isset($_POST['is_xslt_supported']) ? $_POST['is_xslt_supported'] : 'no';
        if ($is_xslt_supported === 'yes')
        {
            $xml = $sms->get_charge_history_by_xml($start_date, $end_date, $page_size, $page);
            header('Content-Type: application/xml; charset=utf-8');
            //TODO:判断错误信息，链上XSLT
            echo $xml;
        }
        else
        {
            $result = $sms->get_charge_history($start_date, $end_date, $page_size, $page);
            if ($result !== false)
            {
                $smarty->assign('sms_charge_history', $result);

                /* 分页信息 */
                $turn_page = array( 'total_records' => $result['count'],
                                    'total_pages'   => intval(ceil($result['count']/$page_size)),
                                    'page'          => $page,
                                    'page_size'     => $page_size);
                $smarty->assign('turn_page', $turn_page);
                $smarty->assign('start_date', $start_date);
                $smarty->assign('end_date', $end_date);

                assign_query_info();

                $smarty->display('sms_charge_history.htm');
            }
            else
            {
                $link[] = array('text'  =>  $_LANG['back_charge_history'],
                                'href'  =>  'sms.php?act=display_charge_history_ui');

                @$error_detail = $_LANG['server_errors'][$sms->errors['server_errors']['error_no']]
                              . $_LANG['api_errors']['get_history'][$sms->errors['api_errors']['error_no']];

                sys_msg($_LANG['history_query_error'] . $error_detail, 1, $link);
            }
        }

        break;

    /* 显示我的短信服务个人信息 */
    default :
        $sms_my_info = $sms->get_my_info();
        if (!$sms_my_info)
        {
            $link[] = array('text'  =>  $_LANG['back'], 'href'  =>  './');
            sys_msg($_LANG['empty_info'], 1, $link);
        }

        if (!$sms_my_info['sms_user_name'])//此处不用$sms->has_registered()能够减少一次数据库查询
        {
            $smarty->assign('ur_here', $_LANG['register_sms']);
            $smarty->assign('sms_site_info', $sms->get_site_info());
            assign_query_info();
            $smarty->display('sms_register_ui.htm');
        }
        else
        {
            /* 立即更新短信特服信息 */
            $sms->restore($sms_my_info['sms_user_name'], $sms_my_info['sms_password']);

            /* 再次获取个人数据，保证显示的数据是最新的 */
            $sms_my_info = $sms->get_my_info();//这里不再进行判空处理，主要是因为如果前个式子不出错，这里一般不会出错

            /* 格式化时间输出 */
            $sms_last_request = $sms_my_info['sms_last_request']
                    ? $sms_my_info['sms_last_request']
                    : 0;//赋0防出错
            $sms_my_info['sms_last_request'] = local_date('Y-m-d H:i:s O', $sms_my_info['sms_last_request']);

            $smarty->assign('sms_my_info', $sms_my_info);
            $smarty->assign('ur_here', $_LANG['02_sms_my_info']);
            assign_query_info();
            $smarty->display('sms_my_info.htm');
        }
}

?>