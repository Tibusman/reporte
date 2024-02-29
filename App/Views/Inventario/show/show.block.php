<?php
class Inventario_Block
{
    public static function Bloque1()
    {
        ?>
            <div class="cont-90 d-flex mr-t-6 mr-auto">
                <div class="cont-50">
                    
                </div>
                <div class="cont-50">
                    <button class="button bg-success c-white float-end cont-50 border-rad-1" @click="OpenModal(false)">Nuevo inventario</button>
                </div>
            </div>
        <?php
    }

    public static function InvenatrioCards()
    {
        ?>
            <div class=" container mr-t-10">
                <div class="rw">
                    <div class="sup-4-s mr-t-6 bg-white shad-1-gray border-rad-1 pad-2" v-for="(item, index) of inventarios" :key="index">
                    <img src="<?php Icon('option.png')?>" alt="" class="float-end cursor-pointer hov-1" @click="OpenOptions(item.id, index)"><br>
                        <div class="cont-70 mr-auto bg-gray-100 border-rad-1 h-5 mr-t-2"></div>
                        <p class="text-16 mr-t-2 text-center">{{item.titulo}}</p>
                        <div class="cont-95 mr-auto mr-t-4 h-5">
                            <p class="text-12 text-center">{{item.descripcion}} </p>
                        </div><br>
                        <button class="button bg-blue c-white cont-80 mr-auto d-block border-rad-1" @click="Goto(item.id)">Ver inventario</button><br>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function Modal_inventario()
    {
        ?>
            <div class="modal" v-show="modal === true">
                <div class=" modal-window-md cont-30 bg-white border-rad-1">
                    <p class="text-14 pad-4">Nuevo inventario</p>
                    <form @submit="RegisterInventario">
                        <input type="text" class="input-form" placeholder="Titulo del inventario" v-model="titulo">
                        <textarea type="text" class="input-form" placeholder="Descripción" rows="3" v-model="descripcion"></textarea>
                        <input type="submit" class="button bg-blue c-white mr-t-4 d-block mr-l-4 cont-35 border-rad-1" value="Editar" v-if="edit === true">
                        <input type="submit" class="button bg-blue c-white mr-t-4 d-block mr-l-4 cont-35 border-rad-1" value="Registrar" v-if="edit === false"><br>
                    </form>
                </div>
            </div>
        <?php
    }
    public static function ModalOptions()
    {
        ?>
            <div class="modal" v-show="options === true">
                <div class=" modal-window-sm bg-white border-rad-1 cont-25">
                    <p class="text-center text-14 pad-2">MENU DE OPCIONES</p><br>
                    <div class="option" @click="OpenModal(true)">
                        <p>Editar inventario</p>
                    </div>
                    <div class="option" @click="Question">
                        <p>Eliminar inventario</p>
                    </div><br>
                </div>
            </div>
        <?php
    }

    public static function Question()
    {
        ?>
            <div class="modal" v-show="question === true">
                <div class=" modal-window-sm bg-white pad-2 border-rad-1 cont-25">
                    <p class="text-14 text-center">¿Seguro de eliminar el inventario?</p>
                    <div class="d-flex cont-100 mr-t-4">
                        <button class="button bg-gray-100 border-rad-1 cont-45 mr-auto" @click="question = false">Cancelar</button>
                        <button class="button bg-blue c-white border-rad-1 cont-45 mr-auto" @click = "DeleteInventory()">Eliminar</button>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function LoadResource()
    {
        ?>
            <div class="load_view" id="loadingview">
                <div class="show-spinner" v-if="showload">
                    <div class="loadingio-spinner-ripple-v3oo5m0dq9k">
                        <div class="ldio-rmrl4u541f">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <p  style="margin-left: 53%;">Cargando Vista</p>
                </div>
            </div>
        <?php
    }
}

?>