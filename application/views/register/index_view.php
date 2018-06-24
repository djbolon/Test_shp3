<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <?php
    echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : FALSE;
    ?>
    <h1>Register</h1>
    <?php
    echo form_open();
    echo form_label('Email:','email').'<br />';
    echo form_error('email');
    echo '<input type="email" name="email" placeholder="Email" required /><br />';
    echo form_label('Username:','username').'<br />';
    echo form_error('username');
    echo '<input type="text" name="username" placeholder="Username" maxlength="15" minlength="6" pattern="[a-zA-Z0-9\s]+" required /><br />';
    echo form_label('Password:', 'password').'<br />';
    echo form_error('password');
    echo '<input type="password" name="password" maxlength="16" minlength="8" placeholder="Password" required /><br />';
    echo form_label('Confirm password:', 'confirm_password').'<br />';
    echo form_error('confirm_password');
    echo '<input type="password" name="confirm_password" maxlength="16" minlength="8" placeholder="Confirm Password" required /><br />';
    echo form_submit('register','Register');
    echo form_close();
    ?>
</div>