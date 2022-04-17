<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller {
    
    public function __construct()
        {
            parent::__construct();

            $this->load->library('session');
            $this->load->model('conexao_modal', 'conexao');
        }
    
    public function queryBanco()
    {
        $this->conexao->queryDatabase();
        return TRUE;
    }
    
    function loadView($view, $data=null, $js=null, $css=null) {
        $this->load->view('template/header', $css);
        $this->load->view('template/menu');
        $data ? $this->load->view($view, $data) : $this->load->view($view);
        $this->load->view('template/footer', $js);
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
