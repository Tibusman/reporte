<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "App/core/__DB/DB.php";
require_once "App/core/__HTML2PDF/Html2Pdf.php";
require_once "App/core/__App/bin/integrations.php";
require_once "App/core/__App/bin/_Model/Model.php";
importModel("archivos");

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

if(isset($_GET['formato']))
{
    $formtatype = $_GET['formato'];
    $id = $_GET['id'];
    if($formtatype === "entrega")
    {
        $archivos = new archivos;
        $archivo = $archivos->FIND($id);
        PrintPDF(BuildStructure($archivo[0], "entrega"), "nombre.pdf");
    }
    else if($formtatype === "salida")
    {
        $archivos = new archivos;
        $archivo = $archivos->FIND($id);
        PrintPDF(BuildStructure($archivo[0], "salida"), "nombre.pdf");
    }
    else if($formtatype === "regreso")
    {
        $archivos = new archivos;
        $archivo = $archivos->FIND($id);
        PrintPDF(BuildStructure($archivo[0], "regreso"), "nombre.pdf");
    }
    else if($formtatype === "accesorio")
    {
        $archivos = new archivos;
        $archivo = $archivos->FIND($id);
        PrintPDF(BuildFormat2($archivo[0]), "nombre.pdf");
    }
}

function BuildStructure($archivo, $tipo)
{
    if($tipo === "entrega")
    {
        $html = "
        <table style='width:100%;'>
            <tr>
                <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%'>
                    FORMATO DE ENTREGA DE EQUIPOS Y ACCESORIOS DE COMPUTO
                </td>
                <td style=' font-size:12px; width:30%; text-align:center'>
                    Código: <b>0001</b><br>
                    Version: <b>1.0</b>
                </td>
            </tr>
        </table>
    ";
    }
    else if($tipo === "regreso")
    {
        $html = "
        <table style='width:100%;'>
            <tr>
                <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%'>
                    FORMATO DE REGRESO DE EQUIPOS Y ACCESORIOS DE COMPUTO
                </td>
                <td style=' font-size:12px; width:30%; text-align:center'>
                    Código: <b>0001</b><br>
                    Version: <b>1.0</b>
                </td>
            </tr>
        </table>
    ";
    }
    else if($tipo === "salida")
    {
        $html = "
        <table style='width:100%;'>
            <tr>
                <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%'>
                    FORMATO DE SALIDA DE EQUIPOS
                </td>
                <td style=' font-size:12px; width:30%; text-align:center'>
                    Código: <b>0001</b><br>
                    Version: <b>1.0</b>
                </td>
            </tr>
        </table>
    ";
    }
    $html .= "
        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:rgb(231,231,231);'></td>
            </tr>
            <tr>
                <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Datos del colaborador</td>
            </tr>
            
        </table>
        <table style='width:100%;'>
            <tr>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '># Empleado: <b>$archivo[No_Empleado]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Nombre: <b>$archivo[Nombre]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Puesto: <b>$archivo[Puesto]</b></td>
            </tr>
            <tr>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Correo: <b>$archivo[Correo]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Area: <b>$archivo[Area]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Fecha: <b>$archivo[Fecha]</b></td>
            </tr>
        </table>

        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Descripción del equipo</td>
            </tr>
        </table>

        <table style='width:100%;'>
            <tr>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Tipo: <b>$archivo[Tipo]</b></td>
                <td style='background:white; width:20%; padding:10px; border:1px solid black; '>Nombre: <b>$archivo[Nombre_E]</b></td>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Marca: <b>$archivo[Marca]</b></td>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Modelo: <b>$archivo[Modelo]</b></td>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>No. Serie: <b>$archivo[No_Serie]</b></td>
            </tr>
        </table>

        <table style='width:100%;'>
            <tr>
                <td style='background:white; width:96%; padding:10px; border:1px solid black; '>
                    <table style='width:100%;'>
                        <tr>
                            <td style='width:50%;'>
                                <p>Procesador: <b>$archivo[Procesador]</b></p>
                                <p>Memoria RAM: <b>$archivo[Memoria]</b></p>
                                <p>Espacio en Disco: <b>$archivo[Disco]</b></p>
                            </td>
                            <td style='width:22%;'>
                                <p>Mouse: <b>$archivo[Mouse]</b></p>
                                <p>Teclado: <b>$archivo[Teclado]</b></p>
                                <p>Monitor: <b>$archivo[Monitor]</b></p>
                            </td>
                            <td style='width:22%;'>
                                <p>Cargador: <b>$archivo[Cargador]</b></p>
                                <p>Celular: <b>$archivo[Celular]</b></p>
                                <p>USB: <b>$archivo[USB]</b></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Software</td>
            </tr>
        </table>

        <table style='width:100%;'>
            <tr>
                <td style='background:white; width:96%; padding:10px; border:1px solid black; '>
                    <table style='width:100%;'>
                        <tr>
                            <td style='width:50%;'>
                                <p>Sistema Operativo: <b>$archivo[Sistema]</b></p>
                                <p>Ofimática: <b>$archivo[Ofice]</b></p>
                                <p>Compresor: <b>$archivo[Compresor]</b></p>
                            </td>
                            <td style='width:30%;'>
                                <p>Navegador: <b>$archivo[Navegador]</b></p>
                                <p>Antivirus: <b>$archivo[Antivirus]</b></p>
                                <p>Lector PDF: <b>$archivo[Lector_pdf]</b></p>
                            </td>
                            <td style='width:16%;'>
                                <p>Siemens NX: <b>$archivo[Nx]</b></p>
                                <p>MASTERCAM: <b>$archivo[Master]</b></p>
                                <p>Tulip: <b>$archivo[Tulip]</b></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table><br><br><br><br><br>
        <table style='width:80%; margin:auto;'>
            <tr>
                <td style='width:50%'>
                    <p style='text-align:center;'>__________________________________</p>
                    <p style='text-align:center;'>Firma de quien entrega</p>
                </td>
                <td style='width:50%'>
                    <p style='text-align:center;'>__________________________________</p>
                    <p style='text-align:center;'>Firma de quien recibe</p>
                </td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <br><br><br><br><br><br>
    ";
    if($tipo === "entrega")
    {
        $html.="
        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:white; text-align:justify; font-size:10px;'>
                Al firmar el documento me comprometo a ser responsable por el equipo que se me sera asignado, si se daña  pierde tomare esa responsabilidad
                y pagare el equipo, evaluando a las condiciones en las que se me entrego.
                <br><br>
                Al dejar de laborar en la empresa entregare el equipo que se me otorgo en aquel momento, devolviéndolo en las mismas condiciones en las que
                se me asigno, si el equipo no cumple con las condiciones en las que se me entrego, tomare mi responsabilidad y pagare por las reparaciones 
                que se le deban hacer.
                </td>
            </tr>
        </table>";
    }
    if($tipo === "salida")
    {
        $html.="
        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:white; text-align:justify; font-size:10px;'>
                    Al firmar el documento, asumo plena responsabilidad por el equipo proporcionado. 
                    Me comprometo a cuidarlo adecuadamente y a devolverlo en las mismas condiciones en las que fue entregado.
                    En caso de perdida, daño o no retorno del equipo, acepto pagar el costo total del reemplazo o reparación según corresponda.
                    Esta responsabilidad se mantiene durante el periodo en que tenga posesión de el.
                </td>
            </tr>
        </table>";
    }
    return $html;
}

