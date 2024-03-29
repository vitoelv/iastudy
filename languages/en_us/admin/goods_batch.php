<?php

/**
 * ECSHOP Batch upload products,modification language item
 * ============================================================================
 * All right reserved (C) 2005-2007 Beijing Yi Shang Interactive Technology
 * Development Ltd.
 * Web site: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * This is a free/open source software；it mean that you can modify, use and
 * republish the program code, on the premise of that your behavior is not for
 * commercial purposes.
 * ============================================================================
 * $Author: scottye $
 * $Date: 2007-02-06 15:40:38 +0800 (Tuesday, 06 February 2007) $
 * $Id: goods_batch.php 5241 2007-02-06 07:40:38Z scottye $
 */

$_LANG['select_method'] ='Product method:';
$_LANG['by_cat'] ='Basis product category, brand.';
$_LANG['by_sn'] ='Basis product NO.';
$_LANG['select_cat'] ='Category:';
$_LANG['select_brand'] ='Brand:';
$_LANG['goods_list'] ='List:';
$_LANG['src_list'] ='Choose product:';
$_LANG['dest_list'] ='Chosen product:';
$_LANG['input_sn'] ='Enter product NO.:<Br/>(One NO. per line)';
$_LANG['edit_method'] ='Method:';
$_LANG['edit_each'] ='One by one';
$_LANG['edit_all'] ='Unify';
$_LANG['go_edit'] ='Enter';

$_LANG['notice_edit'] = '会员价格为-1表示会员价格将根据会员等级折扣比例计算';

$_LANG['goods_class'] = 'Goods Class';
$_LANG['g_class'][G_REAL] = 'Real Goods';
$_LANG['g_class'][G_CARD] = 'Virtual Card';

$_LANG['goods_name'] ='Name';
$_LANG['market_price'] ='Market price';
$_LANG['shop_price'] ='Shop price';
$_LANG['integral'] = '积分购买';
$_LANG['give_integral'] = '赠送积分';
$_LANG['goods_number'] ='Stock';
$_LANG['brand'] ='Brand';

$_LANG['batch_edit_ok'] ='Batch modify successfully.';

$_LANG['goods_cat'] ='Category:';
$_LANG['csv_file'] ='Upload csv files:';
$_LANG['notice_file'] ='(The product quantity once upload had better be less than 1000 in CSV file, the CSV file size had better be less than 500K.)';
$_LANG['file_charset'] ='Character set:';
$_LANG['download_file'] ='Download batch CSV files(%s).';
$_LANG['use_help'] ='Help:' .
        '<ol>' .
          '<Li>According to the usage habit, the download corresponds language of csv file, for example Chinese mainland customers download the simplified Chinese character language file, Hongkong and Taiwan customers download the traditional Chinese language file;</li>' .
          '<Li>Fill in the csv file, can use the excel or text editor to open a csv file;<br />' .
              'If "Best product" and so on, fill in numeral 0 or 1, 0 means "NO", 1 mean "YES";<br />' .
              'Please fill in file name with path for product picture and thumbnail, the path is relative path [root directory]/images/, for example, the picture path is [root catalogue]/images/200610/abc.jpg, fill in 200610/abc.jpg;<br />'.
          '<Li>Upload the product picture and thumbnail to correspond directory, for example:[Root catalogue]/images/200610/;</li>' .
          '<Li>Select category and file code to upload, upload the csv file.</li>'.
        '</ol>';

$_LANG['js_languages']['please_select_goods'] ='Please select product.';
$_LANG['js_languages']['please_input_sn'] ='Please enter product NO..';
$_LANG['js_languages']['goods_cat_not_leaf'] ='Please select bottom class category.';
$_LANG['js_languages']['please_select_cat'] ='Please select belong category.';
$_LANG['js_languages']['please_upload_file'] ='Please upload batch csv files.';

// Batch upload field of product
$_LANG['upload_goods']['goods_name'] ='Name';
$_LANG['upload_goods']['goods_sn'] ='NO.';
$_LANG['upload_goods']['brand_name'] ='Brand';   // Need to be convert brand_id
$_LANG['upload_goods']['market_price'] ='Market price';
$_LANG['upload_goods']['shop_price'] ='Shop price';
$_LANG['upload_goods']['integral'] ='Points limit for buying';
$_LANG['upload_goods']['original_img'] ='Original picture';
$_LANG['upload_goods']['goods_img'] ='Picture';
$_LANG['upload_goods']['goods_thumb'] ='Thumbnail';
$_LANG['upload_goods']['keywords'] ='Keywords';
$_LANG['upload_goods']['goods_brief'] ='Brief';
$_LANG['upload_goods']['goods_desc'] ='Details';
$_LANG['upload_goods']['goods_weight'] ='Weight(kg)';
$_LANG['upload_goods']['goods_number'] ='Stock quantity';
$_LANG['upload_goods']['warn_number'] ='Stock warning quantity';
$_LANG['upload_goods']['is_best'] ='Best';
$_LANG['upload_goods']['is_new'] ='New';
$_LANG['upload_goods']['is_hot'] ='Hot';
$_LANG['upload_goods']['is_on_sale'] ='On sale';
$_LANG['upload_goods']['is_alone_sale'] ='Can be a common product sale?';
$_LANG['upload_goods']['is_real'] ='Entity';

$_LANG['batch_upload_ok'] ='Batch upload successfully.';
$_LANG['goods_upload_confirm']='Batch upload confirmation.';
?>
