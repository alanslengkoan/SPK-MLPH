<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Consultation extends MY_Controller
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
            'assessment' => $this->_get_assessment(),
        ];
        // untuk load view
        $this->template->load('admin', 'Consultation', 'consultation', 'view', $data);
    }

    public function process()
    {
        $post = $this->input->post(NULL, TRUE);

        $data_test = [];
        for ($i = 0; $i < count($post['id_criteria']); $i++) {
            $data_test[$post['id_criteria'][$i]] = $post['nilai'][$i];
        }

        $data = [
            'id_users'     => $this->id_users,
            'consultation' => json_encode($data_test),
        ];

        $this->db->trans_start();
        $this->crud->i('tb_consultation', $data);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!', 'id' => $id];
        }

        $this->_response_message($response);
    }

    public function results($id)
    {
        $get_consultation   = $this->crud->gda('tb_consultation', ['id_consultation' => $id]);
        $get_classification = $this->m_classification->get_all()->result();

        $data_training = $this->_get_datatraining();

        $konsultasi = json_decode($get_consultation['consultation'], TRUE);

        $criteria = $this->m_criteria->get_all()->result();

        $klasifikasi = [];
        foreach ($get_classification as $key => $value) {
            $klasifikasi[$value->id_classification] = $value->nama;
        }

        $tree      = $this->decisiontree->buildTree($data_training, $criteria, $klasifikasi);
        $hasil     = $this->decisiontree->classify($tree['tree'], $konsultasi, $criteria);
        $steps     = $this->decisiontree->steps();
        $graphTree = $this->decisiontree->graphTree();

        $show_classification = $this->m_classification->get_description($hasil);

        $classification_food = [];
        if (empty($show_classification)) {
            $description = '-';
        } else {
            $description         = $show_classification->deskripsi;
            $classification_food = $this->m_classification_food->get_show_classification($show_classification->id_classification)->result_array();
        }

        // Buat data untuk grafik (Tree Visualization)
        $treeData = json_encode($graphTree, JSON_PRETTY_PRINT);

        $data = [
            'ini'                 => $this,
            'data_training'       => $data_training,
            'criteria'            => $criteria,
            'data_test'           => $konsultasi,
            'data_classification' => $get_classification,
            'steps'               => $steps,
            'hasil'               => $hasil,
            'description'         => $description,
            'classification_food' => $classification_food,
            'tree_json'           => $treeData,
        ];

        // untuk load view
        $this->template->load('admin', 'Result', 'consultation', 'result', $data);
    }
}
