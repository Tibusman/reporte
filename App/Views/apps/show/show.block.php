<?php

class App_Block
{
    public static function OptionsApps()
    {
        ?>
            <div class="cont-100 d-flex-f">
                <div class="cont-50 mr-auto">
                    <p class="text-20">Administra Apps</p>
                    <p class="text-12">Registra y administra todas las aplicaciones desarrolladas de la empresa</p>
                </div>
                <div class="cont-50 mr-auto">
                    <button class="float-end button bg-success border-rad-1 c-white" @click="OpenCreate">Agregar App</button>
                </div>
            </div>
        <?php
    }

    public static function LoadApps()
    {
        ?>
            <div class="apps-container d-flex">
                <div class="app-card" v-for="(item, index) in apps"><br>
                    <img :src="item.icon" alt="" class="app-icon"><br>
                    <p class="text-center text-14 c-gray">{{item.app_name}}</p><br>
                    <div class="cont-80 mr-auto h-10">
                        <p class="text-12 text-justify">
                            {{item.Descripcion}} 
                        </p>
                    </div>
                    <div class="cont-80 mr-auto mr-t-6">
                        <a :href="item.url" class="c-black">
                            <div class="float-left hov-1">
                                <i class="fa-solid fa-arrow-up-right-from-square" title="Abrir App"></i>
                            </div>
                        </a>
                        <a :href= `edit/${item.id}` class="c-gray">
                            <div class="float-end hov-1">
                                <i class="fa-solid fa-table-columns" title="Administrar App"></i>
                            </div>
                        </a>
                    </div>
                    <br>
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