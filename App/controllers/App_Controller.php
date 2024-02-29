<?php
importModel("apps");
import("Files");

class App_Controller extends Views
{
    protected $app;

    function __construct()
    {
        $this->app =  new apps;
    }

    public function show()
    {
        return $this->View("apps.show", "App Administrator");
    }

    public function create()
    {
        return $this->View("apps.create", "Register App");
    }

    public function edit($id="")
    {
        return $this->View("apps.edit", "Edit App", $id);
    }

    public function store()
    {
        $imgurl = Files::UploadFile(Files::SetFile("files"), "", ["max_size" => 10000.00, "replace" => false], true);
        $this->app->icon = "http://localhost/reportes/".$imgurl['route'];
        return $this->app->POST(true);
    }

    public function update()
    {
        $file = Files::SetFile("files");
        if($file !== "No hay coincidencias")
        {
            $imgurl = Files::UploadFile($file , "", ["max_size" => 10000.00, "replace" => true]);
            $this->app->icon = "http://localhost/reportes/".$imgurl['route'];
        }
        echo $this->app->PUT();
    }

    public function delete()
    {
        $filename = $this->app->extractsend("filename");
        Files::DeleteFile(explode("http://localhost/reportes/", $filename)[1]);
        return $this->app->DELETE();
    }

    public function getall($id="")
    {
        if($id === "")
        {
            return $this->app->SELECT()->GET();
        }
        else
        {
            return $this->app->FIND($id);
        }
    }
}
?>