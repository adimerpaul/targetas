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
    public function targeta($id)
    {
        require('tcpdf/tcpdf.php');
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Adimer Paul Chambi Ajata');
        $pdf->SetTitle('TCPDF Example 002');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

// set font
        $pdf->SetFont('times', 'BI', 20);

// add a page
        $pdf->AddPage();
        $pdf->Image('assets/img/credencial.jpeg', 10, 10, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);


// set some text to print
        $txt = <<<EOD
TCPDF Example 002

Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
EOD;

// print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('example_002.pdf', 'I');
    }
}
