<?php
date_default_timezone_set('America/Sao_Paulo');
require_once('lib/tcpdf/tcpdf.php');

class TekcertoPdfCertificado extends TCPDF {
    public $imagem;

    public function Header() {
          $bMargin = $this->getBreakMargin();
          $auto_page_break = $this->AutoPageBreak;
          $this->SetAutoPageBreak(false, 0);
          $this->Image($this->imagem, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
          $this->SetAutoPageBreak($auto_page_break, $bMargin);
          $this->setPageMark();
    }
}
$pdf = new TekcertoPdfCertificado('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->imagem =  preg_replace("/\r|\n/", "", $secoes[4]);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('times', '', 12);
$pdf->AddPage();
$html = <<<EOF
<table style="">
    <tr>
    <td style="height: 35px;">
    </td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: 25px; height: 150px;
            margin-top: 100; vertical-align: middle">
            <br>
           {$secoes[0]}
        </td>
    </tr>
    <tr>
        <td style="text-align: center; height: 55px;">
       {$secoes[1]}
        </td>
    </tr>
    <tr>
        <td style="text-align: center; color: red; font-size: 20px; font-family: Arial, Helvetica, sans-serif;
        font-weight: bold; height: 100px;">
            {$nome}<br>
            CPF: {$cpf}<br>
            {$empresa}
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            assistiu ao vídeo de treinamento do uso de<br>
           {$secoes[2]}<br>
           {$secoes[3]}<br>
            <strong style="color: red;">na data de {$data}, horário {$hora}</strong>
        </td>
    </tr>
</table>
EOF;

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output(__DIR__ . '/Certificado.pdf', 'F');

?>