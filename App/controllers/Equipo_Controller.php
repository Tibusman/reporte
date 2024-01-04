<?php
importModel("equipo");
importModel("usuario");


class Equipo_Controller extends Views
{
    protected $equipos;
    protected $usuario;

    public function __construct()
    {
        $this->equipos = new equipo;
        $this->usuario = new usuario;
    }

    public function getall($page)
    {
        $search = $this->equipos->extractsend("search");
        if($search === null || $search === "")
        {
            
            return $this->equipos->SELECT()
            ->INNER_JOIN("marca ma", "ma.id", "=", "equ.id_marca")
            ->JOIN("usuario u", "u.id", "=", "equ.Id_Us")
            ->DESC("equ.id")
            ->Pagination(10,$page)
            ->GET();
        }
        else
        {
            $user = $this->usuario->SELECT()->WHERE("mail", "LIKE", "%$search%")->GET()[0];
            if(count($user) !== 0)
            {
                $id = $user['id'];
                return $this->equipos->SELECT()
                ->INNER_JOIN("marca ma", "ma.id", "=", "equ.id_marca")
                ->JOIN("usuario u", "u.id", "=", "equ.Id_Us")
                ->WHERE("u.id", "=", "$id")
                ->DESC("equ.id")
                ->Pagination(10,$page)
                ->GET();
            }
            else
            {
                return [];
            }
        }
    }
}
