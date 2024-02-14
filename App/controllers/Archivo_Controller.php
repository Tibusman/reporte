<?php

import("Timer");
importModel("archivos");

class Archivo_Controller extends Views
{
    protected $archivo;

    public function __construct() {
        $this->archivo =  new archivos;
    }

    public function save()
    {
        $this->archivo->Fecha = Timer::GetDate();
        return $this->archivo->POST("id");
    }

    public function show()
    {
        return $this->View('Archivo.show', 'Administración de documentos');
    }

    public function getall($page)
    {
        $search = $this->archivo->extractsend("search");
        if($search === "" || $search === null)
        {
            return $this->archivo->SELECT()->DESC()->Pagination(15, $page)->GET();
        }
        else
        {
            return $this->archivo->SELECT()->WHERE("Nombre", "LIKE", "%$search%")->DESC()->Pagination(15, $page)->GET();
        }
        
    }

    public function update()
    {
        echo $this->archivo->PUT();
    }

    public function delete()
    {
        return $this->archivo->DELETE();
    }
}