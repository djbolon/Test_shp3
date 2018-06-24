<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends My_Controller
{
	function __construct()
        {
            parent::__construct();
            $this->load->library('ion_auth');
         //    if($this->ion_auth->is_admin()===FALSE)
	        // {
	        //     redirect('/');
	        // }
    }
    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]|min_length[6]|max_length[15]|alpha_numeric');
        $this->form_validation->set_rules('email','Email','trim|valid_email|required|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_password','Confirm password','trim|matches[password]|required');

        if($this->form_validation->run()===FALSE)
        {
            $this->load->helper('form');
            $this->render('register/index_view');
        }
        else
        {
            $username = $this->security->xss_clean($this->input->post('username'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));

            $additional_data = array(
                'first_name' => NULL,
                'last_name' => NULL
            );

            $this->load->library('ion_auth');
            if($this->ion_auth->register($username,$password,$email,$additional_data))
            {
                $_SESSION['auth_message'] = 'The account has been created. You may now login.';
                $this->session->mark_as_flash('auth_message');
                //redirect('user/login');
                if ($this->ion_auth->login($username,$password,NULL)) {
	            	redirect('preferred');
	            } else {

                redirect('preferred');
	            }
            }
            else
            {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('register');
            }
        }
    }
}