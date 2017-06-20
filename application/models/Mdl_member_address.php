<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI后台model
 * @category    model
 * @author      ming.king
 * @date        2015/11/26
 */
class Mdl_member_address extends MY_Model{
    /**
     * 构造函数
     *
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        $this->my_select_field = 'id,name,member_id,province,city,area,detail,phone,person,date_add,date_edit,status';
        $this->my_table = 'member_address';
    }
    /**
     * 根据地址id判断
     * 0：未知类型
     * 1：江浙沪
     * 2：非江浙沪
     */
    public function shipping_type($id){
        if( empty($id) ){
            return 0;
        }
        $jzh = array('320000','330000','310000');
        $data_address = $this->my_select( $id );
        if( empty($data_address['province']) ){
            return 0;
        }
        if( in_array($data_address['province'],$jzh) ){
            return 1;
        }else{
            return 2;
        }
    }
}