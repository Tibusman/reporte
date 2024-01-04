<?php

class Backup_Block
{
    public static function header()
    {
        ?>
            <div class="cont-100 mr-auto mr-t-4">
            <button class="button bg-success c-white cont-35 float-end border-rad-1">Nuevo respaldo</button>
                <div class="cont-50">
                    <input type="date" class="input-form shad-1-gray" v-model="fecha">
                </div>
            </div>
        <?php
    }

    public static function Table()
    {
        ?>
            <div class="cont-100 mr-t-6 d-flex-f bg-white pad-2 shad-1-gray text-14 text-center">
                <div class="mr-auto cont-5">
                    <p>Semana</p>
                </div>
                <div class="mr-auto cont-15">
                    <p>Almacenamiento</p>
                </div>
                <div class="mr-auto cont-25">
                    <p>Comentarios</p>
                </div>
                <div class="mr-auto cont-15">
                    <p>Fecha</p>
                </div>
                <div class="mr-auto cont-10">
                    <p>Firma</p>
                </div>
                <div class="mr-auto cont-5">
                    <p>Acción</p>
                </div>
            </div>

            <div class="cont-100 h-60 scroll-y">
                <div class="cont-100 mr-t-6 d-flex-f bg-white pad-2 shad-1-gray text-14 text-center border-rad-1" v-for="(item, index) of backs" :key="index">
                    <div class="mr-auto cont-5">
                        <p>{{item.Semana}}</p>
                    </div>
                    <div class="mr-auto cont-15">
                        <p>{{item.Almacenamiento}} GB</p>
                    </div>
                    <div class="mr-auto cont-25">
                        <p>{{item.Comentarios}}</p>
                    </div>
                    <div class="mr-auto cont-15">
                        <p>{{item.Fecha}}</p>
                    </div>
                    <div class="mr-auto cont-10">
                        <img :src="item.Firma" alt="" class="cont-100">
                    </div>
                    <div class="mr-auto cont-5">
                        <img src="<?php Icon('option.png');?>" alt="" class="d-block mr-auto hov-1 cursor-pointer" title="Abrir menu" @click="OpenOptions(item.id)">
                    </div>
                </div>
            </div>
            <div class="cont-100">
                <button class="button-list1"><</button>
                <button class="button-list2">></button>
            </div>
        <?php
    }

    public static function ModalOptions()
    {
        ?>
            <div class="modal">
                <div class=" modal-window-cover bg-white pad-2 border-rad-1 cont-75 mr-t-6">
                    <div class="cont-100 d-flex-f">
                        <div class="cont-60 mr-auto"></div>
                        <div class="cont-40 mr-auto d-flex-f">
                            <button class="button mr-auto d-block bg-success c-white cont-45 border-rad-1">Registrar</button>
                            <button class="button mr-auto d-block bg-gray-200 cont-45 border-rad-1">Cancelar</button>
                        </div>
                    </div>

                    
                </div>
            </div>
        <?php
    }
}

?>