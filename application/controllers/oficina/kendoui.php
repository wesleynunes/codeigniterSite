<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kendoui extends CI_Controller
{

    /*
     * Carregar helper library e model.
     */
    public function __construct()
    {
        parent::__construct();  
        $this->load->model('oficina_model');   
        $this->load->library('form_validation');
    }

    function grid()
    {
        $arr = func_get_args();
        $data = array();

        if(isset($arr[0])):
            if($arr[0] == 'read'):
                echo $this->oficina_model->read();
                exit();     
            endif;
        endif;  
        
        $this->template->load('template_painel','oficina/kendoui/grid', $data);      
    }
    

    public function read()
    {
        $arr = func_get_args();
        $data = array();

        if(isset($arr[0])):
        if($arr[0] == 'read'):
            echo $this->oficina_model->read();
            exit();     
        endif;
        endif;   

        //$this->load->view('oficina/kendoui/crud', $data);
        $this->template->load('template_painel', 'oficina/kendoui/crud', $data);
    }

    function create()
    {
         // carrega a validacao do form validation usuario, email, senha, e mesagem de is_unique
         $this->form_validation->set_rules('categoria','CATEGORIA','trim|required|max_length[25]|strtolower'); 
                
          // validação de campos form 
         $validation = $this->form_validation->run()==true; 
         
         //faz a validacao do upload e do validation
         if ($validation) 
         {           
             // array com dados do usuario 
             $data = array(                
                 'categoria' 	    => $this->input->post('categoria'),          
                 'data_criacao'     => date('Y-m-d H:i:s'),
                 'data_alteracao'   => date('Y-m-d H:i:s'),                   
             );
 
             $this->usuario_model->create($data);  // salva os dados inserido no banco
             redirect('oficina/kendoui/read');             
         }
         else
         {
             $erros = array('mensagem' => validation_errors());            		
             $this->template->load('template_painel','usuario/adicionar', $erros);          
         } 
    }

    function update()
    {

    }

    function destroy()
    {
        $this->usuario_model->destroy($id);      
        redirect('oficina/kendoui/read');  
    }
  
}