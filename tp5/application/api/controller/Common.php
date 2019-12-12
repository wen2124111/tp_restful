<?php

namespace app\api\controller;

use think\Request;
use think\Controller;
use think\Validate;

/**
 * Common
 * @param $model  模块名称 Common
 * 类的注释必须卸载定义Class 关键字的前面
 */

class Common extends Controller
{
  protected $_request; //处理参数a
  protected $_validater; //验证请求参数
  protected $_params; //复核要求的参数
  protected $_rules = array(
    'User' => array(
      'login' => array(
        'user_name' => ['require', 'chsDash', 'max' => 20],
        'user_pwd' => 'require|length:32'
      ),
      'index' => array(
        'kk' => ['require', 'max' => 3],
      ),
    ),
    'Code' => array(
      'get_code' => array(
        'username' => ['require'],
      ),
    ),
  );
  //初始化
  protected function _initialize()
  {

    parent::_initialize();
    $this->_request = Request::instance();
    // //验证时间戳
    // $this->check_time($this->_request->only(['time']));
    // //验证token
    // $this->check_token($this->_request->param());
    //验证参数
    $this->check_params($this->_request->except(['time', 'token']));
  }


  /**
   * 验证请求是否超时
   * @param [array] $arr  [包含时间戳的参数数组]
   * @return json  [检测结果]
   * @throws ReflectionException
   * 格式：   /**
   * @name 增加权限
   */

  public function check_time($arr)
  {

    if (!isset($arr['time']) || intval($arr['time'] <= 1)) {
      $this->return_msg(400, '时间戳错误!');
    }
    if (time() - intval($arr['time']) > 60) {
      $this->return_msg(400, '请求超时!');
    }
  }

  /**
   * 验证TOKEN
   * @param [array] $arr  [请求参数]
   * @return json  [检测结果]
   * @throws ReflectionException
   * 格式：   /**
   * @name 增加权限
   */
  public function check_token($arr)
  {
    if (!isset($arr['token']) || empty($arr['token'])) {
      $this->return_msg(400, 'token错误!');
    }
    $app_token = $arr['token']; //api请求的tokne
    unset($arr['token']);
    $service_token = '';
    foreach ($arr as $key => $value) {
      $service_token .= md5($value);
    }
    $service_token = md5('api_' . $service_token . '_api'); //服务器生成的token
    // dump($service_token);die;

    //token校验

    if ($app_token !== $service_token) {
      $this->return_msg(400, 'token值不正确!');
    }
  }

  /**
   * 验证请求参数
   * @param [array] $arr  [请求参数]
   * @return json  [检测结果]
   * @throws ReflectionException
   * 格式：   /**
   * @name 增加权限
   */
  public function check_params($arr)
  {
    $rule = $this->_rules[$this->request->controller()][$this->request->action()];
    //验证参数
  
    $this->_validater = new Validate($rule);
    if (!$this->_validater->check($arr)) {

      $this->return_msg(400, $this->_validater->getError());
    }
  
    $this->params = $arr;
  }

  public function return_msg($code, $msg = '', $data = [])
  {
    //组合数据
    $return_data['code'] = $code;
    $return_data['msg'] = $msg;
    $return_data['data'] = $data;
    echo json_encode($return_data);
    die;
  }
}
