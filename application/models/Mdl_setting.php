<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI设置model
 *
 * @author	jinjunming
 * @date	2014/4/19         
 */
class Mdl_setting extends MY_Model{
    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct(){
        parent::__construct();
        $this->my_select_field = 's_key,s_value';
        $this->my_table = 'setting';
    }
    /**
     * 获取设置列表
     *
     * @param   mixed
     * @return  array
     */
    public function get_settings(){
        $sql = "
            SELECT
                s_key,
                s_value
            FROM
                {$this->db->dbprefix('setting')}
        ";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        if(!empty($data)){
            $return = array();
            foreach( $data as $value ){
                $return[$value['s_key']] = $value['s_value'];
            }
            return $return;
        }
        return array();
    }
    /**
     * 获取设置
     *
     * @param   mixed
     * @return  array
     */
    public function get_setting($s_key){
        if( empty($s_key) ){
            return false;
        }
        $sql = "
            SELECT
                s_key,
                s_value
            FROM
                {$this->db->dbprefix('setting')}
            WHERE
                s_key = '$s_key'
        ";
        $query = $this->db->query($sql);
        $data = $query->row_array();
        if(!empty($data)){
            return $data;
        }
        return false;
    }
    /**
     * 保存更新设置
     *
     * @param   $project_id   string
     * @param   $content      string
     * @return  boolen
     */
    public function setting_update( $s_key='', $s_value ){
        if(empty($s_key) || !isset($s_value)){
            return false;
        }
        $data = $this->get_setting( $s_key );
        if($data){
            return $this->db->update('setting', array('s_key'=>$s_key,'s_value'=>$s_value), array('s_key'=>$s_key));
        }else{
            return $this->db->insert('setting', array('s_key'=>$s_key,'s_value'=>$s_value));
        }
        
    }
}