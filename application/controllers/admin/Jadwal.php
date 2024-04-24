<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

    public function index()
    {
        $this->db->select('jadwal.*, petugas.nama as petugas');
        $this->db->from('jadwal');
        $this->db->join('petugas', 'petugas.id = jadwal.petugas_id');
        $jadwal = $this->db->get()->result();
        $data = array(
            'title' => 'Jadwal',
            'jadwal' => $jadwal
        );
        $this->load->view('admin/pages/jadwal/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('petugas', 'Petugas', 'required|is_unique[jadwal.petugas_id]', array(
            'is_unique' => '%s sudah ada dalam daftar jadwal'
        ));
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam selesai', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Jadwal',
                'petugas' => $this->db->get('petugas')->result()
            );
            $this->load->view('admin/pages/jadwal/add', $data);
        } else {
            $data = [
                'petugas_id' => htmlspecialchars($this->input->post('petugas')),
                'hari' => htmlspecialchars($this->input->post('hari')),
                'jam_mulai' => htmlspecialchars($this->input->post('jam_mulai')),
                'jam_selesai' => htmlspecialchars($this->input->post('jam_selesai')),
            ];

            $this->db->insert('jadwal', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/jadwal');
        }
    }

    public function edit($id)
    {
        $jadwal = $this->db->get_where('jadwal', array('id' => $id))->row();

        $this->form_validation->set_rules('petugas', 'Petugas', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam selesai', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->input->post('petugas') != $jadwal->petugas_id) {
            $this->form_validation->set_rules('petugas', 'Petugas', 'is_unique[jadwal.petugas_id]', array(
                'is_unique' => '%s sudah ada dalam daftar jadwal'
            ));
        }

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Jadwal',
                'petugas' => $this->db->get('petugas')->result(),
                'jadwal' => $jadwal
            ];

            $this->load->view('admin/pages/jadwal/edit', $data);
        } else {

            $data = [
                'petugas_id' => htmlspecialchars($this->input->post('petugas')),
                'hari' => htmlspecialchars($this->input->post('hari')),
                'jam_mulai' => htmlspecialchars($this->input->post('jam_mulai')),
                'jam_selesai' => htmlspecialchars($this->input->post('jam_selesai')),
            ];

            $this->db->update('jadwal', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/jadwal');
        }
    }

    public function destroy($id)
    {
        $this->db->delete('jadwal', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/jadwal');
    }
}
