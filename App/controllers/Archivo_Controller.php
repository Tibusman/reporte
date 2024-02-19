<?php

import("Timer");
importModel("archivos");
import_helper("mail");

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

    public function sendsolicitud()
    {
        $type = $this->archivo->extractsend("tipo");
        $id = $this->archivo->extractsend("id");
        $mail = $this->archivo->extractsend("correo");
        Mail::SendMail("Firmar", 
            "Firma de documento", "Por favor firma el documento de $type digitalmente, da clic al botón de abajo y te redireccionara a visualizar y firmar tu documento",
            "http://localhost/reportes/Archivo/firma/$id", $mail);
        echo "true";
    }

    public function update()
    {
        echo $this->archivo->PUT();
    }

    public function delete()
    {
        return $this->archivo->DELETE();
    }

    public function firma($id)
    {
        $this->View("Firma", "Firmar archivo", $id);
    }

    public function getfile($id)
    {
        return $this->archivo->FIND($id);
    }

    public function firmar()
    {
        $firmaBase64 = $this->archivo->extractsend("firma");
        $firmaBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $firmaBase64));
        $nombreArchivo = 'firma_' . time() . '.png';
        $rutaArchivo = 'App/Resources/Firmas/' . $nombreArchivo;
        file_put_contents($rutaArchivo, $firmaBinaria);
        $this->archivo->Firma = $rutaArchivo;
        echo $this->archivo->PUT();
    }
}