<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
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
            'title' => 'Petugas',
            'petugas' => $this->db->get('petugas')->result()
        );
        $this->load->view('pages/admin/petugas/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[petugas.nik]', array(
            'is_unique' => '%s sudah terinput'
        ));
        $this->form_validation->set_rules('nama', 'Nama petugas', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]', array(
            'min_length' => '%s minimal 5 karakter'
        ));
        $this->form_validation->set_rules('pass_conf', 'Konfirmasi password', 'required|matches[password]');
        $this->form_validation->set_rules('bagian', 'Bagian', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Petugas'
            );
            $this->load->view('pages/admin/petugas/add', $data);
        } else {

            $upload_data = array();

            $this->upload->initialize(array(
                'allowed_types' => 'png|jpg|jpeg',
                'upload_path' => 'assets/uploads/petugas/',
                'encrypt_name'  => TRUE,
                'max_size' => 2048,
            ));

            if (empty($_FILES['foto']['name'])) {
                $foto = 'petugas.svg';
            } else {

                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', strip_tags($error));
                    redirect('admin/petugas');
                } else {
                    $upload_data['foto'] = $this->upload->data();
                    $foto = $upload_data['foto']['file_name'];
                }
            }

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'nik' => htmlspecialchars($this->input->post('nik')),
                'password' => password_hash(htmlspecialchars($this->input->post('password')), PASSWORD_DEFAULT),
                'bagian' => htmlspecialchars($this->input->post('bagian')),
                'foto' => $foto,
            ];

            $this->db->insert('petugas', $data);

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/petugas');
        }
    }

    public function edit($id)
    {
        $petugas = $this->db->get_where('petugas', array('id' => $id))->row();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama petugas', 'required');
        $this->form_validation->set_rules('password', 'Password', 'min_length[5]', array(
            'min_length' => '%s minimal 5 karakter'
        ));
        $this->form_validation->set_rules('pass_conf', 'Konfirmasi password', 'matches[password]');
        $this->form_validation->set_rules('bagian', 'Bagian', 'required');

        if ($this->input->post('nik') != $petugas->nik) {
            $this->form_validation->set_rules('nik', 'NIK', 'is_unique[petugas.nik]', array(
                'is_unique' => '%s sudah terinput'
            ));
        }

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Petugas',
                'petugas' => $petugas
            ];

            $this->load->view('pages/admin/petugas/edit', $data);
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

                if ($old_foto != "petugas.svg") {
                    $old_photo_path = 'assets/uploads/petugas/' . $old_foto;
                    if (file_exists($old_photo_path)) {
                        unlink($old_photo_path);
                    }
                }

                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', strip_tags($error));
                    redirect('admin/petugas');
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
                'nik' => htmlspecialchars($this->input->post('nik')),
                'password' => $password,
                'bagian' => htmlspecialchars($this->input->post('bagian')),
                'foto' => $foto,
            ];

            $this->db->update('petugas', $data, array('id' => $id));

            $this->session->set_flashdata('success', 'Saved has successfully');
            redirect('admin/petugas');
        }
    }

    public function destroy($id)
    {
        $foto = $this->db->get_where('petugas', ['id' => $id])->row_array()['foto'];

        if ($foto != "petugas.svg") {
            // Hapus file foto dari folder uploads
            $path = 'assets/uploads/petugas/' . $foto;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->db->delete('petugas', array('id' => $id));

        $this->session->set_flashdata('success', 'Deleted has successfully');
        redirect('admin/petugas');
    }
}
