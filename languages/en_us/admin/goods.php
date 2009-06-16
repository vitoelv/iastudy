<?php

/**
 * ECSHOP Manage a center start page language file
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
 * $Date: 2006-12-28 11:30:30 +0800 (Thursday,28 Decembers 2006) $
 * $Id: goods.php 3809 2006-12-28 03:30:30Z scottye $
*/

$_LANG['edit_goods'] ='Edit';
$_LANG['copy_goods'] ='Copy';
$_LANG['continue_add_goods'] ='Continue add new product';
$_LANG['back_goods_list'] ='Return product list';
$_LANG['add_goods_ok'] ='Add successfully';
$_LANG['edit_goods_ok'] ='Edit successfully';
$_LANG['trash_goods_ok'] ='Move to recycle bin successfully.';
$_LANG['restore_goods_ok'] ='Restore successfully.';
$_LANG['drop_goods_ok'] ='Delete successfully.';
$_LANG['batch_handle_ok']       = 'Batch operation successfully.';
$_LANG['drop_goods_confirm']    = 'Are you sure delete the product?';
$_LANG['batch_drop_confirm']    = 'All related products will be deleted if you thorough delete the pruduct!';
$_LANG['trash_goods_confirm']   = 'Are you sure move the product to recycle bin?';
$_LANG['batch_trash_confirm']   = 'Are you sure move the checked product to recycle bin?';
$_LANG['restore_goods_confirm'] = 'Are you sure restore the product?';
$_LANG['batch_restore_confirm'] = 'Are you sure restore the checked product?';
$_LANG['batch_on_sale_confirm'] = 'Are you sure set the checked product as on sale?';
$_LANG['batch_not_on_sale_confirm'] = 'Are you sure cancel the checked on sale product?';
$_LANG['batch_best_confirm']    = 'Are you sure set the checked product as best?';
$_LANG['batch_not_best_confirm']    = 'Are you sure cancel the checked best product?';
$_LANG['batch_new_confirm']     = 'Are you sure set the checked product as new?';
$_LANG['batch_not_new_confirm'] = 'Are you sure cancel the checked new product?';
$_LANG['batch_hot_confirm']     = 'Are you sure set the checked product as hot?';;
$_LANG['batch_not_hot_confirm']='Are you surecancel the checked hot product?';
$_LANG['cannot_found_goods'] = 'Don\'t find appointed product.';

/*------------------------------------------------------ */
//-- The picture processing is related to hint an information
/*------------------------------------------------------ */
$_LANG['no_gd'] ='Your server nonsupport GD or didn\'t install to operate the picture type to expand a database perhaps.';
$_LANG['img_not_exists'] ='Don\'t find out an original picture, create thumbnail failure.';
$_LANG['img_invalid'] ='Create thumbnail failure, because you upload an invalid picture file.';
$_LANG['create_dir_failed'] ='The images file clip and can\'t write, create thumbnail failure.';
$_LANG['safe_mode_warning'] ='Your server circulate under the safe mode, and %s directory nonentity. Your needing probably to establish a directory in advance then can upload a picture.';
$_LANG['not_writable_warning']='The %s directory can\'t be wrote, you need to config the directory as writable then can upload a picture.';

/*------------------------------------------------------ */
//-- Product list
/*------------------------------------------------------ */
$_LANG['goods_cat'] ='All Categories';
$_LANG['goods_brand'] ='All Brands';
$_LANG['intro_type'] ='Recommend';
$_LANG['keyword'] ='Keywords';
$_LANG['is_best'] ='Best';
$_LANG['is_new'] ='New';
$_LANG['is_hot'] ='Hot';
$_LANG['is_promote'] ='Sales promotion';

$_LANG['goods_name'] ='Name';
$_LANG['goods_sn'] ='NO.';
$_LANG['shop_price'] ='Price';
$_LANG['is_on_sale'] ='On sale';
$_LANG['goods_number'] ='Stock';

$_LANG['copy'] ='Copy';

