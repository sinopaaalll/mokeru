<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        is_admin();
    }

    public function index()
    {
        $query = $this->db->select('barang_masuk.*, barang.nama')
            ->from('barang_masuk')
            ->join('barang', 'barang_masuk.barang_id = barang.id')->get();
        $barang = $query->result();

        $data = array(
            'title' => 'Barang Masuk',
            'barang_masuk' => $barang
        );
        $this->load->view('pages/admin/barang-masuk/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('barang', 'Barang', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Barang masuk',
                'barang' => $this->db->get('barang')->result()
            );
            $this->load->view('pages/admin/barang-masuk/add', $data);
        } else {
            $data = [
                'tgl' => htmlspecialchars($this->input->post('tgl')),
                'barang_id' => htmlspecialchars($this->input->post('barang')),
                'qty' => htmlspecialchars($this->input->post('qty')),
                'ket' => htmlspecialchars($this->input->post('ket')),
            ];

            $this->db->insert('barang_masuk', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/barang_masuk');
        }
    }

    public function destroy($id)
    {
        $this->db->delete('barang_masuk', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/barang_masuk');
    }
}
