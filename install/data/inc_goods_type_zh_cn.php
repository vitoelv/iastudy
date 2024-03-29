<?php

/**
 * ECSHOP 安装程序商品类型
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: weberliu $
 * $Date: 2006-08-30 10:18:12 +0800 (星期三, 30 八月 2006) $
 * $Id: inc_goods_type.php 1065 2006-08-30 02:18:12Z weberliu $
*/

$attributes['book'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '作者', 0, 0, '', 0),
                                (NULL, {cat_id}, '出版社', 0, 0, '', 0),
                                (NULL, {cat_id}, '图书书号/ISBN', 0, 0, '', 0),
                                (NULL, {cat_id}, '出版日期', 0, 0, '', 0),
                                (NULL, {cat_id}, '开本', 0, 0, '', 0),
                                (NULL, {cat_id}, '图书页数', 0, 0, '', 0),
                                (NULL, {cat_id}, '图书装订', 1, 0, '平装\r\n黑白', 0),
                                (NULL, {cat_id}, '图书规格', 0, 0, '', 0),
                                (NULL, {cat_id}, '版次', 0, 0, '', 0),
                                (NULL, {cat_id}, '印张', 0, 0, '', 0),
                                (NULL, {cat_id}, '字数', 0, 0, '', 0),
                                (NULL, {cat_id}, '所属分类', 0, 0, '', 0)",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '书', 1);");

$attributes['music'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '中文片名', 0, 0, '', 0),
                                (NULL, {cat_id}, '英文片名', 0, 0, '', 0),
                                (NULL, {cat_id}, '商品别名', 0, 0, '', 0),
                                (NULL, {cat_id}, '介质/格式', 1, 0, 'HDCD\r\nDTS\r\nDVD\r\nDVD9\r\nVCD\r\nCD\r\nTAPE\r\nLP', 0),
                                (NULL, {cat_id}, '片装数', 0, 0, '', 0),
                                (NULL, {cat_id}, '国家地区', 0, 0, '', 0),
                                (NULL, {cat_id}, '语种', 1, 0, '中文\r\n英文\r\n法文\r\n西班牙文', 0),
                                (NULL, {cat_id}, '导演/指挥', 0, 0, '', 0),
                                (NULL, {cat_id}, '主唱', 0, 0, '', 0),
                                (NULL, {cat_id}, '所属类别', 1, 0, '古典\r\n流行\r\n摇滚\r\n乡村\r\n民谣\r\n爵士\r\n蓝调\r\n电子\r\n舞曲\r\n国乐\r\n民族\r\n怀旧\r\n经典\r\n人声\r\n合唱\r\n发烧\r\n试音\r\n儿童\r\n胎教\r\n轻音乐\r\n世界音乐\r\n庆典音乐\r\n影视音乐\r\n新世纪音乐\r\n大自然音乐', 0),
                                (NULL, {cat_id}, '长度', 0, 0, '', 0),
                                (NULL, {cat_id}, '歌词', 1, 0, '有\r\n无', 0),
                                (NULL, {cat_id}, '碟片代码', 0, 0, '', 0),
                                (NULL, {cat_id}, 'ISRC码', 0, 0, '', 0),
                                (NULL, {cat_id}, '发行公司', 0, 0, '', 0),
                                (NULL, {cat_id}, '出版', 0, 0, '', 0),
                                (NULL, {cat_id}, '出版号', 0, 0, '', 0),
                                (NULL, {cat_id}, '引进号', 0, 0, '', 0),
                                (NULL, {cat_id}, '版权号', 0, 0, '', 0);",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '音乐', 1);");

