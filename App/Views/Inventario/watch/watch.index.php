<body>
<?php
        Layout("Menu");
        CSRF();
    ?>
    <div id="app">
        <?php 
            Watch_Block::ModalAdd();
            Watch_Block::Question();
            Watch_Block::ModalOptions();
            Watch_Block::ModalAsign();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                Watch_Block::table($params);
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "inventario";
    </script>
    <?php scripts();?>
</body>