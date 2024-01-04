<body>
    <div id="app">
        <div class="cont-100 h-100 absolute bg-blue-400">
            <div class="content">
                <div class="rw">
                    <div class="sup-3 mr-auto "></div>
                    <div class="sup-3 mr-auto "></div>
                    <div class="sup-3 mr-auto ">
                        <form @submit="LoginForm" class="cont-100 bg-white h-100">
                            <br><br><br><br><br><br><br>
                            <?php CSRF();?>
                            <img src="<?php Image('logo.png'); ?>" alt="" class="d-block mr-auto">
                            <div class="cont-70 mr-auto mr-t-10">
                                <span class="text-12 c-blue">Correo</span>
                                <input type="text" placeholder="Correo" class="login-input" v-model="mail">
                            </div>
                            <div class="cont-70 mr-auto mr-t-6">
                                <span class="text-12 c-blue">Contraseña</span>
                                <input type="password" placeholder="password" class="login-input" v-model="password">
                            </div><br><br>
                            <a href="" class="text-12 c-gray text-center d-block mr-auto text-d">Recuperar Contraseña</a>
                            <br><br>
                            <button class="button bg-blue-300 c-white d-block mr-auto mr-t-10 cont-55 border-rad-1">INGRESAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php scripts(["menu.js"]); ?>
</body>