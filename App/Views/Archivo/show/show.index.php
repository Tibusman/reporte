<body>
<?php
        Layout("Menu");
        CSRF();
    ?>
    <div id="app">
        <?php 
            Archivo_Block::Formulario();
            Archivo_Block::formato2();
            Archivo_Block::Opciones();
            Archivo_Block::User();
            Archivo_Block::Choice();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                Archivo_Block::Bloque1();
                Archivo_Block::Tabla();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "inventario";
    </script>
    <?php scripts();?>
</body>