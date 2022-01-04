<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesquisa extends CI_Controller {

	public function index($alert = null)
	{
		$dados['titulo'] = "Pesquisa Satisfação";
		$dados['alert'] = $alert;
	
		$this->load->model('pesquisa_model', 'modelpesquisa');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('gentileza', 'gentileza', 'required');
		$this->form_validation->set_rules('satisfacao', 'satisfação', 'required');
		$this->form_validation->set_rules('indicacao', 'chance de indicação', 'required');
		if($this->form_validation->run() == FALSE) {
		} else {
			$nivel_gentileza = $this->input->post('gentileza');
			$nivel_satisfacao = $this->input->post('satisfacao');
			$chance_indicacao = $this->input->post('indicacao');
			if($this->modelpesquisa->votos($nivel_gentileza, $nivel_satisfacao, $chance_indicacao)){
				redirect(base_url('pesquisa/1'));
			} 
		}
		$this->load->view('pesquisa', $dados);
	}	

}