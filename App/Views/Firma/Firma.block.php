<?php

class Firma_Block{
    public static function VistaPrevia1()
    {
        ?>
            <div class="sheet mr-auto mr-t-6 shad-1-gray pad-2">
                <table style='width:100%;' v-if="documento.tipo_doc === 'entrega'">
                    <tr>
                        <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                        <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%'>
                            FORMATO DE ENTREGA DE EQUIPOS Y ACCESORIOS DE COMPUTO
                        </td>
                        <td style=' font-size:12px; width:30%; text-align:center'>
                            Código: <b>0001</b><br>
                            Version: <b>1.0</b>
                        </td>
                    </tr>
                </table>
                <table style='width:100%;' v-if="documento.tipo_doc === 'regreso'">
                    <tr>
                        <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                        <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%'>
                            FORMATO DE REGRESO DE EQUIPOS Y ACCESORIOS DE COMPUTO
                        </td>
                        <td style=' font-size:12px; width:30%; text-align:center'>
                            Código: <b>0001</b><br>
                            Version: <b>1.0</b>
                        </td>
                    </tr>
                </table>
                <table style='width:100%;' v-if="documento.tipo_doc === 'salida'">
                    <tr>
                        <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                        <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%'>
                            FORMATO DE SALIDA DE EQUIPOS
                        </td>
                        <td style=' font-size:12px; width:30%; text-align:center'>
                            Código: <b>0001</b><br>
                            Version: <b>1.0</b>
                        </td>
                    </tr>
                </table>
                <table style='width:100%;'>
                    <tr>
                        <td style='width:96.5%; height:3px; background:rgb(231,231,231);'></td>
                    </tr>
                    <tr>
                        <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Datos del colaborador</td>
                    </tr>
                    
                </table>
                <table style='width:100%;'>
                    <tr>
                        <td class="text-12" style='background:white; width:32%; padding:10px; border:1px solid black; '># Empleado: <b>{{documento.No_Empleado}}</b></td>
                        <td class="text-12" style='background:white; width:32%; padding:10px; border:1px solid black; '>Nombre: <b>{{documento.Nombre}}</b></td>
                        <td class="text-12" style='background:white; width:32%; padding:10px; border:1px solid black; '>Puesto: <b>{{documento.Puesto}}</b></td>
                    </tr>
                    <tr>
                        <td class="text-12" style='background:white; width:32%; padding:10px; border:1px solid black; '>Correo: <b>{{documento.Correo}}</b></td>
                        <td class="text-12" style='background:white; width:32%; padding:10px; border:1px solid black; '>Area: <b>{{documento.Area}}</b></td>
                        <td class="text-12" style='background:white; width:32%; padding:10px; border:1px solid black; '>Fecha: <b>{{documento.Fecha}}</b></td>
                    </tr>
                </table>
                <table style='width:100%;'>
                    <tr>
                        <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Descripción del equipo</td>
                    </tr>
                </table>
                <table style='width:100%;'>
                    <tr>
                        <td class="text-12" style='background:white; width:19%; padding:10px; border:1px solid black; '>Tipo: <b>{{documento.Tipo}}</b></td>
                        <td class="text-12" style='background:white; width:20%; padding:10px; border:1px solid black; '>Nombre: <b>{{documento.Nombre_E}}</b></td>
                        <td class="text-12" style='background:white; width:19%; padding:10px; border:1px solid black; '>Marca: <b>{{documento.Marca}}</b></td>
                        <td class="text-12" style='background:white; width:19%; padding:10px; border:1px solid black; '>Modelo: <b>{{documento.Modelo}}</b></td>
                        <td class="text-12" style='background:white; width:19%; padding:10px; border:1px solid black; '>No. Serie: <b>{{documento.No_Serie}}</b></td>
                    </tr>
                </table>

                <table style='width:100%;'>
                    <tr>
                        <td style='background:white; width:96%; padding:10px; border:1px solid black; '>
                            <table style='width:100%;'>
                                <tr>
                                    <td style='width:50%;'>
                                        <p class="mr-t-2 text-12">Procesador: <b>{{documento.Procesador}}</b></p>
                                        <p class="mr-t-2 text-12">Memoria RAM: <b>{{documento.Memoria}}</b></p>
                                        <p class="mr-t-2 text-12">Espacio en Disco: <b>{{documento.Disco}}</b></p>
                                    </td>
                                    <td style='width:22%;'>
                                        <p class="mr-t-2 text-12">Mouse: <b>{{documento.Mouse}}</b></p>
                                        <p class="mr-t-2 text-12">Teclado: <b>{{documento.Teclado}}</b></p>
                                        <p class="mr-t-2 text-12">Monitor: <b>{{documento.Monitor}}</b></p>
                                    </td>
                                    <td style='width:22%;'>
                                        <p class="mr-t-2 text-12">Cargador: <b>{{documento.Cargador}}</b></p>
                                        <p class="mr-t-2 text-12">Celular: <b>{{documento.Celular}}</b></p>
                                        <p class="mr-t-2 text-12">USB: <b>{{documento.USB}}</b></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table style='width:100%;'>
                    <tr>
                        <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Software</td>
                    </tr>
                </table>
                <table style='width:100%;'>
                    <tr>
                        <td style='background:white; width:96%; padding:10px; border:1px solid black; '>
                            <table style='width:100%;'>
                                <tr>
                                    <td style='width:50%;'>
                                        <p class="mr-t-2 text-12">Sistema Operativo: <b>{{documento.Sistema}}</b></p>
                                        <p class="mr-t-2 text-12">Ofimática: <b>{{documento.Ofice}}</b></p>
                                        <p class="mr-t-2 text-12">Compresor: <b>{{documento.Compresor}}</b></p>
                                    </td>
                                    <td style='width:30%;'>
                                        <p class="mr-t-2 text-12">Navegador: <b>{{documento.Navegador}}</b></p>
                                        <p class="mr-t-2 text-12">Antivirus: <b>{{documento.Antivirus}}</b></p>
                                        <p class="mr-t-2 text-12">Lector PDF: <b>{{documento.Lector_pdf}}</b></p>
                                    </td>
                                    <td style='width:16%;'>
                                        <p class="mr-t-2 text-12">Siemens NX: <b>{{documento.Nx}}</b></p>
                                        <p class="mr-t-2 text-12">MASTERCAM: <b>{{documento.Master}}</b></p>
                                        <p class="mr-t-2 text-12">Tulip: <b>{{documento.Tulip}}</b></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table><br><br><br><br><br>
                <div class=" cont-80 d-flex mr-auto">
                    <div class="content" v-if="documento.tipo_doc === 'entrega' || documento.tipo_doc === 'salida'">
                        <div class="rw">
                            <div class="sup-2-s">
                                <img :src= "`https://internos.busman.com.mx/reportes/App/Resources/Firmas/firma_Alan.png`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien entrega</p>
                            </div><br><br><br><br>
                            <div class=" sup-2-s  mr-auto">
                                <div class="button_firma text-center c-white" @click="OpenModal" v-if="documento.Firma === null || documento.Firma === ''"><br>Agregar Firma</div>
                                <img :src= "`https://internos.busman.com.mx/reportes/${documento.Firma}`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien recibe</p>
                            </div>
                        </div>
                    </div>
                    <div class="content" v-else>
                        <div class="rw">
                            <div class=" sup-2-s  mr-auto">
                                <div class="button_firma text-center c-white" @click="OpenModal" v-if="documento.Firma === null || documento.Firma === ''"><br>Agregar Firma</div>
                                <img :src= "`https://internos.busman.com.mx/reportes/${documento.Firma}`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien entrega</p>
                            </div><br><br><br><br>
                            <div class="sup-2-s">
                                <img :src= "`https://internos.busman.com.mx/reportes/App/Resources/Firmas/firma_Alan.png`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien recibe</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br>
                <table style='width:100%;' v-if="documento.tipo_doc === 'entrega'">
                    <tr>
                        <td style='width:96.5%; background:white; text-align:justify; font-size:10px;'>
                        Al firmar el documento me comprometo a ser responsable por el equipo que se me sera asignado, si se daña  pierde tomare esa responsabilidad
                        y pagare el equipo, evaluando a las condiciones en las que se me entrego.
                        <br><br>
                        Al dejar de laborar en la empresa entregare el equipo que se me otorgo en aquel momento, devolviéndolo en las mismas condiciones en las que
                        se me asigno, si el equipo no cumple con las condiciones en las que se me entrego, tomare mi responsabilidad y pagare por las reparaciones 
                        que se le deban hacer.
                        </td>
                    </tr>
                </table>
                <table style='width:100%;' v-if="documento.tipo_doc === 'salida'">
                    <tr>
                        <td style='width:96.5%; background:white; text-align:justify; font-size:10px;'>
                            Al firmar el documento, asumo plena responsabilidad por el equipo proporcionado. 
                            Me comprometo a cuidarlo adecuadamente y a devolverlo en las mismas condiciones en las que fue entregado.
                            En caso de perdida, daño o no retorno del equipo, acepto pagar el costo total del reemplazo o reparación según corresponda.
                            Esta responsabilidad se mantiene durante el periodo en que tenga posesión de el.
                        </td>
                    </tr>
                </table>
            </div>
        <?php
    }

