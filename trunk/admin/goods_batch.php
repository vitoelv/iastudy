<?php
/**
 * ECSHOP 商品批量上传、修改
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 18:33:06 +0800 (星期一, 28 一月 2008) $
 * $Id: goods_batch.php 14079 2008-01-28 10:33:06Z testyang $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require('includes/lib_goods.php');

/*------------------------------------------------------ */
//-- 批量上传
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'add')
{
    /* 检查权限 */
    admin_priv('goods_manage');

    /* 取得分类列表 */
    $smarty->assign('cat_list', cat_list());

    /* 取得可选语言 */
    $dir = opendir('../languages');
    $lang_list = array(
        'UTF8'      => $_LANG['charset']['utf8'],
        'GB2312'    => $_LANG['charset']['zh_cn'],
        'BIG5'      => $_LANG['charset']['zh_tw'],
    );
    $download_list = array();
    while (@$file = readdir($dir))
    {
        if ($file != '.' && $file != '..' && $file != ".svn" && $file != "_svn" && is_dir('../languages/' .$file) == true)
        {
            $download_list[$file] = sprintf($_LANG['download_file'], isset($_LANG['charset'][$file]) ? $_LANG['charset'][$file] : $file);
        }
    }
    @closedir($dir);
    $smarty->assign('lang_list',     $lang_list);
    $smarty->assign('download_list', $download_list);

    /* 参数赋值 */
    $ur_here = $_LANG['13_batch_add'];
    $smarty->assign('ur_here', $ur_here);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_add.htm');
}

/*------------------------------------------------------ */
//-- 批量上传：处理
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'upload')
{
    /* 检查权限 */
    admin_priv('goods_manage');

    /* 将文件按行读入数组，逐行进行解析 */
    $line_number = 0;
    $goods_list = array();
    $field_list = array_keys($_LANG['upload_goods']); // 字段列表
    $data = file($_FILES['file']['tmp_name']);
    foreach ($data AS $line)
    {
        // 跳过第一行
        if ($line_number == 0)
        {
            $line_number++;
            continue;
        }

        // 转换编码
        if ($_POST['charset'] != 'UTF8')
        {
            $line = ecs_iconv($_POST['charset'], 'UTF8', $line);
        }

        // 初始化
        $arr    = array();
        $buff   = '';
        $quote  = 0;
        $len    = strlen($line);
        for ($i = 0; $i < $len; $i++)
        {
            $char = $line[$i];

            if ('\\' == $char)
            {
                $i++;
                $char = $line[$i];

                switch ($char)
                {
                    case '"':
                        $buff .= '"';
                        break;
                    case '\'':
                        $buff .= '\'';
                        break;
                    case ',';
                        $buff .= ',';
                        break;
                    default:
                        $buff .= '\\' . $char;
                        break;
                }
            }
            elseif ('"' == $char)
            {
                if (0 == $quote)
                {
                    $quote++;
                }
                else
                {
                    $quote = 0;
                }
            }
            elseif (',' == $char)
            {
                if (0 == $quote)
                {
                    if (!isset($field_list[count($arr)]))
                    {
                        continue;
                    }
                    $field_name = $field_list[count($arr)];
                    $arr[$field_name] = trim($buff);
                    $buff = '';
                    $quote = 0;
                }
                else
                {
                    $buff .= $char;
                }
            }
            else
            {
                $buff .= $char;
            }

            if ($i == $len - 1)
            {
                if (!isset($field_list[count($arr)]))
                {
                    continue;
                }
                $field_name = $field_list[count($arr)];
                $arr[$field_name] = trim($buff);
            }
        }
        $goods_list[] = $arr;
    }

    $smarty->assign('goods_class', $_LANG['g_class']);
    $smarty->assign('goods_list', $goods_list);

    // 字段名称列表
    $smarty->assign('title_list', $_LANG['upload_goods']);

    // 显示的字段列表
    $smarty->assign('field_show', array('goods_name' => true, 'goods_sn' => true, 'brand_name' => true, 'market_price' => true, 'shop_price' => true));

    /* 参数赋值 */
    $smarty->assign('ur_here', $_LANG['goods_upload_confirm']);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_confirm.htm');
}

