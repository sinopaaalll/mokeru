<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $data = array(
            'title' => 'Laporan'
        );
        $this->load->view('pages/admin/laporan/index', $data);
    }

    public function get_laporan()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $query = $this->db->select('p.*, r.nama as ruangan')
            ->from('pekerjaan p')
            ->join('ruangan r', 'r.id = p.ruangan_id')
            ->where('DATE(p.tgl) >=', $tgl_awal)
            ->where('DATE(p.tgl) <=', $tgl_akhir)
            ->get();
        $data_laporan = $query->result();


        // Format data laporan sesuai kebutuhan (contoh)
        $formatted_data = [];
        foreach ($data_laporan as $laporan) {
            $query_petugas = $this->db->select('petugas.nama AS nama_petugas')
                ->from('detail_jadwal')
                ->join('petugas', 'detail_jadwal.petugas_id = petugas.id')
                ->where('detail_jadwal.jadwal_id', $laporan->jadwal_id)
                ->get();
            $petugas_list = $query_petugas->result();

            // Lopping petugas
            $petugas = [];
            foreach ($petugas_list as $p) {
                $petugas[] = $p->nama_petugas;
            }
            $laporan->petugas = !empty($petugas) ? implode(", ", $petugas) : 'Semua petugas gudang';

            $formatted_data[] = [
                'tgl' => $laporan->tgl,
                'ruangan' => $laporan->ruangan,
                'petugas' => $laporan->petugas,
                'status' => $laporan->status,
            ];
        }

        $response = [
            'status' => 'success',
            'data' => $formatted_data,
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function export()
    {

        $this->load->library('pdfgenerator');

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $query = $this->db->select('p.*, r.nama as ruangan')
            ->from('pekerjaan p')
            ->join('ruangan r', 'r.id = p.ruangan_id')
            ->where('DATE(p.tgl) >=', $tgl_awal)
            ->where('DATE(p.tgl) <=', $tgl_akhir)
            ->get();
        $data_laporan = $query->result();

        $formatted_data = [];
        foreach ($data_laporan as $laporan) {
            $query_petugas = $this->db
                ->select('petugas.nama AS nama_petugas')
                ->from('detail_jadwal')
                ->join('petugas', 'detail_jadwal.petugas_id = petugas.id')
                ->where('detail_jadwal.jadwal_id', $laporan->jadwal_id)
                ->get();
            $petugas_list = $query_petugas->result();

            $petugas = [];
            foreach ($petugas_list as $p) {
                $petugas[] = $p->nama_petugas;
            }
            $laporan->petugas = !empty($petugas) ? implode(", ", $petugas) : 'Semua petugas gudang';

            $formatted_data[] = [
                'tgl' => $laporan->tgl,
                'ruangan' => $laporan->ruangan,
                'petugas' => $laporan->petugas,
                'status' => $laporan->status,
            ];
        }

        $data = [
            'title_pdf' => 'Laporan Monitoring Kebersihan Ruangan',
            'laporan' => $formatted_data
        ];

        $file_pdf = 'laporan_' . $tgl_awal . ' s/d ' . $tgl_akhir . '_mokeru';
        $paper = 'A4';
        $orientation = "portrait";

        $html = $this->load->view('pages/admin/laporan/laporan_pdf', $data, true);

        // Generate PDF
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

        redirect('admin/laporan');
    }
}
