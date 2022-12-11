<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('nim', 'NIM', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates_admin/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates_admin/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $nim = $this->input->post('nim');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['nim' => $nim])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'nim' => $user['nim'],
                    'role_id' => $user['role_id'],
                ];
                $this->session->set_userdata($data);
                switch ($user['role_id']) {
                    case 1:
                        redirect('admin/dashboard');
                        break;
                    case 2:
                        redirect('user/dashboard');
                        break;

                    default:
                        break;
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Incorrect Password!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">NIM is not registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        is_logged_in();
        $data['users'] = $this->Pendidikan_model->get_data('user')->result();
        $data['user'] = $this->db->get_where('user', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nim', 'Username', 'required|trim|is_unique[user.nim]', [
            'is_unique' => 'This NIM has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!',
            'required' => 'Password Required!',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_admin/admin_header');
            $this->load->view('templates_admin/admin_sidebar');
            $this->load->view('templates_admin/admin_topbar', $data);
            $this->load->view('admin/data_user', $data);
            $this->load->view('templates_admin/admin_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'nim' => htmlspecialchars($this->input->post('nim', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'date_created' => time()
            ];

            $this->Pendidikan_model->insert_data($data, 'user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Berhasil</div>');
            redirect('admin/data_user');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nim');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Logout Success</div>');
        redirect('user/dashboard');
    }
}
