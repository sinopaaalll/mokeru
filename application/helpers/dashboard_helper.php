<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('count_ruangan')) {
    function count_ruangan()
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->from('ruangan');
        return $CI->db->count_all_results();
    }
}

if (!function_exists('count_petugas')) {
    function count_petugas()
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->from('petugas');
        return $CI->db->count_all_results();
    }
}

if (!function_exists('count_user')) {
    function count_user()
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->from('user');
        return $CI->db->count_all_results();
    }
}

if (!function_exists('count_barang')) {
    function count_barang()
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->from('barang');
        return $CI->db->count_all_results();
    }
}
