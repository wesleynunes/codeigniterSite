<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_model extends CI_Model
{
    function save_image($data){		
		$this->db->insert('uploaded_images',$data);
	}
	
	function get_images(){
		$this->db->from('uploaded_images');
		$this->db->order_by('date_uploaded', 'asc');
		$query = $this->db->get();
		
		return $query->result();		

	}
}