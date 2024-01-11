<?php

class user_rol extends Model
{
	public $id;
	public $id_user;
    public $id_rol;

	function __construct()
	{
		parent::__construct(user_rol::class, $this);
	}
}