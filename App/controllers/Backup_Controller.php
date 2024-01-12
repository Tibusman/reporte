<?php

import("Timer");
importModel("respaldo");
import_helper("mail");
importModel("user_rol");

class Backup_Controller extends Views{
    
    protected $back;
    protected $user;

    function __construct()
    {
        $this->back = new respaldo;
        $this->user = new user_rol;
    }

    public function show()
    {
        return $this->View("back.show", "Backup");
    }

    public function getall($page)
    {
        $filtro = $this->back->extractsend("fecha");
        if($filtro === NULL || $filtro === "")
        {
            return $this->back->SELECT()->DESC()->Pagination(10,$page)->GET();
        }
        else{
            return $this->back->SELECT()->WHERE("Fecha", "LIKE", "%$filtro%")->DESC()->Pagination(10,$page)->GET();
        }
    }

    public function save()
    {
        $folio = $this->back->FINDLAST("Semana");
        $this->back->Link = "https://drive.google.com/drive/folders/1eA4JR9gMzooOgekShaP3bdzO_PeZjgVB?usp=sharing";
        $this->back->Semana = intval($folio + 1);
        $this->back->Fecha = Timer::GetDate();
        $this->back->id_User = Ses::id();
        Mail::SendMail("Firmar", "Nuevo respaldo", "Hola se ha generado un nuevo respaldo te pedimos revises y firmes.", "https://internos.busman.com.mx/reportes/Backup/show", "uriel.araujo@busman.com.mx");
        return $this->back->POST(true);
    }

    public function getrespaldo($id)
    {
        return $this->back->FIND($id);
    }

    public function update()
    {
        $user = $this->user->SELECT()->JOIN("usuario u", "u.id", "=", "esu.id_user")->WHERE("esu.id_rol", "=", "3")->GET();
        foreach($user as $item => $key)
        {
            Mail::SendMail("VER RESPALDO", "Respaldo firmado", "Hola el respaldo ha sido firmado.", "https://internos.busman.com.mx/reportes/Backup/show", $key['mail']);
        }
        echo $this->back->PUT();
    }

    public function getcont()
    {
        return $this->back->SELECT()->COUNT("id", "cantidad")->GET();
    }
}


?>