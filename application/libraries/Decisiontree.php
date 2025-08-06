<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Decisiontree
{
    private $ci;
    public $steps = [];

    function __construct()
    {
        $this->ci = &get_instance();
    }

    public function steps()
    {
        return $this->steps;
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
