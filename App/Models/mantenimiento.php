<?php

class mantenimiento extends Model
{
    public $id;
	public $nombre;
    public $Fecha_exp;
	public $folio;
    public $estado;
    public $id_user;
    public $id_com;

	function __construct()
	{
		parent::__construct(mantenimiento::class, $this);
	}
}

?>