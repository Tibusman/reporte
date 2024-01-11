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
                        <img src="<?php Icon('eye.png')?>" alt="" class="mr-l-4 cursor-pointer hov-1" title="Ver no asignados" @click="Loadunsigned('-')">
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
                                    <button class="button bg-blue c-white cont-80 border-rad-1" @click="Asignar(item.id)">Asignar</button>
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
}

?>