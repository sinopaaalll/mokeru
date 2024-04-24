<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Dashboard'
        );
        $this->load->view('admin/pages/dashboard/index', $data);
    }
}
