<?php
//Tworzenie obiektu mPDF
include('data/mpdf60/mpdf.php');

$mpdf=new mPDF();

$mpdf->WriteHTML($ShowWZ);

$mpdf->setFooter(iconv(strftime('%Y-%m-%d',strtotime(date("Y-m-d")))).'|PLAS-MAG|{PAGENO}');

$mpdf->SetTitle(iconv("ISO-8859-2","UTF-8",'Wydanie z magazynu'));

$mpdf->SetAuthor("PLAS-MAG");

$mpdf->SetCreator('System testowy');

$mpdf->SetSubject('Dokument WZ');

//$mpdf->SetProtection(array('print'), 'HasloUsera', 'HasloAdmina');

$mpdf->Output("test.pdf");

?>