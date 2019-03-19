<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model
{

    /**
     * funcao para validar usuario e senha
     */
    public function login($usuario, $senha)
    {
        $this->db->select('id_usuario, usuario, senha');
        $this->db->from('usuarios');
        $this->db->where('usuario = ' . "'" . $usuario . "'");
        $this->db->where('senha = ' . "'" . MD5($senha) . "'");
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    
    public function listar($order_by = null, $sort = 'DESC', $limit = null, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('usuarios');
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
        $this->db->insert('usuarios', $data);
        return true;
    }


    public function atualizar($data, $id)
    {
        $this->db->where('id_usuario', $id);
        $this->db->update('usuarios', $data);
        return true;
    }


    public function deletar($id)
    {
        $this->db->where('id_usuario', $id);
        $this->db->delete('usuarios');
        return true;
    }

     /*
	 * Get Single User
	 */
    public function usuario_id($id=NULL)
    {
        $this->db->where('id_usuario',$id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }


}