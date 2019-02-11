<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    /*
     * carregar helper library e model.
     */
    public function __construct(){
        parent::__construct();      
        $this->load->model('usuario_model');
        $this->load->library('form_validation');
    }


    public function listar()
    {
      
        $data['usuario'] = $this->usuario_model->listar();
      
        $this->template->load('template_painel', 'usuario/listar', $data);       
    }    
               
    

    public function adicionar()
    {          
        $this->template->load('template_painel', 'usuario/adicionar');        
    }


    public function salvar()
    {  
        $this->form_validation->set_rules('usuario','USUARIO','trim|required|max_length[25]|strtolower|is_unique[usuarios.usuario]'); 
        $this->form_validation->set_rules('email','EMAIL','trim|required|max_length[50]|strtolower|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('senha','SENHA','trim|required|strtolower');        
        $this->form_validation->set_message('is_unique','Este %s já está cadastrado no sistema');
        

        $sucesso = $this->form_validation->run()==true;            
     
        $filename = md5(uniqid(rand(), true));
		$config = array(
			'upload_path' => './assets/uploads/usuario/',
			'allowed_types' => "gif|jpg|png|jpeg",
			'file_name' => $filename
		);

        $this->load->library('upload', $config);

        if ($this->upload->do_upload() && $sucesso) 
		{
            $file_data = $this->upload->data();

            $data = array(                
                'usuario' 	        => $this->input->post('usuario'),            
                'email'  	        => $this->input->post('email'),
                'senha'             => md5($this->input->post('senha')),
                'arquivo'  	        => $file_data['file_name'],
                'data_criacao'      => date('Y-m-d H:i:s'),
                'data_alteracao'    => date('Y-m-d H:i:s'),                   
            );

            $this->usuario_model->salvar($data);  
            $this->session->set_flashdata('usuario_salvado', 'Usuario Cadastrado com Sucesso');   
            redirect('usuario/listar');             
        }
        else
		{
            $erros = array('mensagem' => validation_errors());            		
			$erros = array('error' => $this->upload->display_errors());		
			$this->template->load('template_painel','usuario/adicionar', $erros);          
        }     
    }
    

    public function editar($id)
    {  
        $data['usuario'] = $this->usuario_model->usuario_id($id);
        $this->template->load('template_painel', 'usuario/editar', $data, $id); 
    }   
    


    public function atualizar($id){

        $data['usuario'] = $this->usuario_model->usuario_id($id);

        $filename = md5(uniqid(rand(), true));
		$config = array(
			'upload_path' => './assets/uploads/usuario/',
			'allowed_types' => "gif|jpg|png|jpeg",
			'file_name' => $filename
        );
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
		{
            /* erro no upload do arquivo */

			/* recebemos o erro em uma matriz */
			$error = array('error' => $this->upload->display_errors());

			/* carregamos a visão inicial, mas já com a matriz de erros preenchidos */
			$this->template->load('template_painel','usuario/listar', $error);
        }
        else
		{
            $file_data = $this->upload->data();

            $data = array(                
                'usuario' 	        => $this->input->post('usuario'),            
                'email'  	        => $this->input->post('email'),
                'senha'             => md5($this->input->post('senha')),
                'arquivo'  	        => $file_data['file_name'],
                'data_criacao'      => date('Y-m-d H:i:s'),
                'data_alteracao'    => date('Y-m-d H:i:s'),                   
            );

            $this->usuario_model->atualizar($data, $id);
            $this->session->set_flashdata('usuario_atualizado', 'Usuario atualizado com sucesso');      
            redirect('usuario/listar');  
        }     
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