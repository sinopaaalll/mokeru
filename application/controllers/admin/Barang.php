<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        is_admin();
    }

    public function index()
    {
        $data = array(
            'title' => 'Barang',
            'barang' => $this->db->get('barang')->result()
        );
        $this->load->view('pages/admin/barang/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Barang', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Barang'
            );
            $this->load->view('pages/admin/barang/add', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama'))
            ];

            $this->db->insert('barang', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/barang');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama', 'barang', 'required');

        if ($this->form_validation->run() == false) {
            $barang = $this->db->get_where('barang', array('id' => $id))->row();
            $data = [
                'title' => 'Barang',
                'barang' => $barang
            ];

            $this->load->view('admin/pages/barang/edit', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama'))
            ];

            $this->db->update('barang', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/barang');
        }
    }

    public function destroy($id)
    {
        $this->db->delete('barang', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/barang');
    }
}
