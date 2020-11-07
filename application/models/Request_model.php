<?php

class Request_model extends CI_model
{
    public function getAllData()
    {
        return $this->db->get('user_requests')->result_array();
    }
    public function accept($id_gangguan, $id_request)
    {
        $this->db->where('id', $id_gangguan);
        $this->db->update('data_gangguan_internet', ["is_active" => 1]);

        $this->db->delete('user_requests', ['id' => $id_request]);
    }
    public function reject($id_gangguan, $id_request)
    {
        $this->db->delete('data_gangguan_internet', ['id' => $id_gangguan]);

        $this->db->delete('user_requests', ['id' => $id_request]);
    }
}
