<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
class Preferred_model extends CI_Model {
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();        
        
    }    
    
    public function insertUserKtp($noktp,$fotoktp,$fotoanda,$id_users,$username,$email)
    {  
            $string = array(
                'id_users'=>$id_users,
                'username'=>$username,
                'email'=>$email,
                'noktp'=>$noktp,
                'photo'=>$fotoanda,
                'photoktp'=>$fotoktp
                
            );
            $q = $this->db->insert_string('data_collect_users',$string);             
            $this->db->query($q);
            return $this->db->insert_id();
    }
    
    public function isDuplicateKtp($noktp)
    {     
        $this->db->get_where('data_collect_users', array('noktp' => $noktp), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }
    
    
    public function getUserInfo($id)
    {
        $q = $this->db->get_where('data_collect_users', array('id_users' => $id), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }
    
}