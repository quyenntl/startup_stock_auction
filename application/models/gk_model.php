<?php
/**
 * Class model dùng chung cho nhiều bảng
 */ 
class gk_model extends Model{
    function __construct(){
        $this->load->database('db','db'); // DB Market   
    }
    
    /**
     * Hàm insert dữ liệu vào Market Database
     * $table   String - Tên bảng cần insert dữ liệu vào
     * $data    Array  - Dữ liệu insert dạng mảng
     */
    function insert($table='',$data=array()){
        if(empty($data) || empty($table))
            return false;
            
        $query = $this->db->insert($table,$data);
        
        if($query) {
            return $this->db->insert_id();
        }
        else {
            return false;
        }
    }
    
    /**
     * Hàm insert multi dữ liệu vào Market Database
     * $table   String - Tên bảng cần insert dữ liệu vào
     * $data    Array  - Dữ liệu insert dạng mảng
     */
    function multi_insert($table='',$data=array()){
        if(empty($data) || empty($table))
            return false;
            
        return $this->db->insert_batch($table, $data);
    }
    
    /**
     * Hàm update dữ liệu vào Market Database
     * $table       String - Tên bảng cần update dữ liệu vào
     * $condition   Array  - Điều kiện để Update
     * $data        Array  - Dữ liệu update dạng mảng
     */
    function update($table='',$condition=array(),$data=array()){
        if(empty($data) || empty($table) || empty($condition))
            return false;
 
         return $this->db->where($condition)->update($table,$data);
    }
    
    /**
     * Hàm update multi dữ liệu vào Market Database
     * $table       String - Tên bảng cần update dữ liệu vào
     * $data        Array  - Dữ liệu update dạng mảng
     * $key         String - Khóa chính để update dữ liệu
     */
    function multi_update($table='',$data=array(),$key='') {
        if(empty($data) || empty($table) || empty($key))
            return false;
        $this->db->update_batch($table, $data,$key);    
        return true;
    }
    
    /**
     * Hàm delete dữ liệu Market Database
     * $table       String - Tên bảng cần delete dữ liệu
     * $condition   Array  - Điều kiện để Delete
     */
    function delete($table='',$condition=array()){
        if(empty($condition))
            return false;
 
         return $this->db->delete($table, $condition);
    }
    
    /**
     * Hàm multi delete dữ liệu Market Database
     * $table       String - Tên bảng cần delete dữ liệu
     * $condition   Array  - Điều kiện để Delete
     * $arrID       Array  - Array ID can delete
     * $key         String - Khoa chính de delete
     */
    function multi_del($table='',$condition=array(),$arrID=array(),$key = ''){
        
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
            
        if($arrID && $key) 
        {
            $this->db->where_in($key, $arrID);
        }   
        
        return $this->db->delete($table);
    }
    
    /**
     * Ham dem
     * @author huandt@peacesoft.net
     * @param $table : Tên bảng, $condition: điều kiện, $like: so sánh like
     * @timecreated 2/11/2012
     */
    function count($table='',$condition=array(),$like=array()){
        if(!empty($condition)){
            $this->db->where($condition);
        }
        if(!empty($like)){
            $this->db->like($like);
        }
        return $this->db->count_all_results($table);
    }
   

    function select($table = '',$field = '*', $condition = array(), $like = array(), $order = 'id DESC', $limit = null, $offset = null)
    {
        $this->db->select($field);
        $this->db->order_by($order);
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
        if(!empty($like))
        {
            $this->db->like($like);
        }        
        return $this->db->get($table, $limit, $offset)->result_array();
    }
    /** SELECT DỮ LIỆU KHÔNG TRÙNG NHAU **/
    function select_distinct($table = '',$field = '*', $condition = array(), $like = array(), $order = 'time_create DESC', $limit = null, $offset = null)
    {
        $this->db->distinct();
        $this->db->select($field);
        $this->db->order_by($order);
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
        if(!empty($like))
        {
            $this->db->like($like);
        }
        return $this->db->get($table, $limit, $offset)->result_array();
    }

    function select_in($table = '', $field = '*', $condition = array(), $field_in = 'id', $in = array(), $order = '', $limit = null, $offset = null)
    {
        $this->db->select($field);
        if($order)
        {
            $this->db->order_by($order);            
        }
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
        
        $this->db->where_in($field_in, $in);
        
        return $this->db->get($table, $limit, $offset)->result_array();
    }

    function count_in($table = '', $condition = array(), $field_in = 'id', $in = array())
    {
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
        
        $this->db->where_in($field_in, $in);
        
        return $this->db->count_all_results($table);
    }

    function select_one($table = '', $field = '*', $condition = array())
    {
        $this->db->select($field);
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
        $data = $this->db->get($table)->result_array();
        return $data[0];
    }
    /**
    * @desscription Get one by condition
    * @author ^^
    * @param $table: ten bang, $field: field, $condition = array dieu kien
    * @timecreated 8/11/2012     
    */
    function get_one($table,$field='*',$condtion=array()){
        if(empty($condtion))
            return false;
        $data   = $this->db->select($field)->get_where($table,$condtion)->result_array();
        return $data[0];
    }
    
    function query($sql=''){
        if($sql=='') 
            return false;
               
        return $this->db->query($sql)->result_array();
    }
    
    function select_group($table = '',$field = '*', $condition = array(), $like = array(), $order = 'time_create DESC', $limit = null, $offset = null,$group)
    {
        $this->db->distinct();
        $this->db->select($field);
        $this->db->order_by($order);
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
        if(!empty($like))
        {
            $this->db->like($like);
        }
        if(!empty($group)){
            $this->db->group_by($group);
        }
        return $this->db->get($table, $limit, $offset)->result_array();
    }
    function count_group($table='',$condition=array(),$like=array(),$group_by){
        if(!empty($condition)){
            $this->db->where($condition);
        }
        if(!empty($like)){
            $this->db->like($like);
        }
        if(!empty($group_by)){
            $this->db->group_by($group_by);
        }
        return $this->db->count_all_results($table);
    }
    
}

/* End of file gk_model.php */ 
?>