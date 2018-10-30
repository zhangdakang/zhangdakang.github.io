<?php
/**
 * @Author: anchen
 * @Date:   2018-10-09 22:54:41
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-10-09 22:55:21
 */
// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../admin/');

//define('VIEW_LAYER','index');
// 开启调试模式
define('APP_DEBUG', true);

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';