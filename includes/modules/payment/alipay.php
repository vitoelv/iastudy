<?php

/**
 * ECSHOP 支付宝插件
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-31 10:30:46 +0800 (星期四, 31 一月 2008) $
 * $Id: alipay.php 14096 2008-01-31 02:30:46Z testyang $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' .$GLOBALS['_CFG']['lang']. '/payment/alipay.php';

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* 代码 */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* 描述对应的语言项 */
    $modules[$i]['desc']    = 'alipay_desc';

    /* 是否支持货到付款 */
    $modules[$i]['is_cod']  = '0';

    /* 是否支持在线支付 */
    $modules[$i]['is_online']  = '1';

    /* 作者 */
    $modules[$i]['author']  = 'ECSHOP TEAM';

    /* 网址 */
    $modules[$i]['website'] = 'http://www.alipay.com';

    /* 版本号 */
    $modules[$i]['version'] = '1.0.1';

    /* 配置信息 */
    $modules[$i]['config']  = array(
        array('name' => 'alipay_account',           'type' => 'text',   'value' => ''),
        array('name' => 'alipay_key',               'type' => 'text',   'value' => ''),
        array('name' => 'alipay_partner',           'type' => 'text',   'value' => ''),
        array('name' => 'alipay_real_method',       'type' => 'select', 'value' => '0'),
        array('name' => 'alipay_virtual_method',    'type' => 'select', 'value' => '0'),
        array('name' => 'is_instant',               'type' => 'select', 'value' => '0')
    );

    return;
}

/**
 * 类
 */
class alipay
{

    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function alipay()
    {
    }

    function __construct()
    {
        $this->alipay();
    }

    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment)
    {
        if (empty($payment['is_instant']))
        {
            /* 未开通即时到帐 */
            $service = 'trade_create_by_buyer';
        }
        else
        {
            if (!empty($order['order_id']))
            {
                /* 检查订单是否全部为虚拟商品 */
                $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('order_goods').
                        " WHERE is_real=1 AND order_id='$order[order_id]'";

                if ($GLOBALS['db']->getOne($sql) > 0)
                {
                    /* 订单中存在实体商品 */
                    $service =  (!empty($payment['alipay_real_method']) && $payment['alipay_real_method'] == 1) ?
                        'create_direct_pay_by_user' : 'trade_create_by_buyer';
                }
                else
                {
                    /* 订单中全部为虚拟商品 */
                    $service = (!empty($payment['alipay_virtual_method']) && $payment['alipay_virtual_method'] == 1) ?
                        'create_direct_pay_by_user' : 'create_digital_goods_trade_p';
                }
            }
            else
            {
                /* 非订单方式，按照虚拟商品处理 */
                $service = (!empty($payment['alipay_virtual_method']) && $payment['alipay_virtual_method'] == 1) ?
                    'create_direct_pay_by_user' : 'create_digital_goods_trade_p';
            }
        }


        $parameter = array(
            'service'           => $service,
            'partner'           => $payment['alipay_partner'],
            //'partner'           => ALIPAY_ID,
            '_input_charset'    => 'utf-8',
            'return_url'        => return_url(basename(__FILE__, '.php')),
            /* 业务参数 */
            'subject'           => $order['order_sn'],
            'out_trade_no'      => strtolower($payment['alipay_account']) . '_' . $order['log_id'],
            'price'             => $order['order_amount'],
            'quantity'          => 1,
            'payment_type'      => 1,
            /* 物流参数 */
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            /* 买卖双方信息 */
            'seller_email'      => $payment['alipay_account']
        );

        ksort($parameter);
        reset($parameter);

        $param = '';
        $sign  = '';

        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }

        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['alipay_key'];
        //$sign  = substr($sign, 0, -1). ALIPAY_AUTH;

        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\'https://www.alipay.com/cooperate/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5\')" value="' .$GLOBALS['_LANG']['pay_button']. '" /></div>';

        return $button;
    }

    /**
     * 响应操作
     */
    function respond()
    {
        $payment  = get_payment($_GET['code']);
        $seller_email = rawurldecode($_GET['seller_email']);
        $order_sn = str_replace($seller_email.'_', '', $_GET['out_trade_no']);
        $order_sn = trim($order_sn);

        /* 检查支付的金额是否相符 */
        if (!check_money($order_sn, $_GET['total_fee']))
        {
            return false;
        }

        /* 检查数字签名是否正确 */
        ksort($_GET);
        reset($_GET);

        $sign = '';
        foreach ($_GET AS $key=>$val)
        {
            if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
            {
                $sign .= "$key=$val&";
            }
        }

        $sign = substr($sign, 0, -1) . $payment['alipay_key'];
        //$sign = substr($sign, 0, -1) . ALIPAY_AUTH;
        if (md5($sign) != $_GET['sign'])
        {
            return false;
        }

        if ($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS')
        {
            /* 改变订单状态 */
            order_paid($order_sn, PS_PAYING);

            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_FINISHED')
        {
            /* 改变订单状态 */
            order_paid($order_sn);

            return true;
        }
        else
        {
            return false;
        }
    }
}

?>