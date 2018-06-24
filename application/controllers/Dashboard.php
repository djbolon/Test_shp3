<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends Auth_Controller {
 
    public function index()
    {
        echo 'Hello from the Succes Page, wait 5 second..';
        echo "<meta http-equiv='refresh' content='5;url=http://shopee.co.id'>";

    }
}
?>