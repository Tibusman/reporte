<body>
<?php
        Layout("Menu");
        Backup_Block::LoadResource();
        CSRF();
    ?>
    <div id="app">
        <?php 
        Backup_Block::ModalCreate();
        Backup_Block::ModalOptions();
        Backup_Block::ModalVisual();
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