<?php

importModel("inventario");
importModel("articulo_inventario");

class Inventario_Controller extends Views
{
    protected $inventario;
    protected $art;

    public function __construct()
    {
        $this->inventario = new inventario;
        $this->art = new articulo_inventario;
    }

    public function show()
    {
        return $this->View("Inventario.show", "Inventarios");
    }

    public function store()
    {
        return $this->inventario->POST(true);
    }
    public function getall()
    {
        return $this->inventario->SELECT()->GET();
    }
    public function destroy()
    {
        return $this->inventario->DELETE();
    }

    public function update()
    {
        echo $this->inventario->PUT();
    }

    public function watch($id)
    {
        $invent = $this->inventario->FIND($id);
        return $this->View("Inventario.watch", "Inventario $id", $invent[0]);
    }

    public function getinventario($id)
    {
        return $this->art->SELECT()->WHERE("id_inventario", "=", $id)->GET();
    }

    public function additeminventario()
    {
        return $this->art->POST(true);
    }

    public function edititeminventario()
    {
        echo $this->art->PUT();
    }

    public function destroyitem()
    {
        return $this->art->DELETE();
    }
}