$_LANG['integral'] ='Points limit';
$_LANG['on_sale'] ='On sale';
$_LANG['not_on_sale'] ='Not on sale';
$_LANG['best'] ='Best product';
$_LANG['not_best'] ='Cancel best product';
$_LANG['new'] ='New product';
$_LANG['not_new'] ='Cancel new product';
$_LANG['hot'] ='Hot product';
$_LANG['not_hot'] ='Cancel hot product';
$_LANG['move_to'] ='Move to category';

// ajax
$_LANG['goods_name_null'] ='Please enter product name.';
$_LANG['goods_sn_null'] ='Please enter product NO..';
$_LANG['shop_price_not_number']='Price must be a figure.';
$_LANG['goods_sn_exists'] ='The product NO. already exist, please change a number.';

/*------------------------------------------------------ */
//-- Add /edit a product information
/*------------------------------------------------------ */
$_LANG['tab_general'] ='Brief';
$_LANG['tab_detail'] ='Details';
$_LANG['tab_mix'] ='Others';
$_LANG['tab_properties'] ='Attribute';
$_LANG['tab_gallery'] ='Gallery';
$_LANG['tab_linkgoods'] ='Relational products';
$_LANG['tab_groupgoods'] ='Accessories';
$_LANG['tab_article'] ='Relational articles';

$_LANG['lab_goods_name'] ='Name:';
$_LANG['lab_goods_sn'] ='NO.:';
$_LANG['lab_goods_cat'] ='Category:';
$_LANG['lab_other_cat'] ='Extend category:';
$_LANG['lab_goods_brand'] ='Brand:';
$_LANG['lab_shop_price'] ='Shop price:';
$_LANG['lab_market_price'] ='Market price:';
$_LANG['lab_user_price'] ='Member price:';
$_LANG['lab_promote_price'] ='Promotion price:';
$_LANG['lab_promote_date'] ='Promotion date:';
$_LANG['lab_picture'] ='Upload picture:';
$_LANG['lab_thumb'] ='Upload thumbnail:';
$_LANG['auto_thumb'] ='Create thumbnail automatically';
$_LANG['lab_keywords'] ='Keywords:';
$_LANG['lab_goods_brief'] ='Brief:';
$_LANG['lab_seller_note'] ='Shop notice:';

$_LANG['lab_goods_weight'] ='Weight:';
$_LANG['unit_g'] ='Gram';
$_LANG['unit_kg'] ='Kilogram';
$_LANG['lab_goods_number'] ='Stock quantity:';
$_LANG['lab_warn_number'] ='Stock warning quantity:';
$_LANG['lab_integral'] ='Points limit for buying:';
$_LANG['lab_give_integral'] = '赠送积分数：';
$_LANG['lab_intro'] ='Recommend:';
$_LANG['lab_is_on_sale'] ='On sale:';
$_LANG['lab_is_alone_sale'] ='Common product:';

$_LANG['compute_by_mp'] ='Calculate';

$_LANG['notice_goods_sn'] ='If you don\'t enter product NO., the system will create unique NO. automatically.';
$_LANG['notice_integral'] ='How many points buy the product can be used.';
$_LANG['notice_seller_note'] ='Only provide information for shop owner.';
$_LANG['notice_keywords'] ='Divided by blank character.';
$_LANG['notice_user_price'] = '会员价格为-1时表示会员价格按会员等级折扣率计算。你也可以为每个等级指定一个固定价格';

$_LANG['on_sale_desc'] ='Checked means it can be allowed to sale, otherwise can be disallowed to sale.';
$_LANG['alone_sale'] ='Checked means it can be sold as common product, otherwise can be sold as accessories or gifts.';

$_LANG['invalid_goods_img'] ='Product picture format inaccuracy!';
$_LANG['invalid_goods_thumb']='Product thumbnail format inaccuracy!';
$_LANG['invalid_img_url'] ='Product gallery the %s picture format inaccuracy!';

$_LANG['goods_img_too_big'] ='Product picture file is too big(the biggest value: %s), can\'t upload.';
$_LANG['goods_thumb_too_big']='Product thumbnail file is too big(the biggest value: %s), can\'t upload.';
$_LANG['img_url_too_big'] ='Product gallery in the %s picture file is too big(the biggest value: %s), can\'t upload.';

