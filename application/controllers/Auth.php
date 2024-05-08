<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login_admin()
    {
        is_not_login();
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/admin/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('user', ['username' => $username])->row_array();

            // jika usernya ada
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'user_id' => $user['id'],
                        'nama' => $user['nama'],
                        'email' => $user['email'],
                        'foto' => $user['foto'],
                        'role' => $user['role'],
                        'status' => "login",
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('success', 'Selamat, anda berhasil Login!');
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Password Salah!');
                    redirect('login-admin');
                }
            } else {
                $this->session->set_flashdata('error', 'Akun Anda Belum Terdaftar');
                redirect('login-admin');
            }
        }
    }

    public function logout_admin()
    {
        $this->session->sess_destroy();
        redirect('login-admin');
    }

    public function login_petugas()
    {
        is_not_login();
        $this->form_validation->set_rules('nik', 'Nomor Induk Karyawan', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/petugas/login');
        } else {
            $nik = $this->input->post('nik');
            $password = $this->input->post('password');

            $petugas = $this->db->get_where('petugas', ['nik' => $nik])->row_array();

            // jika petugasnya ada
            if ($petugas) {
                if (password_verify($password, $petugas['password'])) {
                    $data = [
                        'petugas_id' => $petugas['id'],
                        'nik' => $petugas['nik'],
                        'nama' => $petugas['nama'],
                        'foto' => $petugas['foto'],
                        'bagian' => $petugas['bagian'],
                        'role' => 'petugas',
                        'status' => "login",
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('success', 'Selamat, anda berhasil Login!');
                    redirect('petugas/pekerjaan');
                } else {
                    $this->session->set_flashdata('error', 'Password Salah!');
                    redirect('login-petugas');
                }
            } else {
                $this->session->set_flashdata('error', 'Akun Anda Belum Terdaftar');
                redirect('login-petugas');
            }
        }
    }

    public function logout_petugas()
    {
        $this->session->sess_destroy();
        redirect('login-petugas');
    }
}
