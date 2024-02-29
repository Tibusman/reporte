<body>
<?php
        Layout("Menu");
        Inventario_Block::LoadResource();
        CSRF();
    ?>
    <div id="app">
        <?php 
            Inventario_Block::ModalOptions();
            Inventario_Block::Modal_inventario();
            Inventario_Block::Question();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                Inventario_Block::Bloque1();
                Inventario_Block::InvenatrioCards();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "inventario";
    </script>
    <?php scripts();?>
</body>