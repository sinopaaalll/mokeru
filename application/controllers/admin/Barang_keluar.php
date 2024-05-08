<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        is_admin();
    }

    public function index()
    {
        $query = $this->db->select('barang_keluar.*, barang.nama')
            ->from('barang_keluar')
            ->join('barang', 'barang_keluar.barang_id = barang.id')->get();
        $barang = $query->result();

        $data = array(
            'title' => 'Barang Keluar',
            'barang_keluar' => $barang
        );
        $this->load->view('pages/admin/barang-keluar/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('barang', 'Barang', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Barang Keluar',
                'barang' => $this->db->get('barang')->result()
            );
            $this->load->view('pages/admin/barang-keluar/add', $data);
        } else {
            $data = [
                'tgl' => htmlspecialchars($this->input->post('tgl')),
                'barang_id' => htmlspecialchars($this->input->post('barang')),
                'qty' => htmlspecialchars($this->input->post('qty')),
                'ket' => htmlspecialchars($this->input->post('ket')),
            ];

            $this->db->insert('barang_keluar', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/barang_keluar');
        }
    }

    public function destroy($id)
    {
        $this->db->delete('barang_keluar', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/barang_keluar');
    }
}
