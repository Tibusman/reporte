<header>

    <div class="menu-desk">
        <div class="menu-top">
            <p class="names"><?php echo Ses::ShowAtribute("username"); ?></p>
            <div class="cont-letter" id="name">
                <p class="letters"><?php LoadLetters(); ?></p>
                <div class="app-container" id="menu1">
                    <div class="item-personal">
                        <a href="<?php to("Usuario/profile/" . Ses::id()) ?>">
                            <p>Perfil</p>
                        </a>
                    </div>
                    <div class=" item-personal">
                        <a href="<?php to("exit") ?>">
                            <p>Salir</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu-lateral">
            <img src="<?php Image('Logo.png') ?>" alt="" class="image-logo">
            <div class="contenedor-menu-items">

                <div id="inicio">
                    <a href="<?php to("menu"); ?>" class="text-d">
                        <div class="item-menu ">
                            <i class="fas fa-home"></i>
                            <p class="pos">Inicio</p>
                        </div>
                    </a>
                </div>

                <p class="subtitle">Navegacion</p>

                <div id="reporte" onclick="LoadSubMenu('reporte')">
                    <a class="text-d">
                        <div class="item-menu">
                            <i class="fas fa-file-alt"></i>
                            <p class="pos">Reportes</p>
                        </div>
                    </a>
                </div>

                <div id="mantenimiento" onclick="LoadSubMenu('mantenimiento')">
                    <a class="text-d">
                        <div class="item-menu">
                            <i class="fa-solid fa-gear"></i>
                            <p class="pos">Mantenimientos</p>
                        </div>
                    </a>
                </div>

                <div id="respaldo" onclick="LoadSubMenu('respaldo')">
                    <a class="text-d">
                        <div class="item-menu">
                            <i class="fa-solid fa-cloud"></i>
                            <p class="pos">Respaldos</p>
                        </div>
                    </a>
                </div>

                <div id="usuario" onclick="LoadSubMenu('usuario')">
                    <a class="text-d">
                        <div class="item-menu">
                            <i class="fa-solid fa-user"></i>
                            <p class="pos">Usuarios</p>
                        </div>
                    </a>
                </div>

                <div id="equipo" onclick="LoadSubMenu('equipo')">
                    <a class="text-d">
                        <div class="item-menu">
                            <i class="fa-solid fa-laptop"></i>
                            <p class="pos">Equipos</p>
                        </div>
                    </a>
                </div>

            </div>

        </div>

        <div class="sub-menu" id="submenu">
            <br><br>
            <p class="close" onclick="closeSubMenu()">X</p>
            <br><br><br>



            <div class="fill">
                <p class="title-submenu">
                    REPORTES
                </p><br><br>
                <?php
                    Bloque("Reporte/show", "Ver reportes");
                ?>
            </div>

            <div class="fill">
                <p class="title-submenu">
                    MANTENIMIENTOS
                </p><br><br>
                <?php
                    Bloque("Mantenimiento/show", "Ver mantenimiento");
                ?>
            </div>

            <div class="fill">
                <p class="title-submenu">
                    RESPALDOS
                </p><br><br>
                <?php
                    Bloque("Backup/show", "Respaldo");
                ?>
            </div>

            

            <div class="fill">
                <p class="title-submenu">
                    USUARIOS
                </p><br><br>
                <?php
                    Bloque("Auto/show", "Ver usuarios");
                ?>
            </div>

            <div class="fill">
                <p class="title-submenu">
                    EQUIPOS
                </p><br><br>
                <?php
                    Bloque("Reporte/show", "Ver equipos");
                ?>
            </div>
        </div>
    </div>

</header>


<?php

function Bloque($module,  $nombre)
{
?>
    <div>
        <a href="<?php to($module); ?>" class="text-d">
            <div class="item-menu">
                <p class="pos2"><?php echo $nombre; ?></p>
            </div>
        </a>
    </div>
<?php
}


function LoadLetters()
{
    $string = explode(" ", Ses::ShowAtribute("username"));
    $let1 = str_split($string[0])[0];
    $let2 = str_split($string[1])[0];
    echo $let1 . "" . $let2;
}

LoadLetters();
?>