<?php

import("HTMLMAIL");

class Mail{
    
    public static function SendMail($button_name,$title, $message, $url,  $mailto)
    {
        $renderhtml = HTMLMAIL::AddBlock(function(){
    
            $html = HTMLMAIL::Column(function(){
                
            },"width:100%;");
        
            $html .= HTMLMAIL::Column(function(){
        
                return HTMLMAIL::AddRow(function(){
        
                    return HTMLMAIL::AddImage("https://dev.busman.com.mx//requisicion2/App/public/img/Logo-Blanco.png", "150");
        
                }, "width:100%;");
        
            },"width:100%;");
        
            return $html;
        
        }, 'background:rgb(0,92,192);');
        
        $renderhtml.= HTMLMAIL::AddBlock(function() use ($button_name, $title, $message, $url){
            
            $html = HTMLMAIL::Column(function() use ($button_name, $title, $message, $url){
                return HTMLMAIL::AddRow(function() use ($button_name, $title, $message, $url){
        
                    $mail =  HTMLMAIL::AddTitle($title, 'text-align:center; font-size:14px;');
                    $mail.= HTMLMAIL::AddParagraph($message, 'text-align:center; font-size:14px;');
                    $mail.=HTMLMAIL::AddButton($button_name, $url, "Background:rgb(0,92,192); color:white; text-align:center; font-size:12px; border-radius:5px;");
        
                    return $mail;
        
                },'width:90%; margin-left:20px; color:black;');
                
            },"width:100%; ");
            return $html;
        });
        
        
        $renderhtml.= HTMLMAIL::AddBlock(function(){
            
            $html = HTMLMAIL::Column(function(){
                // Primera columna para el logo o información adicional
                return HTMLMAIL::AddImage("https://dev.busman.com.mx/requisicion2/App/public/img/Logo.png", "100");
            },"width:30%;");
        
            $html .= HTMLMAIL::Column(function(){
                // Segunda columna para los enlaces o información de contacto
                $textos = ["Contacto:","Teléfono: 4626071753", "Correo electrónico: <a href='mailto:contacto@busman.com.mx'> contacto@busman.com.mx </a>"];
                $html = HTMLMAIL::ForIn($textos, HTMLMAIL::AddText("{item}","font-size:12px"));
                return $html;
            },"width:40%;");
        
            $html .= HTMLMAIL::Column(function(){
                // Tercera columna para los enlaces de redes sociales
                $html = HTMLMAIL::AddText("Redes Sociales", 'font-size: 12px;');
                $html .= HTMLMAIL::LinkImage("#","https://busman.com.mx//App/public/icon/fb.png","20");
                $html .= HTMLMAIL::LinkImage("#","https://busman.com.mx//App/public/icon/tw.png","20");
                $html .= HTMLMAIL::LinkImage("#","https://busman.com.mx//App/public/icon/link.png","20");
                return $html;
        
            },"width:30%;");
        
            return $html;
        
        }, 'background:#f2f2f2; padding:10px; text-align: center;');
        
        $renderhtml .= HTMLMAIL::AddBlock(function(){
            // Segundo bloque del footer, puede contener más información o enlaces adicionales
            $arreglo =["© 2023 Todos los derechos reservados.", "Este es un correo automático, por favor no responder."];
            $html = HTMLMAIL::ForIn($arreglo, HTMLMAIL::AddText("{item}", 'font-size: 10px; text-align:center;'));
            return $html;
        }, 'background:#e6e6e6; padding:5px; text-align: center; width:80%;');
        
        
        $htmlContent = HTMLMAIL::Render($renderhtml);
        mail($mailto,$title, $htmlContent, HTMLMAIL::getheaders());
    }

}

?>