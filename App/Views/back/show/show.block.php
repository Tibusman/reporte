<?php

class Backup_Block
{
    public static function header()
    {
        ?>
            <div class="cont-100 mr-auto mr-t-4">
            <?php
                Rols::Check(["SuperUser"], function(){
                    ?>
                        <button class="button bg-success c-white cont-35 float-end border-rad-1" @click="OpenModal">Nuevo respaldo</button>
                    <?php
                });
            ?>
                <div class="cont-50">
                    <input type="date" class="input-form shad-1-gray" v-model="fechafilter" @change="LoadBackup('')">
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
                <button class="button-list1" @click="LoadBackup('-')"><</button>
                <button class="button-list2" @click="LoadBackup('+')">></button>
            </div>
        <?php
    }

    public static function ModalCreate()
    {
        ?>
            <div class="modal" v-show="modal === true">
                <br>
                <div class=" modal-window-cover bg-white pad-2 border-rad-1 cont-75"><br>
                    <div class="cont-85 mr-auto d-flex-f">
                        <div class="cont-60 mr-auto"></div>
                        <div class="cont-40 mr-auto d-flex-f">
                            <button class="button mr-auto d-block bg-success c-white cont-45 border-rad-1" @click="CrearBackup">Registrar</button>
                            <button class="button mr-auto d-block bg-gray-200 cont-45 border-rad-1" @click="modal = false">Cancelar</button>
                        </div>
                    </div><br>
                    <div class="cont-95 mr-auto">
                        <br>
                        <form>
                            <div class="cont-100 d-flex-f">
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">Tooling</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="tooling">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">PI</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="pi">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">Finanzas</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="finanzas">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">Facturación</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="facturacion">
                                </div>
                            </div>

                            <div class="cont-100 d-flex-f mr-t-8">
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">Finanzas PI</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="finanzaspi">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">Facturación PI</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="facturacionpi">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">RH</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="rh">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">Compras</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="compras">
                                </div>
                            </div>

                            <div class="cont-100 d-flex-f mr-t-8">
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">Calidad</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="calidad">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">SGC</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="sgc">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">TI</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="ti">
                                </div>
                                <div class="cont-25 mr-auto">
                                    <p class="text-12">I4.0</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="i4_0">
                                </div>
                            </div>

                            <div class="cont-100 d-flex-f mr-t-8">
                                
                                <div class="cont-50 mr-auto">
                                    <p class="text-12">Cantidad total en GB</p>
                                    <input type="text" class="input-form bg-gray-100" placeholder="0" v-model="total">
                                </div>
                                <div class="cont-50 mr-auto">
                                    <p class="text-12">Comentarios</p>
                                    <textarea  class="input-form bg-gray-100 cont-90" cols="30" rows="2" v-model="comentarios"></textarea>
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        <?php
    }

    public static function ModalOptions()
    {
        ?>
            <div class="modal" v-show="modal2 === true">
                <div class=" modal-window-sm border-rad-1 cont-25 bg-white pad-2"><br>
                    <p class="text-14 text-center">Menu de opciones</p><br>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="Firmar">
                        <p class="text-12 text-center">Firmar</p>
                    </div>
                    <div class="cont-95 mr-t-2 mr-auto bg-gray-100 border-rad-1 cursor-pointer hov-1 pad-2" @click="LoadRespaldo">
                        <p class="text-12 text-center">visualizar</p>
                    </div>
                    <br>
                </div>
            </div>
        <?php
    }

    public static function ModalVisual()
    {
        ?>
        <div class="modal" v-show="modal3 === true">
            <div class="modal-window-md pad-2 bg-white border-rad-1">
                <br>
                <div class="cont-95 mr-auto text-12">
                    <p class="text-14 c-gray">Visualizar datos del respaldo</p><br>
                    <div class="cont-100 d-flex-f">
                        <div class="cont-25 mr-auto">
                            <p class="text-12">Tooling</p>
                            <div class="input-form bg-gray-100">{{ respaldo.Manufactura }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">PI</p>
                            <div class="input-form bg-gray-100">{{ respaldo.PI }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">Finanzas</p>
                            <div class="input-form bg-gray-100">{{ respaldo.Finanzas }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">Facturación</p>
                            <div class="input-form bg-gray-100">{{ respaldo.Facturacion }}</div>
                        </div>
                    </div>

                    <div class="cont-100 d-flex-f mr-t-8">
                        <div class="cont-25 mr-auto">
                            <p class="text-12">Finanzas PI</p>
                            <div class="input-form bg-gray-100">{{ respaldo.FinanzasPI }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">Facturación PI</p>
                            <div class="input-form bg-gray-100">{{ respaldo.FacturacionPI }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">RH</p>
                            <div class="input-form bg-gray-100">{{ respaldo.RH }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">Compras</p>
                            <div class="input-form bg-gray-100">{{ respaldo.Compras }}</div>
                        </div>
                    </div>

                    <div class="cont-100 d-flex-f mr-t-8">
                        <div class="cont-25 mr-auto">
                            <p class="text-12">Calidad</p>
                            <div class="input-form bg-gray-100">{{ respaldo.Calidad }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">SGC</p>
                            <div class="input-form bg-gray-100">{{ respaldo.SGC }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">TI</p>
                            <div class="input-form bg-gray-100">{{ respaldo.TI }}</div>
                        </div>
                        <div class="cont-25 mr-auto">
                            <p class="text-12">I4.0</p>
                            <div class="input-form bg-gray-100">{{ respaldo.I4_0 }}</div>
                        </div>
                    </div>

                    <div class="cont-100 d-flex-f mr-t-8">
                                
                        <div class="cont-50 mr-auto">
                            <p class="text-12">Cantidad total en GB</p>
                            <div class="input-form bg-gray-100">{{ respaldo.Almacenamiento }}</div>
                        </div>
                        <div class="cont-50 mr-auto">
                            <p class="text-12">Comentarios</p>
                            <div class="input-form bg-gray-100 cont-90">{{ respaldo.Comentarios }}</div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <?php
    }
}

?>