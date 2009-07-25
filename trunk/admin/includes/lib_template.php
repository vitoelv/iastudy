<?php

/**
 * ECSHOP 管理中心模版相关公用函数库
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: fenghl $
 * $Date: 2008-01-14 17:46:45 +0800 (星期一, 14 一月 2008) $
 * $Id: lib_template.php 13976 2008-01-14 09:46:45Z fenghl $
*/

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

/* 可以设置内容的模板 */
$template_files = array(
    'index.dwt',
    'article.dwt',
    'article_cat.dwt',
    'brand.dwt',
    'catalog.dwt',
    'category.dwt',
    'user_clips.dwt',
    'compare.dwt',
    'gallery.dwt',
    'goods.dwt',
    'group_buy_goods.dwt',
    'group_buy_flow.dwt',
    'group_buy_list.dwt',
    'user_passport.dwt',
    'pick_out.dwt',
    'receive.dwt',
    'respond.dwt',
    'search.dwt',
    'flow.dwt',
    'snatch.dwt',
    'user.dwt',
    'tag_cloud.dwt',
    'user_transaction.dwt',
    'style.css',
    'auction_list.dwt',
    'auction.dwt',
);

/* 每个模板允许设置的库项目 */
$page_libs = array(
    'article' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/recommend_best.lbi' => 3,
        '/library/recommend_hot.lbi' => 3,
        '/library/comments.lbi' => 0,
        '/library/goods_related.lbi' => 0,
        '/library/recommend_promotion.lbi' => 3,
        '/library/history.lbi' => 0,
    ),
    'article_cat' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/history.lbi' => 0,
        '/library/recommend_best.lbi' => 3,
        '/library/recommend_hot.lbi' => 3,
        '/library/recommend_promotion.lbi' => 3,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/vote.lbi' => 0,
        '/library/article_category_tree.lbi' => 0,
    ),
    'brand' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/history.lbi' => 0,
        '/library/recommend_best.lbi' => 3,
        '/library/goods_list.lbi' => 0,
        '/library/pages.lbi' => 0,
        '/library/recommend_promotion.lbi' => 3,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/vote.lbi' => 0,
    ),
    'catalog' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
    ),
    'category' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/history.lbi' => 0,
        '/library/recommend_best.lbi' => 3,
        '/library/recommend_hot.lbi' => 3,
        '/library/goods_list.lbi' => 0,
        '/library/pages.lbi' => 0,
        '/library/recommend_promotion.lbi' => 3,
        '/library/brands.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/vote.lbi' => 0,
        '/library/price_grade.lbi' => 0,
        '/library/filter_attr.lbi' => 0,
    ),
    'compare' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
    ),
    'flow' => array(
        '/library/ur_here.lbi' => 0,
    '/library/search_form.lbi' => 0,
    ),
    'index' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/new_articles.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/invoice_query.lbi' => 0,
        '/library/recommend_best.lbi' => 3,
        '/library/recommend_new.lbi' => 3,
        '/library/recommend_hot.lbi' => 3,
        '/library/recommend_promotion.lbi' => 3,
        '/library/group_buy.lbi' => 3,
        '/library/auction.lbi' => 3,
        '/library/brands.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/order_query.lbi' => 0,
        '/library/email_list.lbi' => 0,
        '/library/vote_list.lbi' => 0
    ),
    'goods' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/goods_attrlinked.lbi' => 0,
        '/library/history.lbi' => 0,
        '/library/goods_fittings.lbi' => 0,
        '/library/goods_gallery.lbi' => 0,
        '/library/goods_tags.lbi' => 0,
        '/library/comments.lbi' => 0,
        '/library/bought_goods.lbi' => 0,
        '/library/goods_related.lbi' => 0,
        '/library/goods_article.lbi' => 0,
    ),
    'search_result' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/search_result.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/search_advanced.lbi' => 0,
        '/library/history.lbi' => 0,
        '/library/pages.lbi' => 0,
    ),
    'tag_cloud' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/history.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/recommend_best.lbi' => 3,
        '/library/recommend_new.lbi' => 3,
        '/library/recommend_hot.lbi' => 3,
        '/library/recommend_promotion.lbi' => 3,
    ),
    'group_buy_goods' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/history.lbi' => 0,
    ),
    'group_buy_list' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/history.lbi' => 0,
    ),
    'search' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/history.lbi' => 0,
    ),
    'snatch' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
    ),
    'auction_list' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/history.lbi' => 0,
    ),
    'auction' => array(
        '/library/ur_here.lbi' => 0,
        '/library/search_form.lbi' => 0,
        '/library/member.lbi' => 0,
        '/library/category_tree.lbi' => 0,
        '/library/promotion_info.lbi' => 0,
        '/library/cart.lbi' => 0,
        '/library/top10.lbi' => 0,
        '/library/history.lbi' => 0,
    ),
);

/* 动态库项目 */
$dyna_libs = array(
    'cat_goods',
    'brand_goods',
    'cat_articles',
    'ad_position',
);

///* 插件的 library */
//$sql = 'SELECT code, library FROM ' . $ecs->table('plugins') . " WHERE assign = 1 AND library > ''";
//$res = $db->query($sql);
//
//while ($row = $db->fetchRow($res))
//{
//    include_once('../plugins/' . $row['code'] . '/languages/common_' . $_CFG['lang'] . '.php');
//
//    $page_libs['index'][] = $row['library'];
//}

/**
 * 获得模版的信息
 *
 * @access  private
 * @param   string      $template_name      模版名
 * @return  array
 */
