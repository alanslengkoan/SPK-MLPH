<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_classification_food extends CI_Model
{
    public function get_all()
    {
        $result = $this->db->query("");
        return $result;
    }

    public function get_show_classification($id_classification)
    {
        $result = $this->db->query("SELECT cf.id_classification_food, cf.id_classification, cf.name, cf.weight, cf.urt FROM tb_classification_food AS cf WHERE cf.id_classification = '$id_classification' ORDER BY cf.updated_at DESC");
        return $result;
    }

    public function get_all_data_dt()
    {
        $this->datatables->select('cf.id_classification_food, cf.id_classification, c.nama AS classification, cf.name, cf.weight, cf.urt');
        $this->datatables->join('tb_classification AS c', 'c.id_classification = cf.id_classification', 'left');
        $this->datatables->order_by('cf.updated_at', 'desc');
        $this->datatables->from('tb_classification_food AS cf');
        return print_r($this->datatables->generate());
    }
}
