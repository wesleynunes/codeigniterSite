<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
    public function __construct(){
        parent::__construct();      
        $this->load->model('upload_model');
        $this->load->helper(array('form', 'url'));
    }

    function index(){        
        $this->template->load('template_painel', 'upload/upload_form', array('error' => ' ' ));
    }  


    function do_upload()
	{
        /* 
            - upload_path configura o local onde serar salva as imagens tem que criar esta pasta na raiz do projeto
            - allowed_types sao os tipos de aquivos que podem ser salvos
            - max_size tamanho maximo do arquivo
            - max_width largura maxima do arquivo
            - max_height altura maximo do projeto
		 */
		$config['upload_path'] = './assets/uploads/oficina/upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '300000';
		$config['max_width']  = '2024';
		$config['max_height']  = '2068';

        /* 
            - Se carregar na library do autolad da erro no upload_path
            - Carrega a library do upload para gerenciar o upload dos arquivos
		*/
		$this->load->library('upload', $config); 

		/*verifica se tem erros*/

		if ( ! $this->upload->do_upload())
		{
			/* erro no upload do arquivo */

			/* recebemos o erro em uma matriz */
			$error = array('error' => $this->upload->display_errors());

			/* carregamos a visão inicial, mas já com a matriz de erros preenchidos */
			$this->template->load('template_painel','upload/upload_form', $error);
		}
		else
		{
			/* sucesso no upload do arquivo */

			
			$data = array('upload_data' => $this->upload->data());

			$this->template->load('template_painel','upload/upload_success', $data);
		}
	}
   
}