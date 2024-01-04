<?php

class Page_Controller extends Views
{
    public function index()
    {
        if(Ses::Active())
        {
            return $this->View("menu", "Menu de inicio");
        }
        else
        {
            return $this->View("login", "Iniciar sesión");
        }
    }

    public function login()
    {
        
    }

    public function menu()
    {
        Ses::PageAuth(["layout"=>"<h1 style='font-size:20px; text-align:center;'>No estas autorizado para estar en esta pagina</h1>", "time"=>2000, ":/"], function(){
            return $this->View("Menu", "Bienvenido ".Ses::ShowAtribute("username"));
        });
    }

    public function exit()
    {
        ses::Exit(function(){
            redirect("./");
        });
    }
}
