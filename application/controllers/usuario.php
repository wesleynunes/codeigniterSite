<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    /*
     * carregar helper library e model.
     */
    public function __construct(){
        parent::__construct();      
        $this->load->model('usuario_model');
    }


    public function listar()
    {
        //Get Users
        $data['usuario'] = $this->usuario_model->listar();
      
        $this->template->load('template_painel', 'usuario/listar', $data);

        // $usuario = $this->usuario_model->listar();
        // $dados = array("usuario" => $usuario);
        // $this->template->load('template_painel', 'usuario/listar', $dados);
    }    
               
    

    public function adicionar()
    {          
        $this->template->load('template_painel', 'usuario/adicionar');        
    }

    public function salvar()
    {  
        $data = array(                
            'usuario' 	        => $this->input->post('usuario'),            
            'email'  	        => $this->input->post('email'),
            'senha'             => md5($this->input->post('senha')),
            'arquivo'  	        => $this->input->post('arquivo'),
            'data_criacao'      => date('Y-m-d H:i:s'),
            'data_alteracao'    => date('Y-m-d H:i:s'),                   
        );
        
        $this->usuario_model->salvar($data);  
        $this->session->set_flashdata('usuario_salvado', 'Usuario Cadastrado com Sucesso');      
        redirect('usuario/listar');         
    }
    

    public function editar($id)
    {  
        $data['usuario'] = $this->usuario_model->usuario_id($id);
        $this->template->load('template_painel', 'usuario/editar', $data, $id); 
    }   
    

    public function atualizar($id){

        $data['usuario'] = $this->usuario_model->usuario_id($id);

        $data = array(                          
            'usuario' 	        => $this->input->post('usuario'),
            'email'  	        => $this->input->post('email'),
            'senha'             => md5($this->input->post('senha')),
            'arquivo'  	        => $this->input->post('arquivo'),
            'data_criacao'      => date('Y-m-d H:i:s'),
            'data_alteracao'    => date('Y-m-d H:i:s'),               
        );
        
        $this->usuario_model->atualizar($data, $id);  
        redirect('usuario/listar');  
    }


    
    public function deletar($id)
    {
        $this->usuario_model->deletar($id);
        //Create Message
        $this->session->set_flashdata('usuario_deletado', 'Usuario Deletado');
        //Redirect To Index
        redirect('usuario/listar');
    }	
}