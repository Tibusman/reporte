<?php

class Equipo_Block
{
    public static function BloqueInicio()
    {
        ?>
            <div class="cont-90 mr-auto">
                <div class="cont-100 d-flex-f mr-t-6">
                    <div class="cont-50 mr-auto d-flex-f">
                        <input type="search" class="input-form cont-80" v-model="search" placeholder="Buscar usuario" @keyup="Loadequipos('-')">
                        <img src="<?php Icon('eye.png')?>" alt="" class="mr-l-4 cursor-pointer hov-1" title="Ver no asignados" @click="Loadunsigned('')">
                    </div>
                    <div class="cont-50 mr-auto">
                        <button class="button bg-success c-white float-end cont-50 border-rad-1" @click="openModal()">Registrar equipo</button>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function Table()
    {
        ?>
            <div class="cont-90 mr-auto pad-2 bg-white mr-t-6 shad-1-gray d-flex-f">
                <div class="cont-15 mr-auto">
                    <p class="text-12 text-center">Marca</p>
                </div>
                <div class="cont-20 mr-auto">
                    <p class="text-12 text-center">Modelo</p>
                </div>
                <div class="cont-20 mr-auto">
                    <p class="text-12 text-center">Sistema</p>
                </div>
                <div class="cont-35 mr-auto">
                    <p class="text-12 text-center">Usuario</p>
                </div>
                <div class="cont-10 mr-auto">
                    <p class="text-12 text-center">Acción</p>
                </div>
            </div>

            <div class="cont-90 mr-auto h-60 scroll-y">
                <div class="cont-100 mr-auto pad-2 bg-white mr-t-6 shad-1-gray d-flex-f" v-for="(item, index) of equipos">
                    <div class="cont-15 mr-auto">
                        <p class="text-12 text-center">{{ item.nombre }}</p>
                    </div>
                    <div class="cont-20 mr-auto">
                        <p class="text-12 text-center">{{ item.modelo }}</p>
                    </div>
                    <div class="cont-20 mr-auto">
                        <p class="text-12 text-center">{{ item.sistema }}</p>
                    </div>
                    <div class="cont-35 mr-auto">
                        <p class="text-12 text-center">{{ item.mail }}</p>
                    </div>
                    <div class="cont-10 mr-auto">
                        <p class="text-12 text-center"><img src="<?php Icon("option.png")?>" alt="" class="cursor-pointer hov-1" @click="OpenOptions(item.id, index)"></p>
                    </div>
                </div>
            </div>
            <div class="cont-90 mr-auto mr-t-2">
                <button class="button-list1 hov-1" title="anterior" @click="Loadequipos('-')"><</button>
                <button class="button-list2 hov-1" title="siguiente" @click="Loadequipos('+')">></button>
            </div>
        <?php
    }

    public static function ModalRegistro()
    {
        ?>
            <div class="modal" v-show="modal === true">
                <div class="modal-window-md cont-50 pad-2 bg-gray-100 border-rad-1">
                    <div class="cont-90 mr-auto">
                        <br>
                        <p class="text-14 C-gray">NUEVO EQUIPO</p><br>
                        <div class="cont-100 d-flex-f">
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Nombre del equipo</p>
                                <input type="text" class="input-form cont-95 mr-t-2" v-model='nombre_equipo' placeholder="Nombre del equipo">
                            </div>
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Modelo</p>
                                <input type="text" class="input-form cont-100 mr-t-2" v-model='modelo' placeholder="Modelo">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Sistema Operativo</p>
                                <input type="text" class="input-form cont-95 mr-t-2" v-model="sistema" placeholder="Sistema Operativo">
                            </div>
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Espacio del disco duro</p>
                                <input type="text" class="input-form cont-100 mr-t-2" v-model="espacio" placeholder="Espacio en GB">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Memoria RAM</p>
                                <input type="text" class="input-form cont-95 mr-t-2" v-model="memoria" placeholder="Cantidad de memoria">
                            </div>
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Procesador</p>
                                <input type="text" class="input-form cont-100 mr-t-2" v-model="procesador" placeholder="Procesador">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-100 mr-auto">
                                <p class="text-12">Marca</p>
                                <select  class="input-form cont-100 mr-t-2" v-model="marca">
                                    <option :value="item.id" v-for="(item, index) of marcas" :key="index">{{item.nombre}}</option>
                                </select>
                                <br><br>
                                <button class="button bg-success c-white cont-40 border-rad-1" @click="RegistrarEquipo">Registrar</button>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function ModalOpciones()
    {
        ?>
            <div class="modal" v-show='options === true'>
                <div class="modal-window-sm bg-white cont-20 pad-2 border-rad-1">
                    <p class="text-14 text-center">Menu de opciones</p><br>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="OpenModal3">
                        <p class="text-12 text-center" >Editar equipo</p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="OpenQuestion">
                        <p class="text-12 text-center">Eliminar equipo</p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="OpenModal2">
                        <p class="text-12 text-center" >Asignar Equipo</p>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function ModalEdicion()
    {
        ?>
            <div class="modal" v-show="modal3 === true">
                <div class="modal-window-md cont-50 pad-2 bg-gray-100 border-rad-1">
                    <div class="cont-90 mr-auto">
                        <br>
                        <p class="text-14 C-gray">EDITAR EQUIPO</p><br>
                        <div class="cont-100 d-flex-f">
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Nombre del equipo</p>
                                <input type="text" class="input-form cont-95 mr-t-2" v-model='nombre_equipo' placeholder="Nombre del equipo">
                            </div>
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Modelo</p>
                                <input type="text" class="input-form cont-100 mr-t-2" v-model='modelo' placeholder="Modelo">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Sistema Operativo</p>
                                <input type="text" class="input-form cont-95 mr-t-2" v-model="sistema" placeholder="Sistema Operativo">
                            </div>
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Espacio del disco duro</p>
                                <input type="text" class="input-form cont-100 mr-t-2" v-model="espacio" placeholder="Espacio en GB">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Memoria RAM</p>
                                <input type="text" class="input-form cont-95 mr-t-2" v-model="memoria" placeholder="Cantidad de memoria">
                            </div>
                            <div class="cont-50 mr-auto">
                                <p class="text-12">Procesador</p>
                                <input type="text" class="input-form cont-100 mr-t-2" v-model="procesador" placeholder="Procesador">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-100 mr-auto">
                                <p class="text-12">Marca</p>
                                <select  class="input-form cont-100 mr-t-2" v-model="marca">
                                    <option :value="item.id" v-for="(item, index) of marcas" :key="index">{{item.nombre}}</option>
                                </select>
                                <br><br>
                                <button class="button bg-success c-white cont-40 border-rad-1" @click="ActualizarEquipo">Actualizar</button>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function ModalQuestion()
    {
        ?>
            <div class="modal" v-show="question == true">
                <div class="modal-window-md bg-white cont-25 pad-2">
                    <br>
                    <p class="text-12 text-center">Eliminar equipo</p><br>
                    <div class="cont-100 d-flex-f">
                        <button class="button bg-success mr-auto cont-40 c-white border-rad-1" @click="DeleteEquipo">Eliminar</button>
                        <button class="button bg-gray-100 mr-auto cont-40 border-rad-1" @click="question = false">Cancelar</button>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function ModalAsignar()
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
                                    <button class="button bg-blue c-white cont-80 border-rad-1" @click="Asignar(item.id, item)">Asignar</button>
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
            <div class="modal" v-show=" question2 === true">
                <div class=" modal-window-md bg-white cont-30 pad-2 border-rad-1 text-14 text-center">
                    <p class="pad-2">¿Quieres generar el formato?</p>
                    <div class="cont-100 d-flex-f mr-t-4">
                        <button class="button bg-primary c-white mr-auto" @click="GenDocument">Generar</button>
                        <button class="button bg-gray-100 mr-auto" @click="question2=false">Cancelar</button>
                    </div>
                    <br>
                </div>
            </div>
        <?php
    }

    public static function Formato()
    {
        ?>
            <div class="modal" v-show="archivo === true">
                <div class=" modal-window-md bg-white pad-2 border-rad-1 h-70 scroll-y"><br>
                    <p class="text-14 text-center">Formato de equipos</p><br>
                    <div class="cont-95 mr-auto">
                        <p class="text-12 c-gray">Datos de usuario</p><hr><br>
                        <div class="cont-100 d-flex-f">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Numero de empleado</p>
                                <input type="text" v-model="numero_emp" class="input-form-1" placeholder="Numero">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Nombre de empleado</p>
                                <input type="text" v-model="nombre_emp" class="input-form-1" placeholder="Nombre">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Puesto de empleado</p>
                                <input type="text" v-model="puesto" class="input-form-1" placeholder="Puesto">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Correo de empleado</p>
                                <input type="mail" v-model="correo" class="input-form-1" placeholder="Correo">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Area Perteneciente</p>
                                <input type="text" v-model="area" class="input-form-1" placeholder="Area">
                            </div>
                            <div class="cont-30 mr-auto"></div>
                        </div><br><br>


                        <p class="text-12 c-gray">Datos del equipo</p><hr><br>
                        <div class="cont-100 d-flex-f">
                            <div class="cont-45 mr-auto">
                                <p class="text-10 c-blue">Tipo </p>
                                <select class="input-form-1" v-model="tipo_pc">
                                    <option value="laptop">Laptop</option>
                                    <option value="escritorio">Escritorio</option>
                                </select>
                            </div>
                            <div class="cont-45 mr-auto">
                                <p class="text-10 c-blue">Nombre de equipo</p>
                                <input v-model="nombre_equipo" type="text" class="input-form-1" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-45 mr-auto">
                                <p class="text-10 c-blue">Marca </p>
                                <input type="text" v-model="marca" class="input-form-1" placeholder="Marca">
                            </div>
                            <div class="cont-45 mr-auto">
                                <p class="text-10 c-blue">Modelo</p>
                                <input type="text" v-model="modelo" class="input-form-1" placeholder="Modelo">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-95 mr-auto">
                                <p class="text-10 c-blue">No.Serie</p>
                                <input type="text" v-model="no_serie" class="input-form-1" placeholder="No.Serie">
                            </div>
                        </div><br><br>


                        <p class="text-12 c-gray">Software</p><hr><br>
                        <div class="cont-100 d-flex-f">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Sistema Operativo</p>
                                <input type="text" v-model="sistema" class="input-form-1" placeholder="Sistema Operativo">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Ofimática</p>
                                <input type="text" v-model="ofice" class="input-form-1" placeholder="Ofimática">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Compresor</p>
                                <input type="text" v-model="compresor" class="input-form-1" placeholder="Compresor">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Navegador</p>
                                <input type="text" v-model="navegador" class="input-form-1" placeholder="Navegador">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Antivirus</p>
                                <input type="text" v-model="antivirus" class="input-form-1" placeholder="Antivirus">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Lector PDF</p>
                                <input type="text" v-model="lector_pdf" class="input-form-1" placeholder="Lector PDF">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Siemens NX</p>
                                <select class="input-form-1" v-model="nx">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Mastercam</p>
                                <select class="input-form-1" v-model="master">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Tulip</p>
                                <select class="input-form-1" v-model="tulip">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <br><br>
                        <button class="button bg-blue c-white d-block mr-auto cont-50 border-rad-1" @click="SaveDocument">Generar</button><br>
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