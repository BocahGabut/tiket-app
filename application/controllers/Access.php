<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('username') == "") {
		// 	redirect(base_url() . 'ad789');
		// }
		// $this->load->helper('text');
	}

	public function forbidden()
	{
		$this->load->view('forbidden');
	}
}
