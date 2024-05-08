<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        is_admin();
    }

    public function index($ruangan_id)
    {
        $data = array(
            'title' => 'Tugas',
            'tugas' => $this->db->get_where('tugas', array('ruangan_id' => $ruangan_id))->result(),
            'ruangan' => $this->db->get_where('ruangan', array('id' => $ruangan_id))->row()
        );
        $this->load->view('pages/admin/tugas/index', $data);
    }

    public function create($ruangan_id)
    {
        $this->form_validation->set_rules('nama', 'Tugas', 'required');
        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Tugas',
                'ruangan' => $this->db->get_where('ruangan', array('id' => $ruangan_id))->row()
            );
            $this->load->view('pages/admin/tugas/add', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'ruangan_id' => $ruangan_id
            ];

            $this->db->insert('tugas', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/tugas/index/' . $ruangan_id);
        }
    }

    public function edit($id)
    {
        $tugas = $this->db->get_where('tugas', array('id' => $id))->row();
        $ruangan = $this->db->get_where('ruangan', array('id' => $tugas->ruangan_id))->row();

        $this->form_validation->set_rules('nama', 'Tugas', 'required');
        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tugas',
                'tugas' => $tugas,
                'ruangan' => $ruangan
            ];

            $this->load->view('pages/admin/tugas/edit', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'ruangan_id' => $tugas->ruangan_id
            ];

            $this->db->update('tugas', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Updated has successfully');
            redirect('admin/tugas/index/' . $tugas->ruangan_id);
        }
    }

    public function destroy($id)
    {
        $tugas = $this->db->get_where('tugas', array('id' => $id))->row();
        $ruangan = $this->db->get_where('ruangan', array('id' => $tugas->ruangan_id))->row();

        $this->db->delete('tugas', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/tugas/index/' . $ruangan->id);
    }
}
