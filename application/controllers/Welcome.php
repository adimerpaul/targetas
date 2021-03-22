<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
    public function login()
    {
        $email=$this->input->post('email');
        $password=md5($this->input->post('password'));
        $query=$this->db->query("SELECT * FROM users WHERE email='$email' AND `password`='$password'");
        if ($query->num_rows()==1){
            $row = $query->row();
            $this->session->name=$row->name;
            $this->session->id=$row->id;
            $this->session->tipo=$row->tipo;
//            echo $this->session->tipo;
            header('Location: '.base_url().'Home');
        }else{
            header('Location: '.base_url());
        }
//        $this->load->view('welcome_message');
//        echo $this->input->post('email');
    }
    public function logout()
    {
        session_destroy();
        header('Location: '.base_url());
    }
}
