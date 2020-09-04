<?php

class Default_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

       
    
   public function insert_data($tablename, $inserttable) {
        $query = $this->db->insert($tablename, $inserttable);
        
        return $this->db->insert_id();
        
    }
    
    function UpdateRow($table, $data, $key) {
            $this->db->update($table, $data, $key);
            //echo $this->db->last_query();
            return $this->db->affected_rows();    

    }
 function GetInfoRow($table, $key = '') {
        if (!empty($key)) {
            $query = $this->db->where($key);
        }
        $query = $this->db->get($table);
        return $query->result();
    }  
  function getUserInfoByUName($uid) {
        $query = "select * from user_master where id = '$uid'";
        $result = $this->db->query($query);
        return $result->result();
    }
    
    
    
     

}