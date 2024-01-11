<?php

class marca extends Model
{
    public $id;
    public $nombre;
    public $logo;

    function __construct()
	{
		parent::__construct(marca::class, $this);
	}
}


?>