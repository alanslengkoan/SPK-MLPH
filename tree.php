<?php
$pdo = new PDO("mysql:host=localhost;dbname=codepoze_spk-id3-decision-tree", "my_root", "my_pass");

// Hitung Entropy
function entropy($data)
{
    $total = count($data);
    $counts = array_count_values(array_column($data, 'class'));

    $entropy = 0;
    foreach ($counts as $count) {
        $p = $count / $total;
        $entropy -= $p * log($p, 2);
    }
    return $entropy;
}

// Split data berdasarkan atribut dan nilai
function splitData($data, $attribute, $value)
{
    return array_filter($data, function ($row) use ($attribute, $value) {
        return $row[$attribute] == $value;
    });
}

// Hitung Gain
function infoGain($data, $attribute)
{
    $total = count($data);
    $entropyBefore = entropy($data);

    $values = array_unique(array_column($data, $attribute));
    $entropyAfter = 0;

    foreach ($values as $value) {
        $subset = splitData($data, $attribute, $value);
        $entropyAfter += (count($subset) / $total) * entropy($subset);
    }

    return $entropyBefore - $entropyAfter;
}

// Bangun tree
function buildTree($data, $attributes)
{
    $classes = array_unique(array_column($data, 'class'));

    if (count($classes) == 1) {
        return $classes[0];
    }

    if (empty($attributes)) {
        return array_count_values(array_column($data, 'class'));
    }

    $bestGain = -INF;
    $bestAttribute = null;

    foreach ($attributes as $attribute) {
        $gain = infoGain($data, $attribute);
        if ($gain > $bestGain) {
            $bestGain = $gain;
            $bestAttribute = $attribute;
        }
    }

    if ($bestGain <= 0) {
        return array_count_values(array_column($data, 'class'));
    }

    $tree = [$bestAttribute => []];
    $values = array_unique(array_column($data, $bestAttribute));

    foreach ($values as $value) {
        $subset = splitData($data, $bestAttribute, $value);
        $remainingAttributes = array_diff($attributes, [$bestAttribute]);
        $tree[$bestAttribute][$value] = buildTree($subset, $remainingAttributes);
    }

    return $tree;
}

// Load data dari DB
$stmt = $pdo->query("SELECT * FROM dataset");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Atribut yang digunakan
$attributes = ['age', 'income', 'student', 'loan'];

// Bangun decision tree
$tree = buildTree($data, $attributes);

echo "<pre>";
print_r($tree);
echo "</pre>";

function classify($tree, $instance)
{
    if (!is_array($tree)) return $tree;

    $attribute = key($tree);
    $value = $instance[$attribute];

    if (!isset($tree[$attribute][$value])) return "Tidak Diketahui";

    return classify($tree[$attribute][$value], $instance);
}

// Contoh uji
$testData = [
    'age' => 'Tua',
    'income' => 'Tinggi',
    'student' => 'Tidak',
    'loan' => 'Macet'
];

echo "Prediksi: " . classify($tree, $testData);
