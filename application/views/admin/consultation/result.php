<!-- begin:: breadcumb -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h4 class="m-b-10"><?= $title ?></h4>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= admin_url() ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= admin_url('consultation') ?>">Consultation</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#!"><?= $title ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end:: breadcumb -->

<!-- begin:: content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-block table-border-style">
                        <button class="btn btn-primary btn-block" type="button" data-bs-toggle="collapse" data-bs-target="#produkCard" aria-expanded="false" aria-controls="produkCard">
                            Tampilkan Proses Perhitungan
                        </button>
                    </div>
                </div>

                <div class="collapse" id="produkCard">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2">Data Training</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <table class="table table-striped table-bordered nowrap" style="width: 100%;">
                                <thead>
                                    <tr align="center">
                                        <?php foreach ($criteria as $key => $value) : ?>
                                            <th><?= $value->nama ?></th>
                                        <?php endforeach; ?>
                                        <th>Klastifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_training as $key => $value) : ?>
                                        <tr align="center">
                                            <?php foreach ($value['kriteria'] as $row) : ?>
                                                <td><?= $row['label'] ?></td>
                                            <?php endforeach; ?>
                                            <td><?= $value['nama'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2">Data Test</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <table class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr align="center">
                                        <?php foreach ($criteria as $key => $value) : ?>
                                            <th><?= $value->nama ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        <?php foreach ($criteria as $k_c => $v_c) : ?>
                                            <th><?= $ini->_criteria_sub()[$v_c->id_criteria][$data_test[$v_c->id_criteria]] ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-primary text-white">
                            Langkah-langkah Pembentukan Decision Tree
                        </div>
                        <div class="card-body">
                            <?php foreach ($steps as $step): ?>
                                <p><?= $step ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Grafik Pohon Keputusan</h5>
                        </div>
                        <div class="card-body">
                            <div id="tree-container"></div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        Hasil
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hasil Klasifikasi:</h5>
                        <p><?= $hasil ?></p>
                        <hr />
                        <h5>Deskripsi:</h5>
                        <p><?= $description ?></p>
                        <hr />
                        <h5>Rekomendasi Makanan:</h5>
                        <?php if (count($classification_food) !== 0) : ?>
                            <table class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr align="center">
                                        <th>Nama</th>
                                        <th>Berat</th>
                                        <th>URT</th>
                                        <th>Kalori</th>
                                        <th>Protein</th>
                                        <th>Lemak</th>
                                        <th>Karbohidrat</th>
                                        <th>Serat</th>
                                        <th>Natrium</th>
                                        <th>Kalium</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($classification_food as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $value['name'] ?></td>
                                            <td><?= $value['weight'] ?></td>
                                            <td><?= $value['urt'] ?></td>
                                            <td><?= $value['kalori'] ?></td>
                                            <td><?= $value['protein'] ?></td>
                                            <td><?= $value['lemak'] ?></td>
                                            <td><?= $value['karbohidrat'] ?></td>
                                            <td><?= $value['serat'] ?></td>
                                            <td><?= $value['natrium'] ?></td>
                                            <td><?= $value['kalium'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            Tidak ada rekomendasi makanan
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->