<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sobre extends CI_Controller 
{
	public function index()
	{
		$this->template->load('template', 'sobre');
	}
}