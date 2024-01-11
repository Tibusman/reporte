<?php

import("Timer");
importModel("respaldo");

class Backup_Controller extends Views{
    
    protected $back;

    function __construct()
    {
        $this->back = new respaldo;
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
        return $this->back->POST(true);
    }

    public function getrespaldo($id)
    {
        return $this->back->FIND($id);
    }

    public function update()
    {
        echo $this->back->PUT();
    }
}


?>