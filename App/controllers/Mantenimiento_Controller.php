<?php


importModel("mantenimiento");
importModel("historial_mant");
importModel("usuario");
import_helper("mail");
import("Timer");

class Mantenimiento_Controller extends Views
{
    protected $mantenimiento;
    protected $us;
    protected $histo_man;

    public function __construct() {
        $this->mantenimiento = new mantenimiento;
        $this->histo_man = new historial_mant;
        $this->us = new usuario;
    }

    public function show()
    {
        return $this->View("mantenimiento.show", "Mantenimientos"); 
    }

    public function getall($page)
    {
        $search = $this->mantenimiento->extractsend("search");
        if($search === null || $search === "")
        {
            if(Rols::ShowRol() === "SuperUser" || Rols::ShowRol() === "Admin")
            {
                return $this->mantenimiento->SELECT()->DESC()->Pagination(10,$page)->GET();
            }
            else
            {
                return $this->mantenimiento->SELECT()->WHERE("id_user", "=", Ses::id())->DESC()->Pagination(10,$page)->GET();
            }
        }
        else
        {
            if(Rols::ShowRol() === "SuperUser" || Rols::ShowRol() === "Admin")
            {
                return $this->mantenimiento->SELECT()->WHERE("fecha_exp", "LIKE", "%$search%")->DESC()->Pagination(10,$page)->GET();
            }
            else
            {
                return $this->mantenimiento->SELECT()->WHERE("id_user", "=", Ses::id())->AND("fecha_exp", "LIKE", "%$search%")->DESC()->Pagination(10,$page)->GET();
            }
        }
    }

    public function save()
    {
        $this->mantenimiento->estado = "Pendiente";
        $user = $this->us->FIND($this->mantenimiento->extractsend("id_user"))[0];
        $fecha = $this->mantenimiento->extractsend("fecha_exp");
        Mail::SendMail("Ver mantenimiento", "Nuevo mantenimiento programado", "Hola el area de TI ha programado un nuevo mantenimiento para tu equipo de computo, el mantenimiento esta programado para el día $fecha", "http://internos.busman.com.mx/reporte", $user['mail']);
        return $this->mantenimiento->POST(true);
    }

    public function update()
    {
        echo $this->mantenimiento->PUT();
    }

    public function savemante()
    {
        $this->histo_man->fecha = Timer::GetDate("MX", "Y-m-d h:i:s A");
        $tipo = $this->histo_man->extractsend("tipo");
        $idus = $this->histo_man->extractsend("iduser");
        if($tipo === "Completo")
        {
            $usuario = $this->us->FIND($idus)[0];
            Mail::SendMail("Ver mantenimiento", "Mantenimiento finalizado", "Hola, el mantenimiento a tu equipo ha finalizado con éxito.", "https://internos.busman.com.mx/reporte", $usuario['mail']);
        }
        else
        {
            $usuario = $this->us->FIND($idus)[0];
            Mail::SendMail("Ver mantenimiento", "Mantenimiento actualizado", "Hola, el mantenimiento a tu equipo ha tenido cambios con éxito.", "https://internos.busman.com.mx/reporte", $usuario['mail']);
        }
        return $this->histo_man->POST(true);
    }

    public function gethistorial($id)
    {
        return $this->histo_man->SELECT()->WHERE("id_man", "=", $id)->DESC()->GET();
    }

    public function getcont()
    {
        return $this->mantenimiento->SELECT()->COUNT("id", "cuenta")->GET();
    }
}

?>