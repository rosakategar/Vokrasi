<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Data_mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pendidikan_model');
    }

    public function index()
    {
        $data['title'] = 'Export Import';
        $data['semuamahasiswa'] = $this->data_import->getDataMahasiswa();
        $this->load->view('index', $data);
    }

    public function tambah_mahasiswa()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('excel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $datamahasiswa = array(
                            'nim' => $row->getCellAtIndex(1),
                            'nama' => $row->getCellAtIndex(2),
                            'angkatan' => $row->getCellAtIndex(3),
                        );
                        $this->Pendidikan_model->import_excel($datamahasiswa);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'import Data Berhasil');
                redirect('data_import');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }

    public function mpdf()
    {
        require './assets/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $datamahasiswa = $this->Pendidikan_model->getDataMahasiswa();
        $data = $this->load->view('pdf/mpdf', ['semuamahasiswa' => $datamahasiswa], TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output();
    }

    public function export_excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach (range('A', 'D') as $coulumID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutosize(true);
        }
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Angkatan');

        $users = $this->db->query("SELECT * FROM mahasiswa")->result_array();
        $x = 2;
        $no = 1;

        foreach ($users as $row) {

            $sheet->setCellValue('A' . $x, $row[$no++]);
            $sheet->setCellValue('A' . $x, $row['nim']);
            $sheet->setCellValue('A' . $x, $row['nama']);
            $sheet->setCellValue('A' . $x, $row['angkatan']);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Nama Mahasiswa.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        $writer->save('php://output');
    }
}
