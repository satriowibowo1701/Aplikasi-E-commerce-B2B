<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Reset Form</title>
</head>
<style>
    body {
        background-color: Aquamarine;
    }

    .col-sm {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 30%;
        padding: 20px;
    }


    @media screen and (max-width: 900px) {
        .col-sm {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            padding: 20px;
        }
    }

    @media screen and (max-width: 600px) {
        .col-sm {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            padding: 20px;
        }
    }
</style>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm rounded text-light" style="background-color: #212529">
                    <form action="<?= base_url('auth/forgot/do_update') ?>" method="POST">
                        <div class="text-center">
                            <h1 class="text-light">Reset Form</h1>
                            <p>Silahkan Masukan Password Baru</p>
                            <input type="hidden" name="email" value="<?= $email ?>">
                            <input type="hidden" name="token" value="<?= $token ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Repeat Password</label>
                            <input type="password" class="form-control" id="password" name="rpassword" required>
                        </div>
                        <button type="submit" class="btn btn-info" name="register">Kirim</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>