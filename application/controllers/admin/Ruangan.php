<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Ruangan',
            'ruangan' => $this->db->get('ruangan')->result()
        );
        $this->load->view('admin/pages/ruangan/index', $data);
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
            $this->load->view('admin/pages/ruangan/add', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama'))
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

            $this->load->view('admin/pages/ruangan/edit', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama'))
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
