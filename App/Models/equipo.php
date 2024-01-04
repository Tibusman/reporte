<?php

class equipo extends Model
{
    public $id;
    public $nombre;
    public $sistema;
    public $modelo;
    public $memoria;
    public $almacenamiento;
    public $Id_Us;
    public $id_marca;
    public $procesador;

	function __construct()
	{
		parent::__construct(equipo::class, $this);
	}
}

?>