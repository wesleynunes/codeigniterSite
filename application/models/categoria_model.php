<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_model extends CI_Model
{
    public function index($order_by = null, $sort = 'DESC', $limit = null, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('categorias');
        if($limit != null)
        {
            $this->db->limit($limit, $offset);
        }
        if($order_by != null)
        {
            $this->db->order_by($order_by, $sort);
        }
        $query = $this->db->get();
        return $query->result();
    }

      /*
     * Insert
     *
     * @param - (array) $data
     */
    public function salvar($data)
    {
        $this->db->insert('categorias', $data);
        return true;
    }


    public function deletar($id)
    {
        $this->db->where('id_categoria', $id);
        $this->db->delete('categorias');
        return true;
    }


}