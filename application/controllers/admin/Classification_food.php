<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classification_food extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);
    }

    // untuk default
    public function index()
    {
        $data = [
            'classification' => $this->m_classification->get_all(),
        ];
        // untuk load view
        $this->template->load('admin', 'Classification Food', 'classification_food', 'view', $data);
    }

    public function get_data_dt()
    {
        $this->m_classification_food->get_all_data_dt();
    }

    public function show()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_classification_food', ['id_classification_food' => $post['id']]);

        $this->_response_message($response);
    }

    public function save()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_classification' => $post['id_classification'],
            'name'              => $post['name'],
            'weight'            => $post['weight'],
            'urt'               => $post['urt'],
            'kalori'            => $post['kalori'],
            'protein'           => $post['protein'],
            'lemak'             => $post['lemak'],
            'karbohidrat'       => $post['karbohidrat'],
            'serat'             => $post['serat'],
            'natrium'           => $post['natrium'],
            'kalium'            => $post['kalium'],
        ];

        $this->db->trans_start();
        if (empty($post['id_classification_food'])) {
            $this->crud->i('tb_classification_food', $data);
        } else {
            $this->crud->u('tb_classification_food', $data, ['id_classification_food' => $post['id_classification_food']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }

        $this->_response_message($response);
    }

    public function del()
    {
        $post = $this->input->post(NULL, TRUE);

        $check = checking_data($this->db->database, 'tb_classification_food', 'id_classification_food', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_classification_food', $post['id'], 'id_classification_food');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }

        $this->_response_message($response);
    }
}
