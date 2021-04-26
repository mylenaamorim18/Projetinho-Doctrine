<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $em;

	public function index() {
        $this->load->helper('url');
		$this->load->view('pages/home');
	}

	
}