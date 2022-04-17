<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAnaliseErro($db = null, $query = null)
    {
        if (!$cons = $db->get())
        {
            $db_error = $this->db->error();
        }   

        if (!empty($db_error)) {
            throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            return FALSE;
        }

        if(isset($query)){
            return $cons->result();
        }
        return TRUE;
    }
    

    public function getErro($error = null, $getTable = FALSE)
    {
        log_message('ERROR: ',$error->getMessage());
    }

    public function dump($expressao, $die = null)
    {
        echo '<pre>';
        print_r($expressao);
        if($die){
            die;
        }
    }
}