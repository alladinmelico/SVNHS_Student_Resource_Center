<?php
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
            session_start();
        }
    }

    function login(){
        $data['title'] = "Login";
        $this->load->vars($data);
        $this->load->view('login');
    }

    function register(){
        $data['title'] = "Login";
        $this->load->vars($data);
        $this->load->view('register');
    }
}
?>