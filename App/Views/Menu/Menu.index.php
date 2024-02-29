<body>
<?php
        Layout("Menu");
        MenuBlock::LoadResource();
        CSRF();
    ?>
    <div id="app">
        <?php 
            
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                MenuBlock::block1();
                MenuBlock::Tables();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "inicio";
    </script>
    <?php scripts();?>
</body>