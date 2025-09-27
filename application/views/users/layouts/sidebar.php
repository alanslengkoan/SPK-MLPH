<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <!-- begin:: profil sidebar -->
        <div class="">
            <div class="main-menu-header">
                <img class="img-menu-user img-radius" src="<?= (get_users_detail($this->session->userdata('id'))->foto !== null ? upload_url('gambar') . '' . get_users_detail($this->session->userdata('id'))->foto : "//placehold.co/150") ?>" alt="User-Profile-Image">
                <div class="user-details">
                    <p id="more-details"><?= get_users_detail($this->session->userdata('id'))->nama ?></p>
                </div>
            </div>
        </div>
        <!-- end:: profil sidebar -->
        <!-- begin:: menu sidebar -->
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === null ? 'active' : '') ?>">
                <a href="<?= users_url() ?>">
                    <span class="pcoded-micon">
                        <i class="fa fa-dashboard"></i>
                    </span>
                    <span class="pcoded-mtext">Beranda</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Master</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'assessment' ? 'active' : '') ?>">
                <a href="<?= users_url() ?>assessment">
                    <span class="pcoded-micon">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="pcoded-mtext">Penilaian</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Metode</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'consultation' ? 'active' : '') ?>">
                <a href="<?= users_url() ?>consultation">
                    <span class="pcoded-micon">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="pcoded-mtext">Konsultasi</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Laporan</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'report' ? 'active' : '') ?>">
                <a href="<?= users_url() ?>report">
                    <span class="pcoded-micon">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="pcoded-mtext">Riwayat Konsultasi</span>
                </a>
            </li>
        </ul>
        <!-- end:: menu sidebar -->
    </div>
</nav>