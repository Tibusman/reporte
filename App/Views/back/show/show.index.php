<body>
<?php
        Layout("Menu");
        CSRF();
    ?>
    <div id="app">
        <?php 
        Backup_Block::ModalOptions();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                Backup_Block::header();
                Backup_Block::Table();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "respaldo";
    </script>
    <?php scripts();?>
</body>