<?php
namespace app\api\controller;

class User extends Common{
    public function index(){
        echo 111;
        $data = $this->params;
        dump($data);
    }

    public function login(){
        $data = $this->params;
        dump($data);
    }

}