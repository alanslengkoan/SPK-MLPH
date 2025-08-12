<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Informasi" />
    <meta name="keywords" content="Sistem Informasi" />
    <meta name="author" content="Sistem Informasi" />
    <title>Selamat Datang | Daftar</title>

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="<?= assets_url() ?>admin/images/icon/apple-touch-icon.png" sizes="180x180" />
    <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon-32x32.png" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon-16x16.png" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= assets_url() ?>admin/images/icon/favicon.ico" type="image/x-icon">
    <!-- end:: icon -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>my_assets/my_css.css" />
</head>

<body class="bg-custom">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <?= form_open('auth/process_save', array('id' => 'form-register', 'method' => 'post')) ?>
                    <div class="form-group">
                        <label>Nama</label>
                        <?= form_input(array('name' => 'nama', 'id' => 'nama', 'class' => 'form-control form-control-sm', 'placeholder' => 'Nama')) ?>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <?= form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control form-control-sm', 'placeholder' => 'E-mail')) ?>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control form-control-sm', 'placeholder' => 'Username')) ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <?= form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control form-control-sm', 'placeholder' => 'Password')) ?>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <a href="<?= login_url() ?>">Sudah Punya Akun?</a>
                        </div>
                    </div>
                    <?= form_input(array('type' => 'submit', 'name' => 'register', 'value' => 'Daftar', 'id' => 'register', 'class' => 'btn btn-success btn-flat m-b-30 m-t-30')) ?>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <script>
        var untukSubmit = function() {
            $('#form-register').parsley();
            $('#form-register').submit(function(e) {
                e.preventDefault();
                $('#nama').attr('required', 'required');
                $('#email').attr('required', 'required');
                $('#username').attr('required', 'required');
                $('#password').attr('required', 'required');
                if ($('#form-register').parsley().isValid() == true) {
                    $.ajax({
                        method: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            $('#register').val('Wait');
                        },
                        success: function(response) {
                            $('#register').val('Register');

                            swal({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.type,
                                    button: response.button,
                                })
                                .then((value) => {
                                    location.href = "<?= login_url() ?>";
                                });
                        }
                    })
                }
            });
        }();
    </script>
</body>

</html>