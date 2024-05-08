<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $jadwal = $this->db->get('jadwal')->result();

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
        $this->load->view('pages/admin/jadwal/index', $data);
    }


    public function create()
    {
        $this->form_validation->set_rules('petugas[]', 'Petugas', 'required', array(
            'required' => 'Pilih setidaknya satu petugas'
        ));
        $this->form_validation->set_rules('hari', 'Hari', 'required|is_unique[jadwal.hari]', array(
            'is_unique' => 'Jadwal sudah ada'
        ));
        $this->form_validation->set_rules('jam_mulai', 'Jam mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam selesai', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $data = array(
                'title' => 'Jadwal',
                'days' => $days,
                'petugas' => $this->db->get('petugas')->result()
            );
            $this->load->view('pages/admin/jadwal/add', $data);
        } else {
            $petugas_ids = $this->input->post('petugas');
            $hari = htmlspecialchars($this->input->post('hari'));
            $jam_mulai = htmlspecialchars($this->input->post('jam_mulai'));
            $jam_selesai = htmlspecialchars($this->input->post('jam_selesai'));

            $data = [
                'hari' => $hari,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
            ];
            $this->db->insert('jadwal', $data);
            $jadwal_id = $this->db->insert_id();

            if ($jadwal_id) {
                foreach ($petugas_ids as $petugas_id) {
                    $data_detail_jadwal = [
                        'jadwal_id' => $jadwal_id,
                        'petugas_id' => $petugas_id,
                    ];
                    $this->db->insert('detail_jadwal', $data_detail_jadwal);
                }
            }

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/jadwal');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('petugas[]', 'Petugas', 'required', array(
            'required' => 'Pilih setidaknya satu petugas'
        ));
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam selesai', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        $jadwal = $this->db->get_where('jadwal', ['id' => $id])->row();
        if ($this->input->post('hari') != $jadwal->hari) {
            $this->form_validation->set_rules('hari', 'hari', 'is_unique[jadwal.hari]', array(
                'is_unique' => 'Jadwal sudah ada'
            ));
        }

        if ($this->form_validation->run() === FALSE) {

            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $petugas_terpilih = $this->db->select('petugas_id')
                ->from('detail_jadwal')
                ->where('jadwal_id', $id)
                ->get()
                ->result_array();
            $petugas_terpilih = array_column($petugas_terpilih, 'petugas_id');

            $data = [
                'title' => 'Jadwal',
                'jadwal' => $jadwal,
                'days' => $days,
                'petugas' => $this->db->get('petugas')->result(),
                'selected_petugas' => $petugas_terpilih
            ];
            $this->load->view('pages/admin/jadwal/edit', $data);
        } else {
            // Proses penyimpanan update
            $petugas_ids = $this->input->post('petugas');
            $data = [
                'hari' => $this->input->post('hari'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
            ];

            $this->db->where('id', $id);
            $this->db->update('jadwal', $data);

            // Update petugas
            $this->db->where('jadwal_id', $id);
            $this->db->delete('detail_jadwal');

            foreach ($petugas_ids as $petugas_id) {
                $this->db->insert('detail_jadwal', ['jadwal_id' => $id, 'petugas_id' => $petugas_id]);
            }

            $this->session->set_flashdata('success', 'Updated has successfully');
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
