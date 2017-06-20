<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台首页控制器
 *
 * @package     CI
 * @subpackage  Controllers
 * @category    Controllers
 * @author      jinjunming
 * @link        
 */
class Home extends MY_Controller{
    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct(){
        parent::__construct();
    }
    /**
     * 后台默认首页
     *
     * @access  public
     * @return  void
     */
    public function index(){
        redirect('blood/my_list');
    }
}