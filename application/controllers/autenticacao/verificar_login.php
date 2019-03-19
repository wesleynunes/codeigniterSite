<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verificar_login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();       
        $this->load->library('form_validation');
        $this->load->model('usuario_model', '', TRUE); // carrega model usuario
    }

    public function index()
    {
        $this->load->library('form_validation'); // biblioteca form_validation codeigniter
        
        $this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('senha', 'senha', 'trim|required|xss_clean|callback_check_database');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_view'); // Validacao de campo falhou. Usuario redirecionado para pagina de login
        } else {
            redirect('painel', 'refresh'); // Vai para a area privada
        }
    }

    public function check_database($senha)
    {
        $usuario = $this->input->post('usuario'); // Validacao do campo ok, validar banco
        
        $result = $this->usuario_model->login($usuario, $senha); // consultar o banco de dados
        
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id_usuario'    => $row->id_usuario,
                    'usuario'       => $row->usuario
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'usuario ou senha invalido');
            return false;
        }
    }
}