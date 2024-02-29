<?php
ImportBlock("apps/show");

class AppC_Block
{
    public static function formulario()
    {
        ?>
            <div class="cont-100 d-flex-f">
                <div class="cont-50 mr-auto">
                    <p class="text-20">Registro de App</p>
                    <p class="text-12">Llena los datos en el siguiente formulario</p>
                </div>
                <div class="cont-50 mr-auto">
                    
                </div>
            </div><br>
            <div class="cont-100 bg-white shad-1-gray pad-2">
                <br>
                <div class="cont-95 mr-auto">
                    <?php
                        self::Part1();
                        self::MenuActions();
                    ?>
                </div>
            </div>
        <?php
    }

    public static function Part1()
    {
        ?>
            <div class="cont-100 d-flex-f">
                <div class="cont-50 mr-auto">
                    <p class="text-12 c-gray">Nombre de la app</p>
                    <input type="text" placeholder="Nombre de la app" class="input-form mr-t-2" v-model="nombre">
                </div>
                <div class="cont-50 mr-auto">
                    <p class="text-12 c-gray">Version de la app</p>
                    <input type="text" placeholder="Version de la app" class="input-form mr-t-2" v-model="version">
                </div>
            </div>
            <div class="cont-100 d-flex-f mr-t-8">
                <div class="cont-50 mr-auto">
                    <p class="text-12 c-gray">Url de la app</p>
                    <input type="text" placeholder="Url de la app" class="input-form mr-t-2" v-model="url">
                </div>
                <div class="cont-50 mr-auto">
                    <p class="text-12 c-gray">Descripción de la app</p>
                    <input type="text" placeholder="Descripción de la app" class="input-form mr-t-2" v-model="descripcion">
                </div>
            </div>
            <br><br>
            <div class="cont-100">
                <div class="cont-20">
                    <p class="text-12 c-gray">Icono de la app (1024 x 1024)</p><br>
                    <div v-if="image === ''">
                        <input type="file" class="d-none" id="file" @change="OpenFile" accept=".jpeg, .png, .webp">
                        <label for="file" class="hov-1 cursor-pointer" title="Selecciona una imagen">
                            <img src="<?php Image('add-image.png'); ?>" alt="" class="select-image">
                        </label>
                    </div>
                    <div v-else>
                        <input type="file" class="d-none" id="file" @change="OpenFile" accept=".jpeg, .png, .webp">
                        <label for="file" class="hov-1 cursor-pointer" title="Selecciona una imagen">
                            <img :src="image" alt="" class="select-image2">
                        </label>
                    </div>
                </div>
            </div><br><br>
        <?php
    }
    public static function MenuActions()
    {
        ?>
            <div class="cont-100 d-flex">
                <div class="cont-65 mr-auto"></div>
                <div class="cont-35 mr-auto d-flex-f">
                    <button class="button cont-45 mr-auto border-rad-1 bg-gray-200" @click="Cancel">Cancelar</button>
                    <button class="button cont-45 mr-auto bg-blue c-white border-rad-1" @click="SaveAll">Guardar</button>
                </div>
            </div>
        <?php
    }
}