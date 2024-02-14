<?php

class Watch_Block
{
    public static function table($invent)
    {
        ?>
            <div class="cont-100 d-flex">
                <div class="cont-50 mr-auto">
                    <p class="text-16 pad-2"><?php echo $invent['titulo'];?></p><br>
                </div>
                <div class="cont-50 mr-auto">
                    <button class="float-end button bg-blue c-white cont-50 border-rad-1" @click="OpenModal(false)">Agregar Item</button>
                </div>
            </div>
            <div class="cont-100 mr-auto bg-white pad-2 shad-1-gray">
                
                <div class="cont-100 d-flex">
                    <div class="cont-20"><p class="text-12 text-center">Articulo</p></div>
                    <div class="cont-20"><p class="text-12 text-center">Descripción</p></div>
                    <div class="cont-20"><p class="text-12 text-center">No.Serie</p></div>
                    <div class="cont-20"><p class="text-12 text-center">Asignado</p></div>
                    <div class="cont-20"><p class="text-12 text-center">Acción</p></div>
                </div>
            </div>
            <div class="cont-100 h-70 scroll-y">
                <div class="cont-100 d-flex bg-white mr-t-4" v-for="(item, index) in inventario" :key="index">
                    <div class="cont-20 mr-auto"><p class="text-12 text-center">{{item.articulo}}</p></div>
                    <div class="cont-20 mr-auto"><p class="text-12 text-center">{{item.descripcion}}</p></div>
                    <div class="cont-20 mr-auto"><p class="text-12 text-center">{{item.No_serie}}</p></div>
                    <div class="cont-20 mr-auto" v-if="item.id_usuario !== null"><p class="text-12 text-center">Asignado</p></div>
                    <div class="cont-20 mr-auto"v-else><p class="text-12 text-center">No Asignado</p></div>
                    <div class="cont-20 mr-auto"><p class="text-12 text-center cursor-pointer hov-1"><img src="<?php Icon('option.png')?>" alt="" @click="OpenOptions(item.id, index)"></p></div>
                </div>
            </div>
        <?php
    }

    public static function ModalAdd()
    {
        ?>
            <div class="modal" v-show="modal === true">
                <div class=" modal-window-md bg-white pad-2 cont-35 border-rad-1">
                    <form @submit="SendData">
                        <p class="text-14 mr-l-4 mr-t-2">Agrega un articulo al inventario</p>
                        <input type="text" placeholder="Nombre del articulo" class="input-form" v-model="articulo">
                        <input type="text" placeholder="Numero de serie (opcional)" class="input-form" v-model="no_serie">
                        <textarea rows="4" class="input-form" placeholder="Descripción del articulo" v-model="descripcion"></textarea>
                        <button class="button bg-blue c-white mr-l-6 mr-t-4 cont-90 border-rad-1" v-if="editar === false">Agregar</button>
                        <button class="button bg-blue c-white mr-l-6 mr-t-4 cont-90 border-rad-1" v-else>Editar</button>
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
                        <p>Editar Item</p>
                    </div>
                    <div class="option" @click="Question">
                        <p>Eliminar Item</p>
                    </div>
                    <div class="option" @click="Asign">
                        <p>Asignar a usuario</p>
                    </div>
                    <br>
                </div>
            </div>
        <?php
    }

    public static function ModalAsign()
    {
        ?>
            <div class="modal" v-show="modal2 === true">
                <div class="modal-window-sm cont-50 mr-t-10 bg-white pad-2 border-rad-1">
                    <div class="cont-95 mr-auto">
                        <p class="text-14 pad-2">Asignar equipo a usuario</p><br>
                        <div class="cont-100 h-45 scroll-y mr-t-2" >
                            <div class="cont-100 d-flex-f pad-2 shad-1-black" v-for="(item, index) of users">
                                <div class="cont-15 mr-auto">
                                    <p class="text-12 text-center">{{item.Nombre}}</p>
                                </div>
                                <div class="cont-15 mr-auto">
                                    <p class="text-12 text-center">{{item.Apellidos}}</p>
                                </div>
                                <div class="cont-40 mr-auto">
                                    <p class="text-12 text-center">{{item.Correo}}</p>
                                </div>
                                <div class="cont-25 mr-auto">
                                    <button class="button bg-blue c-white cont-80 border-rad-1" @click="UserAsign(item.id)">Asignar</button>
                                </div>
                            </div>
                        </div>
                        <div class="cont-90 mr-auto mr-t-2">
                            <button class="button-list1 hov-1" title="anterior" @click="Loadusuarios('-')"><</button>
                            <button class="button-list2 hov-1" title="siguiente" @click="Loadusuarios('+')">></button>
                        </div>
                        <br><br><br>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function Question()
    {
        ?>
            <div class="modal" v-show="question === true">
                <div class=" modal-window-sm bg-white pad-2 border-rad-1 cont-25">
                    <p class="text-14 text-center">¿Seguro de eliminar el item del inventario?</p>
                    <div class="d-flex cont-100 mr-t-4">
                        <button class="button bg-gray-100 border-rad-1 cont-45 mr-auto" @click="question = false">Cancelar</button>
                        <button class="button bg-blue c-white border-rad-1 cont-45 mr-auto" @click = "DeleteItem()">Eliminar</button>
                    </div>
                </div>
            </div>
        <?php
    }
}