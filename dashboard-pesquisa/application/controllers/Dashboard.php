<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
           if(!$this->session->userdata('logado')) {
           redirect(base_url('admin/login'));
    }

        $this->load->model('dash_model');
    }

    public function index()
    {
        $dados['titulo'] = 'Dashboard';
        $dados['subtitulo'] = 'Página inicial';
        //d('dump');  
        //dd('dump e encerra');
        // Filtro por data

        $dados['dtinicio'] = $dtinicio = !empty($_POST['dtinicio']) ? $this->converteDataBD($_POST['dtinicio']) : Date('Y-7-1');
        $dados['dtfim'] = $dtfim = !empty($_POST['dtfim']) ? $this->converteDataBD($_POST['dtfim']) : Date('Y-m-d');

        // Votações
        $dados['pesquisa'] = $this->dash_model->getByFilter($dtinicio, $dtfim);
        $dados['pesquisa_gentileza'] = $this->dash_model->getPesquisaGentileza($dtinicio, $dtfim);
        $dados['pesquisa_satisfacao'] = $this->dash_model->getPesquisaSatisfacao($dtinicio, $dtfim);
        $dados['chance_indicacao'] = $this->dash_model->getChanceIndicacao($dtinicio, $dtfim);
        $dados['total_votantes'] = (object) $this->dash_model->totalVotantes($dados['dtinicio'], $dados['dtfim'])[0];   

        // Pontuação do rating Ex: 3.0
        $dados['one'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->one_star;
        $dados['two'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->two_star;
        $dados['three'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->three_star;
        $dados['four'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->four_star;
        $dados['five'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->five_star;

        if(($dados['one'] != null) || ($dados['two'] || null) || ($dados['three'] != null) || ($dados['four'] != null) || ($dados['five'] != null)) {
            $dados['total_rating'] = (5*$dados['five'] + 4*$dados['four'] + 3*$dados['three'] + 2*$dados['two'] + 1*$dados['one']) / ($dados['five'] + $dados['four'] + $dados['three'] + $dados['two'] + $dados['one']);
        }

        // Porcentagem
        $dados['one'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->one_star;
        $dados['two'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->two_star;
        $dados['three'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->three_star;
        $dados['four'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->four_star;
        $dados['five'] = $this->dash_model->getGentilezaRating($dtinicio, $dtfim)[0]->five_star;

        $dados['one_sat'] = $this->dash_model->getSatisfacaoRating($dtinicio, $dtfim)[0]->one_star;
        $dados['two_sat'] = $this->dash_model->getSatisfacaoRating($dtinicio, $dtfim)[0]->two_star;
        $dados['three_sat'] = $this->dash_model->getSatisfacaoRating($dtinicio, $dtfim)[0]->three_star;
        $dados['four_sat'] = $this->dash_model->getSatisfacaoRating($dtinicio, $dtfim)[0]->four_star;
        $dados['five_sat'] = $this->dash_model->getSatisfacaoRating($dtinicio, $dtfim)[0]->five_star;

        $dados['one_ind'] = $this->dash_model->getIndicacaoRating($dtinicio, $dtfim)[0]->one_star;
        $dados['two_ind'] = $this->dash_model->getIndicacaoRating($dtinicio, $dtfim)[0]->two_star;
        $dados['three_ind'] = $this->dash_model->getIndicacaoRating($dtinicio, $dtfim)[0]->three_star;
        $dados['four_ind'] = $this->dash_model->getIndicacaoRating($dtinicio, $dtfim)[0]->four_star;
        $dados['five_ind'] = $this->dash_model->getIndicacaoRating($dtinicio, $dtfim)[0]->five_star;

        // Total das avaliações
        $dados['total'] = $this->dash_model->totalvotos($dtinicio, $dtfim);
        $dados['total_stars'] = ($dados['total'][0]->gentileza + $dados['total'][0]->satisfacao + $dados['total'][0]->indicacao);
        
        // Total das avaliações com 1 estrela 
        $dados['total_one_star'] = ($dados['one'] + $dados['one_sat'] + $dados['one_ind']);
        if($dados['total_one_star'] >= 1){
        $dados['total_one_star'] = ($dados['total_one_star'] / $dados['total_stars'] * 100);
        }
        
        // Total das avaliações com 2 estrelas 
        $dados['total_two_star'] = ($dados['two'] + $dados['two_sat'] + $dados['two_ind']);
        if($dados['total_two_star'] >= 1){
        $dados['total_two_star'] = ($dados['total_two_star'] / $dados['total_stars'] * 100);
        }

        // Total das avaliações com 3 estrelas 
        $dados['total_three_star'] = ($dados['three'] + $dados['three_sat'] + $dados['three_ind']);
        if($dados['total_three_star'] >= 1) {
        $dados['total_three_star'] = ($dados['total_three_star'] / $dados['total_stars'] * 100);
        }

        // Total das avaliações com 4 estrelas 
        $dados['total_four_star'] = ($dados['four'] + $dados['four_sat'] + $dados['four_ind']);
        if($dados['total_four_star'] >= 1) {
        $dados['total_four_star'] = ($dados['total_four_star'] / $dados['total_stars'] * 100);
        }

        // Total das avaliações com 5 estrelas
        $dados['total_five_star'] = ($dados['five'] + $dados['five_sat'] + $dados['five_ind']);
        if($dados['total_five_star'] >= 1){
        $dados['total_five_star'] = ($dados['total_five_star'] / $dados['total_stars'] * 100);
        }
        
        //d($dados['total_stars']);
        $this->load->view('frontend/template/aside', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/dashboard');

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
    
    public function recebetotalVotantes()
    {
        $total = $this->dash_model->totalVotantes();
    }

}