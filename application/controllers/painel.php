<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Painel extends CI_Controller
{
    // public function index()
    // {
    //     $this->template->load('template_painel', 'painel');
    // }

    
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('array');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('table');
        $this->load->library('session');    
	}
	

	public function index()
    {
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $dados['usuario'] = $session_data['usuario'];			
			$this->template->load('template_painel', 'painel', $dados);   
        } else {
            redirect('autenticacao/login', 'refresh'); // Se nenhuma sessao, redirecionar a pagina de login
        }
    }

    public function logout()
    {
        session_start();
        $this->session->unset_userdata('logged_in');
        session_destroy();
        // $this->template->load('template', 'home');
        redirect('home', 'refresh');
    }	
}