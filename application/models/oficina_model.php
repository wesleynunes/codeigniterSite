<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oficina_model extends CI_Model{
  
    public function read()
    {    
      $ret = array();
      $this->db  
  
      ->select("*")
      ->from("categorias");       
    
      $ret_db = $this->db->get()->result_array();
  
      foreach ($ret_db as $k => $v):            
        $ret[] = $v;
      endforeach;
  
      return json_encode($ret);
    }

    /*
     * Insert
     *
     * @param - (array) $data
     */
    public function create($data)
    {
        $this->db->insert('categoria', $data);
        return true;
    }   

    public function destroy($data)
    {
        $this->db->where('id_categoria', $data);
        $this->db->delete('categorias');
        return true;
    }


    //model para jguery ui 
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
				'categoria' 	  => $this->input->post('categoria'), 
				'data_criacao'=>date('Y-m-d H:i:s'),
        'data_alteracao'=>date('Y-m-d H:i:s'),  
			);
		  $result=$this->db->insert('categorias', $data);
		  return $result;
    }

    public function editCategoria(){
      $id_categoria = $this->input->get('id_categoria');
      $this->db->where('id_categoria', $id_categoria);
      $query = $this->db->get('categorias');
      if($query->num_rows() > 0){
        return $query->row();
      }else{
        return false;
      }
    }

    function updateCategoria(){

      $id_categoria=$this->input->post('id_categoria');
      $categoria=$this->input->post('txtcategoria');    

      $this->db->set('categoria', $categoria);
      $this->db->where('id_categoria', $id_categoria);
      $result=$this->db->update('categorias');
      return $result;




      // $id_categoria = $this->input->post('id_categoria');
      // $data = array(
			// 	'categoria' 	  => $this->input->post('categoria'), 
			// 	'data_criacao'=>date('Y-m-d H:i:s'),
      //   'data_alteracao'=>date('Y-m-d H:i:s'),  
      // );
      // $this->db->where('id_categoria', $id_categoria);
		  // $this->db->insert('categorias', $data);
		  // return true;



      // $field = array(
      //   'categoria'=>$this->input->post('categoria'),
      //   'data_criacao'=>date('Y-m-d H:i:s'),   
      //   'data_alteracao'=>date('Y-m-d H:i:s'), 
      // );
      // $this->db->where('id_categoria', $id_categoria);
      // $this->db->update('categorias', $field);
      // if($this->db->affected_rows() > 0){
      //   return true;
      // }else{
      //   return false;
      // }
    }
    
    
    function deleteCategoria(){
      $id_categoria = $this->input->get('id_categoria');
		  $this->db->where('id_categoria', $id_categoria);
		  $this->db->delete('categorias');
		  if($this->db->affected_rows() > 0){
			  return true;
		  }else{
			return false;
		  }
    }



}