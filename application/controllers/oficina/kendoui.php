<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kendoui extends CI_Controller
{

    /*
     * Carregar helper library e model.
     */
    public function __construct()
    {
        parent::__construct();  
        $this->load->model('kendoui_model', 'model');   
        $this->load->library('form_validation');
    }


    function grid()
    {
        $arr = func_get_args();
        $data = array();

        if(isset($arr[0])):
            if($arr[0] == 'read'):
                echo $this->model->read();
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
                echo $this->model->read();
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
                echo $this->model->read();
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
                echo $this->model->read();
                exit();     
            endif;
        endif;   
       
        $this->template->load('template_painel', 'oficina/kendoui/crud', $data);
    }

    function create()
    {
        $arr = func_get_args();
        $data = array();

        if(isset($arr[0])):
            if($arr[0] == 'create'):
                echo $this->model->create();
                exit();     
            endif;
        endif;  
        
        $this->template->load('template_painel', 'oficina/kendoui/crud', $data);      
    }

    public function edit(){
        $data = $this->model->edit();
        echo json_encode($data);
    }

    function update()
    {
        $arr = func_get_args();
        $data = array();   

        if(isset($arr[0])):
            if($arr[0] == 'update'):
                echo $this->model->update();
                exit();     
            endif;
        endif;  
      
        $this->template->load('template_painel', 'oficina/kendoui/crud', $data);   
    }

    function destroy()
    {
        $arr = func_get_args();
        $data = array();   

        if(isset($arr[0])):
            if($arr[0] == 'destroy'):
                echo $this->model->destroy();
                exit();     
            endif;
        endif;  
      
        $this->template->load('template_painel', 'oficina/kendoui/crud', $data);       
    }  


    public function get(){
        $data=$this->model->get();
        echo json_encode($data);
    }

    function save(){
        $data=$this->model->save();
        echo json_encode($data);
    }
  
  
}