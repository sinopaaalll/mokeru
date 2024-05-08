<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $id = $this->session->userdata('petugas_id');
        $petugas = $this->db->get_where('petugas', array('id' => $id))->row();

        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'min_length[5]', array(
            'min_length' => '%s minimal 5 karakter'
        ));

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => "Profil",
                'petugas' => $petugas
            ];

            $this->load->view('pages/petugas/profil/index', $data);
        } else {
            $upload_data = array();

            $this->upload->initialize(array(
                'allowed_types' => 'png|jpg|jpeg',
                'upload_path' => 'assets/uploads/petugas/',
                'encrypt_name'  => TRUE,
                'max_size' => 2048,
            ));

            $old_foto = $this->input->post('old_foto');

            if (empty($_FILES['foto']['name'])) {
                $foto = $old_foto;
            } else {

                if ($old_foto != "no-image.svg") {
                    $old_photo_path = 'assets/uploads/petugas/' . $old_foto;
                    if (file_exists($old_photo_path)) {
                        unlink($old_photo_path);
                    }
                }

                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', strip_tags($error));
                    redirect('petugas/profil');
                } else {
                    $upload_data['foto'] = $this->upload->data();
                    $foto = $upload_data['foto']['file_name'];
                }
            }

            $old_password = $this->input->post('old_password');
            $password = $this->input->post('password') == '' ? $old_password : password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $data = [
                'nik' => htmlspecialchars($this->input->post('nik')),
                'nama' => htmlspecialchars($this->input->post('nama')),
                'password' => $password,
                'foto' => $foto
            ];

            $this->db->update('petugas', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Updated has successfully');
            redirect('petugas/profil');
        }
    }
}
