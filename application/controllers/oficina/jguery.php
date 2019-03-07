<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jguery extends CI_Controller
{
     /*
     * Carregar helper library e model.
     */
    public function __construct(){
        parent::__construct();  
        $this->load->model('oficina_model', 'model');  
    }

    public function index()
    {
        $this->template->load('template_painel', 'oficina/jguery/index');
    } 
    
    public function getCategoria(){
        $data=$this->model->getCategoria();
		echo json_encode($data);
    }

    function saveCategoria(){
        $result = $this->model->saveCategoria();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
}