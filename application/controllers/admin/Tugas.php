<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Tugas',
            'tugas' => $this->db->get('tugas')->result()
        );
        $this->load->view('admin/pages/tugas/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Tugas', 'required|is_unique[tugas.nama]', array(
            'is_unique' => '%s sudah terinput'
        ));

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Tugas'
            );
            $this->load->view('admin/pages/tugas/add', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama'))
            ];

            $this->db->insert('tugas', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/tugas');
        }
    }

    public function edit($id)
    {
        $tugas = $this->db->get_where('tugas', array('id' => $id))->row();

        $this->form_validation->set_rules('nama', 'Tugas', 'required');

        if ($this->input->post('nama') != $tugas->nama) {
            $this->form_validation->set_rules('nama', 'Tugas', 'is_unique[tugas.nama]');
        }

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tugas',
                'tugas' => $tugas
            ];

            $this->load->view('admin/pages/tugas/edit', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama'))
            ];

            $this->db->update('tugas', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/tugas');
        }
    }

    public function destroy($id)
    {
        $this->db->delete('tugas', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/tugas');
    }
}
