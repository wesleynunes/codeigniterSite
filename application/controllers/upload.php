<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
    public function __construct(){
        parent::__construct();      
        $this->load->model('upload_model');
        $this->load->helper(array('form', 'url'));
    }

    function index(){
		$this->template->load('template_painel', 'upload/upload_form', array('error' => ' ' ));
    }



    public function do_upload(){
        $config = array(
            'upload_path' => "uploads",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );
        $this->load->library('upload', $config);
        if($this->upload->do_upload())
        {
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success',$data);
            $this->template->load('template_painel', 'upload/upload_success', array('error' => ' ' ));
        }
        else
        {
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('file_view', $error);
            $this->template->load('template_painel', 'upload/upload_success', array('error' => ' ' ));
        }
    }
       


    // function do_upload()
	// {
	// 	$config['upload_path'] = './uploads/';
	// 	$config['allowed_types'] = 'gif|jpg|png';
	// 	$config['max_size']	= '1000';
	// 	$config['max_width']  = '1024';
	// 	$config['max_height']  = '768';

	// 	$this->load->library('upload', $config);

	// 	if ( ! $this->upload->do_upload())
	// 	{
	// 		$error = array('error' => $this->upload->display_errors());
          
    //         $this->template->load('template_painel', 'upload/upload_form', $error);
	// 	}
	// 	else
	// 	{
	// 		$data = array('upload_data' => $this->upload->data());
            
    //         $this->template->load('template_painel', 'upload/upload_success', $error);
	// 	}
	// }
    
   
}