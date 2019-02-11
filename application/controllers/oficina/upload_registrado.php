<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_registrado extends CI_Controller
{
    public function index()
	{
        $data = array();
		
        $this->load->model('upload_model');

        $data['uploaded_images'] = $this->upload_model->get_images();
        
		$this->template->load('template_painel', 'oficina/upload_reg/home');
    }
    
    function upload(){
		$filename = md5(uniqid(rand(), true));
		$config = array(
			'upload_path' => './assets/uploads/oficina/upload_reg/',
			'allowed_types' => "gif|jpg|png|jpeg",
			'file_name' => $filename
		);
		
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload())
			{
			$file_data = $this->upload->data();
			
			$data['file_dir']       = $file_data['file_name'];
            $data['date_uploaded']  = date('Y-m-d H:i:s');
            
			$this->load->model('upload_model');
			$this->upload_model->save_image($data);
			
			$data['message'] = "Image uploaded";
		
            $this->load->model('upload_model');
            
			$data['uploaded_images'] = $this->upload_model->get_images();
			$this->template->load('template_painel','oficina/upload_reg/home', $data);
			}
			else
			{
			$data = array();	
			$this->load->model('upload_model');			
			$data['uploaded_images'] = $this->upload_model->get_images();
			
			$error = $this->upload->display_errors();
			$data['errors'] = $error;

            $this->template->load('template_painel','oficina/upload_reg/home', $data);
			}
	}
}