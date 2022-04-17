<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/base/BaseController.php';

class Login extends BaseController {

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('conexao_modal', 'conexao');
        // $this->load->model('login_modal', 'login');
        $this->tes();
    }

	public function index()
	{
        $this->config->config["pageTitle"] = 'Faça seu Login!';
        $js['js'] = array(
            'public/assets/js/login.js?v=1.1'
        );

		$this->loadView('login', null, $js);
	}

    public function verificacaoLogin()
    {
        $return = $this->login->autentificacao();
        $dados = array();
        $msg = 'Sucesso, Em instantes você será redirecionado a tela do Sistema';
        if(!is_array($return)){

            if($return == -4){
                $msg = 'Seu Acesso foi bloqueado por varias tentativas de acesso.';
            }

            if($return == -3){
                $msg = 'O usuário a qual está tentando logar está inativo no momento, fale com um Administrador do Sistema para reativa-lo.';
            }

            if($return == -2){
                $msg = 'O Usuário ou Senha digitado estão incorretos.';
            }

            if($return == -1){
                $msg = 'Ops. Ocorreu um problema interno, tente entrar em contato com o Suporte do Sistema!';
            }
        }else{
            $dados = $return;
            $return = 0;
        }
        
        echo json_encode(array('cod' => $return, 'msg' => $msg, 'dados' => $dados));
    }

    public function authentication()
    {   
        $return = $this->login->authentication();
        
        if(is_array($return)){
            if($_POST['hash_log'] == $this->session->userdata('hash_log') && $return[0]->hash_log == $this->session->userdata('hash_log')){
                $this->session->set_userdata('usuario_id', $_POST['usuario_id']);
                $this->session->set_userdata('empresa', 'AtualizarBase');
                $this->session->set_userdata('usuario_ativo', 1);
                $this->session->set_userdata('usuario_nome', $return[0]->nome_usr);
                $this->session->set_userdata('administrador_usr', $return[0]->administrador_usr);
                $this->session->set_userdata('msg_obs', 'Bem Vindo ao Sistema, seu acesso foi liberado!####success');
                redirect(base_url() . "usuario/myprofile", "refresh");
            }else{
                $this->session->set_userdata('msg_obs', 'Ops, Não é permitido forçar a entrada de Login no sistema, os dados devem ser inseridos pela tela do Login####error');
            }
        }

        $this->session->set_userdata('msg_obs', 'Ops, Ocorreu um problema Interno no sistema, procure um administrador');
        redirect(base_url() . "login", "refresh");
    }

    public function singout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . "login", "refresh");
    }
}
