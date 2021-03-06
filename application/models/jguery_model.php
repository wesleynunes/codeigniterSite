<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jguery_model extends CI_Model{

    //model para jguery  
    public function getCategoria(){
      $this->db->order_by('data_criacao', 'desc');
      $query = $this->db->get('categorias');
      if($query->num_rows() > 0){
        return $query->result();
      }else{
        return false;
      }
    }

    public function saveCategoria(){
      $data = array(
				'categoria' 	    => $this->input->post('addCategoria'), 
				'data_criacao'    =>date('Y-m-d H:i:s'),
        'data_alteracao'  =>date('Y-m-d H:i:s'),  
			);
		  $result=$this->db->insert('categorias', $data);
		  return $result;
    }

    public function editCategoria(){
      $idCategoria = $this->input->get('editIdCategoria');
      $this->db->where('id_categoria', $idCategoria);
      $query = $this->db->get('categorias');
      if($query->num_rows() > 0){
        return $query->row();
      }else{
        return false;
      }
    }

    function updateCategoria(){

      $idCategoria = $this->input->post('editIdCategoria');
      $data = array(
				'categoria' 	    => $this->input->post('editCategoria'), 
				// 'data_criacao'    =>date('Y-m-d H:i:s'),
        'data_alteracao'  =>date('Y-m-d H:i:s'),  
      );
      $this->db->where('id_categoria', $idCategoria);
		  $this->db->update('categorias', $data);
		  if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }

      // $idCategoria=$this->input->post('editIdCategoria');
      // $categoria=$this->input->post('editCategoria');    

      // $this->db->set('categoria', $categoria);
      // $this->db->where('id_categoria', $idCategoria);
      // $result=$this->db->update('categorias');
      // return $result;     
      
    }
    
    
    function deleteCategoria(){
      $idCategoria = $this->input->get('idCategoria');
		  $this->db->where('id_categoria', $idCategoria);
		  $this->db->delete('categorias');
		  if($this->db->affected_rows() > 0){
			  return true;
		  }else{
			return false;
		  }
    }



}