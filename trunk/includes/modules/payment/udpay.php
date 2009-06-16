<?php

/**
 * ECSHOP ����ͨ���
 * ============================================================================
 * ��Ȩ���� (C) 2005-2007 ��ʢ���루�������Ƽ����޹�˾������������Ȩ����
 * ��վ��ַ: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * ����һ����ѿ�Դ�����������ζ���������ڲ�������ҵĿ�ĵ�ǰ���¶Գ������
 * �����޸ġ�ʹ�ú��ٷ�����
 * ============================================================================
 * $Author: paulgao $
 * $Date: 2007-01-31 18:07:02 +0800 (������, 31 һ�� 2007) $
 * $Id: udpay.php 4853 2007-01-31 10:07:02Z paulgao $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' .$GLOBALS['_CFG']['lang']. '/payment/udpay.php';

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* ģ��Ļ�����Ϣ */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* ���� */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* ������Ӧ�������� */
    $modules[$i]['desc']    = 'udpay_desc';

    /* �Ƿ�֧�ֻ������� */
    $modules[$i]['is_cod']  = '0';

    /* �Ƿ�֧������֧�� */
    $modules[$i]['is_online']  = '1';

    /* ���� */
    $modules[$i]['author']  = 'ECSHOP TEAM';

    /* ��ַ */
    $modules[$i]['website'] = 'http://www.udpay.com';

    /* �汾�� */
    $modules[$i]['version'] = '1.0.0';

    /* ������Ϣ */
    $modules[$i]['config']  = array(
        array('name' => 'udpay_account', 'type' => 'text', 'value' => ''),
        array('name' => 'udpay_merchantPrivateModulus', 'type' => 'text', 'value' => ''),
        array('name' => 'udpay_merchantPrivateExponent', 'type' => 'text', 'value' => ''),
        array('name' => 'udpay_whtpublicModulus', 'type' => 'text', 'value' => ''),
        array('name' => 'udpay_whtpublicExponent', 'type' => 'text', 'value' => ''),
        array('name' => 'udpay_orderInfo', 'type' => 'text', 'value' => ''),
        array('name' => 'udpay_errorfile', 'type' => 'text', 'value' => $GLOBALS['ecs']->url().'respond.php')
    );

    return;
}

/**
 * ��
 */
class udpay
{
    /**
     * ���캯��
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function udpay()
    {
        if (!function_exists('bcadd'))
        {
            trigger_error('This web server don\'t support BC match module.', E_USER_ERROR);
        }
    }

    function __construct()
    {
        $this->udpay();
    }

    /**
     * ����֧������
     * @param   array   $order  ������Ϣ
     * @param   array   $payment    ֧����ʽ��Ϣ
     */
    function get_code($order, $payment)
    {
        $data_order_id    = $order['log_id'];
        $data_amount      = $order['order_amount'];
        $data_return_url  = $GLOBALS['ecs']->url();
        $data_pay_account = $payment['udpay_account'];
        $udpay_merchantPrivateModulus  = $payment['udpay_merchantPrivateModulus'];
        $udpay_merchantPrivateExponent = $payment['udpay_merchantPrivateExponent'];
        $udpay_orderInfo  = $payment['udpay_orderInfo'];
        $data_notify_url  = return_url(basename(__FILE__, '.php'));
//        $udpay_orderInfo  = iconv('UTF-8','gbk',$udpay_orderInfo);
         $msg="txCode=TP001&merchantId=$data_pay_account&transDate=&transFlow=$data_order_id&orderId=$order[order_sn]&curCode=156&amount=$data_amount&orderInfo=$udpay_orderInfo&comment=comment&merURL=$data_notify_url&interfaceType=7"; //��������ǩ����Ϣԭʼ��
        $privateModulus  = $udpay_merchantPrivateModulus;  // ��������ǩ����Ϣ�̻�˽Կ
        $privateExponent = $udpay_merchantPrivateExponent; // ��������ǩ����Ϣ�̻�˽Կ
        $RsaDecrypt      = $this->generateSigature($msg, $privateExponent, $privateModulus);
        $def_url         = '<form style="text-align:center;" action="http://124.42.2.165/gateway/transForward.jsp" method="post" name=sendOrder>' . // ����ʡ��
            "<input type='hidden' name='txCode' value='TP001'>" .                  // ���״��� (�̶�ֵ�����޸�)
            "<input type='hidden' name='merchantId' value='$data_pay_account'>" .  // ����ͨ�̻���
            "<input type='hidden' name='transDate' value=''>" .                    // ��������
            "<input type='hidden' name='transFlow' value='$data_order_id'>" .      // ������ˮ��
            "<input type='hidden' name='orderId' value='$order[order_sn]'>" .      // ������
            "<input type='hidden' name='curCode' value='156'>" .                   // ���֣��̶�ֵ�����޸ģ�
            "<input type='hidden' name='amount' value='$data_amount'>" .           // �������
            "<input type='hidden' name='orderInfo' value=$udpay_orderInfo>" .      // ������Ϣ�������̻����ڴ������˾������Ϣ��
            "<input type='hidden' name='comment' value='comment'>" .               // ������Ϣ
            "<input type='hidden' name='merURL' value='$data_notify_url'>" .       // ��������ͨϵͳ��֧�������Ϣ��URL
            "<input type='hidden' name='interfaceType' value='7'>" .               // �ӿ�ģʽ
            "<input type='hidden' name='sign' value='$RsaDecrypt'>" .              // ��������ǩ����Ϣ
            "<input type='submit' value='" . $GLOBALS['_LANG']['udpay_button'] . "'>" . // ��ť
            "</form>";

        return $def_url;
    }

