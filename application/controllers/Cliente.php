<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
	public function index()
	{
	    if (!$this->session->name){
            header('Location: '.base_url());
        }
        $this->load->view('templates/header');
        $this->load->view('cliente');
        $this->load->view('templates/footer');
	}
    public function crear()
    {
        if (!$this->session->name){
            header('Location: '.base_url());
        }
        $ci=strtoupper($this->input->post('ci'));
        $nombres=strtoupper($this->input->post('nombres'));
        $apellidos=strtoupper($this->input->post('apellidos'));
        // $fechanac=strtoupper($this->input->post('fechanac'));
        $cargo=strtoupper($this->input->post('cargo'));
        $clave=md5($ci);
        $this->db->query("INSERT INTO clientes SET 
                                                ci='$ci',
                                                nombres='$nombres',
                                                apellidos='$apellidos',
                                                cargo='$cargo',
                                                clave='$clave'
                                                ");
        header('Location: '.base_url().'Home');
    }
    public function modificar()
    {
        if (!$this->session->name){
            header('Location: '.base_url());
        }
        $id=$this->input->post('id');
        $ci=strtoupper($this->input->post('ci'));
        $nombres=strtoupper($this->input->post('nombres'));
        $apellidos=strtoupper($this->input->post('apellidos'));
        // $fechanac=strtoupper($this->input->post('fechanac'));
        $cargo=strtoupper($this->input->post('cargo'));
        $clave=md5($ci);
        $this->db->query("UPDATE clientes SET 
        ci='$ci',
        nombres='$nombres',
        apellidos='$apellidos',
        cargo='$cargo',
        clave='$clave'
        WHERE id='$id'
                                                ");
        header('Location: '.base_url().'Home');
    }
    public function borrar($id)
    {
        if (!$this->session->name){
            header('Location: '.base_url());
        }
        $this->db->query("UPDATE clientes SET
        estado='0'
        WHERE id=$id
        ");
        header('Location: '.base_url().'Home');
    }
}