    public static function VistaPrevia2()
    {
        ?>
            <div class="sheet mr-auto mr-t-6 shad-1-gray pad-2">
                <table style='width:100%;'>
                    <tr>
                        <td style='color:rgb(0,92,192); font-weight:bold; font-size:30px; text-align:center; width:30%;'>BUSMAN</td>
                        <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%' v-if="documento.tipo_doc === 'accesorio_in'">
                            FORMATO DE ENTREGA DE  ACCESORIOS DE COMPUTO
                        </td>
                        <td style='color:black; font-weight:bold; font-size:16px; text-align:center; width:40%' v-else>
                            FORMATO DE REGRESO DE  ACCESORIOS DE COMPUTO
                        </td>
                        <td style=' font-size:12px; width:30%; text-align:center'>
                            Código: <b>0001</b><br>
                            Version: <b>1.0</b>
                        </td>
                    </tr>
                </table>
                <br>
                <table style='width:100%;'>
                    <tr>
                        <td style='width:96.5%; background:rgb(231,231,231);'></td>
                    </tr>
                    <tr>
                        <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Datos del colaborador</td>
                    </tr>
                    
                </table><br><br>
                <table style='width:100%;' class="text-12">
                    <tr>
                        <td class="tetx-12" style='background:white; width:32%; padding:10px; border:1px solid black; '># Empleado: <b>{{documento.No_Empleado}}</b></td>
                        <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Nombre: <b>{{documento.Nombre}}</b></td>
                        <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Puesto: <b>{{documento.Puesto}}</b></td>
                    </tr>
                    <tr>
                        <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Correo: <b>{{documento.Correo}}</b></td>
                        <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Area: <b>{{documento.Area}}</b></td>
                        <td style='background:white; width:32%; padding:10px; border:1px solid black; '>Fecha: <b>{{documento.Fecha}}</b></td>
                    </tr>
                </table>
                <br><br>
                <table style='width:100%;'>
                    <tr>
                        <td style='width:96.5%; background:white; padding:10px; text-align:center;'>Descripción del equipo</td>
                    </tr>
                </table>
                <br><br>
                <table style='width:100%;' class="text-12">
                    <tr>
                        <td style='background:white; width:48%; padding:10px; border:1px solid black; '>Nombre: <b>{{documento.Nombre_E}}</b></td>
                        <td style='background:white; width:48%; padding:10px; border:1px solid black; '>Descripción: <b>{{documento.Sistema}}</b></td>
                    </tr>
                    <tr>
                        <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Tipo: <b>{{documento.Tipo}}</b></td>
                        <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Marca: <b>{{documento.Marca}}</b></td>
                    </tr>
                    <tr>
                        <td style='background:white; width:19%; padding:10px; border:1px solid black; '>Modelo: <b>{{documento.Modelo}}</b></td>
                        <td style='background:white; width:19%; padding:10px; border:1px solid black; '>No. Serie: <b>{{documento.No_Serie}}</b></td>
                    </tr>
                </table><br><br><br><br><br>
                <div class=" cont-80 d-flex mr-auto">
                    <div class="content" v-if="documento.tipo_doc === 'accesorio_in'">
                        <div class="rw">
                            <div class="sup-2-s">
                                <img :src= "`https://internos.busman.com.mx/reportes/App/Resources/Firmas/firma_Alan.png`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien entrega</p>
                            </div><br><br><br><br>
                            <div class=" sup-2-s  mr-auto">
                                <div class="button_firma text-center c-white" @click="OpenModal" v-if="documento.Firma === null || documento.Firma === ''"><br>Agregar Firma</div>
                                <img :src= "`https://internos.busman.com.mx/reportes/${documento.Firma}`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien recibe</p>
                            </div>
                        </div>
                    </div>
                    <div class="content" v-else>
                        <div class="rw">
                            <div class="sup-2-s">
                            <div class="button_firma text-center c-white" @click="OpenModal" v-if="documento.Firma === null || documento.Firma === ''"><br>Agregar Firma</div>
                                <img :src= "`https://internos.busman.com.mx/reportes/${documento.Firma}`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien entrega</p>
                            </div><br><br><br><br>
                            <div class=" sup-2-s  mr-auto">
                                <img :src= "`https://internos.busman.com.mx/reportes/App/Resources/Firmas/firma_Alan.png`"   alt="" class="firma_image" v-else>
                                <p style='text-align:center;'>__________________________________</p>
                                <p style='text-align:center;'>Firma de quien recibe</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br>
                <table style='width:100%;'>
                    <tr>
                        <td style='width:96.5%; background:white; text-align:justify; font-size:10px;' v-if="documento.tipo_doc === 'accesorio_in'">
                        Al firmar el documento me comprometo a ser responsable por el equipo que se me sera asignado, si se daña  pierde tomare esa responsabilidad
                        y pagare el equipo, evaluando a las condiciones en las que se me entrego.
                        <br><br>
                        Al dejar de laborar en la empresa entregare el equipo que se me otorgo en aquel momento, devolviéndolo en las mismas condiciones en las que
                        se me asigno, si el equipo no cumple con las condiciones en las que se me entrego, tomare mi responsabilidad y pagare por las reparaciones 
                        que se le deban hacer.
                        </td>
                    </tr>
                </table>
            </div>
        <?php
    }

