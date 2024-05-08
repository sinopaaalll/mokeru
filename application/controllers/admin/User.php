<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        is_admin();
    }

    public function index()
    {
        $data = array(
            'title' => 'User',
            'user' => $this->db->get('user')->result()
        );
        $this->load->view('pages/admin/user/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]', array(
            'is_unique' => '%s sudah terinput'
        ));
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]', array(
            'min_length' => '%s minimal 5 karakter'
        ));
        $this->form_validation->set_rules('pass_conf', 'Konfirmasi password', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'role', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'User'
            );
            $this->load->view('pages/admin/user/add', $data);
        } else {

            $upload_data = array();

            $this->upload->initialize(array(
                'allowed_types' => 'png|jpg|jpeg',
                'upload_path' => 'assets/uploads/user/',
                'encrypt_name'  => TRUE,
                'max_size' => 2048,
            ));

            if (empty($_FILES['foto']['name'])) {
                $foto = 'user.svg';
            } else {

                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', strip_tags($error));
                    redirect('admin/user');
                } else {
                    $upload_data['foto'] = $this->upload->data();
                    $foto = $upload_data['foto']['file_name'];
                }
            }

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => password_hash(htmlspecialchars($this->input->post('password')), PASSWORD_DEFAULT),
                'role' => htmlspecialchars($this->input->post('role')),
                'foto' => $foto,
            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/user');
        }
    }

    public function edit($id)
    {
        $user = $this->db->get_where('user', array('id' => $id))->row();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'min_length[5]', array(
            'min_length' => '%s minimal 5 karakter'
        ));
        $this->form_validation->set_rules('pass_conf', 'Konfirmasi password', 'matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->input->post('username') != $user->username) {
            $this->form_validation->set_rules('username', 'Username', 'is_unique[user.username]', array(
                'is_unique' => '%s sudah terinput'
            ));
        }

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'User',
                'user' => $user
            ];

            $this->load->view('pages/admin/user/edit', $data);
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

                if ($old_foto != "user.svg") {
                    $old_photo_path = 'assets/uploads/user/' . $old_foto;
                    if (file_exists($old_photo_path)) {
                        unlink($old_photo_path);
                    }
                }

                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', strip_tags($error));
                    redirect('admin/user');
                } else {
                    $upload_data['foto'] = $this->upload->data();
                    $foto = $upload_data['foto']['file_name'];
                }
            }

            if (empty($this->input->post('password'))) {
                $password = $this->input->post('old_password');
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => $password,
                'role' => htmlspecialchars($this->input->post('role')),
                'foto' => $foto,
            ];

            $this->db->update('user', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/user');
        }
    }

    public function destroy($id)
    {
        $foto = $this->db->get_where('user', ['id' => $id])->row_array()['foto'];

        if ($foto != "user.svg") {
            // Hapus file foto dari folder uploads
            $path = 'assets/uploads/user/' . $foto;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->db->delete('user', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/user');
    }
}