    /**
     * ��Ӧ����
     */
    function respond()
    {
        $payment     = get_payment('udpay');
        $merchant_id = $payment['udpay_account']; // ��ȡ�̻����

        $udpay_whtpublicModulus  = $payment['udpay_whtpublicModulus'];
        $udpay_whtpublicExponent = $payment['udpay_whtpublicExponent'];

        /* read the post from udpay system and add 'cmd' */
        $req = 'cmd=_notify-validate';
        foreach ($_GET AS $key => $value)
        {
            $value = urlencode(stripslashes($value));
            $req  .= "&$key=$value";
        }

        /* post back to udpay system to validate */
        //$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        //$header .= "Content-Length: " . strlen($req) ."\r\n\r\n";

        /* ��ȡ����ͨget��������Ҫǩ�������� */
        $sign = $_GET['sign'];
        $msg = "txCode=$_GET[txCode]&merchantId=$_GET[merchantId]&transDate=$_GET[transDate]&transFlow=$_GET[transFlow]&orderId=$_GET[orderId]&curCode=$_GET[curCode]&amount=$_GET[amount]&orderInfo=$_GET[orderInfo]&comment=$_GET[comment]&whtFlow=$_GET[whtFlow]&success=$_GET[success]&errorType=$_GET[errorType]";

        /* ��Կ���� */
        $publicModulus  = $udpay_whtpublicModulus;
        $publicExponent = $udpay_whtpublicExponent;
        $verifySigature = $this-> verifySigature($msg, $sign, $publicExponent, $publicModulus);
        if ($verifySigature)
        {
            order_paid($_GET['transFlow']);
        }

        return $verifySigature;
    }

    function generateSigature($message, $exponent, $modulus)
    {
        $md5Message = md5($message);
        $fillStr    = '01ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff003020300c06082a864886f70d020505000410';
        $md5Message = $fillStr.$md5Message;
        $intMessage = $this->bin2int(@$this->hex2bin($md5Message));
        $intE       = $this->bin2int(@$this->hex2bin($exponent));
        $intM       = $this->bin2int(@$this->hex2bin($modulus));
        $intResult  = $this->powmod($intMessage, $intE, $intM);
        $hexResult  = bin2hex($this->int2bin($intResult));

        return $hexResult;
    }

    function verifySigature($message, $sign, $exponent, $modulus)
    {
        $intSign     = @$this->bin2int($this->hex2bin($sign));
        $intExponent = @$this->bin2int($this->hex2bin($exponent));
        $intModulus  = @$this->bin2int($this->hex2bin($modulus));
        $intResult   = $this->powmod($intSign, $intExponent, $intModulus);
        $hexResult   = bin2hex($this->int2bin($intResult));
        $md5Message  = md5($message);
        if ($md5Message == substr($hexResult, -32))
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }

    function hex2bin($hexdata)
    {
        for ($i = 0, $count = strlen($hexdata); $i < $count; $i += 2)
        {
            $bindata = chr(hexdec(substr($hexdata, $i, 2))) . $bindata;
        }

        return $bindata;
    }

    function bin2int($str)
    {
        $result = '0';
        $n = strlen($str);

        do
        {
            $result = bcadd(bcmul($result, '256'), ord($str{--$n}));
        } while ($n > 0);

        return $result;
    }

    function int2bin($num)
    {
        $result = '';

        do
        {
            $result= chr(bcmod($num, '256')) . $result;
            $num = bcdiv($num, '256');
        } while (bccomp($num, '0'));

        return $result;
    }

    function powmod($num, $pow, $mod)
    {
        $result = '1';

        do
        {
          if (!bccomp(bcmod($pow, '2'), '1'))
          {
              $result = bcmod(bcmul($result, $num), $mod);
          }
          $num = bcmod(bcpow($num, '2'), $mod);
          $pow = bcdiv($pow, '2');
      } while (bccomp($pow, '0'));

      return $result;
    }
}

?>