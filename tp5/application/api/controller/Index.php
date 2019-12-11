<?php
namespace app\api\controller;
use \think\Request;
use \think\Validate;
use \think\Db;
class Index
{
    public function index()
    {
      echo 'api/index';
     
    }
    public function db(){
        
      $db = Db::query('show tables');
      var_dump($db);

    }
}
