<?php
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
include "App/core/__DB/DB.php";
require_once "App/core/__HTML2PDF/Html2Pdf.php";
require_once "App/core/__App/bin/integrations.php";
require_once "App/core/__App/bin/_Model/Model.php";

import("HTMLMAIL");
import("Timer");
importModel("ticket");
importModel("historial_soporte");


use Spipu\Html2Pdf\Html2Pdf;



function PrintPDF($html, $name)
{
    ob_start();
    ob_get_clean();
    $html2pdf = new Html2Pdf('P', 'ANSI_A', 'fr');
    $html2pdf->pdf->SetTitle($name);
    $html2pdf->writeHTML($html);
    $html2pdf->output($name);
}

/** Observar requisición normal */


if(isset($_GET['ticket']))
{
    $tick = new ticket;
    $id = $_GET['ticket'];
    $histo =  new historial_soporte;

    $ticket = $tick->SELECT("tic.id,tic.estado, tic.soldto, tic.Titulo, tic.Problema, con.Nombre, con.Apellidos, con.Correo, con.Telefono, tic.Fecha_Inicio, con.id as id_con")
    ->JOIN("contacto con", "con.id", '=', 'tic.id_contacto')
    ->WHERE("tic.id", "=", $id)
    ->GET()[0];
    
    $historial =  $histo->SELECT("u.name, u.Apellido, u.correo, his.Solucion, his.fecha_up")
    ->JOIN("usuario u", "u.id", "=" ,"his.id_user")
    ->WHERE("his.id_soporte", "=", $id)->get();
    
    $html = createpdf($ticket, $historial);

    PrintPDF($html, "alan.pdf");
}

function createpdf($ticket, $historial)
{
    $html = HTMLMAIL::AddBlock(function(){
        $html2 = "<tr>";
        $html2 .= HTMLMAIL::Column(function(){
            return HTMLMAIL::AddImage("http://localhost/i4.0/App/public/img/blue.png", 150,"","display:block; margin:auto;");
        }, "width:25%");
        $html2 .= HTMLMAIL::Column(function(){
            return HTMLMAIL::AddTitle("REPORTE DE TICKET", "font-size:1em; text-align:center;");
        }, "width:55%");
        $html2 .= HTMLMAIL::Column(function(){
            return HTMLMAIL::AddText("Fecha de impresión:<br>".Timer::GetDate("MX", "Y-m-d h:i:s A"), "font-size:12px;");
        }, "width:20%");
        $html2 .= "</tr><br>";
        return $html2;
    }, "width:100%; padding:0%; margin:0%;");
    $html.="<hr>";

    $html.= HTMLMAIL::AddBlock(function() use ($ticket, $historial){
        
        $html2 = "<tr>";

        $html2 .= HTMLMAIL::AddHeader(function(){
            return HTMLMAIL::AddText("Información del ticket");
        }, "text-align:center; font-size:15px; color:rgb(0,92,192); width:35%;");

        $html2 .= HTMLMAIL::AddHeader(function(){
            return HTMLMAIL::AddText("Historial de soluciones");
        }, "text-align:center; font-size:15px; color:rgb(0,92,192); width:65%;");

        $html2 .= "</tr>";

        $html2 .= "<tr>";

        $html2 .= HTMLMAIL::Column(function() use ($ticket){
            $html3 = HTMLMAIL::AddRow(function() use ($ticket){

                $html4 = HTMLMAIL::AddTitle("Información del contacto", " font-size:12px; color:rgb(190,190,190); text-align:center; border-bottom:5px solid silver;");
                
                $html4 .= HTMLMAIL::AddText("
                        <b>Nombre del contacto</b>
                        <p style='color:balck;'>$ticket[Nombre] $ticket[Apellidos]</p><br>
                    ", "font-size:12px; color:rgb(0,92,192); line-height:1; text-align:center;");
                $html4 .= HTMLMAIL::AddText("
                    <b>Teléfono del contacto</b>
                    <p style='color:balck;'>$ticket[Telefono]</p><br>
                ", "font-size:12px; color:rgb(0,92,192); line-height:1; text-align:center;");
                $html4 .= HTMLMAIL::AddText("
                    <b>Correo del contacto</b>
                    <p style='color:balck;'>$ticket[Correo]</p><br>
                ", "font-size:12px; color:rgb(0,92,192); line-height:1; text-align:center;");

                $html4 .= HTMLMAIL::AddTitle("Información del ticket", " font-size:12px; color:rgb(190,190,190); text-align:center; border-bottom:5px solid silver;");
                
                $html4 .= HTMLMAIL::AddText("
                        <b>Titulo del ticket</b>
                        <p style='color:balck;'>$ticket[Titulo]</p><br>
                    ", "font-size:12px; color:rgb(0,92,192);  line-height:1; text-align:center;");

                $html4 .= HTMLMAIL::AddText("
                    <b>Problema</b>
                    <p style='color:balck;'>$ticket[Problema]</p><br>
                ", "font-size:12px; color:rgb(0,92,192);  line-height:1; text-align:center;");

                $html4 .= HTMLMAIL::AddText("
                        <b>Fecha de expedición</b>
                        <p style='color:balck;'>$ticket[Fecha_Inicio]</p><br>
                    ", "font-size:12px; color:rgb(0,92,192);  line-height:1; text-align:center;");
                
                $html4 .= HTMLMAIL::AddText("
                        <b>Estado del ticket</b>
                        <p style='color:gray;'>$ticket[estado]</p><br>
                    ", "font-size:12px; color:rgb(0,92,192);  line-height:1; text-align:center;");

                return $html4;
            }, "width:100%;");

            return $html3;
        }, "width:35%; border:1px solid silver; ");

        $html2 .= HTMLMAIL::Column(function() use ($historial){
            $html3 = "";
            foreach($historial as $item => $key)
            {
                $html3 .= HTMLMAIL::AddRow(function() use ($key){
                    $html4 = HTMLMAIL::AddBlock(function() use ($key){
                        $html5 = "<tr>";

                        $html5 .= HTMLMAIL::AddHeader(function()use ($key){

                            $html6 =  HTMLMAIL::AddText("
                                <b>Usuario que brindo soporte</b>
                                <p style='line-height:1;'>$key[name] $key[Apellido]</p>
                            ", "font-size:12px; font-weight:normal; text-align:center;");

                            $html6 .=  HTMLMAIL::AddText("
                                <b>Fecha</b>
                                <p style='line-height:1;'>$key[fecha_up]</p>
                            ", "font-size:12px; font-weight:normal; text-align:center;");

                            return $html6;

                        }, "width:50%:");

                        $html5 .= HTMLMAIL::AddHeader(function() use ($key){

                            $html6 =  HTMLMAIL::AddText("
                                <b>Solucion</b>
                                <p style='line-height:1;'>$key[Solucion]</p>
                            ", "font-size:12px; font-weight:normal; text-align:center;");

                            return $html6;

                        },  "width:50%;");

                        $html5 .= "</tr>";

                        return $html5;

                    }, "width:100%;");
                    return $html4;
                }, "width:100%; border:1px solid silver; margin:auto;");
            }
            return $html3;
    
            return $html3;
        }, "width:65%;");

        $html2 .= "</tr>";        
        
        return $html2;


    }, "width:100%; padding:0%; margin:0%;");

    return $html;

}
?>

