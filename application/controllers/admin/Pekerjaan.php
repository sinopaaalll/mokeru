<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $input_tgl = $this->input->post('tgl');
        if ($input_tgl) {
            $tgl = $input_tgl;
        } else {
            $tgl = date('Y-m-d');
        }
        $query = $this->db->select('p.*, r.nama as ruangan')
            ->from('pekerjaan p')
            ->join('ruangan r', 'r.id = p.ruangan_id')
            ->where('DATE(p.tgl)', $tgl)
            ->get();
        $pekerjaan = $query->result();

        foreach ($pekerjaan as $item) {
            $query_petugas = $this->db->select('petugas.nama AS nama_petugas')
                ->from('detail_jadwal')
                ->join('petugas', 'detail_jadwal.petugas_id = petugas.id')
                ->where('detail_jadwal.jadwal_id', $item->jadwal_id) // Menggunakan id pekerjaan sebagai jadwal_id
                ->get();
            $petugas_list = $query_petugas->result();

            $petugas = [];
            foreach ($petugas_list as $p) {
                $petugas[] = $p->nama_petugas;
            }
            $item->petugas = !empty($petugas) ? implode(", ", $petugas) : 'Semua petugas gudang';

            $query_tugas = $this->db->select('t.nama AS nama_tugas')
                ->from('tugas t')
                ->join('ruangan r', 't.ruangan_id = r.id')
                ->where('t.ruangan_id', $item->ruangan_id)
                ->get();
            $tugas_list = $query_tugas->result();

            $tugas = [];
            foreach ($tugas_list as $p) {
                $tugas[] = $p->nama_tugas;
            }
            $item->tugas = !empty($tugas) ? implode(", ", $tugas) : '-';
        }

        $data = array(
            'title' => 'Pekerjaan',
            'pekerjaan' => $pekerjaan,
        );
        $this->load->view('pages/admin/pekerjaan/index', $data);
    }

    public function lihat()
    {
        // Ambil ruangan_id dan tanggal hari ini
        $id = $this->input->post('id');

        // Ambil data pekerjaan berdasarkan ruangan_id dan tanggal hari ini
        $data_pekerjaan = $this->db->get_where('pekerjaan', array('id' => $id))->row();

        if ($data_pekerjaan) {
            // Buat array untuk response JSON
            $response = array(
                'foto_sebelum' => base_url('assets/uploads/pekerjaan/' . $data_pekerjaan->foto_before),
                'foto_sesudah' => base_url('assets/uploads/pekerjaan/' . $data_pekerjaan->foto_after),
                'foto_after' => $data_pekerjaan->foto_after,
            );
        } else {
            // Jika data tidak ditemukan, buat response kosong
            $response = array();
        }

        // Mengirim response JSON
        echo json_encode($response);
    }

    public function validasi($id)
    {
        $data = [
            'status' => 'Selesai dibersihkan'
        ];

        $this->db->update('pekerjaan', $data, array('id' => $id));

        $this->session->set_flashdata('success', 'Updated status has successfully');
        redirect('admin/pekerjaan');
    }
}
