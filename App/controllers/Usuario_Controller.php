<?php

importModel("usuario");
importModel("user_rol");

class Usuario_Controller extends Views
{
    protected $user;
    protected $user_rol;

    function __construct()
    {
        $this->user_rol = new user_rol;
        $this->user = new usuario;
    }
    public function show()
    {
        return $this->View("Usuario.show", "Administrar usuarios");
    }

    public function getall($page)
    {
        $search = $this->user->extractsend("search");
        if($search === null || $search === "")
        {
            return $this->user->SELECT()->Pagination(10,$page)->GET();
        }
        else
        {
            return $this->user->SELECT()->WHERE("name", "LIKE", "%$search%")->GET();
        }
        
    }

    public function asignar()
    {
        $id = $this->user_rol->extractsend("id_user");
        $usuarios = $this->user_rol->SELECT()->WHERE("id_user", "=", $id)->GET();
        if(count($usuarios) === 0)
        {
            return $this->user_rol->POST(true);
        }
        else
        {
            $this->user_rol->send("id", $usuarios[0]["id"]);
            $this->user_rol->send("method", "PUT");
            echo $this->user_rol->PUT();
        }
    }

    
}