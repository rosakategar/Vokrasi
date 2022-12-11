<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $data['kampus'] = $this->Pendidikan_model->get_data('kampus')->result();
        $this->load->view('templates_user/user_header');
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates_user/user_footer');
    }

    public function artikel()
    {
        $this->load->view('templates_user/user_header');
        $this->load->view('user/artikel');
        $this->load->view('templates_user/user_footer');
    }
}
