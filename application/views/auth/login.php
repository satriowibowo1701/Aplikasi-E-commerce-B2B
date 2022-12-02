<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo get_store_name(); ?></title>

    <link href="<?php echo get_theme_uri('custom/auth/login/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_theme_uri('custom/auth/login/css/fontawesome-all.css'); ?>" rel="stylesheet" />
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <h1>Login ke <?php echo get_store_name(); ?></h1>

    <div class=" w3l-login-form">
        <h2>Login Akun</h2>
        <?php if ($flash_message) : ?>
            <div class="flash-message">
                <?php echo $flash_message;
                $this->session->set_userdata('login_flash', ''); ?>
            </div>
        <?php endif; ?>
        <?php if ($pp) : ?>
            <div class="flash-message">
                <?php echo $pp;
                $this->session->set_userdata('status', '');
                $this->session->set_userdata('profile', '');
                ?>
            </div>
        <?php endif; ?>

        <?php if ($redirection) :
        ?>
            <div class="flash-message">
                Silahkan login untuk melanjutkan...
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success1')) { ?>
            <div class="flash-message">
                <?php echo $this->session->flashdata('success1'); ?>
            </div>

        <?php } ?>

        <?php echo form_open('auth/login/do_login'); ?>

        <div class=" w3l-form-group">
            <label>Username:</label>
            <div class="group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" value="<?php echo set_value('username', $old_username); ?>" class="form-control" placeholder="Username" minlength="4" maxlength="16" required>
            </div>
            <?php echo form_error('username'); ?>
        </div>
        <div class=" w3l-form-group">
            <label>Password:</label>
            <div class="group">
                <i class="fas fa-unlock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <?php echo form_error('password'); ?>
        </div>
        <div class="forgot">
            <p><input type="checkbox" name="remember_me" value="1">Ingat saya</p>
            <?php echo anchor('auth/forgot', 'Lupa password?'); ?>
        </div>
        <button type="submit">Login</button>
        <?php echo form_close(); ?>
        <a class="btn btn-primary mt-3" href="<?php echo base_url(); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg> Kembali</a>
    </div>


    <footer>
        <p class="copyright-agileinfo"> &copy; 2020 <?php echo anchor(base_url(), get_store_name()); ?></p>
    </footer>

</body>

</html>