function BuildFormat2($archivo)
{
    $html = "
        <table style='width:100%;'>
            <tr>
                <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%'>
                    FORMATO DE ENTREGA DE  ACCESORIOS DE COMPUTO
                </td>
                <td style=' font-size:12px; width:30%; text-align:center'>
                    Código: <b>0001</b><br>
                    Version: <b>1.0</b>
                </td>
            </tr>
        </table>
        <br>
        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:rgb(231,231,231);'></td>
            </tr>
            <tr>
                <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Datos del colaborador</td>
            </tr>
            
        </table><br><br>
        <table style='width:100%;'>
            <tr>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '># Empleado: <b>$archivo[No_Empleado]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Nombre: <b>$archivo[Nombre]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Puesto: <b>$archivo[Puesto]</b></td>
            </tr>
            <tr>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Correo: <b>$archivo[Correo]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Area: <b>$archivo[Area]</b></td>
                <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Fecha: <b>$archivo[Fecha]</b></td>
            </tr>
        </table>
        <br><br>
        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Descripción del equipo</td>
            </tr>
        </table>
        <br><br>
        <table style='width:100%;'>
            <tr>
                <td style='background:white; width:48%; padding:10px; border:1px solid black; '>Nombre: <b>$archivo[Nombre_E]</b></td>
                <td style='background:white; width:48%; padding:10px; border:1px solid black; '>Descripción: <b>$archivo[Sistema]</b></td>
            </tr>
            <tr>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Tipo: <b>$archivo[Tipo]</b></td>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Marca: <b>$archivo[Marca]</b></td>
            </tr>
            <tr>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Modelo: <b>$archivo[Modelo]</b></td>
                <td style='background:white; width:19%; padding:10px; border:1px solid black; '>No. Serie: <b>$archivo[No_Serie]</b></td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br>
        <table style='width:80%; margin:auto;'>
            <tr>
                <td style='width:50%'>
                    <p style='text-align:center;'>__________________________________</p>
                    <p style='text-align:center;'>Firma de quien entrega</p>
                </td>
                <td style='width:50%'>
                    <p style='text-align:center;'>__________________________________</p>
                    <p style='text-align:center;'>Firma de quien recibe</p>
                </td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <br><br><br><br><br><br>
        <br><br><br><br><br><br>
        <table style='width:100%;'>
            <tr>
                <td style='width:96.5%; background:white; text-align:justify; font-size:10px;'>
                Al firmar el documento me comprometo a ser responsable por el equipo que se me sera asignado, si se daña  pierde tomare esa responsabilidad
                y pagare el equipo, evaluando a las condiciones en las que se me entrego.
                <br><br>
                Al dejar de laborar en la empresa entregare el equipo que se me otorgo en aquel momento, devolviéndolo en las mismas condiciones en las que
                se me asigno, si el equipo no cumple con las condiciones en las que se me entrego, tomare mi responsabilidad y pagare por las reparaciones 
                que se le deban hacer.
                </td>
            </tr>
        </table>
    ";
    return $html;
}