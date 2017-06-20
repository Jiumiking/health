<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI后台model
 * @category    model
 * @author      ming.king
 * @date        2015/11/26
 */
class Mdl_member extends MY_Model{
    /**
     * 构造函数
     *
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        $this->my_select_field .= ',name_real,name_nick,password,phone,email,weixin,weixin_id,qq,email_check,integral,sex,birthday,headpic';
        $this->my_table = 'member';
    }
    /**
     * 列表条件处理
     * @access  public
     * @param   mixed
     * @return  mixed
     */
    protected function my_where( $where=array() ){
        if(empty($where)){
            return '';
        }
        $return = '';
        foreach($where as $key=>$value){
            if( !empty($value) || $value == '0' ){
                $this->sql_value($value);
                if( $key=='phone' || $key=='email' || $key=='weixin' || $key=='qq' || $key=='name_eral' || $key=='name_nick' ){
                    $return .= ' AND '.$key." LIKE '%$value%'";
                }else{
                    $return .= ' AND '.$key." = '$value'";
                }
            }
        }
        return $return;
    }
}