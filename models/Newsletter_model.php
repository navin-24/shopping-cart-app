<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_model extends CI_Model {

    
    function __construct() {
        // Call the Model constructor  
        parent::__construct();
        $this->load->database();
        $this->tableName = 'newsletter';
    }

    
    /**
     * 
     * @param string $email
     * @return boolean
     */
    function checkUser($email) {
        $this->db->where('email', $email);
        $this->db->where('status', 1);
        $query = $this->db->get($this->tableName);

        //echo $this->db->last_query();die;
        if ($query->num_rows() == 1) {
            return true;
        }

        return false;
    }

    
    /**
     * 
     * @param string $email
     * @return boolean
     */
    function subscribe($email) {
        
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['email'] = $email;
        $this->db->insert($this->tableName, $data);
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
