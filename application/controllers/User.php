<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index()
    {
        $this->render('dashboard/index_view');
    }

    public function login()
    {

        if ($this->ion_auth->logged_in())
        {
               redirect('preferred');
        }
        else 
        {
            $this->data['title'] = "Login";
        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[15]|alpha_numeric');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[16]');
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->helper('form');
                $this->render('user/login_view');
            }
            else
            {
                $remember = (bool) $this->input->post('remember');
                $username = $this->security->xss_clean($this->input->post('username'));
                $password = $this->security->xss_clean($this->input->post('password'));
                if ($this->ion_auth->login($username, $password, $remember))
                {
                    redirect('preferred');
                }
                else
                {
                    $_SESSION['auth_message'] = $this->ion_auth->errors();
                    $this->session->mark_as_flash('auth_message');
                    redirect('login');
                }
            }
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('user/login');
    }
}