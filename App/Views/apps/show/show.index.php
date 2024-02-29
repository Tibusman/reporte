<body>
<?php
        Layout("Menu");
        App_Block::LoadResource();
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
                App_Block::OptionsApps();
                App_Block::LoadApps();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "apps";
    </script>
    <?php scripts();?>
</body>