<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//api.tp.cc/ ====> api.tp.cc/index.php/api/index/index 
//域名路由
Route::domain('api','api');   

//api.tp.cc/user/2 ====> api.tp.cc/index.php/api/user/index/id/2 
//添加 修改操作
Route::post('user/','user/login'); 
//查
Route::get('code/:time/:token/:username/:is_exist','code/get_code'); 
//删除操作
Route::delete('code/:time/:token/:username/:is_exist','code/delete_code'); 



return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
