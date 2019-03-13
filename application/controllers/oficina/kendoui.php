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


    function window(){
        $this->template->load('template_painel','oficina/kendoui/window');    
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


    function gridNew()
    {
        $arr = func_get_args();
        $data = array();

        if(isset($arr[0])):
            if($arr[0] == 'read'):
                echo $this->oficina_model->read();
                exit();     
            endif;
        endif;  
        
        $this->template->load('template_painel','oficina/kendoui/gridNew', $data);      
    }


    function crud()
    {
        $arr = func_get_args();
        $data = array();

        if(isset($arr[0])):
            if($arr[0] == 'read'):
                echo $this->oficina_model->read();
                exit();     
            endif;
        endif;  
        
        $this->template->load('template_painel','oficina/kendoui/crud', $data);      
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
        $arr = func_get_args();
        $data = array();

        if(isset($arr[0])):
            if($arr[0] == 'create'):
                echo $this->oficina_model->create();
                exit();     
            endif;
        endif;   

        //$this->load->view('oficina/kendoui/crud', $data);
        $this->template->load('template_painel', 'oficina/kendoui/crud', $data);      
    }

    function update()
    {

    }

    function destroy()
    {
        $arr = func_get_args();
        $data = array();   

        if(isset($arr[0])):
        if($arr[0] == 'destroy'):
            echo $this->oficina_model->destroy();
            exit();     
        endif;
        endif;  
      
        $this->template->load('template_painel', 'oficina/kendoui/crud', $data);       
    }


    // function destroy(){
    //     $data=$this->oficina_model->destroy();
    //     echo json_encode($data);       
    // }
  
}