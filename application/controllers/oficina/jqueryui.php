<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jqueryui extends CI_Controller
{
     /*
     * Carregar helper library e model.
     */
    public function __construct(){
        parent::__construct();    
    }

    public function index()
    {
        $this->template->load('template_painel', 'oficina/jqueryui/index');
    }

    public function modal()
    {
        $this->template->load('template_painel', 'oficina/jqueryui/modal');
    }
}