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
                    <div class="card-header">
                        <h3>Sistem Pendukung Keputusan Berbasis Web Dalam Penentuan Makanan Lansia Penderita Hipertensi Menggunakan Algoritma Decision Tree</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-justify">
                                    Sistem ini merupakan Sistem Pendukung Keputusan berbasis web yang dirancang untuk membantu dalam penentuan makanan bagi lansia penderita hipertensi. Dengan memanfaatkan algoritma Decision Tree, sistem ini mampu mengolah data dan memberikan rekomendasi makanan yang sesuai berdasarkan kondisi kesehatan lansia.
                                </p>
                                <p class="text-justify">
                                    Tujuan dari sistem ini adalah memberikan dukungan kepada pengguna dalam mengambil keputusan yang lebih tepat, sehingga dapat membantu menjaga pola makan yang sehat, mengontrol tekanan darah, serta meningkatkan kualitas hidup lansia penderita hipertensi.
                                </p>
                            </div>

                            <!-- Gambar 1 -->
                            <div class="col-md-6 text-center my-3">
                                <img src="<?= assets_url() ?>admin/images/01.jpg"
                                    class="img-fluid rounded" width="500">
                            </div>

                            <!-- Gambar 2 -->
                            <div class="col-md-6 text-center my-3">
                                <img src="<?= assets_url() ?>admin/images/02.jpg"
                                    class="img-fluid rounded" width="500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <i class="fa fa-list f-28 text-c-yellow"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <h6 class="text-muted m-b-0">Criteria</h6>
                                        <h4><?= $criteria ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <i class="fa fa-list f-28 text-c-green"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <h6 class="text-muted m-b-0">Sub Criteria</h6>
                                        <h4><?= $criteria_sub ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <i class="fa fa-list f-28 text-c-blue"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <h6 class="text-muted m-b-0">Assessment</h6>
                                        <h4><?= $criteria_sub ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <i class="fa fa-list f-28 text-c-red"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <h6 class="text-muted m-b-0">Classification</h6>
                                        <h4><?= $classification ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <i class="fa fa-list f-28 text-c-black"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <h6 class="text-muted m-b-0">Data Training</h6>
                                        <h4><?= $datatraining ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <i class="fa fa-list f-28 text-c-orenge"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <h6 class="text-muted m-b-0">Consultation</h6>
                                        <h4><?= $consultation ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->