$attributes['movie'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '中文片名', 0, 0, '', 0),
                                (NULL, {cat_id}, '英文片名', 0, 0, '', 0),
                                (NULL, {cat_id}, '商品别名', 0, 0, '', 0),
                                (NULL, {cat_id}, '介质/格式', 1, 0, 'HDCD\r\nDTS\r\nDVD\r\nDVD9\r\nVCD', 0),
                                (NULL, {cat_id}, '碟片类型', 1, 0, '单面\r\n双层', 0),
                                (NULL, {cat_id}, '片装数', 0, 0, '', 0),
                                (NULL, {cat_id}, '国家地区', 0, 0, '', 0),
                                (NULL, {cat_id}, '语种/配音', 1, 0, '中文\r\n英文\r\n法文\r\n西班牙文', 0),
                                (NULL, {cat_id}, '字幕', 0, 0, '', 0),
                                (NULL, {cat_id}, '色彩', 0, 0, '', 0),
                                (NULL, {cat_id}, '中文字幕', 1, 0, '有\r\n无', 0),
                                (NULL, {cat_id}, '导演', 0, 0, '', 0),
                                (NULL, {cat_id}, '表演者', 0, 0, '', 0),
                                (NULL, {cat_id}, '所属类别', 1, 0, '爱情\r\n偶像\r\n生活\r\n社会\r\n科幻\r\n神话\r\n武侠\r\n动作\r\n惊险\r\n恐怖\r\n传奇\r\n人物\r\n侦探\r\n警匪\r\n历史\r\n军事\r\n戏剧\r\n舞台\r\n经典\r\n名著\r\n喜剧\r\n情景\r\n动漫\r\n卡通\r\n儿童\r\n伦理激情', 0),
                                (NULL, {cat_id}, '年份', 0, 0, '', 0),
                                (NULL, {cat_id}, '音频格式', 0, 0, '', 0),
                                (NULL, {cat_id}, '区码', 0, 0, '', 0),
                                (NULL, {cat_id}, '碟片代码', 0, 0, '', 0),
                                (NULL, {cat_id}, 'ISRC码', 0, 0, '', 0),
                                (NULL, {cat_id}, '发行公司', 0, 0, '', 0),
                                (NULL, {cat_id}, '出版 ', 0, 0, '', 0),
                                (NULL, {cat_id}, '出版号', 0, 0, '', 0),
                                (NULL, {cat_id}, '引进号', 0, 0, '', 0),
                                (NULL, {cat_id}, '版权号', 0, 0, '', 0);",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '电影', 1);");

$attributes['mobile'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '网络制式', 0, 0, '', 0),
                                (NULL, {cat_id}, '支持频率/网络频率', 0, 0, '', 0),
                                (NULL, {cat_id}, '尺寸体积', 1, 0, '   ', 0),
                                (NULL, {cat_id}, '外观样式/手机类型', 1, 0, '翻盖\r\n滑盖\r\n直板\r\n折叠\r\n手写', 0),
                                (NULL, {cat_id}, '主屏参数/内屏参数', 0, 0, '', 0),
                                (NULL, {cat_id}, '副屏参数/外屏参数', 0, 0, '', 0),
                                (NULL, {cat_id}, '清晰度', 0, 0, '', 0),
                                (NULL, {cat_id}, '色数/灰度', 1, 0, '   ', 0),
                                (NULL, {cat_id}, '长度', 0, 0, '', 0),
                                (NULL, {cat_id}, '宽度', 0, 0, '', 0),
                                (NULL, {cat_id}, '厚度', 0, 0, '', 0),
                                (NULL, {cat_id}, '屏幕材质', 0, 0, '', 0),
                                (NULL, {cat_id}, '内存容量', 0, 0, '', 0),
                                (NULL, {cat_id}, '操作系统', 0, 0, '', 0),
                                (NULL, {cat_id}, '通话时间', 0, 0, '', 0),
                                (NULL, {cat_id}, '待机时间', 0, 0, '', 0),
                                (NULL, {cat_id}, '标准配置', 0, 0, '', 0),
                                (NULL, {cat_id}, 'WAP上网', 0, 0, '', 0),
                                (NULL, {cat_id}, '数据业务', 0, 0, '', 0),
                                (NULL, {cat_id}, '天线位置', 1, 0, '内置\r\n外置', 0),
                                (NULL, {cat_id}, '随机配件', 0, 0, '', 0),
                                (NULL, {cat_id}, '铃声', 0, 0, '', 0),
                                (NULL, {cat_id}, '摄像头', 0, 0, '', 0),
                                (NULL, {cat_id}, '彩信/彩e', 1, 0, '支持\r\n不支持', 0),
                                (NULL, {cat_id}, '红外/蓝牙', 0, 0, '', 0),
                                (NULL, {cat_id}, '价格等级', 1, 0, '高价机\r\n中价机\r\n低价机', 0);",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '手机', 1);");

