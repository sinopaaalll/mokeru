<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('is_login')) {

    function is_login()
    {
        $CI = &get_instance();

        if ($CI->session->userdata('status') !== 'login') {
            redirect('login');
            exit();
        }

        return true;
    }
}

if (!function_exists('is_not_login')) {

    function is_not_login()
    {
        $CI = &get_instance();

        if ($CI->session->userdata('status') === 'login' && $CI->session->userdata('role') !== 'petugas') {
            redirect('admin/dashboard');
            exit();
        }

        return true;
    }
}

if (!function_exists('is_petugas')) {
    function is_petugas()
    {
        $CI = &get_instance();

        if ($CI->session->userdata('role') !== 'petugas') {
            // Redirect ke halaman login jika tidak login
            redirect('admin/dashboard');
            exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
        }

        return true;
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        $CI = &get_instance();

        if ($CI->session->userdata('role') === 'petugas') {
            // Redirect ke halaman login jika tidak login
            redirect('petugas/pekerjaan');
            exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
        } else if ($CI->session->userdata('role') === 'manager') {
            // Redirect ke halaman login jika tidak login
            redirect('admin/dashboard');
            exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
        }

        return true;
    }
}
