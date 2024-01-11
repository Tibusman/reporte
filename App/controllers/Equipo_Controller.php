<?php
importModel("equipo");
importModel("usuario");
importModel("marca");


class Equipo_Controller extends Views
{
    protected $equipos;
    protected $usuario;
    protected $marca;

    public function __construct()
    {
        $this->equipos = new equipo;
        $this->usuario = new usuario;
        $this->marca = new marca;
    }

    public function getall($page)
    {
        $search = $this->equipos->extractsend("search");
        if($search === null || $search === "")
        {
            
            return $this->equipos->SELECT("equ.id", "equ.nombre", "equ.sistema", "equ.modelo", "equ.memoria",
                "equ.almacenamiento", "equ.Id_Us", "equ.id_marca", "equ.procesador", "ma.logo", "u.mail")
            ->INNER_JOIN("marca ma", "ma.id", "=", "equ.id_marca")
            ->JOIN("usuario u", "u.id", "=", "equ.Id_Us")
            ->DESC("equ.id")
            ->Pagination(10,$page)
            ->GET();
        }
        else
        {
            $user = $this->usuario->SELECT()->WHERE("mail", "LIKE", "%$search%")->GET();
            if(count($user) !== 0)
            {
                $id = $user[0]['id'];
                return $this->equipos->SELECT("equ.id", "equ.nombre", "equ.sistema", "equ.modelo", "equ.memoria",
                    "equ.almacenamiento", "equ.Id_Us", "equ.id_marca", "equ.procesador", "ma.logo", "u.mail")
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

    public function getallunsigned($page)
    {
        return $this->equipos->SELECT("equ.id", "equ.nombre", "equ.sistema", "equ.modelo", "equ.memoria",
                "equ.almacenamiento", "equ.Id_Us", "equ.id_marca", "equ.procesador", "ma.logo")
            ->INNER_JOIN("marca ma", "ma.id", "=", "equ.id_marca")
            ->IS_NULL("Id_Us")
            ->DESC("equ.id")
            ->Pagination(10,$page)
            ->GET();
    }

    public function show()
    {
        return $this->View("Equipo.show", "Administrar equipos");
    }

    public function getmarca()
    {
        return $this->marca->GET();
    }

    public function store()
    {
        return $this->equipos->POST(true);
    }

    public function update()
    {
        echo $this->equipos->PUT();
    }

    public function delete()
    {
        $this->equipos->DELETE();
    }
}
