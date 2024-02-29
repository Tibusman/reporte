<?php


class Archivo_Block
{
    public static function Bloque1()
    {
        ?>
            <div class="cont-100 d-flex-f">
                <div class="cont-50 mr-auto">
                    <input type="search" placeholder="Buscar por nombre" class="input-form" v-model="search" @keyup="GetAll">
                </div>
                <div class="cont-50 mr-auto">
                    <button class="float-end button bg-blue c-white border-rad-1 cont-60" @click="modalformat = true">Nuevo archivo</button>
                </div>
            </div>
        <?php
    }

    public static function Tabla()
    {
        ?>
            <div class="cont-100 bg-white mr-t-10 d-flex-f pad-2 text-14 shad-1-gray">
                <div class="cont-20 mr-auto">Nombre de equipo</div>
                <div class="cont-20 mr-auto">Nombre</div>
                <div class="cont-20 mr-auto">Puesto</div>
                <div class="cont-20 mr-auto">Fecha</div>
                <div class="cont-15 mr-auto">Tipo de documento</div>
                <div class="cont-5 mr-auto"></div>
            </div>
            <div class="cont-100 h-65 scroll-y">
                <div class="cont-100 bg-white mr-t-4 d-flex-f pad-2 text-14 shad-1-gray" v-for="(item, index) of archivos" :key="index">
                    <div class="cont-20 mr-auto">{{item.Nombre_E}}</div>
                    <div class="cont-20 mr-auto">{{item.Nombre}}</div>
                    <div class="cont-20 mr-auto">{{item.Puesto}}</div>
                    <div class="cont-20 mr-auto">{{item.Fecha}}</div>
                    <div class="cont-15 mr-auto">{{item.tipo_doc}}</div>
                    <div class="cont-5 mr-auto"><img src="<?php Icon('option.png'); ?>" class="hov-1 cursor-pointer" @click="OpenOpciones(item.id, item.tipo_doc, index, item.Firma)"></div>
                </div>
            </div>
        <?php
    }

