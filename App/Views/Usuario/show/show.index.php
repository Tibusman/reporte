<body>
<?php
        Layout("Menu");
        CSRF();
    ?>
    <div id="app">
        <?php 
            Usuario_block::ModalOptions();
            Usuario_block::PanelRoles();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                Usuario_block::panelheader();
                Usuario_block::Table();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "usuario";
    </script>
    <?php scripts();?>
</body>