/*------------------------------------------------------ */
//-- 批量上传：入库
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'insert')
{
    /* 检查权限 */
    admin_priv('goods_manage');

    if (isset($_POST['checked']))
    {
        include_once(ROOT_PATH . 'includes/cls_image.php');
        $image = new cls_image($_CFG['bgcolor']);

        /* 字段默认值 */
        $default_value = array(
            'brand_id'      => 0,
            'goods_number'  => 0,
            'goods_weight'  => 0,
            'market_price'  => 0,
            'shop_price'    => 0,
            'warn_number'   => 0,
            'is_real'       => 1,
            'is_on_sale'    => 1,
            'is_alone_sale' => 1,
            'integral'      => 0,
            'is_best'       => 0,
            'is_new'        => 0,
            'is_hot'        => 0,
            'goods_type'    => 0,
        );

        /* 查询品牌列表 */
        $brand_list = array();
        $sql = "SELECT brand_id, brand_name FROM " . $ecs->table('brand');
        $res = $db->query($sql);
        while ($row = $db->fetchRow($res))
        {
            $brand_list[$row['brand_name']] = $row['brand_id'];
        }

        /* 字段列表 */
        $field_list = array_keys($_LANG['upload_goods']);
        $field_list[] = 'goods_class'; //实体或虚拟商品

        /* 获取商品good id */
        $max_id = $db->getOne("SELECT MAX(goods_id) + 1 FROM ".$ecs->table('goods'));

        /* 循环插入商品数据 */
        foreach ($_POST['checked'] AS $key => $value)
        {
            // 合并
            $field_arr = array(
                'cat_id'        => $_POST['cat'],
                'add_time'      => gmtime(),
                'last_update'   => gmtime(),
            );

            foreach ($field_list AS $field)
            {
                // 转换编码
                $field_value = isset($_POST[$field][$value]) ? $_POST[$field][$value] : '';

                /* 虚拟商品处理 */
                if ($field == 'goods_class')
                {
                    $field_value = intval($field_value);
                    if ($field_value == G_CARD)
                    {
                        $field_arr['extension_code'] = 'virtual_card';
                    }
                    continue;
                }

                // 如果字段值为空，且有默认值，取默认值
                $field_arr[$field] = !isset($field_value) && isset($default_value[$field]) ? $default_value[$field] : $field_value;

                // 特殊处理
                if (!empty($field_value))
                {
                    // 图片路径
                    if (in_array($field, array('original_img', 'goods_img', 'goods_thumb')))
                    {
                        $field_arr[$field] = 'images/' . $field_value;
                    }
                    // 品牌
                    elseif ($field == 'brand_name')
                    {
                        if (isset($brand_list[$field_value]))
                        {
                            $field_arr['brand_id'] = $brand_list[$field_value];
                        }
                        else
                        {
                            $sql = "INSERT INTO " . $ecs->table('brand') . " (brand_name) VALUES ('" . addslashes($field_value) . "')";
                            $db->query($sql);
                            $brand_id = $db->insert_id();
                            $brand_list[$field_value] = $brand_id;
                            $field_arr['brand_id'] = $brand_id;
                        }
                    }
                    // 整数型
                    elseif (in_array($field, array('goods_number', 'warn_number', 'integral')))
                    {
                        $field_arr[$field] = intval($field_value);
                    }
                    // 数值型
                    elseif (in_array($field, array('goods_weight', 'market_price', 'shop_price')))
                    {
                        $field_arr[$field] = floatval($field_value);
                    }
                    // bool型
                    elseif (in_array($field, array('is_best', 'is_new', 'is_hot', 'is_on_sale', 'is_alone_sale', 'is_real')))
                    {
                        $field_arr[$field] = intval($field_value) > 0 ? 1 : 0;
                    }
                }
                if ($field == 'is_real')
                {
                    $field_arr[$field] = intval($_POST['goods_class'][$key]);
                }
            }

            if (empty($field_arr['goods_sn']))
            {
                $field_arr['goods_sn'] = generate_goods_sn($max_id);
            }

            /* 如果是虚拟商品，库存为0 */
            if ($field_arr['is_real'] == 0)
            {
                $field_arr['goods_number'] = 0;
            }
            $db->autoExecute($ecs->table('goods'), $field_arr, 'INSERT');

            $max_id = $db->insert_id() + 1;

            /* 插入商品相册：如果图片不为空 */
            if (!empty($field_arr['original_img']) || !empty($field_arr['goods_img']) || !empty($field_arr['goods_thumb']))
            {
                $goods_gallery = array();
                $goods_gallery['goods_id'] = $db->insert_id();
                if (!empty($field_arr['original_img']))
                {
                    $ext = substr($field_arr['original_img'], strrpos($field_arr['original_img'], '.'));
                    $goods_gallery['img_original'] = dirname($field_arr['original_img']) . '/' . $image->random_filename() . $ext;
                    @copy(ROOT_PATH . $field_arr['original_img'], ROOT_PATH . $goods_gallery['img_original']);
                }
                if (!empty($field_arr['goods_img']))
                {
                    $ext = substr($field_arr['goods_img'], strrpos($field_arr['goods_img'], '.'));
                    $goods_gallery['img_url'] = dirname($field_arr['goods_img']) . '/' . $image->random_filename() . $ext;
                    @copy(ROOT_PATH . $field_arr['goods_img'], ROOT_PATH . $goods_gallery['img_url']);
                }
                if (!empty($field_arr['goods_thumb']))
                {
                    $ext = substr($field_arr['goods_thumb'], strrpos($field_arr['goods_thumb'], '.'));
                    $goods_gallery['thumb_url'] = dirname($field_arr['goods_thumb']) . '/' . $image->random_filename() . $ext;
                    @copy(ROOT_PATH . $field_arr['goods_thumb'], ROOT_PATH . $goods_gallery['thumb_url']);
                }
                $db->autoExecute($ecs->table('goods_gallery'), $goods_gallery, 'INSERT');
            }
        }
    }

    // 记录日志
    admin_log('', 'batch_upload', 'goods');

    /* 显示提示信息，返回商品列表 */
    $link[] = array('href' => 'goods.php?act=list', 'text' => $_LANG['01_goods_list']);
    sys_msg($_LANG['batch_upload_ok'], 0, $link);
}

