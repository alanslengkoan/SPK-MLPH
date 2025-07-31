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
                                <h5 class="w-75 p-2">Daftar <?= $title ?></h5>
                            </div>
                            <div class="col-lg-6 text-right">
                                <button type="button" id="btn-add" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <table class="table table-striped table-bordered nowrap dataTables" style="width: 100%;">
                            <thead align="center">
                                <tr>
                                    <?php foreach ($criteria as $key => $value) : ?>
                                        <th><?= $value->nama ?></th>
                                    <?php endforeach; ?>
                                    <th>Klastifikasi</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <?php foreach ($datatraining as $k_d => $v_d) : ?>
                                    <tr>
                                        <?php foreach ($criteria as $k_c => $v_c) : ?>
                                            <td><?= $v_d['data'][$v_c->id_criteria] ?></td>
                                        <?php endforeach; ?>
                                        <td><?= $v_d['classification'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->


<!-- begin:: modal tambah & ubah -->
<div class="modal fade" id="modal-add-upd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <form id="form-add-upd" action="<?= admin_url() ?>datatraining/save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Classification *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_classification" id="id_classification">
                                <option value="">- Pilih -</option>
                                <?php foreach ($classification as $key => $row) { ?>
                                    <option value="<?= $row->id_classification ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-cancel" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect" id="btn-save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end:: modal tambah & ubah -->