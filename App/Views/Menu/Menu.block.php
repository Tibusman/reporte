<?php


class MenuBlock
{
    public static function block1()
    {
        ?>
        <div class="select-area">
            <div class=" cont-100 d-flex-f mr-t-10">
                <div class="card bor-blue">
                    <p class="c-gray text-12">Cantidad de usuarios</p>
                    <hr>
                    <p class="text-30">{{user_cant}}</p>
                </div>
                <div class="card bor-or">
                    <p class="c-gray text-12">Cantidad de reportes</p>
                    <hr>
                    <p class="text-30">{{rep_cant}}</p>
                </div>
                <div class="card bor-red">
                    <p class="c-gray text-12">Cantidad de mantenimientos</p>
                    <hr>
                    <p class="text-30">{{mant_cant}}</p>
                </div>
                <div class="card bor-gr">
                    <p class="c-gray text-12">Cantidad de respaldos</p>
                    <hr>
                    <p class="text-30">{{resp_cant}}</p>
                </div>
            </div>
        </div>
        <?php
    }

    public static function Tables()
    {
        ?>
            <div class="cont-100 d-flex-f mr-t-10">
                <?php
                    self::Table1();
                    self::Table2();
                ?>
            </div>
        <?php
    }

    public static function Table1()
    {
        Rols::Check(["SuperUser"], function(){
            ?>
                <div class="cont-50 mr-auto">
                    <p class="text-12 c-gray mr-l-4">Tabla Usuarios</p><br>
                    <div class="cont-95 mr-auto pad-2 bg-white shad-1-gray d-flex-f">
                        <div class="cont-15 text-center text-12">Imagen</div>
                        <div class="cont-20 text-center text-12">Nombre</div>
                        <div class="cont-20 text-center text-12">Apellido</div>
                        <div class="cont-30 text-center text-12">Correo</div>
                    </div>
                    <div class="cont-95 h-45 scroll-y mr-auto">
                        <div class="cont-100 mr-auto mr-t-2 pad-2 bg-white shad-1-gray d-flex-f" v-for="(item, index) of users" :key="index">
                            <div class="cont-15 text-center text-12"><img :src="item.Img" alt="" class="minimg"></div>
                            <div class="cont-20 text-center text-12">{{item.Nombre}}</div>
                            <div class="cont-20 text-center text-12">{{item.Apellidos}}</div>
                            <div class="cont-30 text-center text-12">{{item.Correo}}</div>
                        </div>
                    </div>
                    <div class="cont-100 mr-t-4">
                        <button class="button-list hov-1" @click="CargarUsuarios('-')"><</button>
                        <button class="button-list2 hov-1" @click="CargarUsuarios('+')">></button>
                    </div>
                </div>
            
            <?php
        });
    }

    public static function Table2()
    {
        ?>
            <div class="cont-50 mr-auto">
                <p class="text-12 c-gray mr-l-4">Tabla respaldos</p><br>
                <div class="cont-95 mr-auto pad-2 bg-white shad-1-gray d-flex-f">
                    <div class="cont-15 text-center text-12">Semana</div>
                    <div class="cont-25 text-center text-12">Almacenamiento</div>
                    <div class="cont-40 text-center text-12">Comentarios</div>
                    <div class="cont-15 text-center text-12">Fecha</div>
                </div>
                <div class="cont-95 h-45 scroll-y mr-auto">
                    <div class="cont-100 mr-auto mr-t-2 pad-2 bg-white shad-1-gray d-flex-f" v-for="(item, index) of backs" :key="index">
                        <div class="cont-15 text-center text-12">{{item.Semana}}</div>
                        <div class="cont-25 text-center text-12">{{item.Almacenamiento}} GB</div>
                        <div class="cont-40 text-center text-12">{{item.Comentarios}}</div>
                        <div class="cont-15 text-center text-12">{{item.Fecha}}</div>
                    </div>
                </div>
                <div class="cont-100 mr-t-4">
                    <button class="button-list hov-1" @click="LoadBackup('-')"><</button>
                    <button class="button-list2 hov-1" @click="LoadBackup('+')">></button>
                </div>
            </div>
        <?php
    }
}