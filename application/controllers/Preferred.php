<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preferred extends Auth_Controller
{
	function __construct()
        {
            parent::__construct();
            $this->load->library('ion_auth');
            $this->load->model('preferred_model');
         //    if($this->ion_auth->is_admin()===FALSE)
	        // {
	        //     redirect('/');
	        // }
    }
    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
               redirect('register');
        }
        else 
        {

            if ($this->preferred_model->getUserInfo($_SESSION['user_id'])) {
                redirect('dashboard');
            } else {
                $this->load->library('form_validation');
        
                $this->form_validation->set_rules('noktp','No. KTP','trim|min_length[16]|max_length[16]|required');
                if (empty($_FILES['photoktp']['name']))
                {
                    $this->form_validation->set_rules('photoktp', 'Photo KTP', 'required');
                }
                if (empty($_FILES['fotoanda']['name']))
                {
                    $this->form_validation->set_rules('fotoanda', 'Photo Anda', 'required');
                }



                if($this->form_validation->run()===FALSE)
                {
                    $this->load->helper('form');
                    $this->render('preferred/index_view');
                }
                else
                {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '100';
                    $this->load->library('upload', $config);

                    $noktp = $this->security->xss_clean($this->input->post('noktp'));
                    $fotoktp = $_FILES['photoktp']['name'];
                    $fotoanda = $_FILES['fotoanda']['name'];
                    $id_users = $_SESSION['user_id'];
                    $username = $_SESSION['username'];
                    $email = $_SESSION['email'];

                    
                    if ($this->preferred_model->isDuplicateKtp($noktp)) {
                        $_SESSION['auth_message'] = 'KTP Duplikat';
                        $this->session->mark_as_flash('auth_message');
                        redirect('preferred');
                    } else {
                        if($this->preferred_model->insertUserKtp($noktp,$fotoktp,$fotoanda,$id_users,$username,$email))
                        {
                            $_SESSION['auth_message'] = 'The account has been created.';
                            $this->session->mark_as_flash('auth_message');
                            redirect('dashboard');
                        }
                        else
                        {
                            //$_SESSION['auth_message'] = $this->ion_auth->errors();
                            $_SESSION['auth_message'] = 'Silahkan Ulangi Lagi';
                            $this->session->mark_as_flash('auth_message');
                            redirect('preferred');
                        }
                    } 
                        
                }

            }
        }
    }
}