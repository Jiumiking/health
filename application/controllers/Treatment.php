<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台控制器
 * @category    controller
 * @author      ming.king
 * @date        2015/11/26
 */
class Treatment extends MY_Controller{
    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        $this->this_data['_js'][] = 'datepicker/WdatePicker';
        $this->this_data['treatment_status'] = $this->config->item('treatment_status');
    }
}