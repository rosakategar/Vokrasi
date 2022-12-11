<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_kampus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pendidikan_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['nim' =>
        $this->session->userdata('nim')])->row_array();
        $data['kampus'] = $this->Pendidikan_model->get_data('kampus')->result();
        $data['perguruan'] = $this->Pendidikan_model->get_data('perguruan')->result();

        $this->load->view('templates_admin/admin_header');
        $this->load->view('templates_admin/admin_sidebar');
        $this->load->view('templates_admin/admin_topbar', $data);
        $this->load->view('admin/data_kampus', $data);
        $this->load->view('templates_admin/admin_footer');
    }

    public function tambah_kampus()
    {
        $data['user'] = $this->db->get_where('user', ['nim' =>
        $this->session->userdata('nim')])->row_array();
        $data['perguruan'] = $this->Pendidikan_model->get_data('perguruan')->result();
        $this->load->view('templates_admin/admin_header');
        $this->load->view('templates_admin/admin_sidebar');
        $this->load->view('templates_admin/admin_topbar', $data);
        $this->load->view('admin/form_tambah_kampus', $data);
        $this->load->view('templates_admin/admin_footer');
    }

    public function tambah_kampus_aksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->tambah_kampus();
        } else {
            $kode_perguruan     = $this->input->post('kode_perguruan');
            $nama               = $this->input->post('nama');
            $daerah             = $this->input->post('daerah');
            $link               = $this->input->post('link');
            $gambar             = $_FILES['gambar']['name'];
            if ($gambar = '') {
            } else {
                $config['upload_path']          = './assets/assets_user/img/portfolio';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Gambar Institusi Gagal DiUpload!";
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            }

            $data = array(
                'kode_perguruan'    => $kode_perguruan,
                'nama'              => $nama,
                'daerah'            => $daerah,
                'link'              => $link,
                'gambar'            => $gambar,
            );

            $this->Pendidikan_model->insert_data($data, 'kampus');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Berhasil</div>');
            redirect('admin/data_kampus');
        }
    }

    public function update_kampus_aksi()
    {
        $this->_rules();

        $data['kampus'] = $this->Pendidikan_model->get_data('kampus')->result();
        $data['perguruan'] = $this->Pendidikan_model->get_data('perguruan')->result();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_admin/admin_header');
            $this->load->view('templates_admin/admin_sidebar');
            $this->load->view('templates_admin/admin_topbar');
            $this->load->view('admin/data_kampus', $data);
            $this->load->view('templates_admin/admin_footer');
        } else {
            $id                     = $this->input->post('id_perguruan');
            $kode_perguruan         = $this->input->post('kode_perguruan');
            $nama                   = $this->input->post('nama');
            $daerah                 = $this->input->post('daerah');
            $link                   = $this->input->post('link');
            $gambar                 = $_FILES['gambar']['name'];
            if ($gambar) {
                $config['upload_path'] = './assets/upload';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data('file_name');
                    $this->db->set('gambar', $gambar);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data = array(
                'kode_perguruan'    => $kode_perguruan,
                'nama'              => $nama,
                'daerah'            => $daerah,
                'link'              => $link,
            );

            $where = array(
                'id_perguruan' => $id
            );

            $this->Pendidikan_model->update_data('kampus', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Satuan Kerja Changed</div>');
            redirect('admin/data_kampus');
        }
    }

    public function destroy_datakampus($id)
    {
        $where = array('id_perguruan' => $id);
        $this->Pendidikan_model->destroy_kampus($where, 'kampus');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Removed successfull </div>');
        redirect('admin/data_kampus');
    }

    public function detail_kampus($id)
    {
        $data['kampus'] = $this->Pendidikan_model->ambil_id_kampus($id);

        $this->load->view('templates_admin/admin_header');
        $this->load->view('templates_admin/admin_sidebar');
        $this->load->view('templates_admin/admin_topbar');
        $this->load->view('admin/data_kampus', $data);
        $this->load->view('templates_admin/admin_footer');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_perguruan', 'Kode Perguruan', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('daerah', 'Daerah', 'trim|required');
        $this->form_validation->set_rules('link', 'Link', 'trim|required');
    }
}