$_LANG['integral_market_price']='Take integral';
$_LANG['upload_images'] ='Upload a picture';
$_LANG['spec_price'] = 'Attribute price';
$_LANG['drop_img_confirm'] = 'Are you sure delete the picture?';

$_LANG['select_font'] = 'Font Style';
$_LANG['font_styles'] = array('strong' => 'Bold', 'em' => 'Italic', 'u' => 'Underline', 'strike' => 'Strike Through');

$_LANG['rapid_add_cat'] = 'Add category';
$_LANG['rapid_add_brand'] = 'Rapid add brand';
$_LANG['category_manage'] = 'Category manage';
$_LANG['brand_manage'] = 'Brand manage';
$_LANG['hide'] = 'Hide';

/*------------------------------------------------------ */
//-- Connection product
/*------------------------------------------------------ */

$_LANG['all_goods'] ='Choose product';
$_LANG['link_goods'] ='Relational products';
$_LANG['single'] ='Single';
$_LANG['double'] ='Double';
$_LANG['all_article'] ='Choose product';
$_LANG['goods_article'] ='Relational articles';

/*------------------------------------------------------ */
//-- Combine a product
/*------------------------------------------------------ */

$_LANG['group_goods'] ='Accessories';
$_LANG['price'] ='Price';

/*------------------------------------------------------ */
//-- Product gallery
/*------------------------------------------------------ */

$_LANG['img_desc'] ='Description';
$_LANG['img_url'] ='Upload a file';

/*------------------------------------------------------ */
//-- Connection article
/*------------------------------------------------------ */
$_LANG['article_title'] ='Article title';

$_LANG['goods_not_exist'] = 'The product doesn\'t exist. ';
$_LANG['goods_not_in_recycle_bin'] = 'The product can\'t be deleted until it is removed to recycle bin.';

$_LANG['js_languages']['goods_name_not_null']='Product name can\'t be blank.';
$_LANG['js_languages']['goods_cat_not_null'] ='Please select product category.';
$_LANG['js_languages']['category_cat_not_null'] = 'Category name can not null';
$_LANG['js_languages']['brand_cat_not_null'] = 'Brand name can not null';
$_LANG['js_languages']['goods_cat_not_leaf'] ='You selected product category isn\'t a bottom class category, please select a bottom class category.';
$_LANG['js_languages']['shop_price_not_null']='The shop selling price can\'t be blank.';
$_LANG['js_languages']['shop_price_not_number']='The shop selling price isn\'t a figure.';

$_LANG['js_languages']['select_please'] ='Please select...';
$_LANG['js_languages']['button_add'] ='Add';
$_LANG['js_languages']['button_del'] ='Delete';
$_LANG['js_languages']['spec_value_not_null'] ='The specification can\'t be blank.';
$_LANG['js_languages']['spec_price_not_number'] ='The price markup isn\'t a fugure.';
$_LANG['js_languages']['market_price_not_number']='The market price isn\'t a figure.';
$_LANG['js_languages']['goods_number_not_int'] ='The product stock isn\'t an integer.';
$_LANG['js_languages']['warn_number_not_int'] ='The stock warning isn\'t an integer.';
$_LANG['js_languages']['promote_not_lt'] = 'Sales start date can not be greater than the end date';

$_LANG['js_languages']['drop_img_confirm'] = 'Are you sure delete the picture?';
$_LANG['js_languages']['batch_no_on_sale'] = 'Are you sure stop sale the checked product?';
$_LANG['js_languages']['batch_trash_confirm'] = 'Are you sure move the checked product to recycle bin?';
$_LANG['js_languages']['go_category_page'] = "This page's data will lost, are you sure to go to adding category page？";
$_LANG['js_languages']['go_brand_page'] = "This page's data will lost, are you sure to go to adding brand page？";

/* 虚拟卡 */
$_LANG['card'] = '查看虚拟卡信息';
$_LANG['replenish'] = '补货';
$_LANG['batch_card_add'] = '批量补货';

?>
