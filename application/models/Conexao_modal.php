<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'models/base/BaseModel.php';

class Conexao_modal extends BaseModel {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function queryDatabase()
    {
       $sql = "
            CREATE TABLE IF NOT EXISTS cad_usuarios(
                cod_user_usr INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                des_nome_usr VARCHAR(100) NOT NULL,
                num_doc_usr VARCHAR(13) DEFAULT NULL,
                dta_nascimento_usr DATE DEFAULT NULL,
                num_tel_usr VARCHAR(11) DEFAULT NULL,
                des_endereco_usr VARCHAR(100) DEFAULT NULL,
                des_estado_usr VARCHAR(30) NOT NULL,
                des_cidade_usr VARCHAR(100) NOT NULL,
                id_ativo_usr BOOLEAN DEFAULT TRUE,
                user_ins_usr VARCHAR(20),
                dta_ins_usr DATETIME,
                user_upd_usr VARCHAR(20),
                dta_upd_usr DATETIME
            );
       ";

       $this->db->query($sql);
    }

}