    public static function Formulario()
    {
        ?>
        <div class="modal" v-show="formato === true">
            <div class=" modal-window-md bg-white pad-2 cont-65 border-rad-1 h-70 scroll-y"><br>
                    <p class="text-14 text-center">Formato de equipos</p><br>
                    <div class="cont-95 mr-auto ">
                        <p class="text-12 c-gray">Datos de usuario</p>
                        <hr><br>
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
                            <div class="cont-30 mr-auto">
                                <button class="button cont-95 border-rad-1 d-block mr-auto bg-blue c-white" @click="modaluser = true">seleccionar usuario</button>
                            </div>
                        </div><br><br>


                        <p class="text-12 c-gray">Datos del equipo</p>
                        <hr><br>
                        <div class="cont-100 d-flex-f">
                            <div class="cont-45 mr-auto">
                                <p class="text-10 c-blue">Tipo </p>
                                <select class="input-form-1" v-model="tipo_pc">
                                    <option value="Laptop">Laptop</option>
                                    <option value="Escritorio">Escritorio</option>
                                </select>
                            </div>
                            <div class="cont-45 mr-auto">
                                <p class="text-10 c-blue">Nombre de equipo</p>
                                <input v-model="nombre_equipo" type="text" class="input-form-1" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Marca </p>
                                <input type="text" v-model="marca" class="input-form-1" placeholder="Marca">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Modelo</p>
                                <input type="text" v-model="modelo" class="input-form-1" placeholder="Modelo">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">No.Serie</p>
                                <input type="text" v-model="no_serie" class="input-form-1" placeholder="No.Serie">
                            </div>
                        </div>

                        <div class="cont-100 d-flex-f mr-t-6">
                            
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Procesador</p>
                                <input type="text" v-model="procesador" class="input-form-1" placeholder="Procesador">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Almacenamiento</p>
                                <input type="text" v-model="espacio" class="input-form-1" placeholder="Almacenamiento">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Memoria RAM</p>
                                <input type="text" v-model="memoria" class="input-form-1" placeholder="Memoria RAM">
                            </div>
                        </div>
                        <br><br>


                        <p class="text-12 c-gray">Software</p>
                        <hr><br>
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
                        <p class="text-12 c-gray">Accesorios</p>
                        <hr><br>

                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Mouse</p>
                                <select class="input-form-1" v-model="mouse">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Teclado</p>
                                <select class="input-form-1" v-model="teclado">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Monitor</p>
                                <select class="input-form-1" v-model="monitor">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Cargador</p>
                                <select class="input-form-1" v-model="cargador">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Celular</p>
                                <select class="input-form-1" v-model="celular">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">USB</p>
                                <select class="input-form-1" v-model="usb">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <p class="text-10 c-blue">Tipo de documento</p>
                            <select class="input-form-1" v-model="tipo_formato">
                                <option value="entrega">Formato de entrega</option>
                                <option value="regreso">Formato de regreso</option>
                                <option value="salida">Formato de Salida</option>
                            </select>
                        </div>
                        <br><br>
                        <button class="button bg-blue c-white d-block mr-auto cont-50 border-rad-1" @click="SaveDocument" v-if="edit === false">Generar</button>
                        <button class="button bg-blue c-white d-block mr-auto cont-50 border-rad-1" @click="EditarDocumento" v-else>Editar</button>
                        <br>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function Opciones()
    {
        ?>
            <div class="modal" v-show="opciones === true">
                <div class=" modal-window-md bg-white cont-20 border-rad-1 pad-2">
                    <p class="text-14 text-center">Menu de opciones</p><br>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="OpenEdit">
                        <p class="text-12 text-center" >Editar </p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="DeleteDocument">
                        <p class="text-12 text-center" >Eliminar </p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="Duplicar">
                        <p class="text-12 text-center" >Duplicar</p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="OpenDocument">
                        <p class="text-12 text-center" >Imprimir</p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="SendFirma" v-if="firma === '' || firma === null">
                        <p class="text-12 text-center" >Petición de Firma</p>
                    </div>
                    <br>
                </div>
            </div>
        <?php
    }

    public static function User()
    {
        ?>
            <div class="modal" v-show='modaluser === true'>
                <div class=" modal-window-md bg-white cont-50 border-rad-1">
                    <p class="float-end text-14 hov-1 cursor-pointer mr-r-4 mr-t-2" title="Cerrar" @click="modaluser = false">X</p>
                    <div class="cont-95 mr-auto">
                        <p class="text-14 pad-2">Seleccionar usuario</p><br>
                        <div class="cont-100 h-40 scroll-y mr-t-2 border-1-black" >
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
                                    <button class="button bg-blue c-white cont-80 border-rad-1" @click="SelectUser(index)">Seleccionar</button>
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

    public static function Choice()
    {
        ?>
            <div class="modal" v-show="modalformat === true">
                <div class="modal-window-md bg-white cont-45 pad-2 border-rad-1"><br>
                    <p class="text-14 text-center">Selecciona un formato</p><br>
                    <div class="cont-100 d-flex" >
                        <div class="format-card border-rad-2 hov-1" @click="OpenFormat1">
                            <br>
                            Formato entrega y regreso
                            <br><br>
                        </div>
                        <div class="format-card border-rad-2 hov-1" @click="OpenFormat2">
                            <br>
                            Formato Accesorio
                            <br><br>
                        </div>
                        <div class="format-card border-rad-2 hov-1" @click="OpenFormat1">
                            <br>
                            Formato salida equipo
                            <br><br>
                        </div>
                    </div><br>
                </div>
            </div>
        <?php
    }

    public static function formato2()
    {
        ?>
            <div class="modal" v-show="formato2 === true">
                <div class=" modal-window-md bg-white pad-2 cont-65 border-rad-1 h-70 scroll-y"><br>
                    <p class="text-14 text-center">Formato de equipos</p><br>
                    <div class="cont-95 mr-auto ">
                        <p class="text-12 c-gray">Datos de usuario</p>
                        <hr><br>
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
                            <div class="cont-30 mr-auto">
                                <button class="button cont-95 border-rad-1 d-block mr-auto bg-blue c-white" @click="modaluser = true">seleccionar usuario</button>
                            </div>
                        </div><br><br>

                        <br><br>
                        <p class="text-12 c-gray">Equipo</p>
                        <hr><br>
                        <div class="cont-100 d-flex-f">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Nombre del equipo</p>
                                <input type="text" v-model="nombre_equipo" class="input-form-1" placeholder="Nombre del equipo">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Descripción del equipo</p>
                                <input type="text" v-model="sistema" class="input-form-1" placeholder="Descripción del equipo">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">No. serie</p>
                                <input type="text" v-model="no_serie" class="input-form-1" placeholder="No. serie">
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Marca</p>
                                <input type="mail" v-model="marca" class="input-form-1" placeholder="Marca">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Modelo</p>
                                <input type="text" v-model="modelo" class="input-form-1" placeholder="Modelo">
                            </div>
                            <div class="cont-30 mr-auto">
                                <p class="text-10 c-blue">Tipo de equipo</p>
                                <select class="input-form-1" v-model="tipo_pc">
                                    <option value="Celular">Celular</option>
                                    <option value="Cámara">Cámara</option>
                                    <option value="Monitor">Monitor</option>
                                    <option value="Disco Duro">Disco Duro</option>
                                    <option value="Memoria USB">Memoria USB</option>
                                    <option value="Teclado">Teclado</option>
                                    <option value="Mouse">Mouse</option>
                                    <option value="Cargador">Cargador</option>
                                </select>
                            </div>
                        </div>
                        <div class="cont-100 d-flex-f mr-t-6">
                            <div class="cont-95 mr-auto">
                            <p class="text-10 c-blue">Tipo de formato</p>
                                <select class="input-form-1" v-model="tipo_formato">
                                    <option value="accesorio_in">Entrega de accesorio</option>
                                    <option value="accesorio_out">Regreso de accesorio</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <br><br>
                        <button class="button bg-blue c-white d-block mr-auto cont-50 border-rad-1" @click="SaveDocument2" v-if="edit === false">Generar</button>
                        <button class="button bg-blue c-white d-block mr-auto cont-50 border-rad-1" @click="EditarDocumento2" v-else>Editar</button>
                        <br>
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