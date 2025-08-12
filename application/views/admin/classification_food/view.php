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
                        <table class="table table-striped table-bordered nowrap" id="tabel-classification_food-dt" style="width: 100%;">
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
            <form id="form-add-upd" action="<?= admin_url() ?>classification_food/save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <input type="hidden" name="id_classification_food" id="id_classification_food" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Classification *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_classification" id="id_classification">
                                <option value="">Pilih Classification</option>
                                <?php foreach ($classification->result() as $row) : ?>
                                    <option value="<?= $row->id_classification ?>"><?= $row->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Berat *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="weight" id="weight" placeholder="Masukkan berat" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">URT *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="urt" id="urt" placeholder="Masukkan urt" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kalori *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kalori" id="kalori" placeholder="Masukkan kalori" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Protein *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="protein" id="protein" placeholder="Masukkan protein" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Lemak *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lemak" id="lemak" placeholder="Masukkan lemak" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Karbohidrat *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="karbohidrat" id="karbohidrat" placeholder="Masukkan karbohidrat" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Serat *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="serat" id="serat" placeholder="Masukkan serat" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Natrium *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="natrium" id="natrium" placeholder="Masukkan natrium" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kalium *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kalium" id="kalium" placeholder="Masukkan kalium" />
                        </div>
                    </div>
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