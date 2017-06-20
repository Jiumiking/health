<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI后台控制器基类
 *
 * @package     CI
 * @subpackage  core
 * @category    core
 * @author      ming.king
 * @link
 */
class MY_Controller extends Controller_base{
    /**
     * 保存当前登录用户的信息
     *
     * @var object
     * @access  public
     **/
    protected $this_user = NULL;
    /**
     * ajax返回数组
     *
     * @var string
     * @access  protected
     **/
    protected $ajax_data = array(
        'sta' => '0',
        'msg' => '操作失败',
        'dat' => '',
    );
    /**
     * 当前控制器
     * @access  protected
     **/
    protected $this_controller = '';
    /**
     * 当前model
     * @access  protected
     **/
    protected $this_model = '';
    /**
     * 每页数量
     * @access  protected
     **/
    protected $this_page_size = '';
    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        $this->ini();
    }
    /**
     * 入口方法
     *
     * @access  public
     * @return  void
     */
    private function ini(){
        $this->check_login();   //登录验证
        $this->get_bred();    //权限验证
        $this->this_controller = $this->uri->rsegment(1);
        $this->this_model = 'Mdl_'.$this->this_controller;
        if( file_exists(APPPATH.'models/'.$this->this_model.'.php') ){
            $this->load->model( $this->this_model );
        }
        $this->this_page_size = empty($this->this_setting['page_number'])?10:$this->this_setting['page_number'];
        $this->this_data['_js'][] = 'authen';
        $this->this_data['this_controller'] = $this->this_controller;
    }
    /**
     * 检查用户是否登录
     * @access  protected
     * @return  void
     */
    private function check_login(){
        if ( !$this->session->userdata('this_user')){
            redirect( site_url('login') );
        }else{
            $this->this_user = $this->session->userdata('this_user');
            $this->this_data['this_user'] = $this->session->userdata('this_user');
        }
    }
    /**
     * 面包屑
     * @access  protected
     * @return  void
     */
    private function get_bred(){
        $this->config->load('menu');
        $menu = $this->config->item('menu');
        $this->this_data['menu'] = $menu;
        $this_uri_string = $this->uri->uri_string;//当前访问key
        $bred = array();
        if( !empty($this_uri_string) && !empty($menu) ){
            foreach( $menu as $k=>$v ){
                $bred[0]['name'] = $v['name'];
                $bred[0]['icon'] = $v['icon'];
                if(!empty($v['link']) && $v['link']==$this_uri_string){
                    break;
                }elseif( !empty($v['sons']) ){
                    foreach( $v['sons'] as $kk=>$vv ){
                        if(!empty($vv['link']) && $vv['link']==$this_uri_string){
                            $bred[1]['name'] = $vv['name'];
                            $bred[1]['icon'] = $vv['icon'];
                            break 2;
                        }
                    }
                }
            }
        }
        $this->this_data['bred'] = $bred;
//        print_r($this_uri_string);exit;
    }
    /**
     * 接口结束返回
     * @access  protected
     * @return  bool
     */
    protected function ajax_end(){
        echo json_encode($this->ajax_data);
        exit;
    }
    /**
     * 列表
     * @access  protected
     * @param   mixed
     * @return  mixed
     */
    public function my_list(){
        $this->this_data['_js'][] = 'jquery.form';
        $this->this_data['_js'][] = 'page';
        $this->this_data['data'] = $this->{$this->this_model}->my_selects($this->this_page_size,0,array('member_id'=>$this->this_user['id']));
        $count = $this->{$this->this_model}->my_count(array('member_id'=>$this->this_user['id']));
        $this->this_data['pages'] = array(
            'page_count' => ceil($count/$this->this_page_size)==0?1:ceil($count/$this->this_page_size) ,
            'count' => $count
        );
        $this->load->view( $this->this_controller.'/'.$this->this_controller.'_index',$this->this_data);
    }
    /**
     * 列表分页ajax
     * @access  protected
     * @param   mixed
     * @return  mixed
     */
    public function my_page(){
        $page = empty($_POST['page'])?1:$_POST['page'];
        $filter = $_POST;
        unset($filter['page']);
        unset($filter['page_size']);
        $filter['member_id'] = $this->this_user['id'];
        $this->this_data['data'] = $this->{$this->this_model}->my_selects( $this->this_page_size, ($page-1)*$this->this_page_size, $filter );
        $this->ajax_data['list_content'] = $this->load->view( $this->this_controller.'/'.$this->this_controller.'_tb', $this->this_data, true );
        $this->ajax_data['page'] = $page;
        $this->ajax_data['count'] = $this->{$this->this_model}->my_count($filter);
        $this->ajax_data['page_count'] = ceil($this->ajax_data['count']/$this->this_page_size)==0?1:ceil($this->ajax_data['count']/$this->this_page_size);
        $this->ajax_end();
    }
    /**
     * 查看ajax
     * @access  protected
     * @param   mixed
     * @return  mixed
     */
    public function my_show(){
        if( !empty($_GET['id']) ){
            $this->this_data['data'] = $this->{$this->this_model}->my_select( $_GET['id'] );
        }
        $this->ajax_data['dat'] = $this->load->view( $this->this_controller.'/'.$this->this_controller.'_show', $this->this_data, true );
        $this->ajax_data['sta'] = '1';
        $this->ajax_data['msg'] = $this->config->item(1,'default_ajax_status');
        $this->ajax_end();
    }
    /**
     * 编辑ajax
     * @access  protected
     * @param   mixed
     * @return  mixed
     */
    public function my_edit(){
        if( !empty($_GET['id']) ){
            $this->this_data['data'] = $this->{$this->this_model}->my_select( $_GET['id'] );
        }
        $this->ajax_data['dat'] = $this->load->view( $this->this_controller.'/'.$this->this_controller.'_edit', $this->this_data, true );
        $this->ajax_data['sta'] = '1';
        $this->ajax_data['msg'] = $this->config->item(1,'default_ajax_status');
        $this->ajax_end();
    }
    /**
     * 编辑执行ajax
     * @access  protected
     * @param   mixed
     * @return  mixed
     */
    public function my_edit_do(){
        $data=$_POST;
        if( !empty($data['id']) ){
            $back = $this->{$this->this_model}->my_update( $data['id'],$data );
        }else{
            $data['member_id'] = $this->this_user['id'];
            $back = $this->{$this->this_model}->my_insert( $data );
        }
        if($back){
            $this->ajax_data['sta'] = '1';
            $this->ajax_data['msg'] = $this->config->item(1,'default_ajax_status');
        }
        $this->ajax_end();
    }
    /**
     * 删除ajax
     * @access  protected
     * @param   mixed
     * @return  mixed
     */
    public function my_del(){
        if( empty($_GET['id']) ){
            $this->ajax_data['msg'] = $this->config->item(0,'default_ajax_status');
            $this->ajax_end();
        }
        if( $this->{$this->this_model}->my_delete($_GET['id']) ){
            $this->ajax_data['sta'] = '1';
            $this->ajax_data['msg'] = $this->config->item(1,'default_ajax_status');
        }
        $this->ajax_end();
    }
    /**
     * 状态ajax
     * @access  public
     * @return  void
     */
    public function my_status(){
        if( empty($_GET['id']) ){
            $this->ajax_data['msg'] = $this->config->item(0,'default_ajax_status');
            $this->ajax_end();
        }
        $data['status'] = empty($_GET['status'])?0:$_GET['status'];
        if( $this->{$this->this_model}->my_update( $_GET['id'], $data) ){
            $this->ajax_data['sta'] = '1';
            $this->ajax_data['msg'] = $this->config->item(1,'default_ajax_status');
        }else{
            $this->ajax_data['msg'] = $this->config->item(2,'default_ajax_status');
        }
        $this->ajax_end();
    }
    /*
     * 导入
     * @access  public
     */
    public function my_import(){
        $this->ajax_data['dat'] = $this->load->view( $this->this_controller.'/'.$this->this_controller.'_import', $this->this_data, true );
        $this->ajax_data['sta'] = '1';
        $this->ajax_data['msg'] = $this->config->item(1,'default_ajax_status');
        $this->ajax_end();
    }
    /*
    * 导入模板
     * @access  public
    */
    public function my_import_template(){
    }
    /**
     * 导入
     * @access  public
     */
    public function my_import_do(){
    }
}
/**
 * 基类
 *
 * @package     CI
 * @subpackage  core
 * @category    core
 * @author      ming.king
 * @link
 */
class Controller_base extends CI_Controller{
    /**
     * 输出变量
     * @var object
     * @access  public
     **/
    protected $this_data = array();
    /**
     * 保存当前设置信息
     * @var object
     * @access  public
     **/
    protected $this_setting = array();
    /**
     * 构造函数
     * @access  public
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        require_once('MY_Function.php');
        $this->load->library('session');
        $this->load->model('mdl_member');
        $this->load->model('mdl_setting');
        $this->get_setting();
    }
    /**
     * 配置信息
     * @access  protected
     * @return  void
     */
    private function get_setting(){
        $this->this_setting = $this->mdl_setting->get_settings();
        $this->this_data['this_setting'] = $this->this_setting;
    }
}