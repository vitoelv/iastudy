<?php

/**
 * ECSHOP 转换程序
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: testyang $
 * $Date: 2008-01-28 19:27:47 +0800 (星期一, 28 一月 2008) $
 * $Id: convert.php 14080 2008-01-28 11:27:47Z testyang $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

/*------------------------------------------------------ */
//-- 转换程序主页面
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'main')
{
    /* 检查权限：只有超级管理员（安装本系统的人）才可以执行此操作 */
    admin_priv('all');

    /* 取得插件文件中的转换程序 */
    $modules = read_modules('../includes/modules/convert');
    for ($i = 0; $i < count($modules); $i++)
    {
        $code = $modules[$i]['code'];
        $lang_file = ROOT_PATH.'languages/' . $_CFG['lang'] . '/convert/' . $code . '.php';
        if (file_exists($lang_file))
        {
            include_once($lang_file);
        }
        $modules[$i]['desc'] = $_LANG[$modules[$i]['desc']];
    }
    $smarty->assign('module_list', $modules);

    /* 设置默认值 */
    $def_val = array(
        'host'      => $db_host,
        'db'        => '',
        'user'      => $db_user,
        'pass'      => $db_pass,
        'prefix'    => 'sdb_',
        'path'      => ''
    );
    $smarty->assign('def_val', $def_val);

    /* 取得字符集数组 */
    $smarty->assign('charset_list', get_charset_list());

    /* 显示模板 */
    $smarty->assign('ur_here', $_LANG['convert']);
    assign_query_info();
    $smarty->display('convert_main.htm');
}

/*------------------------------------------------------ */
//-- 转换前检查
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'check')
{
    /* 检查权限 */
    check_authz_json('all');

    /* 取得参数 */
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;
    $config = $json->decode($_POST['JSON']);

    /* 测试连接数据库 */
    $sdb = new cls_mysql($config->host, $config->user, $config->pass, $config->db);

    /* 检查必需的表是否存在 */
    $sprefix = $config->prefix;
    $config->path = rtrim(str_replace('\\', '/', $config->path), '/');  // 把斜线替换为反斜线，去掉结尾的反斜线
    include_once(ROOT_PATH . 'includes/modules/convert/' . $config->code . '.php');
    $convert = new $config->code($sdb, $sprefix, $config->path);
    $required_table_list = $convert->required_tables();

    $sql = "SHOW TABLES";
    $table_list = $sdb->getCol($sql);

    $diff_arr = array_diff($required_table_list, $table_list);
    if ($diff_arr)
    {
        make_json_error(sprintf($_LANG['table_error'], join(',', $table_list)));
    }

    /* 检查源目录是否存在，是否可读 */
    $dir_list = $convert->required_dirs();
    foreach ($dir_list AS $dir)
    {
        $cur_dir = ($config->path . $dir);
        if (!file_exists($cur_dir) || !is_dir($cur_dir))
        {
            make_json_error(sprintf($_LANG['dir_error'], $cur_dir));
        }

        if (file_mode_info($cur_dir) & 1 != 1)
        {
            make_json_error(sprintf($_LANG['dir_not_readable'], $cur_dir));
        }

        $res = check_files_readable($cur_dir);
        if ($res !== true)
        {
            make_json_error(sprintf($_LANG['file_not_readable'], $res));
        }
    }

    /* 创建图片目录 */
    $img_dir = ROOT_PATH . 'images/' . date('Ym') . '/';
    if (!file_exists($img_dir))
    {
        make_dir($img_dir);
    }

    /* 需要检查可写的目录 */
    $to_dir_list = array(
        ROOT_PATH . 'images/upload/',
        $img_dir,
        ROOT_PATH . 'data/afficheimg/',
        ROOT_PATH . 'cert/'
    );

    /* 检查目的目录是否存在，是否可写 */
    foreach ($to_dir_list AS $to_dir)
    {
        if (!file_exists($to_dir) || !is_dir($to_dir))
        {
            make_json_error(sprintf($_LANG['dir_error'], $to_dir));
        }

        if (file_mode_info($to_dir) & 4 != 4)
        {
            make_json_error(sprintf($_LANG['dir_not_writable'], $to_dir));
        }
    }

    /* 保存配置信息 */
    $_SESSION['convert_config'] = $config;

    /* 包含插件语言文件 */
    include_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/convert/' . $config->code . '.php');

    /* 取得第一步操作 */
    $step = $convert->next_step('');

    /* 返回 */
    make_json_result($step, $_LANG[$step]);
}

/*------------------------------------------------------ */
//-- 转换操作
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'process')
{
    /* 设置执行时间 */
    set_time_limit(0);

    /* 检查权限 */
    check_authz_json('all');

    /* 取得参数 */
    $step = $_POST['step'];

    /* 连接原数据库 */
    $config = $_SESSION['convert_config'];

    $sdb = new cls_mysql($config->host, $config->user, $config->pass, $config->db);
    $sdb->set_mysql_charset($config->charset);

    /* 创建插件对象 */
    include_once(ROOT_PATH . 'includes/modules/convert/' . $config->code . '.php');
    $convert = new $config->code($sdb, $config->prefix, $config->path, $config->charset);

    /* 包含插件语言文件 */
    include_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/convert/' . $config->code . '.php');

    /* 执行步骤 */
    $result = $convert->process($step);
    if ($result !== true)
    {
        make_json_error($result);
    }

    /* 取得下一步操作 */
    $step = $convert->next_step($step);

    /* 返回 */
    make_json_result($step, empty($_LANG[$step]) ? '' : $_LANG[$step]);
}

/**
 * 检查某个目录的文件是否可读（不包括子目录）
 * 前提：$dirname 是目录且存在且可读
 *
 * @param   string  $dirname    目录名：以 / 结尾，以 / 分隔
 * @return  mix     如果所有文件可读，返回true；否则，返回第一个不可读的文件名
 */
function check_files_readable($dirname)
{
    /* 遍历文件，检查文件是否可读 */
    if ($dh = opendir($dirname))
    {
        while (($file = readdir($dh)) !== false)
        {
            if (filetype($dirname . $file) == 'file' && strtolower($file) != 'thumbs.db')
            {
                if (file_mode_info($dirname . $file) & 1 != 1)
                {
                    return $dirname . $file;
                }
            }
        }
        closedir($dh);
    }

    /* 全部可读的返回值 */
    return true;
}

/**
 * 把一个目录的文件复制到另一个目录（不包括子目录）
 * 前提：$from_dir 是目录且存在且可读，$to_dir 是目录且存在且可写
 *
 * @param   string  $from_dir   源目录
 * @param   string  $to_dir     目标目录
 * @param   string  $file_prefix    文件名前缀
 * @return  mix     成功返回true，否则返回第一个失败的文件名
 */
function copy_files($from_dir, $to_dir, $file_prefix = '')
{
    /* 遍历并复制文件 */
    if ($dh = opendir($from_dir))
    {
        while (($file = readdir($dh)) !== false)
        {
            if (filetype($from_dir . $file) == 'file' && strtolower($file) != 'thumbs.db')
            {
                if (!copy($from_dir . $file, $to_dir . $file_prefix . $file))
                {
                    return $from_dir . $file;
                }
            }
        }
        closedir($dh);
    }

    /* 全部复制成功，返回true */
    return true;
}

?>