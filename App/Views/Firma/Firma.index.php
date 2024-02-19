<body class="bg-white">
    <div id="app">
        <input type="hidden" name="" value="<?php echo $params; ?>" id="id">
        <?php 
            CSRF();
            Firma_Block::Modal();
            Firma_Block::Print();
            
        ?>
        <div v-if="documento.tipo_doc === 'accesorio_in' || documento.tipo_doc ==='accesorio_out'">
            <?php
                Firma_Block::VistaPrevia2();
            ?>
        </div>
        <div v-else>
            <?php
                Firma_Block::VistaPrevia1();
            ?>
        </div>
    </div>
    <?php scripts(["menu"]); ?>
</body>

