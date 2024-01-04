<?php
//Incluye los bloques o controladores y las paginas dependientes de cada uno
$blocks=array(
    'Page'=>[
        'index',
        'login',
        'menu',
        'exit'
    ],
    "Reporte"=>[
        "show",
        "getreportes",
        "store",
        "delete",
        "loadreportedetail",
        "postsolution",
        "update"
    ],
    "Mantenimiento"=>[
        "show",
        "getall",
        "save",
        "savemante",
        "update",
        "gethistorial"
    ],
    "Equipo"=>[
        "getall",
        "save"
    ],
    "Backup"=>[
        "show",
        "getall"
    ]
);
//Se pueden registrar varios bloques y varias paginas
?>