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
            $query2=$this->db->query("SELECT *
            FROM horas
            WHERE dia_id='$row->id'
            ");
            $a=array();
            $dias=array();
            $con=0;
            foreach ($query2->result() as $row2){
                $con++;
                if ($con==1){
                    $dias['entrada']=$row2->hora;
                }else{
                    $dias['salida']=$row2->hora;
                }
            }
            $a['nombre']=$row->nombre;
            $a['dia']=$row->dia;
            $a['estados']=$dias;
            $array[]=$a;
        }
        echo json_encode($array);
    }
}
