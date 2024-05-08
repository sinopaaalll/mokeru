<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        is_petugas();
    }

    public function index()
    {
        $jadwal = $this->db->order_by('hari', 'asc')->get('jadwal')->result();

        foreach ($jadwal as $item) {
            // Query untuk mengambil semua nama petugas berdasarkan ID jadwal
            $query = $this->db->select('p.nama AS nama_petugas')
                ->from('detail_jadwal dj')
                ->join('petugas p', 'dj.petugas_id = p.id')
                ->where('dj.jadwal_id', $item->id)
                ->get();
            $petugas_list = $query->result();

            $nama_petugas = []; // Array untuk menyimpan semua nama petugas
            foreach ($petugas_list as $petugas) {
                $nama_petugas[] = $petugas->nama_petugas;
            }
            $item->nama_petugas = !empty($nama_petugas) ? implode(", ", $nama_petugas) : '-';
        }

        $data = array(
            'title' => 'Jadwal',
            'jadwal' => $jadwal,

        );
        $this->load->view('pages/petugas/jadwal/index', $data);
    }
}
