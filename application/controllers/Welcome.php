<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $em;

    //Doctrine EntityManager

    function __construct()
    {
        parent::__construct();

        //Instantiate a Doctrine Entity Manager
        $this->em = $this->doctrine->em;
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function insertPessoa($nome, $cpf) {
		$pessoa = new Pessoa();
		$this->pessoa->setNome($nome);
		$this->pessoa->setCpf($cpf).save();


		$em->flush();
	}

	function deletePessoa($id){
        try{
            $this->em->remove($id);
            $this->em->flush();
            return TRUE;
        }
        catch(Exception $err) {
            log_message("error", $err->getMessage(), false);
            return FALSE;
        }
    }
}
