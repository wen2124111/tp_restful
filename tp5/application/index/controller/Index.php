<?php
namespace app\index\controller;
use \think\Request;
use \think\Validate;
use \think\Db;
class Index
{
    public function index()
    {
        //Request属于单例模式，不能直接new
        $request = Request::instance();
        echo '请求方法：' . $request->method() . '<br/>';
        echo '资源类型：' . $request->type() . '<br/>';
        echo '访问ip地址：' . $request->ip() . '<br/>';
        echo '是否AJax请求：' . var_export($request->isAjax(), true) . '<br/>';
        echo '请求参数：';
        dump($request->param());
        echo '请求参数：仅包含name';
        dump($request->only(['name']));
        echo '请求参数：排除name';
        dump($request->except(['name']));
     
    }
    public function db(){
        
      $db = Db::query('show tables');
      var_dump($db);

    }
}
