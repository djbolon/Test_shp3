<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <?php
    //print_r($_SESSION);
    echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : FALSE;
    ?>
    <h1>Register</h1>
    <?php echo form_open_multipart();
    echo '<h2>LANGKAH 1</h2>';
    echo form_label('No KTP:','noktp').'<br />';
    echo form_error('noktp');
    echo '<input type="number" name="noktp" maxlength="16" placeholder="No KTP" required />';
    echo '<h2>LANGKAH 2</h2>';
    echo form_label('Tambahkan Foto KTP Anda :','photoktp').'<br />';
    echo form_error('photoktp');
    echo "<input type='file' name='photoktp' size='20' required /><br />";
    echo form_label('Tambahkan Foto Anda:','fotoanda').'<br />';
    echo form_error('fotoanda');
    echo "<input type='file' name='fotoanda' size='20' required /><br />";
    echo form_checkbox('setuju','1',FALSE).' Saya setuju dengan <a href="#">Syarat & Ketentuan</a> Program Penjual Terpilih Shopee <br />';
    echo form_submit('kirim','Kirimkan');
    echo form_close();
    ?>
</div>