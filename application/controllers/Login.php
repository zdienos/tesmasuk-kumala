<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('M_login','m');
  }
  function index() {
    $this->session->sess_destroy();
    $this->load->view('login');
  }

  function proses() {
    $this->form_validation->set_rules('txt_username', 'username', 'required|trim|xss_clean');
    $this->form_validation->set_rules('txt_password', 'password', 'required|trim|xss_clean');
    $this->form_validation->set_error_delimiters('', '');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('login');
    } else {
      $hasil = $this->m->cekLogin();
      if ($hasil) {
        $this->session->set_flashdata('psn_sukses', 'Login Berhasil !');
          redirect(base_url('dashboard'));
      }
      else {
         $this->session->set_flashdata('psn_error', 'Username atau Password yang anda masukkan salah.');
        redirect(base_url('login'));
      }
    }
  }

  function keluar(){
   $this->session->sess_destroy();
   redirect(base_url('login'));
  }


}
