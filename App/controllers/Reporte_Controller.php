<?php


importModel("reportes");
importModel("rep_his");
import("Timer");
import_helper("mail");

class Reporte_Controller extends Views
{
    protected $reporte;
    protected $rep_his;

    function __construct()
    {
        $this->reporte =  new reportes;
        $this->rep_his = new rep_his;
    }

    public function show()
    {
        Ses::PageAuth(["layout"=>"<div><h1>Inicia sesión para acceder al contenido/h1></div>","time"=>0.2000,"url"=>"../../"], function(){
            return $this->View("reportes.show", "Visualizar reporte");
        });
    }

    public function getreportes($page)
    {
        $search = $this->reporte->extractsend("search");
        if($search === null || $search === "")
        {
            if(Rols::ShowRol() === "SuperUser" || Rols::ShowRol() === "Admin")
            {
                return $this->reporte->SELECT()->DESC()->Pagination(10,$page)->GET();
            }
            else
            {
                return $this->reporte->SELECT()->WHERE("Idus", "=", Ses::id())->DESC()->Pagination(10,$page)->GET();
            }
        }
        else
        {
            if(Rols::ShowRol() === "SuperUser" || Rols::ShowRol() === "Admin")
            {
                return $this->reporte->SELECT()->WHERE("Titulo", "LIKE", "%$search%")->DESC()->Pagination(10,$page)->GET();
            }
            else
            {
                return $this->reporte->SELECT()->WHERE("Idus", "=", Ses::id())->AND("Titulo", "LIKE", "%$search%")->DESC()->Pagination(10,$page)->GET();
            }
        }

    }

    public function store()
    {
        $this->reporte->Fecha_req = Timer::GetDate("MX", "Y-m-d h:i:s");
        $this->reporte->Estado = "Pendiente";
        $this->reporte->Idus = Ses::id();
        $desc = $this->reporte->extractsend("Descripcion");
        Mail::SendMail("Ver Reporte", "Nuevo reporte creado", "Se ha generado un reporte con la siguiente descripción: $desc, se pide resolución lo antes posible", "https://internos.busman.com.mx/reporte", "ti@busman.com.mx");
        return $this->reporte->POST(true);
    }

    public function delete()
    {
        return $this->reporte->DELETE();
    }

    public function update()
    {
        if($this->reporte->extractsend("Estado") === "Completo")
        {
            $variable = $this->reporte->FIND($this->reporte->extractsend("id"))[0];
            $usuario = $this->reporte->TABLE("usuario")->select()->WHERE("id", "=", $variable['Idus'])->get();
            Mail::SendMail("Ver reporte", "Reporte resuelto", "Se ha resuelto el reporte que has generado, por favor verifica que las cosas están correctas antes de continuar, si no reporte al area de TI", "https://internos.busman.com.mx/reporte", $usuario['mail']);
        }
        echo $this->reporte->PUT();
    }

    public function loadreportedetail($id)
    {
        return $this->reporte->SELECT()->JOIN("rep_his r", "rep.id", "=", "r.id_rep")->WHERE("rep.id", "=", $id)->GET();
    }

    public function postsolution()
    {
        $this->rep_his->Fecha_reg = Timer::GetDate("MX", "Y-m-d h:i:s A");
        return $this->rep_his->POST(true);
    }

    public function getcont()
    {
        return $this->reporte->SELECT()->COUNT("id", "cuenta")->GET();
    }
}