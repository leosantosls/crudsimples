<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'models/base/BaseModel.php';

class Usuario_modal extends BaseModel {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function listUsuarios($cod_user_usr = 0)
    {
        try{
            $this->db->select("
                cod_user_usr,
                des_nome_usr,
                num_doc_usr,
                DATE_FORMAT(dta_nascimento_usr,'%d/%m/%Y') dta_nascimento_usr,
                num_tel_usr,
                des_endereco_usr,
                des_estado_usr,
                des_cidade_usr,
                CASE WHEN id_ativo_usr = 1 THEN 'ATIVO' ELSE 'DESATIVADO' END ativo,
                DATE_FORMAT(dta_ins_usr,'%d/%m/%Y %H:%i') data_ins,
                CASE WHEN dta_upd_usr IS NULL THEN '' ELSE DATE_FORMAT(dta_upd_usr,'%d/%m/%Y %H:%i') END data_update,
                user_ins_usr usuario_insert,
                user_upd_usr usuario_update
            ", false);
            $this->db->from('cad_usuarios');

            if($cod_user_usr)
                $this->db->where('cod_user_usr', $cod_user_usr);

            $return = $this->getAnaliseErro($this->db, TRUE);

            return $return;

        } catch (Exception $e) {
            $this->getErro($e, TRUE);
            return array();
        }
        
        
    }

    public function saveUser($cod_user_usr)
    {
        try{
            $this->db->select('1');
            $this->db->from('cad_usuarios');
            $this->db->where('num_doc_usr', str_replace(array('.','-'), '', $_POST['num_doc_usr']));
                if($cod_user_usr > 0){
                    $this->db->where('cod_user_usr <>', $cod_user_usr);
                }
                $return = $this->getAnaliseErro($this->db, TRUE);

                // $this->dump($this->db->last_query(), 1);
                if(count($return) > 0){
                    return -2;
                }

                if(!is_array($return)){
                    return $return;
                }


            $this->db->set('des_nome_usr', $_POST['des_nome_usr']);
            $this->db->set('num_doc_usr', str_replace(array('.','-'), '', $_POST['num_doc_usr']));
            $this->db->set('dta_nascimento_usr', date('Y-m-d', strtotime($_POST['dta_nascimento_usr'])));
            $this->db->set('num_tel_usr', str_replace(array('(',')', '-', ' '), '', $_POST['num_tel_usr']));
            $this->db->set('des_endereco_usr', $_POST['des_endereco_usr']);
            $this->db->set('des_estado_usr', $_POST['des_estado_usr']);
            $this->db->set('des_cidade_usr', $_POST['des_cidade_usr']);
            
            if($cod_user_usr > 0){
                $this->db->set('user_upd_usr', 'USUARIO_SISTEMA');
                $this->db->set('dta_upd_usr', date('Y-m-d H:i:s'));
                $this->db->where('cod_user_usr', $cod_user_usr);
                $this->db->update('cad_usuarios');

            }else{
                $this->db->set('user_ins_usr', 'USUARIO_SISTEMA');
                $this->db->set('dta_ins_usr', date('Y-m-d H:i:s'));
                $this->db->insert('cad_usuarios');

                $cod_user_usr = $this->db->insert_id();
            }

            return $cod_user_usr;
            

        } catch (Exception $e) {
            $this->getErro($e, TRUE);
            return -1;
        }
    }

    public function removeuser($cod_user_usr)
    {
        $this->db->set('id_ativo_usr', 'f');
        $this->db->set('user_upd_usr', 'USUARIO_SISTEMA');
        $this->db->set('dta_upd_usr', date('Y-m-d H:i:s'));
        $this->db->where('cod_user_usr', $cod_user_usr);
        $this->db->update('cad_usuarios');
    }

}