<?php

/**
 * ECSHOP 贺卡管理语言项
 * ============================================================================
 * 版权所有 (C) 2005-2006 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: weberliu $
 * $Date: 2007-09-13 16:15:00 +0800 (星期四, 13 九月 2007) $
 * $Id: card.php 12056 2007-09-13 08:15:00Z weberliu $
*/

$_LANG['card_name'] = '贺卡名称';
$_LANG['card_fee'] = '贺卡费用';
$_LANG['free_money'] = '贺卡免费额度';
$_LANG['card_img'] = '贺卡图纸';
$_LANG['card_desc'] = '贺卡描述';

$_LANG['card_edit'] = '编辑贺卡';

$_LANG['drop_card_img'] = '删除贺卡图纸';
$_LANG['confirm_drop_card_img'] = '你确认删除该贺卡图纸吗？';
$_LANG['drop_card_img_success'] = '删除贺卡图片成功';

$_LANG['card_edit_lnk'] = '重新编辑该贺卡';
$_LANG['card_list_lnk'] = '返回列表页面';

/*帮助信息*/
$_LANG['notice_cardfee'] = '使用这个贺卡所需要支付的费用，免费时设置为0';
$_LANG['notice_cardfreemoney'] = '当用户消费金额超过这个值时，将免费使用这个贺卡<br />设置为0表明必须支付贺卡费用';

$_LANG['warn_cardimg'] = '你已经上传过图片。再次上传时将覆盖原图片';

/*提示信息*/
$_LANG['cardname_exist'] ='贺卡名 %s 已经存在';
$_LANG['cardadd_succeed'] ='已成功添加';
$_LANG['carddrop_fail'] ='删除失败';
$_LANG['carddrop_succeed'] ='删除成功';
$_LANG['cardedit_succeed'] ='贺卡 %s 修改成功';
$_LANG['cardedit_fail'] ='贺卡 %s 修改失败';
$_LANG['drop_confirm'] ='你确认要删除这条记录吗？';
$_LANG['enter_num'] ='请输入一个数字！';

$_LANG['no_cardname'] ='你输入的卡片名称为空！';

$_LANG['back_list'] ='返回贺卡列表';
$_LANG['continue_add'] ='继续添加新贺卡';

$_LANG['upfile_type_error'] = "只能上传jpg，gif，png类型的图片";
$_LANG['upfile_error'] = "图片无法上传，请确保data目录下所有子目录的可写性";

/*JS 语言项*/
$_LANG['js_languages']['no_cardname'] = '没有输入贺卡名';
$_LANG['js_languages']['cardfee_un_num'] = '贺卡费用为空或不是数字';
$_LANG['js_languages']['cardmoney_un_num'] = '贺卡免费额度为空或不是数字';

?>