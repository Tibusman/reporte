<?php


class ReporteBlock
{
    public static function Block1()
    {
        ?>
            <br>
            <div class="cont-95 mr-auto">
                <div class="cont-100 d-flex-f">
                    <div class="cont-50 mr-auto">
                        <input type="text" class="input" placeholder="Buscar..." v-model="search" @keyup="LoadReportes">
                    </div>
                    <div class="cont-50 mr-auto pad-2">
                        <button class="button cont-50 float-end c-white bg-success border-rad-1" @click="OpenModal">Nuevo reporte</button>
                    </div>
                </div>
            </div><br>
        <?php
    }

    public static function Table()
    {
        ?>
            <div class="cont-95 mr-auto bg-white pad-2 shad-1-gray">
                <div class="cont-100 d-flex-f bg-white">
                    <div class="cont-15 mr-auto text-14 tw-bold text-center">Titulo</div>
                    <div class="cont-15 mr-auto text-14 tw-bold text-center">Fecha <i class="fas fa-filter cursor-pointer hov-1"></i></div>
                    <div class="cont-45 mr-auto text-14 tw-bold text-center">Descripción</div>
                    <div class="cont-15 mr-auto text-14 tw-bold text-center">Estatus</div>
                    <div class="cont-10 mr-auto text-14 tw-bold text-center">Acción</div>
                </div>
            </div>
            <div class="contenido-table">
                <div class="cont-100 d-flex-f bg-white shad-1-gray pad-2" v-for="(item, index) of reportes" :key="index">
                    <div class="cont-15 mr-auto text-12 text-center"> {{ item.Titulo }} </div>
                    <div class="cont-15 mr-auto text-12 text-center">{{ item.Fecha_req }}</div>
                    <div class="cont-45 mr-auto text-12 text-center text-truncate">{{ item.Descripcion }}</div>
                    <div class="cont-15 mr-auto text-12 text-center">
                        <div class="status  c-white" :class="{bg_success:item.Estado === 'Completo', bg_danger:item.Estado === 'Pendiente', bg_warning:item.Estado === 'Proceso'}">
                            {{ item.Estado }}
                        </div>
                    </div>
                    <div class="cont-10 mr-auto"><img src="<?php Icon('option.png');?>" alt="" class="d-block mr-auto hov-1 cursor-pointer" title="Abrir menu" @click="OpenOptions(item.id)"></div>
                </div>
            </div>
            <div class="cont-100">
                <button class="button-list1 hov-1" title="anterior" @click="LoadReportes('-')"><</button>
                <button class="button-list2 hov-1" title="siguiente" @click="LoadReportes('+')">></button>
            </div>
        <?php
    }


    public static function ModalOptions()
    {
        ?>
            <div class="modal" v-show="modal2 === true">
                <div class=" modal-window-sm bg-white border-rad-1 cont-25">
                    <p class="text-center text-14 pad-2">MENU DE OPCIONES</p><br>
                    <div class="option" @click="LoadReporteDetail">
                        <p>Ver reporte</p>
                    </div>
                    
                    <?php
                        Rols::Check(["SuperUser"], function(){
                            ?>
                                <div class="option" @click="OpenModal3">
                                    <p>Eliminar reporte</p>
                                </div>

                                <div class="option" @click="OpenSupport">
                                    <p>Dar soporte</p>
                                </div><br>
                            <?php
                        });
                    ?>
                </div>
            </div>
        <?php
    }

    public static function ModalRegister()
    {
        ?>
            <div class="modal" v-show="modal == true">
                <div class=" modal-window-md cont-45 bg-white shad-1-gray border-rad-1">
                    <div class="cont-90 mr-auto">
                        <p class="text-18 pad-2 text-center">NUEVO REPORTE</p>
                        <p class="text-10 c-gray text-center">Llena todos los campos de tu reporte, se lo mas detallado posible.</p><br>
                        <form @submit="CreateReport" >
                            <label class="text-14">Titulo del problema</label><br>
                            <input type="text" class="input-form" v-model="titulo" placeholder="Titulo"><br><br>
                            <label class="text-14">Tipo de reporte</label><br>
                            <select class="input-form" v-model="tipo">
                                <option value="general" class="text-14">General</option>
                                <option value="por equipo" class="text-14">Por Equipo</option>
                            </select><br><br>
                            <label class="text-14">Descripción del problema</label><br>
                            <textarea class="input-form" cols="10" rows="5" v-model="descripcion" placeholder="Descripcion"></textarea><br>
                            <br>
                            <button class="button bg-blue cont-50 c-white border-rad-1">Registrar</button><br><br>
                        </form>
    
                    </div>
                </div>
            </div>
        <?php
    }

    public static function ModalQuestion()
    {
        ?>
            <div class="modal" v-show="modal3 === true">
                <div class="bg-white modal-window-sm border-rad-1"><br>
                    <p class="text-center text-14">¿Deseas eliminar el reporte?</p><br>
                    <div class="cont-100 d-flex">
                        <button class="button bg-gray-200 c-black mr-auto border-rad-1" @click="modal2=false">Cancelar</button>
                        <button class="button bg-success c-white mr-auto border-rad-1" @click="DeleteReporte">Aceptar</button>
                    </div><br>
                </div>
            </div>  
        <?php
    }

    public static function DetailModal()
    {
        ?>
            <div class="modal" v-show="modal4 == true">
                <div class="modal-window-md bg-white cont-50 mr-auto mr-t-10 border-rad-1">
                    <br>    
                    <p class="text-center">Detalles del reporte</p>
                    <br>
                    <hr>
                    <br>
                    <div class="cont-95 mr-auto text-14">
                        <p><b>Titulo del reporte: </b>{{ title_text }}</p><br>
                        <p><b>Descripción del reporte: </b>{{ description_text }}</p><br>
                    </div>
                    <div class="cont-100 h-60 scroll-y">
                        <div class="" v-for="(item, index) of producto_detail" :key="index">
                            <div class="cont-50 d-flex-f bg-gray-100 mr-auto pad-2 border-rad-1 mr-t-4" @click="OpenInfo(index)">
                                <div class="cont-50 mr-auto">
                                    <p class="text-16 tw-bold">Solucion {{ index + 1 }}</p>
                                </div>
                                <div class="cont-50 mr-auto">
                                    <i class="fa-solid fa-arrow-down text-14 cursor-pointer hov-1 float-end" ></i>
                                </div>
                            </div>
                            <div class="cont-50 mr-auto shad-1-gray bg-white pad-2" v-show="showinfo === index">
                                <p class="text-12">{{item.Solucion}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        <?php
    }

    public static function SolutionSupport()
    {
        ?>
            <div class="modal" v-show="modal5 === true">
                <div class="modal-window-md bg-white cont-45 pad-2 mr-t-10 border-rad-1">
                    <br>
                    <div class="cont-90 mr-auto">
                        <p class=" text-12">Dar Soporte</p><br>
                        <textarea  class="input-form cont-100" placeholder="Solucion" v-model="solucion"></textarea><br><br>
                        <div class="cont-100">
                            <button class="button cursor-pointer-pad-2 bg-success c-white border-rad-1" @click="SendSupport('Proceso')">Dar soporte</button>
                            <button class="button cursor-pointer-pad-2 float-end bg-danger c-white border-rad-1" @click="SendSupport('Completo')">Finalizar</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        <?php
    }
}

?>