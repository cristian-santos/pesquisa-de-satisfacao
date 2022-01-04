<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function pagLogin()
    {
        $this->load->view('frontend/login');
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-user', 'usuario','required|min_length[3]');
        $this->form_validation->set_rules('txt-senha', 'senha','required|min_length[4]');
        if ($this->form_validation->run() == FALSE){
            $this->pagLogin();
        } else {
            $usuario = $this->input->post('txt-user');
            $senha = $this->input->post('txt-senha');
            $this->db->where('login', $usuario);
            $this->db->where('senha', sha1($senha));
            $userlogado = $this->db->get('usuario')->result();
            if(count($userlogado) == 1) {
                    $dadosSessao['userlogado'] = $userlogado[0];
                    $dadosSessao['logado'] = TRUE;
                    $this->session->set_userdata($dadosSessao);
                    $dadosSessao['user'] = $usuario;
                    redirect(base_url('dashboard'));
                } else {
                    $dadosSessao['userlogado'] = NULL;
                    $dadosSessao['logado'] = FALSE;
                    $dadosSessao['erroLogin'] = TRUE;
                    $this->session->set_userdata($dadosSessao);
                    redirect(base_url('admin/login'));
                }
        }
    }

    public function novoUsuario()
    {
        $dados['titulo'] = 'Administar usuários';
        $dados['subtitulo'] = "Usuários";
        
        if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
        
        $this->load->model('dash_model');
        $dados['usuarios'] = $this->dash_model->listar_usuarios();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('novousuario', 'usuário', 'required|min_length[3]|is_unique[usuario.login]');
        $this->form_validation->set_rules('novasenha', 'senha' ,'required|min_length[4]');
        $this->form_validation->set_rules('confirsenha', 'confirmação de senha' ,'required|min_length[3]|matches[novasenha]');
        if($this->form_validation->run() == FALSE){
        } else {
            $user = array(
                'login' => $this->input->post('novousuario'),
                'senha' => sha1($this->input->post('novasenha'))
            );
            $this->dash_model->salvarUsuario($user);
        }
        $this->load->view('frontend/template/aside', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/cadastrar');

    }

    public function excluir($id)
	{
        if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
		$this->load->model('dash_model');
		if($this->dash_model->excluir($id)){
            $this->novoUsuario();
        } else {
			echo "houve um erro no sistema!";
		}
	}
    

    public function logout()
    {
        $dadosSessao['userlogado'] = NULL;
        $dadosSessao['logado'] = FALSE;
        $this->session->set_userdata($dadosSessao);
        redirect(base_url('admin/login'));
    }


    public function index()
    {
        if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
        $dados['dtinicio'] = $dtinicio = !empty($_POST['dtinicio']) ? $this->converteDataBD($_POST['dtinicio']) : Date('Y-m-1');
        $dados['dtfim'] = $dtfim = !empty($_POST['dtfim']) ? $this->converteDataBD($_POST['dtfim']) : Date('Y-m-d');
        $lista = $this->dash_model->getByFilter($dtinicio, $dtfim);
        $dados['pesquisa'] = $lista;
        $this->load->view('frontend/template/aside', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/cadastrar');

    }
    
    
    // Funções de conversão de data ou valores, podem ser colocadas em helpers para que toda aplicação possa ter acesso.
    public function converteDataBD($valor)
    {
        if (!empty($valor)) {
            $valor = date('Y-m-d', strtotime(str_replace('/', '-', $valor)));
        } else {
            $valor = null;
        }
        return $valor;
    }


    public function converteDataView($valor)
    {
        if (!empty($valor) && $valor != "0000-00-00") {
            $valor = date('d/m/Y', strtotime($valor));
        }
        return $valor;
    }

}
