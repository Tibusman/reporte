<?php



class Mantenimiento_Block
{
    public static function Block1()
    {
        ?>
            <div class="mr-auto cont-100 d-flex-f mr-t-8">
                <div class="cont-50 mr-auto  float-left">
                    <p class="text-14">Buscar por fecha</p>
                    <input type="date" class="input-form bg-white" v-model="fecha_filter" @change="LoadMantenimientos('-')">
                </div>
                <div class="cont-50 mr-auto">
                    <?php
                        Rols::Check(["Admin", "SuperUser"], function(){
                            ?>
                                <button class="button cont-50 bg-success c-white border-rad-1 float-end" @click="Programar()">Programar mantenimiento</button>
                            <?php
                        });
                    ?>
                </div>
            </div>
        <?php
    }

    public static function table()
    {
        ?>
            <div class="cont-100 d-flex-f bg-white pad-2 shad-1-gray mr-t-4">
                
                <div class="cont-50">
                    <p class="text-14 ">Nombre</p>
                </div>
                <div class="cont-20">
                    <p class="text-14 text-center">Fecha</p>
                </div>
                <div class="cont-20">
                    <p class="text-14 text-center">Estatus</p>
                </div>
                <div class="cont-20">
                    <p class="text-14 text-center">Acción</p>
                </div>
            </div>
            <div class="cont-100 mr-t-2 h-50 scroll-y">
                <div class="cont-100 d-flex-f bg-white pad-2 shad-1-gray mr-t-4" v-for="(item, index) of mantenimientos">
                    
                    <div class="cont-50">
                        <p class="text-14 ">{{ item.nombre }}</p>
                    </div>
                    <div class="cont-20">
                        <p class="text-14 text-center">{{ item.fecha_exp }}</p>
                    </div>
                    <div class="cont-20">
                        <p class="text-14 text-center status c-white"
                        :class="{bg_success:item.estado === 'Completo', bg_danger:item.estado === 'Pendiente', bg_warning:item.estado === 'Proceso'}">{{ item.estado }}</p>
                    </div>
                    <div class="cont-20">
                        <img src="<?php Icon("option.png");?>" alt="" class="d-block mr-auto cursor-pointer hov-1" @click="OpenOptions(item.id, item.id_user, item.estado)">
                    </div>
                </div>
            </div><br>
            <div class="cont-100">
                <button class="button-list1 hov-1" title="anterior" @click="LoadMantenimientos('-')"><</button>
                <button class="button-list2 hov-1" title="siguiente" @click="LoadMantenimientos('+')">></button>
            </div>
        <?php
    }

    public static function ModalOptions()
    {
        ?>
            <div class="modal" v-show="modal === true">
                <div class=" modal-window-sm bg-white border-rad-1 cont-25">
                    <p class="text-center text-14 pad-2">MENU DE OPCIONES</p><br>
                    <div class="option" @click="LoadhistorialMante">
                        <p>Ver mantenimiento</p>
                    </div>
                    
                    <?php
                        Rols::Check(["SuperUser"], function(){
                            ?>
                                <div class="option" @click="Actualizar()" v-show="iscomplete === false">
                                    <p>Actualizar Mantenimiento</p>
                                </div>
                            <?php
                        });
                    ?>
                    <br>
                </div>
            </div>
        <?php
    }

