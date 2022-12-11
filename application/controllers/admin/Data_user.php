<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['users'] = $this->Pendidikan_model->get_data('user')->result();
        $data['user'] = $this->db->get_where('user', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $this->load->view('templates_admin/admin_header');
        $this->load->view('templates_admin/admin_sidebar');
        $this->load->view('templates_admin/admin_topbar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates_admin/admin_footer');
    }

    public function destroy_datauser($id)
    {
        $where = array('id' => $id);
        $this->Pendidikan_model->destroy_kampus($where, 'user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Removed successfull </div>');
        redirect('admin/data_user');
    }

    public function update_user()
    {
        $id                 = $this->input->post('id');
        $name               = $this->input->post('name');
        $nim                = $this->input->post('nim');
        $role_id            = $this->input->post('role_id');

        $data = array(
            'name'           => $name,
            'nim'            => $nim,
            'role_id'        => $role_id,
        );

        $where = array(
            'id'   => $id
        );

        $this->Pendidikan_model->update_data('user', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> Customer Changed</div>');
        redirect('admin/data_user');
    }

    public function detail_user($id)
    {
        $data['users'] = $this->Pendidikan_model->ambil_id_user($id);
        $this->load->view('templates_admin/admin_header');
        $this->load->view('templates_admin/admin_sidebar');
        $this->load->view('templates_admin/admin_topbar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates_admin/admin_footer');
    }
}