function get_template_info($template_name)
{
    $info = array();
    $ext  = array('png', 'gif', 'jpg', 'jpeg');

    $info['code']       = $template_name;
    $info['screenshot'] = '';

    foreach ($ext AS $val)
    {
        if (file_exists('../themes/' . $template_name . "/screenshot.$val"))
        {
            $info['screenshot'] = '../themes/' . $template_name . "/screenshot.$val";

            break;
        }
    }

    if (file_exists('../themes/' . $template_name . '/style.css') && !empty($template_name))
    {
        $arr = array_slice(file('../themes/'. $template_name. '/style.css'), 0, 9);

        $template_name      = explode(': ', $arr[1]);
        $template_uri       = explode(': ', $arr[2]);
        $template_desc      = explode(': ', $arr[3]);
        $template_version   = explode(': ', $arr[4]);
        $template_author    = explode(': ', $arr[5]);
        $author_uri         = explode(': ', $arr[6]);
        $logo_filename      = explode(': ', $arr[7]);

        $info['name']       = isset($template_name[1]) ? trim($template_name[1]) : '';
        $info['uri']        = isset($template_uri[1]) ? trim($template_uri[1]) : '';
        $info['desc']       = isset($template_desc[1]) ? trim($template_desc[1]) : '';
        $info['version']    = isset($template_version[1]) ? trim($template_version[1]) : '';
        $info['author']     = isset($template_author[1]) ? trim($template_author[1]) : '';
        $info['author_uri'] = isset($author_uri[1]) ? trim($author_uri[1]) : '';
        $info['logo']       = isset($logo_filename[1]) ? trim($logo_filename[1]) : '';
    }
    else
    {
        $info['name']       = '';
        $info['uri']        = '';
        $info['desc']       = '';
        $info['version']    = '';
        $info['author']     = '';
        $info['author_uri'] = '';
        $info['logo']       = '';
    }

    return $info;
}

/**
 * 获得模版文件中的编辑区域及其内容
 *
 * @access  public
 * @param   string  $tmp_name   模版名称
 * @param   string  $tmp_file   模版文件名称
 * @return  array
 */
function get_template_region($tmp_name, $tmp_file, $lib=true)
{
    global $dyna_libs;

    $file = '../themes/' . $tmp_name . '/' . $tmp_file;

    /* 将模版文件的内容读入内存 */
    $content = file_get_contents($file);

    /* 获得所有编辑区域 */
    static $regions = array();

    if (empty($regions))
    {
        $matches = array();
        $result  = preg_match_all('/(<!--\\s*TemplateBeginEditable\\sname=")([^"]+)("\\s*-->)/', $content, $matches, PREG_SET_ORDER);

        if ($result && $result > 0)
        {
            foreach ($matches AS $key => $val)
            {
                if ($val[2] != 'doctitle' && $val[2] != 'head')
                {
                    $regions[] = $val[2];
                }
            }
        }

    }

    if (!$lib)
    {
        return $regions;
    }

    $libs = array();
    /* 遍历所有编辑区 */
    foreach ($regions AS $key => $val)
    {
        $matches = array();
        $pattern = '/(<!--\\s*TemplateBeginEditable\\sname="%s"\\s*-->)(.*?)(<!--\\s*TemplateEndEditable\\s*-->)/s';

        if (preg_match(sprintf($pattern, $val), $content, $matches))
        {
            /* 找出该编辑区域内所有库项目 */
            $lib_matches = array();

            $result      = preg_match_all('/([\s|\S]{0,20})(<!--\\s#BeginLibraryItem\\s")([^"]+)("\\s-->)/',
                                          $matches[2], $lib_matches, PREG_SET_ORDER);
            $i = 0;
            if ($result && $result > 0)
            {
                foreach ($lib_matches AS $k => $v)
                {
                    $v[3]   = strtolower($v[3]);
                    $libs[] = array('library' => $v[3], 'region' => $val, 'lib'=>basename(substr($v[3], 0, strpos($v[3], '.'))), 'sort_order' => $i);
                    $i++;
                }

            }
        }
    }

    return $libs;
}

/**
 * 将插件library从默认模板中移动到指定模板中
 *
 * @access  public
 * @param   string  $tmp_name   模版名称
 * @param   string  $msg        如果出错，保存错误信息，否则为空
 * @return  Boolen
 */
function move_plugin_library($tmp_name, &$msg)
{
    $sql = 'SELECT code, library FROM ' . $GLOBALS['ecs']->table('plugins') . " WHERE library > ''";
    $rec = $GLOBALS['db']->query($sql);
    $return_value = true;
    $target_dir = ROOT_PATH . 'themes/' . $tmp_name;
    $source_dir = ROOT_PATH . 'themes/' . $GLOBALS['_CFG']['template'];
    while ($row = $GLOBALS['db']->fetchRow($rec))
    {
        //先移动，移动失败试则拷贝
        if (!@rename($source_dir . $row['library'], $target_dir . $row['library']))
        {
            if (!@copy(ROOT_PATH . 'plugins/' . $row['code'] . '/templates' . $row['library'], $target_dir . $row['library']))
            {
                $return_value = false;
                $msg .= "\n moving " . $row['library'] . ' failed';
            }
        }
    }
}

/**
 * 获得指定库项目在模板中的设置内容
 *
 * @access  public
 * @param   string  $lib    库项目
 * @param   array   $libs    包含设定内容的数组
 * @return  void
 */
function get_setted($lib, &$arr)
{
    $options = array('region' => '', 'sort_order' => 0, 'display' => 0);

    foreach ($arr AS $key => $val)
    {
        if ($lib == $val['library'])
        {
            $options['region']     = $val['region'];
            $options['sort_order'] = $val['sort_order'];
            $options['display']    = 1;

            break;
        }
    }

    return $options;
}

?>