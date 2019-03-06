<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller
{
    /*
     * Carregar helper library e model.
     */
    public function __construct()
    {
        parent::__construct();      
        $this->load->model('categoria_model');      
    }

    //Carrega formulario lista de categoria
    public function index(){
        $data['categoria'] = $this->categoria_model->index();
        $this->template->load('template_painel', 'categoria/index', $data); 
    }
    
    public function Salvar()
    {
        $this->form_validation->set_rules('categoria','CATEGORIA','trim|required|max_length[100]|strtolower|is_unique[categorias.categoria]');
        
        // validação de campos form 
        $validation = $this->form_validation->run()==true; 

        if ($validation) 
		{
            // array com dados do usuario 
            $data = array(                
                'categoria' 	    => $this->input->post('categoria'),           
                'data_criacao'      => date('Y-m-d H:i:s'),
                'data_alteracao'    => date('Y-m-d H:i:s'),                   
            );

            $this->categoria_model->salvar($data);  // salva os dados inserido no banco
            $this->session->set_flashdata('categoria_salvado', 'Categoria cadastrada com sucesso');   // mensagem de dados inseridos  
            redirect('categoria/index');             
        }
        else
		{
            // $erros = array('mensagem' => validation_errors());   
            $data['categoria'] = $this->categoria_model->index();
			$this->template->load('template_painel','categoria/index', $data);          
        } 
    }

    public function deletar($id)
    {
        $this->categoria_model->deletar($id);
        //Create Message
        $this->session->set_flashdata('categoria_deletada', 'Categoria Deletada');
        //Redirect To Index
        redirect('categoria/index');
    }	
}