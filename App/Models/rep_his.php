<?php

class rep_his extends Model
{
    public $id;
	public $Solucion;
    public $Fecha_reg;
	public $id_rep;

	function __construct()
	{
		parent::__construct(rep_his::class, $this);
	}
}

?>