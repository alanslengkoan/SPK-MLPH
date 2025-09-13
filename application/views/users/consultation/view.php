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
                        <a href="<?= users_url() ?>">Dashboard</a>
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2"><?= $title ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form-consultation" action="<?= users_url() ?>consultation/process" method="POST">
                            <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                            <?php foreach ($assessment as $row) : ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?= $row['nama'] ?> *</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id_criteria[]" value="<?= $row['id_criteria'] ?>" />
                                        <select class="form-control" name="nilai[]" id="nilai">
                                            <option value="">- Pilih <?= $row['nama'] ?> -</option>
                                            <?php foreach ($row['sub_criteria'] as $key => $value) : ?>
                                                <option value="<?= $value['nilai'] ?>"><?= $value['nama']  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect" id="btn-process"><i class="fa fa-spinner"></i>&nbsp;Proses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="w-75 p-2">Kategori: Underweight (Kurus) - IMT &lt; 18</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Rentang Tinggi Badan (TB)</th>
                                            <th>Rentang Berat Badan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>145 - 149 cm</td>
                                            <td>&lt; 39.0 kg</td>
                                        </tr>
                                        <tr>
                                            <td>150 - 154 cm</td>
                                            <td>&lt; 40.5 - 42.7 kg</td>
                                        </tr>
                                        <tr>
                                            <td>155 - 159 cm</td>
                                            <td>&lt; 43.2 - 45.4 kg</td>
                                        </tr>
                                        <tr>
                                            <td>160 - 164 cm</td>
                                            <td>&lt; 46.1 - 48.4 kg</td>
                                        </tr>
                                        <tr>
                                            <td>165 - 169 cm</td>
                                            <td>&lt; 49.0 - 51.5 kg</td>
                                        </tr>
                                        <tr>
                                            <td>170 - 174 cm</td>
                                            <td>&lt; 52.0 - 54.6 kg</td>
                                        </tr>
                                        <tr>
                                            <td>175 - 179 cm</td>
                                            <td>&lt; 55.1 - 57.8 kg</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="w-75 p-2">Kategori: Normal (Sehat) - IMT 18 - 24.9</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Rentang Tinggi Badan (TB)</th>
                                            <th>Rentang Berat Badan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>145 - 149 cm</td>
                                            <td>39.0 - 53.9 kg</td>
                                        </tr>
                                        <tr>
                                            <td>150 - 154 cm</td>
                                            <td>40.5 - 56.9 kg</td>
                                        </tr>
                                        <tr>
                                            <td>155 - 159 cm</td>
                                            <td>43.2 - 60.8 kg</td>
                                        </tr>
                                        <tr>
                                            <td>160 - 164 cm</td>
                                            <td>46.1 - 64.9 kg</td>
                                        </tr>
                                        <tr>
                                            <td>165 - 169 cm</td>
                                            <td>49.0 - 69.2 kg</td>
                                        </tr>
                                        <tr>
                                            <td>170 - 174 cm</td>
                                            <td>52.0 - 73.7 kg</td>
                                        </tr>
                                        <tr>
                                            <td>175 - 179 cm</td>
                                            <td>55.1 - 78.4 kg</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="w-75 p-2">Kategori: Overweight (Beresiko) - IMT 25 - 29.9</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Rentang Tinggi Badan (TB)</th>
                                            <th>Rentang Berat Badan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>145 - 149 cm</td>
                                            <td>54.0 - 64.7 kg</td>
                                        </tr>
                                        <tr>
                                            <td>150 - 154 cm</td>
                                            <td>57.0 - 68.3 kg</td>
                                        </tr>
                                        <tr>
                                            <td>155 - 159 cm</td>
                                            <td>60.9 - 73.0 kg</td>
                                        </tr>
                                        <tr>
                                            <td>160 - 164 cm</td>
                                            <td>65.0 - 77.9 kg</td>
                                        </tr>
                                        <tr>
                                            <td>165 - 169 cm</td>
                                            <td>69.3 - 83.0 kg</td>
                                        </tr>
                                        <tr>
                                            <td>170 - 174 cm</td>
                                            <td>73.8 - 88.4 kg</td>
                                        </tr>
                                        <tr>
                                            <td>175 - 179 cm</td>
                                            <td>78.5 - 94.0 kg</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="w-75 p-2">Kategori: Obesitas - IMT ≥ 30</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Rentang Tinggi Badan (TB)</th>
                                            <th>Berat Badan (BB)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>145 - 149 cm</td>
                                            <td>≥ 64.8 kg</td>
                                        </tr>
                                        <tr>
                                            <td>150 - 154 cm</td>
                                            <td>≥ 68.4 kg</td>
                                        </tr>
                                        <tr>
                                            <td>155 - 159 cm</td>
                                            <td>≥ 73.1 kg</td>
                                        </tr>
                                        <tr>
                                            <td>160 - 164 cm</td>
                                            <td>≥ 78.0 kg</td>
                                        </tr>
                                        <tr>
                                            <td>165 - 169 cm</td>
                                            <td>≥ 83.1 kg</td>
                                        </tr>
                                        <tr>
                                            <td>170 - 174 cm</td>
                                            <td>≥ 88.5 kg</td>
                                        </tr>
                                        <tr>
                                            <td>175 - 179 cm</td>
                                            <td>≥ 94.1 kg</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->