/*------------------------------------------------------ */
//-- 批量修改：选择商品
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'select')
{
    /* 检查权限 */
    admin_priv('goods_manage');

    /* 取得分类列表 */
    $smarty->assign('cat_list', cat_list());

    /* 取得品牌列表 */
    $smarty->assign('brand_list', get_brand_list());

    /* 参数赋值 */
    $ur_here = $_LANG['14_batch_edit'];
    $smarty->assign('ur_here', $ur_here);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_select.htm');
}

/*------------------------------------------------------ */
//-- 批量修改：修改
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'edit')
{
    /* 检查权限 */
    admin_priv('goods_manage');

    /* 取得商品列表 */
    if ($_POST['select_method'] == 'cat')
    {
        $where = " WHERE goods_id " . db_create_in($_POST['goods_ids']);
    }
    else
    {
        $goods_sns = str_replace("\n", ',', str_replace("\r", '', $_POST['sn_list']));
        $sql = "SELECT DISTINCT goods_id FROM " . $ecs->table('goods') .
                " WHERE goods_sn " . db_create_in($goods_sns);
        $goods_ids = join(',', $db->getCol($sql));
        $where = " WHERE goods_id " . db_create_in($goods_ids);
    }
    $sql = "SELECT DISTINCT goods_id, goods_sn, goods_name, market_price, shop_price, goods_number, integral, give_integral, brand_id, is_real FROM " . $ecs->table('goods') . $where;
    $smarty->assign('goods_list', $db->getAll($sql));

    /* 取得会员价格 */
    $member_price_list = array();
    $sql = "SELECT DISTINCT goods_id, user_rank, user_price FROM " . $ecs->table('member_price') . $where;
    $res = $db->query($sql);
    while ($row = $db->fetchRow($res))
    {
        $member_price_list[$row['goods_id']][$row['user_rank']] = $row['user_price'];
    }
    $smarty->assign('member_price_list', $member_price_list);

    /* 取得会员等级 */
    $sql = "SELECT rank_id, rank_name, discount " .
            "FROM " . $ecs->table('user_rank') .
            " ORDER BY discount DESC";
    $smarty->assign('rank_list', $db->getAll($sql));

    /* 取得品牌列表 */
    $smarty->assign('brand_list', get_brand_list());

    /* 赋值编辑方式 */
    $smarty->assign('edit_method', $_POST['edit_method']);

    /* 参数赋值 */
    $ur_here = $_LANG['14_batch_edit'];
    $smarty->assign('ur_here', $ur_here);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_edit.htm');
}

