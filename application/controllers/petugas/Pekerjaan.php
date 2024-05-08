<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        is_petugas();
    }

    public function index()
    {
        $ruangan = $this->db->get('ruangan')->result();
        $pekerjaan = $this->db->get_where('pekerjaan', array('DATE(tgl)' => date('Y-m-d')))->result();
        $petugas = $this->db->get_where('petugas', array('id' => $this->session->userdata('petugas_id')))->row();
        $detail_jadwal = $this->db->get_where('detail_jadwal', array('petugas_id' => $petugas->id))->result();

        if ($detail_jadwal) {
            // Mengolah jadwal perhari ini
            foreach ($detail_jadwal as $dj) {
                $jadwal = $this->db->get_where('jadwal', array('id' => $dj->jadwal_id))->row();
                if ($jadwal->hari == date('N')) {
                    $hari = $jadwal->hari;
                } else {
                    $hari = $jadwal->hari;
                }
            }
        } else {
            $hari = NULL;
        }

        // Mengolah status pekerjaan
        foreach ($ruangan as $r) {
            $status = 'Belum dibersihkan'; // Default status
            foreach ($pekerjaan as $p) {
                if ($p->ruangan_id == $r->id) {
                    $status = $p->status;
                    break; // Keluar dari loop jika status ditemukan
                }
            }
            $r->status_pekerjaan = $status; // Menyimpan status pekerjaan ke dalam objek ruangan
        }

        $data = array(
            'title' => 'Pekerjaan',
            'ruangan' => $ruangan,
            'petugas' => $petugas,
            'bagian' => $petugas->bagian,
            'jadwal_hari' => $hari,
        );
        $this->load->view('pages/petugas/pekerjaan/index', $data);
    }


    public function mulai($ruangan_id)
    {
        $data = array(
            'title' => 'Unggah Foto',
            'ruangan_id' => $ruangan_id
        );
        $this->load->view('pages/petugas/pekerjaan/mulai', $data);
    }

    public function proses_mulai($ruangan_id)
    {
        $upload_data = array();

        $this->upload->initialize(array(
            'allowed_types' => 'png|jpg|jpeg',
            'upload_path' => 'assets/uploads/pekerjaan/',
            'encrypt_name'  => TRUE,
            'max_size' => 2048,
        ));

        if (empty($_FILES['image']['name'])) {
            $this->session->set_flashdata('error', 'Foto tidak boleh kosong');
            redirect('petugas/pekerjaan/mulai/' . $ruangan_id);
        } else {

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', strip_tags($error));
                redirect('petugas/pekerjaan/mulai/' . $ruangan_id);
            } else {
                $upload_data['image'] = $this->upload->data();
                $image = $upload_data['image']['file_name'];
            }
        }

        $petugas = $this->db->get_where('petugas', array('id' => $this->session->userdata('petugas_id')))->row();
        $jadwal = $this->db->get('jadwal')->result();
        foreach ($jadwal as $j) {
            if ($j->hari == date('N') && $petugas->bagian == 'kantor') {
                $jadwal_id = $j->id;
            } elseif ($petugas->bagian == 'gudang') {
                $jadwal_id = NULL;
            }
        }

        $data = [
            'tgl' => date('Y-m-d H:i:s'),
            'ruangan_id' => $ruangan_id,
            'jadwal_id' => $jadwal_id,
            'status' => 'Proses dibersihkan',
            'foto_before' => $image
        ];

        $this->db->insert('pekerjaan', $data);

        $this->session->set_flashdata('success', 'Upload has successfully');
        redirect('petugas/pekerjaan');
    }

    public function lihat()
    {
        // Ambil ruangan_id dan tanggal hari ini
        $ruangan_id = $this->input->post('ruangan_id');
        $tanggal_hari_ini = date('Y-m-d');

        // Ambil data pekerjaan berdasarkan ruangan_id dan tanggal hari ini
        $data_pekerjaan = $this->db->get_where('pekerjaan', array('ruangan_id' => $ruangan_id, 'DATE(tgl)' => $tanggal_hari_ini))->row();
        $data_ruangan = $this->db->get_where('ruangan', array('id' => $ruangan_id))->row();

        if ($data_pekerjaan) {
            $query_petugas = $this->db->select('p.nama AS nama_petugas')
                ->from('detail_jadwal dj')
                ->join('petugas p', 'dj.petugas_id = p.id')
                ->where('dj.jadwal_id', $data_pekerjaan->jadwal_id)
                ->get();
            $petugas_list = $query_petugas->result();

            $petugas = [];
            foreach ($petugas_list as $p) {
                $petugas[] = $p->nama_petugas;
            }
            $data_pekerjaan->petugas = !empty($petugas) ? implode(", ", $petugas) : 'Semua petugas gudang';

            $query_tugas = $this->db->select('t.nama AS nama_tugas')
                ->from('tugas t')
                ->join('ruangan r', 't.ruangan_id = r.id')
                ->where('t.ruangan_id', $data_pekerjaan->ruangan_id)
                ->get();
            $tugas_list = $query_tugas->result();

            $tugas = [];
            foreach ($tugas_list as $p) {
                $tugas[] = $p->nama_tugas;
            }
            $data_pekerjaan->tugas = !empty($tugas) ? implode(", ", $tugas) : '-';

            $formatted_date = date('d/m/Y - H:i', strtotime($data_pekerjaan->tgl));

            // Buat array untuk response JSON
            $response = array(
                'tanggal' => $formatted_date,
                'petugas' => $data_pekerjaan->petugas,
                'tugas' => $data_pekerjaan->tugas,
                'ruangan' => $data_ruangan->nama,
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

    public function task($ruangan_id)
    {
        $tanggal_hari_ini = date('Y-m-d');

        $tugas = $this->db->get_where('tugas', array('ruangan_id' => $ruangan_id))->result();
        $pekerjaan = $this->db->get_where('pekerjaan', array('ruangan_id' => $ruangan_id, 'DATE(tgl)' => $tanggal_hari_ini))->row();

        $data = array(
            'title' => 'Ceklis Tugas',
            'ruangan_id' => $ruangan_id,
            'tugas' => $tugas,
            'pekerjaan' => $pekerjaan
        );
        $this->load->view('pages/petugas/pekerjaan/task', $data);
    }

    public function proses_task($id)
    {
        $tanggal_hari_ini = date('Y-m-d');
        $pekerjaan = $this->db->get_where('pekerjaan', array('id' => $id, 'DATE(tgl)' => $tanggal_hari_ini))->row();

        $upload_data = array();

        $this->upload->initialize(array(
            'allowed_types' => 'png|jpg|jpeg',
            'upload_path' => 'assets/uploads/pekerjaan/',
            'encrypt_name'  => TRUE,
            'max_size' => 2048,
        ));

        if (!$this->upload->do_upload('image')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', strip_tags($error));
            redirect('petugas/pekerjaan/mulai/' . $pekerjaan->ruangan_id);
        } else {
            $upload_data['image'] = $this->upload->data();
            $image = $upload_data['image']['file_name'];
        }

        $data = [
            'status' => 'Menunggu validasi',
            'foto_after' => $image
        ];

        $this->db->update('pekerjaan', $data, array('id' => $id));

        $this->session->set_flashdata('success', 'Submit has successfully');
        redirect('petugas/pekerjaan');
    }
}
