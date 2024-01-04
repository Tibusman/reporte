<?php

class historial_mant extends Model
{
    public $id;
	public $id_man;
    public $Description;
	public $fecha;

	function __construct()
	{
		parent::__construct(historial_mant::class, $this);
	}
}

?>