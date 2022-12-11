<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $data['pengguna'] = $this->Pendidikan_model->jumlah_user();
        $data['kampus'] = $this->Pendidikan_model->jumlah_kampus();

        $this->load->view('templates_admin/admin_header', $data);
        $this->load->view('templates_admin/admin_sidebar');
        $this->load->view('templates_admin/admin_topbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates_admin/admin_footer', $data);
    }
}