/*------------------------------------------------------ */
//-- 批量修改：提交
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'update')
{
    /* 检查权限 */
    admin_priv('goods_manage');

    if ($_POST['edit_method'] == 'each')
    {
        // 循环更新每个商品
        if (!empty($_POST['goods_id']))
        {
            foreach ($_POST['goods_id'] AS $goods_id)
            {
                // 更新商品
                $goods = array(
                    'market_price'  => floatval($_POST['market_price'][$goods_id]),
                    'shop_price'    => floatval($_POST['shop_price'][$goods_id]),
                    'integral'      => intval($_POST['integral'][$goods_id]),
                    'give_integral'      => intval($_POST['give_integral'][$goods_id]),
                    'goods_number'  => intval($_POST['goods_number'][$goods_id]),
                    'brand_id'      => intval($_POST['brand_id'][$goods_id]),
                    'last_update'   => gmtime(),
                );
                $db->autoExecute($ecs->table('goods'), $goods, 'UPDATE', "goods_id = '$goods_id'");

                // 更新会员价格
                if (!empty($_POST['rank_id']))
                {
                    foreach ($_POST['rank_id'] AS $rank_id)
                    {
                        if (trim($_POST['member_price'][$goods_id][$rank_id]) == '')
                        {
                            /* 为空时不做处理 */
                            continue;
                        }

                        $rank = array(
                            'goods_id'  => $goods_id,
                            'user_rank' => $rank_id,
                            'user_price'=> floatval($_POST['member_price'][$goods_id][$rank_id]),
                        );
                        $sql = "SELECT COUNT(*) FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'";
                        if ($db->getOne($sql) > 0)
                        {
                            if ($rank['user_price'] < 0)
                            {
                                $db->query("DELETE FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'");
                            }
                            else
                            {
                                $db->autoExecute($ecs->table('member_price'), $rank, 'UPDATE', "goods_id = '$goods_id' AND user_rank = '$rank_id'");
                            }

                        }
                        else
                        {
                            if ($rank['user_price'] >= 0)
                            {
                                $db->autoExecute($ecs->table('member_price'), $rank, 'INSERT');
                            }
                        }
                    }
                }
            }
        }
    }
    else
    {
        // 循环更新每个商品
        if (!empty($_POST['goods_id']))
        {
            foreach ($_POST['goods_id'] AS $goods_id)
            {
                // 更新商品
                $goods = array();
                if (trim($_POST['market_price'] != ''))
                {
                    $goods['market_price'] = floatval($_POST['market_price']);
                }
                if (trim($_POST['shop_price']) != '')
                {
                    $goods['shop_price'] = floatval($_POST['shop_price']);
                }
                if (trim($_POST['integral']) != '')
                {
                    $goods['integral'] = intval($_POST['integral']);
                }
                if (trim($_POST['give_integral']) != '')
                {
                    $goods['give_integral'] = intval($_POST['give_integral']);
                }
                if (trim($_POST['goods_number']) != '')
                {
                    $goods['goods_number'] = intval($_POST['goods_number']);
                }
                if ($_POST['brand_id'] > 0)
                {
                    $goods['brand_id'] = $_POST['brand_id'];
                }
                if (!empty($goods))
                {
                    $db->autoExecute($ecs->table('goods'), $goods, 'UPDATE', "goods_id = '$goods_id'");
                }

                // 更新会员价格
                if (!empty($_POST['rank_id']))
                {
                    foreach ($_POST['rank_id'] AS $rank_id)
                    {
                        if (trim($_POST['member_price'][$rank_id]) != '')
                        {
                            $rank = array(
                                        'goods_id'  => $goods_id,
                                        'user_rank' => $rank_id,
                                        'user_price'=> floatval($_POST['member_price'][$rank_id]),
                                        );

                            $sql = "SELECT COUNT(*) FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'";
                            if ($db->getOne($sql) > 0)
                            {
                                if ($rank['user_price'] < 0)
                                {
                                    $db->query("DELETE FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'");
                                }
                                else
                                {
                                    $db->autoExecute($ecs->table('member_price'), $rank, 'UPDATE', "goods_id = '$goods_id' AND user_rank = '$rank_id'");
                                }

                            }
                            else
                            {
                                if ($rank['user_price'] >= 0)
                                {
                                    $db->autoExecute($ecs->table('member_price'), $rank, 'INSERT');
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // 记录日志
    admin_log('', 'batch_edit', 'goods');

    // 提示成功
    $link[] = array('href' => 'goods_batch.php?act=select', 'text' => $_LANG['14_batch_edit']);
    sys_msg($_LANG['batch_edit_ok'], 0, $link);
}

/*------------------------------------------------------ */
//-- 下载文件
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'download')
{
    /* 检查权限 */
    admin_priv('goods_manage');

    // 文件标签
    Header("Content-type: application/octet-stream");
    Header("Content-Disposition: attachment; filename=goods_list.csv");

    // 下载
    if ($_GET['charset'] != $_CFG['lang'])
    {
        $lang_file = '../languages/' . $_GET['charset'] . '/admin/goods_batch.php';
        if (file_exists($lang_file))
        {
            unset($_LANG['upload_goods']);
            require($lang_file);
        }
    }
    if (isset($_LANG['upload_goods']))
    {
        /* 创建字符集转换对象 */
        if ($_GET['charset'] == 'zh_cn' || $_GET['charset'] == 'zh_tw')
        {
            $to_charset = $_GET['charset'] == 'zh_cn' ? 'GB2312' : 'BIG5';
            echo ecs_iconv('UTF8', $to_charset, join(',', $_LANG['upload_goods']));
        }
        else
        {
            echo join(',', $_LANG['upload_goods']);
        }
    }
    else
    {
        echo 'error: $_LANG[upload_goods] not exists';
    }
}

/*------------------------------------------------------ */
//-- 取得商品
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'get_goods')
{
    $filter = &new stdclass;

    $filter->cat_id = intval($_GET['cat_id']);
    $filter->brand_id = intval($_GET['brand_id']);
    $filter->real_goods = -1;
    $arr = get_goods_list($filter);

    make_json_result($arr);
}

?>