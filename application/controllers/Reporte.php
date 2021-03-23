<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {
    public function index()
    {
        if (!$this->session->name){
            header('Location: '.base_url());
        }
        $this->load->view('templates/header');
        $this->load->view('reporte');
        $this->load->view('templates/footer');
    }
    public function buscar($fecha){
        $query=$this->db->query("SELECT *
        FROM dias
        WHERE date(dia)=date('$fecha')
        ");
        $array=array();
        foreach ($query->result() as $row){
            $a=array();
            $a['nombre']=$row->nombre;
            $array[]=$a;
        }
        echo json_encode($array);
    }
}