    public static function Modal()
    {
        ?>
            <div class="modal" v-show='modal === true'>
                <div class="header-options ">
                    <div class="cont-100 d-flex-f">
                        <div class="cont-50 mr-auto">
                            <button class="button_back hov-1" title="Volver"  @click="CloseModal"><i class="fa-solid fa-arrow-left c-white cursor-pointer hov-1" ></i></button>
                        </div>
                        <div class="cont-50 mr-auto">
                            <button class="button_success hov-1" title="firmar" @click="GuardarBtn"><i class="fa-solid fa-check c-white"></i></button>
                        </div>
                    </div>
                </div>
                <div class="shad-1-gray  mr-auto  firma_container">
                    <canvas id="signatureCanvas" width="800" height="400" class="canvas_firma"></canvas>
                </div>
                <div class="footer-options">
                    <div class="cont-10 d-flex-f float-end">
                        <button class="btn_blue c-white" @click="LimpiarFirma()" title="Limpiar firma"><i class="fa-solid fa-broom"></i></button>
                    </div>
                    <div class="cont-10 d-flex-f">
                        <button class="btn_blue" @click="ChangeColor('blue')"></button>
                        <button class="btn_black" @click="ChangeColor('black')"></button>
                    </div>
                    
                </div>
            </div>
        <?php
    }

    public static function Print()
    {
        ?>
        <div class="button_print hov-1" title="Imprimir documento" @click="OpenPrint">
            <i class="fa-solid fa-print"></i>
        </div>
        <?php
    }
}