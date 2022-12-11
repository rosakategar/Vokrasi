<?php

class pendidikan_model extends CI_model
{
    public function import_excel($datamahasiswa)
    {
        $jumlah = count($datamahasiswa);
        if ($jumlah > 0) {
            $this->db->replace('mahasiswa', $datamahasiswa);
        }
    }

    public function getDataMahasiswa()
    {
        return $this->db->get('mahasiswa')->result_array();
    }

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function getAlluser()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function destroy_kampus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function ambil_id_kampus($id)
    {
        $hasil = $this->db->where('id_perguruan', $id)->get('kampus');
        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        } else {
            return false;
        }
    }

    public function ambil_id_user($id)
    {
        $akhir = $this->db->where('id', $id)->get('user');
        if ($akhir->num_rows() > 0) {
            return $akhir->result();
        } else {
            return false;
        }
    }

    function jumlah_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        return $this->db->get()->num_rows();
    }

    function jumlah_kampus()
    {
        $this->db->select('*');
        $this->db->from('kampus');
        return $this->db->get()->num_rows();
    }
}
