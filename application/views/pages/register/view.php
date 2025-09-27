<!DOCTYPE html>
<html lang="en">

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Arial', sans-serif;
        }

        .split-screen-container {
            display: flex;
            height: 100vh;
        }

        .left-pane {
            flex: 1;
            background-color: #3674B5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .right-pane {
            flex: 1;
            background-image: url(../public/assets/bg.jpg);
            background-size: cover;
            background-position: right;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            color: white;
        }

        .login-box .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-box .logo-container img {
            max-width: 150px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #f0f4f8;
            color: #333;
        }

        .form-control::placeholder {
            color: #999;
        }

        .login-link {
            display: block;
            margin-bottom: 25px;
            color: #f1f1f1;
            text-decoration: none;
            font-size: 0.9em;
        }

        .login-link:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="split-screen-container">
        <div class="left-pane">
            <div class="login-box">
                <div class="logo-container">
                    <img src="<?= base_url('public/assets/logo.png') ?>" alt="Logo">
                </div>

                <?= form_open('auth/process_save', array('id' => 'form-register', 'method' => 'post')) ?>

                <div class="input-group">
                    <i class="fas fa-id-card"></i>
                    <?= form_input(array('name' => 'nama', 'id' => 'nama', 'class' => 'form-control form-control-sm', 'placeholder' => 'Nama')) ?>
                </div>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <?= form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control form-control-sm', 'placeholder' => 'E-mail')) ?>
                </div>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control form-control-sm', 'placeholder' => 'Username')) ?>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <?= form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control form-control-sm', 'placeholder' => 'Password')) ?>
                </div>

                <a href="<?= login_url() ?>" class="login-link">Sudah Punya Akun?</a>

                <?= form_input(array('type' => 'submit', 'name' => 'register', 'value' => 'Daftar', 'id' => 'register', 'class' => 'btn-submit')) ?>

                <?= form_close() ?>
            </div>
        </div>

        <div class="right-pane"></div>
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

                            if (response.type == 'error') {
                                swal({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.type,
                                    button: response.button,
                                });
                            } else {
                                swal({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.type,
                                    button: response.button,
                                }).then((value) => {
                                    location.href = "<?= login_url() ?>";
                                });
                            }
                        }
                    })
                }
            });
        }();
    </script>
</body>

</html>