<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller
{
    /*
     * Carregar helper library e model.
     */
    public function __construct()
    {
        parent::__construct();      
        $this->load->model('categoria_model');      
    }

    //teste de branch
    //teste git revert teste    
}