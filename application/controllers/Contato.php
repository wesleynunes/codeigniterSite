<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller 
{
    public function index()
	{
		$this->template->load('template', 'contato');
	}
}

   