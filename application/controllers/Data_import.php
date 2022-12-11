<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

//Memanggil class dari PhpSpreadsheet dengan namespace
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Data_import extends CI_Controller
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
        $data['mahasiswa'] = $this->Pendidikan_model->get_data('mahasiswa')->result();

        $this->load->view('templates_admin/admin_header');
        $this->load->view('templates_admin/admin_sidebar');
        $this->load->view('templates_admin/admin_topbar', $data);
        $this->load->view('admin/data_import', $data);
        $this->load->view('templates_admin/admin_footer');
    }

    // public function spreadsheet_import()
    // {
    //     $upload_file = $_FILES['upload_file']['name'];
    //     $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
    //     if ($extension == 'csv') {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    //     } elseif ($extension == 'xls') {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //     } else {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //     }
    //     $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
    //     $sheetdata = $spreadsheet->getActiveSheet()->toArray();
    //     echo '<pre>';
    //     print_r($sheetdata);
    // }
}
