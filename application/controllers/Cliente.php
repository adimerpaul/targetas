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
        $query=$this->db->query("SELECT * FROM clientes where id='$id'");
        $row=$query->row();
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
//        $pdf->Image('assets/img/credencial.jpeg', 10, 10, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
        $pdf->Image('assets/img/credencial.jpeg',5,5,198,0,'JPEG');
        // set style for barcode
        $style = array(
            'bgcolor' => array(255,255,255),
//            'border' => 2,
            'vpadding' => 1,
//            'hpadding' => 'auto',
//            'fgcolor' => array(0,0,0),
//            'bgcolor' => false, //array(255,255,255)
//            'module_width' => 1, // width of a single module in points
//            'module_height' => 1 // height of a single module in points
        );

// QRCODE,L : QR-CODE Low error correction
        $pdf->write2DBarcode(base_url()."Cliente/asistencia/".$row->clave, 'QRCODE,L', 105, 10, 40, 40, $style);


        $pdf->Ln(3);
        $pdf->setTextColor(255, 61, 0);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode('PARTICIPANTE'),0,0,'C');
        $pdf->setTextColor(0, 0, 0);
        $pdf->Ln(7);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode($row->nombres),0,0,'C');
        $pdf->Ln(9);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode($row->apellidos),0,0,'C');
        $pdf->Ln(9);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode($row->ci),0,0,'C');

//        $pdf->Ln(15);
//        $pdf->SetFont('helvetica','B',15);
//        $pdf->Cell(101,4,'',0);
//        $pdf->Cell(20,4,utf8_decode("qr"),0,0,'C');
// set some text to print
//        $txt = <<<EOD
//TCPDF Example 002
//
//Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
//EOD;

// print a block of text using Write()
//        $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('example_002.pdf', 'I');
    }
    public function asistencia($clave)
    {

//        exit;
        $query=$this->db->query("SELECT * FROM clientes where clave='$clave'");
        if ($query->num_rows()==0){
            echo "No existe persona";
            exit;
        }
        $row=$query->row();
        $id=$row->id;
        $nombre=$row->nombres." ".$row->apellidos;
        $cargo=$row->cargo;
        $query=$this->db->query("SELECT * FROM dias WHERE cliente_id='$id' AND date(dia)=date(now())");
        if ($query->num_rows()==0){
            $this->db->query("INSERT INTO dias SET
            cliente_id='$id',
            dia='".date('Y-m-d')."',
            nombre='$row->nombres $row->apellidos',
            cargo='$row->cargo'
            ");
            $dia_id=$this->db->insert_id();
            $this->db->query("INSERT INTO horas SET
            dia_id='$dia_id',
            hora='".date('H:i:s')."'
            ");
            $estado="ENTRADA";
        }else{
            $row=$query->row();
            $query=$this->db->query("SELECT * FROM horas WHERE dia_id='$row->id' ORDER BY id desc");
            if ($query->num_rows()==2){
                $estado="NO";
            }else{
                $row2=$query->row();
                if ($row2->estado=='ENTRADA'){
                    $this->db->query("INSERT INTO horas SET
                dia_id='$row->id',
                hora='".date('H:i:s')."',
                estado='SALIDA'
                ");
                    $estado="SALIDA";
                }else{
                    $this->db->query("INSERT INTO horas SET
                dia_id='$row->id',
                hora='".date('H:i:s')."',
                estado='ENTRADA'
                ");
                    $estado="ENTRADA";
                }
            }

        }
        $data['nombre']=$nombre;
        $data['cargo']=$cargo;
        $data['estado']=$estado;
        $this->load->view('asistencia',$data);
    }
}
