<body>
<?php
        Layout("Menu");
        CSRF();
    ?>
    <div id="app">
        <?php 
            Equipo_Block::ModalRegistro();
            Equipo_Block::ModalOpciones();
            Equipo_Block::ModalEdicion();
            Equipo_Block::ModalAsignar();
            Equipo_Block::ModalQuestion();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                Equipo_Block::BloqueInicio();
                Equipo_Block::Table();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "equipo";
    </script>
    <?php scripts();?>
</body>