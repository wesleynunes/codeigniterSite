<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    /*
     * Carregar helper library e model.
     */
    public function __construct(){
        parent::__construct();      
        $this->load->model('usuario_model');
        $this->load->library('form_validation');
    }


    //Carrega formulario lista de usuarios
    public function listar()
    {      
        $data['usuario'] = $this->usuario_model->listar();      
        $this->template->load('template_painel', 'usuario/listar', $data);       
    }    
               
    
    /*
    * Carrega o formulario adicionar
    */
    public function adicionar()
    {          
        $this->template->load('template_painel', 'usuario/adicionar');        
    }


    /*
    * Salva os dados do formulario adcionar 
    */
    public function salvar()
    {  
        // carrega a validacao do form validation usuario, email, senha, e mesagem de is_unique
        $this->form_validation->set_rules('usuario','USUARIO','trim|required|max_length[25]|strtolower|is_unique[usuarios.usuario]'); 
        $this->form_validation->set_rules('email','EMAIL','trim|required|max_length[50]|strtolower|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('senha','SENHA','trim|required|strtolower');        
        $this->form_validation->set_message('is_unique','Este %s já está cadastrado no sistema');
        
         // validação de campos form 
        $validation = $this->form_validation->run()==true; 
     
        /*
        * configuracao do upload de arquivos
        * upload_path carrega o local para onde as imagens serao salvas
        * allowed_types tipos de arquivos que poderao ser salvos
        * file_name desta forma sera gerado um md5 para ser salvo no banco
        */
        $filename = md5(uniqid(rand(), true));
		$config = array(
			'upload_path' => './assets/uploads/usuario/',
			'allowed_types' => "gif|jpg|png|jpeg",
			'file_name' => $filename
		);

        /* 
            - Se carregar na library do autolad da erro no upload_path
            - Carrega a library do upload para gerenciar o upload dos arquivos
		*/
        $this->load->library('upload', $config);

        //faz a validacao do upload e do validation
        if ($this->upload->do_upload() && $validation) 
		{
            $file_data = $this->upload->data();

            // array com dados do usuario 
            $data = array(                
                'usuario' 	        => $this->input->post('usuario'),            
                'email'  	        => $this->input->post('email'),
                'senha'             => md5($this->input->post('senha')),
                'arquivo'  	        => $file_data['file_name'],
                'data_criacao'      => date('Y-m-d H:i:s'),
                'data_alteracao'    => date('Y-m-d H:i:s'),                   
            );

            $this->usuario_model->salvar($data);  // salva os dados inserido no banco
            $this->session->set_flashdata('usuario_salvado', 'Usuario Cadastrado com Sucesso');   // mensagem de dados inseridos  
            redirect('usuario/listar');             
        }
        else
		{
            // $erros = array('mensagem' => validation_errors());            		
			$erros = array('error' => $this->upload->display_errors());	 // gera mesagem de erro de upload	
			$this->template->load('template_painel','usuario/adicionar', $erros);          
        }     
    }
    
    /*
    * Carrega o formulario editar com id e dados do usuario
    */
    public function editar($id)
    {  
        $data['usuario_editar'] = $this->usuario_model->usuario_id($id);
        $this->template->load('template_painel', 'usuario/editar', $data); 
    }   

    /*
    * Atualiza so dados do formulario editar 
    */
    public function atualizar($id)
    {
        //validação de usuario unico
        $original_value_usuario = $this->db->query("select usuario from usuarios where id_usuario = ".$id)->row()->usuario;
        if($this->input->post('usuario') != $original_value_usuario) {
            $is_unique_usuario =  '|is_unique[usuarios.usuario]';
        } else {
            $is_unique_usuario =  '';
        }

         //validação de usuario unico
        $original_value_email = $this->db->query("select email from usuarios where id_usuario = ".$id)->row()->email;
        if($this->input->post('email') != $original_value_email) {
            $is_unique_email =  '|is_unique[usuarios.email]';
        } else {
            $is_unique_email =  '';
        }
        
        //form validation usuario, email, senha
        $this->form_validation->set_rules('usuario', 'USUARIO', 'trim|required|xss_clean|strtolower'.$is_unique_usuario);
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|xss_clean|strtolower'.$is_unique_email);
        $this->form_validation->set_rules('senha','SENHA','trim|required|strtolower');
        $this->form_validation->set_message('is_unique','Este %s já está cadastrado no sistema');  
        
        // validação de campos form 
        $validation = $this->form_validation->run()==true;            

        /*
        * configuracao do upload de arquivos
        * upload_path carrega o local para onde as imagens serao salvas
        * allowed_types tipos de arquivos que poderao ser salvos
        * file_name desta forma sera gerado um md5 para ser salvo no banco
        */
        $filename = md5(uniqid(rand(), true));
		$config = array(
			'upload_path' => './assets/uploads/usuario/',
			'allowed_types' => "gif|jpg|png|jpeg",
			'file_name' => $filename
        );
        
         /* 
            - Se carregar na library do autolad da erro no upload_path
            - Carrega a library do upload para gerenciar o upload dos arquivos
		*/
        $this->load->library('upload', $config);

        //faz a validacao do upload e do validation
        if ($this->upload->do_upload() && $validation)
		{
            $file_data = $this->upload->data();

            // array com dados do usuario 
            $data = array(                
                'usuario' 	        => $this->input->post('usuario'),            
                'email'  	        => $this->input->post('email'),
                'senha'             => md5($this->input->post('senha')),
                'arquivo'  	        => $file_data['file_name'],
                'data_criacao'      => date('Y-m-d H:i:s'),
                'data_alteracao'    => date('Y-m-d H:i:s'),                   
            );

            $this->usuario_model->atualizar($data, $id); // salva os dados inserido no banco
            $this->session->set_flashdata('usuario_atualizado', 'Usuario atualizado com sucesso'); // mensagem de dados inseridos      
            redirect('usuario/listar');  			
        }
        else
		{                              		
            $data = array('error' => $this->upload->display_errors()); // gera mesagem de erro de upload	
            $data['usuario_editar'] = $this->usuario_model->usuario_id($id); // pega o id do usuario para editar se o campo for invalido  
            $this->template->load('template_painel','usuario/editar', $data); // carrega o formulario editar
            // debug();  // debugar codigo
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