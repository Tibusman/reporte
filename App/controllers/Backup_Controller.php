<?php

importModel("respaldo");

class Backup_Controller extends Views{
    
    protected $back;

    function __construct()
    {
        $this->back = new respaldo;
    }

    public function show()
    {
        return $this->View("back.show", "Backup");
    }

    public function getall()
    {
        return $this->back->SELECT()->Pagination(10,1)->GET();
    }
}


?>