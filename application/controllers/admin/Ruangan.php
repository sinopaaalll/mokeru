<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan extends CI_Controller
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
            'title' => 'Ruangan',
            'ruangan' => $this->db->get('ruangan')->result()
        );
        $this->load->view('pages/admin/ruangan/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Ruangan', 'required|is_unique[ruangan.nama]', array(
            'is_unique' => '%s sudah terinput'
        ));

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Ruangan'
            );
            $this->load->view('pages/admin/ruangan/add', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $bagian = (stripos($nama, 'gudang') !== false) ? 'gudang' : 'kantor';

            $data = [
                'nama' => $nama,
                'bagian' => $bagian
            ];

            $this->db->insert('ruangan', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/ruangan');
        }
    }

    public function edit($id)
    {
        $ruangan = $this->db->get_where('ruangan', array('id' => $id))->row();

        $this->form_validation->set_rules('nama', 'Ruangan', 'required');

        if ($this->input->post('nama') != $ruangan->nama) {
            $this->form_validation->set_rules('nama', 'Ruangan', 'is_unique[ruangan.nama]');
        }

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ruangan',
                'ruangan' => $ruangan
            ];

            $this->load->view('pages/admin/ruangan/edit', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $bagian = (stripos($nama, 'gudang') !== false) ? 'gudang' : 'kantor';

            $data = [
                'nama' => $nama,
                'bagian' => $bagian
            ];

            $this->db->update('ruangan', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/ruangan');
        }
    }

    public function destroy($id)
    {
        $this->db->delete('ruangan', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/ruangan');
    }
}
