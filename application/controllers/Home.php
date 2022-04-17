<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/base/BaseController.php';

class Home extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->queryBanco();
        $this->load->model('usuario_modal', 'user');
    }

	public function index()
	{
        // $this->config->config["pageTitle"] = 'Lista de Usuários';

        $js['js'] = array(
            'public/assets/js/usuarios.js?v=0.95'
        );

        $data['list'] = $this->user->listUsuarios();

		$this->loadView('home', $data, $js);
	}

    public function saveUser($cod_user_usr = 0)
    {
        $return = $this->user->saveUser($cod_user_usr);
        $dados = array();
        $msg = 'Sucesso, Em processar os dados do Usuário';
        $this->session->set_userdata('msg_obs', $msg.'####success');
        if(!is_array($return)){

            if($return == -1){
                $msg = 'Ops. Ocorreu um problema interno, tente entrar em contato com o Suporte do Sistema!';
            }

            if($return == -2){
                $msg = 'Ops. Ocorreu um problema no Cadastro, Um usuario já possui o CPF digitado cadastro no sistema!';
            }

            if($return < 0){
                $this->session->set_userdata('msg_obs', $msg.'####error');
            }

            if($return == -2){
                $this->session->set_userdata('msg_obs', null);
            }
        }else{
            $return = 0;
        }

        echo json_encode(array('cod' => $return, 'msg' => $msg));
    }

    public function editarUsuario($cod){
        $list = $this->user->listUsuarios($cod);
        echo json_encode($list);
    }

    public function removeuser($cod_user_usr)
    {
        $return = $this->user->removeuser($cod_user_usr);
        $msg = 'Sucesso, Em processar os dados do Usuário';
        $this->session->set_userdata('msg_obs', $msg.'####success');

        redirect(base_url() . "home/", "refresh");
    }
}