    public static function ModalCreate()
    {
        ?>
            <div class="modal" v-show="modal2 === true">
                <div class=" modal-window-md bg-white pad-2 border-rad-1"><br>
                    <div class="cont-95 mr-auto">
                        <p class="text-14">PROGRAMAR MANTENIMIENTO</p>
                        <p class="text-10 c-gray">Para programar un mantenimiento, selecciona un equipo, nombra el mantenimiento y escoge una fecha para realizarlo.</p>
                    </div>
                    <br>
                    <div class="cont-100" v-if="indice === ''">
                        <div class="cont-95 mr-auto">
                            <input type="search" class="input-form cont-45" placeholder="Buscar por correo" v-model="search" @keyup="LoadEquipos('-')"><br>
                        </div><br>
                        <div class="h-20 cont-95 mr-auto scroll-y">
                            <div class="cont-100 d-flex-f pad-2 shad-1-gray" v-for="(item,index) of equipos" :key="index">
                                <div class="cont-10 mr-auto text-14">{{ index + 1 }}</div>
                                <div class="cont-10 mr-auto"><img :src="item.logo" alt="" class="icon"></div>
                                <div class="cont-20 mr-auto"><p class="text-12">{{ item.nombre }} {{ item.modelo }}</p></div>
                                <div class="cont-35 mr-auto"><p class="text-12">{{ item.mail }}</p></div>
                                <div class="cont-20 mr-auto"><button class="button bg-blue c-white cont-90 border-rad-1" @click="Elegir(item.id, index)">Elegir</button></div>
                            </div>
                        </div>
                        <div class="cont-95 mr-auto">
                            <button class="button-list1 hov-1" title="anterior" @click="LoadEquipos('-')"><</button>
                            <button class="button-list2 hov-1" title="siguiente" @click="LoadEquipos('+')">></button>
                        </div><br><br><br>
                    </div>
                    <div class=" cont-95 mr-auto mr-t-6" v-else>
                        <p class="text-14 c-gray">Equipo seleccionado</p>
                        <div class="cont-100 d-flex-f pad-2 shad-1-gray">
                            <div class="cont-10 mr-auto text-14">{{ indice + 1 }}</div>
                            <div class="cont-10 mr-auto"><img :src="equipos[indice].logo" alt="" class="icon"></div>
                            <div class="cont-20 mr-auto"><p class="text-12">{{ equipos[indice].nombre }} {{ equipos[indice].modelo }}</p></div>
                            <div class="cont-35 mr-auto"><p class="text-12">{{ equipos[indice].mail }}</p></div>
                            <div class="cont-20 mr-auto"><button class="button bg-blue c-white cont-90 border-rad-1" @click="Cambiar">Cambiar</button></div>
                        </div>
                        <br><br>
                    </div>
                    <div class=" cont-95 mr-auto">
                        <p class="c-gray text-10">Nombre del mantenimiento</p>
                        <input type="text" class="input-form" placeholder="Nombre del mantenimiento" v-model="nombre"><br><br>
                        <p class="c-gray text-10">Fecha del mantenimiento</p>
                        <input type="date" class="input-form" placeholder="Nombre del mantenimiento" v-model="fecha">
                        <br><br>
                        <button class="button bg-success c-white border-rad-1" @click="ProgramarMantenimiento">Programar</button>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function ModalUpdate()
    {
        ?>
            <div class="modal" v-show="modal3 === true">
                <div class="modal-window-md bg-white pad-2 border-rad-1">
                    <br>    
                        <p class="text-14 text-center">Agrega una actualización</p><br>
                        <div class="cont-95 mr-auto">
                            <textarea class="input-form cont-100" cols="30" v-model="solucion" rows="10" placeholder="Describe la solucion al mantenimiento"></textarea>
                            <br><br>
                            <div class="cont-100">
                                <button class="button bg-success c-white border-rad-1" @click="UpdateMante('Proceso')">Actualizar</button>
                                <button class="button bg-danger c-white float-end border-rad-1" @click="UpdateMante('Completo')">Finalizar</button>
                            </div>
                        </div>
                    <br>
                </div>
            </div>
        <?php
    } 

    public static function ModalHistorial()
    {
        ?>
            <div class="modal" v-show="modal4 === true">
                <div class=" modal-window-md bg-white pad-2 border-rad-1 cont-40">
                    <div class="cont-95 mr-auto">
                        <p class="text-12 c-gray">Historial de cambios en el mantenimiento</p>
                        <br>
                        <div class="cont-100 h-50 scroll-y">
                            <div class="cont-100 mr-t-4 bg-gray-100 pad-2 d-flex-f shad-1-gray border-rad-1" v-for="(item, index) of historial" :key = "index">
                                <div class="cont-65 mr-auto">
                                    <p class="text-14">{{ item.Description }}</p>
                                </div>
                                <div class="cont-35 mr-auto">
                                    <p class="text-14">{{ item.fecha }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

}

?>