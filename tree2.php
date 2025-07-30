<?php

class DecisionTree
{
    private $pdo;
    private $attributes = ['age', 'income', 'student', 'loan'];

    public function __construct()
    {
        // --- KONEKSI DATABASE ---
        $host = 'localhost';
        $db   = 'codepoze_spk-id3-decision-tree'; // Ganti dengan nama database Anda
        $user = 'my_root';
        $pass = 'my_pass'; // Ganti dengan password Anda
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Fungsi utama untuk membangun pohon keputusan
     */
    public function buildTree($data)
    {
        // Kasus dasar: Jika semua data memiliki kelas yang sama, kembalikan kelas tersebut
        $classCounts = array_count_values(array_column($data, 'class'));
        if (count($classCounts) === 1) {
            return array_key_first($classCounts);
        }

        // Kasus dasar: Jika tidak ada atribut lagi untuk di-split, kembalikan kelas mayoritas
        if (empty($this->attributes)) {
            arsort($classCounts);
            return array_key_first($classCounts);
        }

        // Cari atribut terbaik untuk dijadikan node
        $bestAttribute = $this->findBestAttribute($data);
        $tree = [$bestAttribute => []];

        // Dapatkan semua nilai unik dari atribut terbaik
        $attributeValues = array_unique(array_column($data, $bestAttribute));

        // Buat cabang untuk setiap nilai
        foreach ($attributeValues as $value) {
            $subset = array_filter($data, fn($row) => $row[$bestAttribute] === $value);
            $tree[$bestAttribute][$value] = $this->buildTree($subset);
        }

        return $tree;
    }

    /**
     * Fungsi untuk memulai proses klasifikasi
     */
    public function classify($testData)
    {
        $stmt = $this->pdo->query('SELECT * FROM dataset');
        $trainingData = $stmt->fetchAll();

        $tree = $this->buildTree($trainingData);

        // Cetak struktur pohon untuk debugging (opsional)
        echo "<h3>Struktur Decision Tree:</h3>";
        echo "<pre>" . print_r($tree, true) . "</pre>";
        echo "<hr>";

        return $this->traverseTree($tree, $testData);
    }

    /**
     * Fungsi rekursif untuk menelusuri pohon
     */
    private function traverseTree($tree, $testData)
    {
        if (!is_array($tree)) {
            return $tree; // Mencapai leaf node (hasil klasifikasi)
        }

        $attribute = array_key_first($tree);
        $value = $testData[$attribute];

        // Jika nilai dari data tes ada di cabang pohon
        if (isset($tree[$attribute][$value])) {
            return $this->traverseTree($tree[$attribute][$value], $testData);
        } else {
            // Jika tidak ada cabang yang cocok, kembalikan null atau kelas default
            return "Tidak dapat diklasifikasikan";
        }
    }

    private function findBestAttribute($data)
    {
        $totalEntropy = $this->calculateEntropy($data);
        $bestGain = -1;
        $bestAttribute = null;

        foreach ($this->attributes as $attribute) {
            $gain = $this->calculateInformationGain($data, $attribute, $totalEntropy);
            if ($gain > $bestGain) {
                $bestGain = $gain;
                $bestAttribute = $attribute;
            }
        }
        return $bestAttribute;
    }

    private function calculateInformationGain($data, $attribute, $totalEntropy)
    {
        $totalRows = count($data);
        $attributeValues = array_unique(array_column($data, $attribute));
        $weightedEntropy = 0;

        foreach ($attributeValues as $value) {
            $subset = array_filter($data, fn($row) => $row[$attribute] === $value);
            $subsetCount = count($subset);
            if ($subsetCount > 0) {
                $weightedEntropy += ($subsetCount / $totalRows) * $this->calculateEntropy($subset);
            }
        }

        return $totalEntropy - $weightedEntropy;
    }

    private function calculateEntropy($data)
    {
        $totalRows = count($data);
        if ($totalRows === 0) return 0;

        $classCounts = array_count_values(array_column($data, 'class'));
        $entropy = 0;

        foreach ($classCounts as $count) {
            $probability = $count / $totalRows;
            $entropy -= $probability * log($probability, 2);
        }

        return $entropy;
    }
}

// --- PENGGUNAAN ---

// Data Testing dari gambar
$dataTesting = [
    'age' => 'Tua',
    'income' => 'Tinggi',
    'student' => 'Tidak',
    'loan' => 'Macet'
];

echo "<h2>Klasifikasi Data Testing</h2>";
echo "<b>Data:</b><br>";
echo "<ul>";
foreach ($dataTesting as $key => $value) {
    echo "<li>" . ucfirst($key) . ": $value</li>";
}
echo "</ul>";

$classifier = new DecisionTree();
$prediction = $classifier->classify($dataTesting);

echo "<h3>Hasil Prediksi Class:</h3>";
echo "<h1>" . htmlspecialchars($prediction) . "</h1>";
