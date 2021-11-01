<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],

    'index'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Index', 'Ad','Login'],
        'model'      => ['Category'],
        'view'       => [
            'index/index',
            'ad/index',
            'login/index',
        ],
    ],

    'admin'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Index', 'Ad','Login','Category','Goods'],
        'model'      => ['Category'],
        'view'       => [
            'index/index',
            'ad/index',
            'login/index',
            'category/index',
            'goods/index',
            'goods/content',
            'goods/add',
            'goods/edit',
            'goods/addimg'
        ],
    ],
    
];
