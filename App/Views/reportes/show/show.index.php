<body>
<?php
        Layout("Menu");
        CSRF();
    ?>
    <div id="app">
        <?php 
            ReporteBlock::ModalRegister();
            ReporteBlock::ModalOptions();
            ReporteBlock::ModalQuestion();
            ReporteBlock::DetailModal();
            ReporteBlock::SolutionSupport();
        ?>
        <div class="loadalert" v-show="alert==true">
            <img src="<?php Icon("load.gif")?>" alt="">
            <p>{{textalert}}</p>
        </div>
        <div class="wrap mr-t-6">
            <div class="cont-90 mr-auto">
            <?php 
                ReporteBlock::Block1();
                ReporteBlock::Table();
            ?>
            </div>
        </div>
    </div>
    <script>
        var module = "reporte";
    </script>
    <?php scripts();?>
</body>