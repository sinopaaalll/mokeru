<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $id = $this->session->userdata('user_id');
        $user = $this->db->get_where('user', array('id' => $id))->row();

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'min_length[5]', array(
            'min_length' => '%s minimal 5 karakter'
        ));

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => "Profil",
                'user' => $user
            ];

            $this->load->view('pages/admin/profil/index', $data);
        } else {
            $upload_data = array();

            $this->upload->initialize(array(
                'allowed_types' => 'png|jpg|jpeg',
                'upload_path' => 'assets/uploads/user/',
                'encrypt_name'  => TRUE,
                'max_size' => 2048,
            ));

            $old_foto = $this->input->post('old_foto');

            if (empty($_FILES['foto']['name'])) {
                $foto = $old_foto;
            } else {

                if ($old_foto != "no-image.svg") {
                    $old_photo_path = 'assets/uploads/user/' . $old_foto;
                    if (file_exists($old_photo_path)) {
                        unlink($old_photo_path);
                    }
                }

                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', strip_tags($error));
                    redirect('admin/profil');
                } else {
                    $upload_data['foto'] = $this->upload->data();
                    $foto = $upload_data['foto']['file_name'];
                }
            }

            $old_password = $this->input->post('old_password');
            $password = $this->input->post('password') == '' ? $old_password : password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $data = [
                'username' => htmlspecialchars($this->input->post('username')),
                'nama' => htmlspecialchars($this->input->post('nama')),
                'password' => $password,
                'foto' => $foto
            ];

            $this->db->update('user', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Updated has successfully');
            redirect('admin/profil');
        }
    }
}