$attributes['notebook'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '型号', 0, 0, '', 0),
                                (NULL, {cat_id}, '详细规格', 0, 0, '', 0),
                                (NULL, {cat_id}, '笔记本尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '处理器类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '处理器最高主频', 0, 0, '', 0),
                                (NULL, {cat_id}, '二级缓存', 0, 0, '', 0),
                                (NULL, {cat_id}, '系统总线', 0, 0, '', 0),
                                (NULL, {cat_id}, '主板芯片组', 0, 0, '', 0),
                                (NULL, {cat_id}, '内存容量', 0, 0, '', 0),
                                (NULL, {cat_id}, '内存类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '硬盘', 0, 0, '', 0),
                                (NULL, {cat_id}, '屏幕尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '显示芯片', 0, 0, '', 0),
                                (NULL, {cat_id}, '标称频率', 0, 0, '', 0),
                                (NULL, {cat_id}, '显卡显存', 0, 0, '', 0),
                                (NULL, {cat_id}, '显卡类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '光驱类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '电池容量', 0, 0, '', 0),
                                (NULL, {cat_id}, '其他配置', 0, 0, '', 0);",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '笔记本电脑', 1);");

$attributes['dc'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '最大像素/总像素  ', 0, 0, '', 0),
                                (NULL, {cat_id}, '有效像素', 1, 0, '  ', 0),
                                (NULL, {cat_id}, '光学变焦倍数', 0, 0, '', 0),
                                (NULL, {cat_id}, '数字变焦倍数', 0, 0, '', 0),
                                (NULL, {cat_id}, '操作模式', 0, 0, '', 0),
                                (NULL, {cat_id}, '显示屏类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '显示屏尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '感光器件', 0, 0, '', 0),
                                (NULL, {cat_id}, '感光器件尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '最高分辨率', 0, 0, '', 0),
                                (NULL, {cat_id}, '图像分辨率', 0, 0, '', 0),
                                (NULL, {cat_id}, '传感器类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '传感器尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '镜头', 0, 0, '', 0),
                                (NULL, {cat_id}, '光圈', 0, 0, '', 0),
                                (NULL, {cat_id}, '焦距', 0, 0, '', 0),
                                (NULL, {cat_id}, '旋转液晶屏', 1, 0, '支持\r\n不支持', 0),
                                (NULL, {cat_id}, '存储介质', 0, 0, '', 0),
                                (NULL, {cat_id}, '存储卡', 1, 0, '  记录媒体\r\n存储卡容量', 0),
                                (NULL, {cat_id}, '影像格式', 1, 0, '    静像\r\n动画', 0),
                                (NULL, {cat_id}, '曝光控制', 0, 0, '', 0),
                                (NULL, {cat_id}, '曝光模式', 0, 0, '', 0),
                                (NULL, {cat_id}, '曝光补偿', 0, 0, '', 0),
                                (NULL, {cat_id}, '白平衡', 0, 0, '', 0),
                                (NULL, {cat_id}, '连拍', 0, 0, '', 0),
                                (NULL, {cat_id}, '快门速度', 0, 0, '', 0),
                                (NULL, {cat_id}, '闪光灯', 1, 0, '内置\r\n外置', 0),
                                (NULL, {cat_id}, '拍摄范围', 1, 0, '  ', 0),
                                (NULL, {cat_id}, '自拍定时器', 0, 0, '', 0),
                                (NULL, {cat_id}, 'ISO感光度', 0, 0, '', 0),
                                (NULL, {cat_id}, '测光模式', 0, 0, '', 0),
                                (NULL, {cat_id}, '场景模式', 0, 0, '', 0),
                                (NULL, {cat_id}, '短片拍摄', 0, 0, '', 0),
                                (NULL, {cat_id}, '外接接口', 0, 0, '', 0),
                                (NULL, {cat_id}, '电源', 0, 0, '', 0),
                                (NULL, {cat_id}, '电池使用时间', 0, 0, '', 0),
                                (NULL, {cat_id}, '外形尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '标配软件', 0, 0, '', 0),
                                (NULL, {cat_id}, '标准配件', 0, 0, '', 0),
                                (NULL, {cat_id}, '兼容操作系统', 0, 0, '', 0);",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '数码相机', 1);");

$attributes['dv'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '编号', 0, 0, '', 0),
                                (NULL, {cat_id}, '类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '外型尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '最大像素数', 0, 0, '', 0),
                                (NULL, {cat_id}, '光学变焦倍数', 0, 0, '', 0),
                                (NULL, {cat_id}, '数字变焦倍数', 0, 0, '', 0),
                                (NULL, {cat_id}, '显示屏尺寸及类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '感光器件', 0, 0, '', 0),
                                (NULL, {cat_id}, '感光器件尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '感光器件数量', 0, 0, '', 0),
                                (NULL, {cat_id}, '像素范围', 0, 0, '', 0),
                                (NULL, {cat_id}, '传感器数量', 0, 0, '', 0),
                                (NULL, {cat_id}, '传感器尺寸', 0, 0, '', 0),
                                (NULL, {cat_id}, '水平清晰度', 0, 0, '', 0),
                                (NULL, {cat_id}, '取景器', 0, 0, '', 0),
                                (NULL, {cat_id}, '数码效果', 0, 0, '', 0),
                                (NULL, {cat_id}, '镜头性能', 0, 0, '', 0),
                                (NULL, {cat_id}, '对焦方式', 0, 0, '', 0),
                                (NULL, {cat_id}, '曝光控制', 0, 0, '', 0),
                                (NULL, {cat_id}, '其他接口', 0, 0, '', 0),
                                (NULL, {cat_id}, '随机存储', 0, 0, '', 0),
                                (NULL, {cat_id}, '电池类型', 0, 0, '', 0),
                                (NULL, {cat_id}, '电池供电时间', 0, 0, '', 0);",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '数码摄像机', 1);");

$attributes['cosmetics'] = array("attr"=>"INSERT INTO `".$prefix."attribute` (`attr_id`, `cat_id`, `attr_name`, `attr_input_type`, `attr_type`, `attr_values`, `sort_order`) VALUES
                                (NULL, {cat_id}, '产地', 0, 0, '', 0),
                                (NULL, {cat_id}, '产品规格/容量', 0, 0, '', 0),
                                (NULL, {cat_id}, '主要原料', 0, 0, '', 0),
                                (NULL, {cat_id}, '所属类别', 1, 0, '彩妆\r\n化妆工具\r\n护肤品\r\n香水', 0),
                                (NULL, {cat_id}, '使用部位', 0, 0, '', 0),
                                (NULL, {cat_id}, '适合肤质', 1, 0, '油性\r\n中性\r\n干性', 0),
                                (NULL, {cat_id}, '适用人群', 1, 0, '女性\r\n男性', 0);",
                        "cat"=>"INSERT INTO `".$prefix."goods_type` (`cat_id`, `cat_name`, `enabled`) VALUES (NULL, '化妆品', 1);");

?>
