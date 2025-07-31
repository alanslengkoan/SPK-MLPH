<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Consultation extends MY_Controller
{
    protected $steps = [];

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

        $tree  = $this->buildTree($data_training, $criteria , $klasifikasi);
        $hasil = $this->classify($tree, $konsultasi, $criteria );

        $data = [
            'ini'                 => $this,
            'data_training'       => $data_training,
            'criteria'            => $criteria,
            'data_test'           => $konsultasi,
            'data_classification' => $get_classification,
            'steps'               => $this->steps,
            'hasil'               => $hasil,
        ];

        // untuk load view
        $this->template->load('admin', 'Result', 'consultation', 'result', $data);
    }

    public function _get_assessment()
    {
        $criteria = $this->m_criteria->get_all()->result();
        $result = [];
        foreach ($criteria as $key => $value) {
            $criteria_sub = $this->m_criteria_sub->get_detail($value->id_criteria)->result_array();
            $result[] = [
                'id_criteria'  => $value->id_criteria,
                'nama'         => $value->nama,
                'sub_criteria' => $criteria_sub
            ];
        }
        return $result;
    }

    // Hitung Entropy dari subset
    public function entropy($subset)
    {
        $total = count($subset);
        if ($total === 0) return 0;

        $count = [];
        foreach ($subset as $row) {
            $cls = $row['classification'];
            if (!isset($count[$cls])) $count[$cls] = 0;
            $count[$cls]++;
        }

        $entropy = 0;
        foreach ($count as $freq) {
            $p = $freq / $total;
            $entropy -= $p * log($p, 2);
        }

        return $entropy;
    }

    // Bagi data berdasarkan nilai pada satu atribut
    public function splitByAttribute($data, $attr_id)
    {
        $splits = [];
        foreach ($data as $row) {
            $val = $row['kriteria'][$attr_id]['nilai'];
            $splits[$val][] = $row;
        }
        return $splits;
    }

    // Hitung Information Gain
    public function informationGain($data, $attr_id)
    {
        $base_entropy = $this->entropy($data);
        $splits = $this->splitByAttribute($data, $attr_id);
        $total = count($data);

        $weighted_entropy = 0;
        foreach ($splits as $subset) {
            $weighted_entropy += (count($subset) / $total) * $this->entropy($subset);
        }

        $gain = $base_entropy - $weighted_entropy;

        return $gain;
    }

    // Bangun tree secara rekursif
    public function buildTree($data, $attributes, $klasifikasi, $depth = 0)
    {
        $classes = array_unique(array_column($data, 'classification'));

        if (count($classes) == 1) {
            $this->steps[] = str_repeat('&nbsp;&nbsp;', $depth) . "Hasil klasifikasi: <b>{$klasifikasi[$classes[0]]}</b>";
            return $klasifikasi[$classes[0]];
        }

        if (empty($attributes)) {
            $votes = array_count_values(array_column($data, 'classification'));
            arsort($votes);
            $majority = $klasifikasi[array_key_first($votes)];
            $this->steps[] = str_repeat('&nbsp;&nbsp;', $depth) . "Voting mayoritas: <b>$majority</b>";
            return $majority;
        }

        $best_gain = -1;
        $best_attr = null;

        foreach ($attributes as $attr) {
            $gain = $this->informationGain($data, $attr->id_criteria);
            $this->steps[] = str_repeat('&nbsp;&nbsp;', $depth) . "Information Gain <b>{$attr->nama}</b>: " . round($gain, 4);
            if ($gain > $best_gain) {
                $best_gain = $gain;
                $best_attr = $attr;
            }
        }

        if (!$best_attr) {
            $votes = array_count_values(array_column($data, 'classification'));
            arsort($votes);
            $majority = $klasifikasi[array_key_first($votes)];
            $this->steps[] = str_repeat('&nbsp;&nbsp;', $depth) . "Tidak ada atribut terbaik, Voting mayoritas: <b>$majority</b>";
            return $majority;
        }

        $this->steps[] = str_repeat('&nbsp;&nbsp;', $depth) . "<b>Atribut Terbaik: {$best_attr->nama}</b>";
        $tree = [$best_attr->nama => []];

        $splits = $this->splitByAttribute($data, $best_attr->id_criteria);
        $remaining_attributes = array_filter($attributes, fn($a) => $a->id_criteria != $best_attr->id_criteria);

        foreach ($splits as $val => $subset) {
            $this->steps[] = str_repeat('&nbsp;&nbsp;', $depth + 1) . "Jika <b>{$best_attr->nama}</b> = <b>$val</b>:";
            $tree[$best_attr->nama][$val] = $this->buildTree($subset, $remaining_attributes, $klasifikasi, $depth + 2);
        }

        return $tree;
    }

    // Prediksi klasifikasi dari tree
    public function classify($tree, $input, $criteria)
    {
        if (!is_array($tree)) return $tree;

        $attribute = key($tree);
        $childs = $tree[$attribute];

        // Temukan ID criteria berdasarkan nama
        foreach ($criteria as $c) {
            if ($c->nama == $attribute) {
                $attr_id = $c->id_criteria;
                break;
            }
        }

        $value = $input[$attr_id] ?? null;
        return isset($childs[$value]) ? $this->classify($childs[$value], $input, $criteria) : "Tidak Diketahui";
    }
}
