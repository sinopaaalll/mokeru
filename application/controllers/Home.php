<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		is_not_login();
		$this->load->view('home/index');
	}
}
