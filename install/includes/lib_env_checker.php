<?php

/**
 * ECSHOP 系统环境检测函数库
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: paulgao $
 * $Date: 2007-01-30 15:37:32 +0800 (星期二, 30 一月 2007) $
 * $Id: index.php 4749 2007-01-30 07:37:32Z paulgao $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

/**
 * 检查目录的读写权限
 *
 * @access  public
 * @param   array     $checking_dirs     目录列表
 * @return  array     检查后的消息数组，
 *    成功格式形如array('result' => 'OK', 'detail' => array(array($dir, $_LANG['can_write']), array(), ...))
 *    失败格式形如array('result' => 'ERROR', 'd etail' => array(array($dir, $_LANG['cannt_write']), array(), ...))
 */
function check_dirs_priv($checking_dirs)
{
    include_once(ROOT_PATH . 'includes/lib_common.php');

    global $_LANG;
    $msgs = array('result' => 'OK', 'detail' => array());

    foreach ($checking_dirs AS $dir)
    {
        if (!file_exists(ROOT_PATH . $dir))
        {
            $msgs['result'] = 'ERROR';
            $msgs['detail'][] = array($dir, $_LANG['not_exists']);
            continue;
        }

        if (file_mode_info(ROOT_PATH . $dir) < 2)
        {
            $msgs['result'] = 'ERROR';
            $msgs['detail'][] = array($dir, $_LANG['cannt_write']);
        }
        else
        {
            $msgs['detail'][] = array($dir, $_LANG['can_write']);
        }
    }

    return $msgs;
}

/**
 * 检查模板的读写权限
 *
 * @access  public
 * @param   array      $templates_root        模板文件类型所在的根路径数组，形如：array('dwt'=>'', 'lbi'=>'')
 * @return  array      检查后的消息数组，全部可写为空数组，否则是一个以不可写的文件路径组成的数组
 */
function check_templates_priv($templates_root)
{
    global $_LANG;

    $msgs = array();
    $filename = '';
    $filepath = '';

    foreach ($templates_root as $tpl_type => $tpl_root)
    {
        if (!file_exists($tpl_root))
        {
            $msgs[] = str_replace(ROOT_PATH, '', $tpl_root . ' ' . $_LANG['not_exists']);
            continue;
        }

        $tpl_handle = @opendir($tpl_root);
        while (($filename = @readdir($tpl_handle)) !== false)
        {
            $filepath = $tpl_root . $filename;
            if (is_file($filepath)
                    && strrpos($filename, '.' . $tpl_type) !== false
                    && file_mode_info($filepath) < 7)
            {
                $msgs[] = str_replace(ROOT_PATH, '', $filepath . ' ' . $_LANG['cannt_write']);
            }
        }
        @closedir($tpl_handle);
    }

    return $msgs;
}

/**
 *  检查特定目录是否有执行rename函数权限
 *
 * @access  public
 * @param   void
 *
 * @return void
 */
function check_rename_priv()
{
    /* 获取要检查的目录 */
    $dir_list   = array();
    $dir_list[] = 'templates/caches';
    $dir_list[] = 'templates/compiled';
    $dir_list[] = 'templates/compiled/admin';
    /* 获取images目录下图片目录 */
    $folder = opendir(ROOT_PATH . 'images');
    while ($dir = readdir($folder))
    {
        if (is_dir(ROOT_PATH . 'images/' . $dir) && preg_match('/^[0-9]{6}$/', $dir))
        {
            $dir_list[] = 'images/' . $dir;
        }
    }
    closedir($folder);
    /* 检查目录是否有执行rename函数的权限 */
    $msgs = array();
    foreach ($dir_list AS $dir)
    {
        $mask = file_mode_info(ROOT_PATH .$dir);
        if ((($mask & 2) > 0 ) && (($mask & 8) < 1))
        {
            /* 只有可写时才检查rename权限 */
            $msgs[] = $dir . ' ' . $GLOBALS['_LANG']['cannt_modify'];
        }
    }
    return $msgs;
}

?>