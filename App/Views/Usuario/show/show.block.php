<?php

class Usuario_block
{
    public static function panelheader()
    {
        ?>
            <div class="cont-90 d-flex mr-t-6 mr-auto">
                <div class="cont-50">
                    <input type="text" placeholder="Buscar por nombre" class="input-form" v-model="search" @keyup="CargarUsuarios('-')">
                </div>
                <div class="cont-50">
                    <button class="button bg-success c-white float-end cont-50 border-rad-1" @click="ChangeView">Nuevo usuario</button>
                </div>
            </div>
        <?php
    }

    public static function Table()
    {
        ?>
            <div class="cont-90 mr-auto bg-white shad-1-gray pad-2 mr-t-4 d-flex-f text-center">
                <div class="cont-25 text-12">Nombre</div>
                <div class="cont-25 text-12">Apellidos</div>
                <div class="cont-35 text-12">Correo</div>
                <div class="cont-35 text-12">Imagen</div>
                <div class="cont-5 mr-auto text-12">Acción</div>
            </div>
            <div class="cont-90 mr-auto h-60 scroll-y">
                <div class="cont-100 bg-white shad-1-gray pad-2 mr-t-4 d-flex-f text-center " v-for="(item, index) of users">
                    <div class="cont-25 mr-auto text-12">{{item.Nombre}}</div>
                    <div class="cont-25 mr-auto text-12">{{item.Apellidos}}</div>
                    <div class="cont-35 mr-auto text-12">{{item.Correo}}</div>
                    <div class="cont-35 mr-auto text-12"> <img :src="item.Img" alt="" class="cont-20"></div>
                    <div class="cont-5 mr-auto text-12">
                        <img src="<?php Icon("option.png"); ?>" alt="" class="cursor-pointer hov-1" title="Opciones" @click="OpenOptions(item.id)">
                    </div>
                </div>
            </div>
            <div class="cont-100">
                <button class="button-list1 hov-1" title="anterior" @click="CargarUsuarios('-')"><</button>
                <button class="button-list2 hov-1" title="siguiente" @click="CargarUsuarios('+')">></button>
            </div>
        <?php
    }

    public static function ModalOptions()
    {
        ?>
            <div class="modal" v-show="modal === true">
                <div class="modal-window-sm bg-white cont-20 pad-2 border-rad-1">
                <p class="text-14 text-center">Menu de opciones</p><br>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="OpenAsignar">
                        <p class="text-12 text-center">Asignar rol</p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="GotoEdit">
                        <p class="text-12 text-center">Editar usuario</p>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function PanelRoles()
    {
        ?>
            <div class="modal" v-show="modal2 === true">
                <div class=" modal-window-sm bg-white cont-30 pad-2 border-rad-1">
                    <div class="cont-90 mr-auto">
                        <p class="text-14 c-gray text-center">Asignar rol</p>
                        <p class="text-10 text-center">Selecciona alguno de los roles que se muestra a continuación.</p>
                        <br>
                        <select class="input-form d-block mr-auto" v-model="rol">
                            <option value="1">Usuario</option>
                            <option value="2">SuperUser</option>
                            <option value="3">Admin</option>
                        </select>
                        <br>
                        <button class="button bg-success c-white text-14 d-block mr-auto cont-50 border-rad-1" @click="AsignarRol">Asignar</button>
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