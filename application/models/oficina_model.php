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


    public function destroy($id)
    {
        $this->db->where('id_usuario', $id);
        $this->db->delete('usuarios');
        return true;
    }


}