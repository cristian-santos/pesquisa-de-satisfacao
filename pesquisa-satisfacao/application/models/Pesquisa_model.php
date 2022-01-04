<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Pesquisa_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
        }

        public function votos($nivel_gentileza, $nivel_satisfacao, $chance_indicacao)
        {
            $dados['nivel_gentileza'] = $nivel_gentileza;
            $dados['nivel_satisfacao'] = $nivel_satisfacao;
            $dados['chance_indicacao'] = $chance_indicacao;
            return $this->db->insert('pesquisa_satisfacao', $dados);
        }
    } 