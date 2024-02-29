<body>
<?php
        Layout("Menu");
        Mantenimiento_Block::LoadResource();
        CSRF();
    ?>
    <div id="app">
        <?php 
            Mantenimiento_Block::ModalOptions();
            Mantenimiento_Block::ModalCreate();
            Mantenimiento_Block::ModalUpdate();
            Mantenimiento_Block::ModalHistorial();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                Mantenimiento_Block::Block1();
                Mantenimiento_Block::table();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "mantenimiento";
    </script>
    <?php scripts();?>
</body>