<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kendoui_model extends CI_Model
{
      
  // model para kendo ui 
  public function read()
  {    
    $ret = array();
    $this->db  

    ->select("*")
    ->from("categorias")       
    ->order_by('data_criacao', 'desc');

    $ret_db = $this->db->get()->result_array();

    foreach ($ret_db as $k => $v):            
      $ret[] = $v;
    endforeach;

    return json_encode($ret);
  }
  
      
  public function create()
  {
    $data = array(
      'categoria' 	    => $this->input->post('addCategoria'), 
      'data_criacao'    =>date('Y-m-d H:i:s'),
      'data_alteracao'  =>date('Y-m-d H:i:s'),  
    );
    $result=$this->db->insert('categorias', $data);
    return $result;
      // $this->db->insert('categoria', $data);
      // return true;
  }   
  
  public function destroy()
  {         
    $idCategoria = $this->input->get('idCategoria');
    $this->db->where('id_categoria', $idCategoria);
    $this->db->delete('categorias');
    if($this->db->affected_rows() > 0){
        return true;
    }else{
      return false;
    }
  }
  
  public function edit()
  {
    $idCategoria = $this->input->get('idEditCategoria');
    $this->db->where('id_categoria', $idCategoria);
    $query = $this->db->get('categorias');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  }  
  
  public function update()
  {         
    $idCategoria = $this->input->post('idEditCategoria');
    $data = array(
      'categoria' 	    => $this->input->post('editCategoria'), 
      // 'data_criacao' =>date('Y-m-d H:i:s'),
      'data_alteracao'  =>date('Y-m-d H:i:s'),  
    );
    $this->db->where('id_categoria', $idCategoria);
    $this->db->update('categorias', $data);
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

   //model para jguery  
   public function get(){
    $this->db->order_by('data_criacao', 'desc');
    $query = $this->db->get('categorias');
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

  public function save(){
    $data = array(
      'categoria' 	    => $this->input->post('addCategoria'), 
      'data_criacao'    =>date('Y-m-d H:i:s'),
      'data_alteracao'  =>date('Y-m-d H:i:s'),  
    );
    $result=$this->db->insert('categorias', $data);
    return $result;
  }
}