<body>
<?php
        Layout("Menu");
        App_Block::LoadResource();
        CSRF();
    ?>
    <div id="app">
        <?php 
            AppE_Block::Modal();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <input type="hidden" id="id" value="<?php echo $params?>" >
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                AppE_Block::formulario();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "apps";
    </script>
    <?php scripts();?>
</body>